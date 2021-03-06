<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Install extends BaseController
{
    public function __construct()
    {
        $this->google = new \Google_Client();;
        $this->google->setClientId('935030474584-ppg52lsgm2b3vmloph8okrbbdmu278b6.apps.googleusercontent.com');
        $this->google->setClientSecret('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');
        $this->google->addScope('email');
        $this->google->addScope('profile');
        $this->google->setRedirectUri(base_url('installadduser'));
        $this->logingoogle = $this->google->createAuthUrl();
    }
    public function index()
    {
        return view('install/beranda');
    }

    public function cekdb()
    {
        $result = false;
        $dbcek = $this->request->getVar('dbname');
        $usercek = $this->request->getVar('userdb');
        $passwordcek = $this->request->getVar('passworddb');
        $cekdb = [
            'DSN'      => '',
            'hostname' => 'localhost',
            'username' => $usercek,
            'password' => $passwordcek,
            'database' => $dbcek,
            'DBDriver' => 'MySQLi',
            'DBPrefix' => '',
            'pConnect' => false,
            'DBDebug'  => (ENVIRONMENT !== 'production'),
            'charset'  => 'utf8',
            'DBCollat' => 'utf8_general_ci',
            'swapPre'  => '',
            'encrypt'  => false,
            'compress' => false,
            'strictOn' => false,
            'failover' => [],
            'port'     => 3306,
        ];
        $dbte = \Config\Database::connect($cekdb);
        try {
            $dbtes = $dbte->persistentConnect()->ping();
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('koneksi_info', $e->getMessage());
            session()->setFlashdata('koneksi_status', 'Gagal terhubung ke database');
            return redirect()->to(base_url());
        }
        session()->setFlashdata('koneksi_status', 'Mantap, database terhubung');
        $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $url .= "://" . $_SERVER['HTTP_HOST'];
        $url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

        $oldenv = '# CI_ENVIRONMENT = production';
        $newenv = 'CI_ENVIRONMENT = development';
        $oldhost = '# database.default.hostname = localhost';
        $newhost = 'database.default.hostname = localhost';
        $olddb = '# database.default.database = ci4';
        $newdb = 'database.default.database = ' . $dbcek;
        $oldusr = '# database.default.username = root';
        $newusr = 'database.default.username = ' . $usercek;
        $oldpwd = '# database.default.password = root';
        $newpwd = 'database.default.password = ' . $passwordcek;
        $olddbdriver = '# database.default.DBDriver = MySQLi';
        $newdbdriver = 'database.default.DBDriver = MySQLi';
        $olddbprefix = '# database.default.DBPrefix =';
        $newdbprefix = 'database.default.DBPrefix =';
        $oldbase = "# app.baseURL = ''";
        $newbase = "app.baseURL = '" . $url . "'";
        $str = file_get_contents('../env');

        $str = str_replace($oldenv, $newenv, $str);
        $str = str_replace($oldbase, $newbase, $str);
        $str = str_replace($oldhost, $newhost, $str);
        $str = str_replace($olddb, $newdb, $str);
        $str = str_replace($oldusr, $newusr, $str);
        $str = str_replace($oldpwd, $newpwd, $str);
        $str = str_replace($olddbdriver, $newdbdriver, $str);
        $str = str_replace($olddbprefix, $newdbprefix, $str);

        file_put_contents('../.env', $str);

        $forge = \Config\Database::forge();
        $forge->dropTable('auth_activation_attempts', true, true);
        $forge->dropTable('auth_groups', true, true);
        $forge->dropTable('auth_groups_permissions', true, true);
        $forge->dropTable('auth_groups_users', true, true);
        $forge->dropTable('auth_logins', true, true);
        $forge->dropTable('auth_permissions', true, true);
        $forge->dropTable('auth_reset_attempts', true, true);
        $forge->dropTable('auth_tokens', true, true);
        $forge->dropTable('auth_users_permissions', true, true);
        $forge->dropTable('menu', true, true);
        $forge->dropTable('migrations', true, true);
        $forge->dropTable('order', true, true);
        $forge->dropTable('payment', true, true);
        $forge->dropTable('users', true, true);

        $migrate = \Config\Services::migrations();

        try {
            $migrate->latest();
        } catch (\Throwable $e) {
            die($e->getMessage());
        }

        return redirect()->to(base_url('adduser'));
    }

    public function adduser()
    {
        $data = [
            'logingoogle' => $this->logingoogle
        ];
        return view('install/adduser', $data);
    }

    public function padduser()
    {
        $token = $this->google->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        if (!isset($token['error'])) {
            $this->google->setAccessToken($token['access_token']);
            session()->set("AccessToken", $token['access_token']);

            $googleService = new \Google\Service\Oauth2($this->google);
            $data = $googleService->userinfo->get();
            $email = $data->email;
            $gambar = $data->picture;

            $adduser = new \App\Models\Userconf();
            $userdata = [
                'oauth_id' => $data->id,
                'name' => $data->name,
                'username' => 'admin',
                'email' => $email,
                'profile' => $gambar,
                'active' => 1,
                'force_pass_reset' => 0,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ];
            $adduser->save($userdata);

            $seeder = \Config\Database::seeder();
            $seeder->call('Dataawal');

            unlink('../app/Config/Routes.php');
            $routes = file_get_contents('../installer/Routes.php');
            file_put_contents('../app/Config/Routes.php', $routes);
            return redirect()->to(base_url('complete_install'));
        } else {
            session()->setFlashdata('gagal', [
                'pesan' => 'Gagal login.',
                'value' => 'Autentikasi google gagal'
            ]);
            return redirect()->to(base_url());
        }
    }
}
