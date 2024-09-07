<?php

namespace App\Controllers;

use App\Models\UserActivityModel;
use App\Models\MPE;
use App\Models\UserModel;

class ActivityLogController extends BaseController
{
    protected $userActivityModel;

    public function __construct()
    {
        $this->userActivityModel = new UserActivityModel();
    }

    public function filterActivities()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'log_activity'
            if (has_permission('log_activity')) {
                $model = new MPE();
                $where3 = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();

                $userModel = new UserModel(); // Pastikan model ini benar dan tersedia
                $data['users'] = $userModel->findAll();

                $id_user = $this->request->getVar('user_filter'); // Mengambil ID user dari filter form
                $data['activities'] = $userModel->getActivitiesByUser($id_user);

                // Menambahkan currentUserId ke data
                $data['currentUserId'] = session()->get('id'); // Sesuaikan dengan ID user saat ini

                echo view('header', $data);
                echo view('menu', $data);
                echo view('log_activity', $data);
                echo view('footer');
            } else {
                return redirect()->to('home/error');
            }
        } else {
            return redirect()->to('home/login');
        }
    }
}
