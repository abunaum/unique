<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Install extends BaseController
{
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
        $newenv = 'CI_ENVIRONMENT = production';
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
        //read the entire string
        $str = file_get_contents('../env');

        //replace something in the file string - this is a VERY simple example
        $str = str_replace($oldenv, $newenv, $str);
        $str = str_replace($oldbase, $newbase, $str);
        $str = str_replace($oldhost, $newhost, $str);
        $str = str_replace($olddb, $newdb, $str);
        $str = str_replace($oldusr, $newusr, $str);
        $str = str_replace($oldpwd, $newpwd, $str);
        $str = str_replace($olddbdriver, $newdbdriver, $str);
        $str = str_replace($olddbprefix, $newdbprefix, $str);

        //write the entire string
        file_put_contents('../.env', $str);

        unlink('../app/Config/Routes.php');
        $routes = '../installer/Routes.php';
        $newroutes = '../app/Config/Routes.php';

        if (!copy($routes, $newroutes)) {
            echo "failed to copy $routes...\n";
        }

        $migrate = \Config\Services::migrations();

        try {
            $migrate->latest();
        } catch (\Throwable $e) {
            die($e->getMessage());
        }
        $seeder = \Config\Database::seeder();
        $seeder->call('Dataawal');
        return redirect()->to(base_url());
    }
}
