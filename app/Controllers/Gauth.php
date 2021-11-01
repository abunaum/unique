<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Gauth extends BaseController
{
    public function __construct()
    {
        $this->google = new \Google_Client();;
        $this->google->setClientId('935030474584-ppg52lsgm2b3vmloph8okrbbdmu278b6.apps.googleusercontent.com');
        $this->google->setClientSecret('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');
        $this->google->setRedirectUri(base_url('authgoogle'));
        $this->google->addScope('email');
        $this->google->addScope('profile');
    }
    public function check()
    {
        $token = $this->google->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        if (!isset($token['error'])) {
            $this->google->setAccessToken($token['access_token']);
            session()->set("AccessToken", $token['access_token']);

            $googleService = new \Google\Service\Oauth2($this->google);
            $data = $googleService->userinfo->get();
            $email = $data->email;
            $gambar = $data->picture;
            $cekuser = $this->userconf->where('email', $email)->first();
            if ($cekuser) {
                $userupdate = [
                    'id' => $cekuser['id'],
                    'oauth_id' => $data->id,
                    'name' => $data->name,
                    'profile' => $gambar,
                ];
                $this->userconf->save($userupdate);
            } else {
                session()->setFlashdata('gagal', [
                    'pesan' => 'Gagal login.',
                    'value' => 'Akun anda tidak terdaftar'
                ]);
                return redirect()->to(base_url('login'));
            }
            $newc = new \App\Models\Userconf();
            $ceklagi = $newc->where('email', $email)->first();
            session()->set('logged_in', $ceklagi['id']);
            return redirect()->to(base_url('cekrole'));
        } else {
            session()->setFlashdata('gagal', [
                'pesan' => 'Gagal login.',
                'value' => 'Autentikasi google gagal'
            ]);
            return redirect()->to(base_url('login'));
        }
    }

    public function cekrole()
    {
        if (logged_in() == true) {
            if (in_groups('admin')) {
                return redirect()->to(base_url('admin'));
            } else {
                return redirect()->to(base_url('seller'));
            }
        } else {
            return redirect()->to(base_url('login'));
        }
    }
}
