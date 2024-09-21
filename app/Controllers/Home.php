<?php

namespace App\Controllers;

use App\Models\MPE;
use App\Models\LevelPermissionModel;
use App\Models\UserActivityModel;
use TCPDF;

class Home extends BaseController
{
    protected $db;
    protected $userActivityModel;
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->userActivityModel = new UserActivityModel();
    }

    public function index()
    {
        return view('welcome_message');
    }

    public function dashboard()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('dashboard')) {
                $this->logUserActivity('Masuk ke Dashboard');

                $model = new MPE();
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
                helper('permission'); // Pastikan helper dimuat

                echo view('header', $data);
                echo view('menu', $data);
                echo view('dashboard', $data);
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }
    public function logout()

    {
        session()->destroy();
        return redirect()->to('home/login');
    }
    public function login()
    {
        $model = new MPE();
        $where = array('id_setting' => '1');
        $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

        echo view('header', $data);
        echo view('login', $data);
    }
    public function aksi_login()
    {
        $od = $this->request->getPost('username');
        $tgl = $this->request->getPost('password');

        $captcha_response = $this->request->getPost('g-recaptcha-response');
        $backup_captcha = $this->request->getPost('backup_captcha');

        if (empty($captcha_response) && empty($backup_captcha)) {
            return redirect()->to('home/login')->with('error', 'CAPTCHA is required.');
        }

        // Validate reCAPTCHA
        if (!empty($captcha_response)) {
            $secret_key = '6LeWmSUqAAAAAK4S-ldt-C6V66shotK8rUTXk25M';
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$captcha_response");
            $response_keys = json_decode($response, true);

            if (intval($response_keys["success"]) !== 1) {
                return redirect()->to('home/login')->with('error', 'reCAPTCHA validation failed.');
            }
        }

        // Validate offline CAPTCHA
        if (!empty($backup_captcha)) {
            // Validate the backup CAPTCHA here (e.g., by checking against a stored value or a generated value)
            // Assuming validateOfflineCaptcha is a method that verifies the backup CAPTCHA
            if (!$this->validateOfflineCaptcha($backup_captcha)) {
                return redirect()->to('home/login')->with('error', 'Offline CAPTCHA validation failed.');
            }
        }

        $where = array(
            'username' => $od,
            'password' => md5($tgl),
        );

        $model = new MPE();
        $check = $model->getWhere('user', $where);

        if ($check > 0) {
            session()->set('username', $check->username);
            session()->set('id', $check->id_user);
            session()->set('level', $check->level);

            return redirect()->to('home/dashboard');
        } else {
            return redirect()->to('home/login')->with('error', 'Invalid username or password.');
        }
    }

    private function validateOfflineCaptcha($captchaInput)
    {
        // Ambil CAPTCHA yang disimpan di session
        $storedCaptcha = session()->get('captcha_code');

        // Bandingkan input pengguna dengan CAPTCHA yang disimpan (peka huruf besar/kecil)
        return $captchaInput === $storedCaptcha;
    }
    public function generateCaptcha()
    {
        $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

        // Store the CAPTCHA code in the session
        session()->set('captcha_code', $code);

        // Generate the image
        $image = imagecreatetruecolor(120, 40);
        $bgColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);

        imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);
        imagestring($image, 5, 10, 10, $code, $textColor);

        // Set the content type header - in this case image/png
        header('Content-Type: image/png');

        // Output the image
        imagepng($image);

        // Free up memory
        imagedestroy($image);
    }


    public function register()

    {
        $model = new MPE;
        $where = array('id_setting' => '1');
        $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
        echo view('register', $data);
    }
    public function aksi_t_user()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        // $email = $this->request->getPost('nis');
        // $alamat = $this->request->getPost('kelas');
        // $nohp = $this->request->getPost('jurusan');

        // Default foto jika tidak ada yang diupload
        $foto = '1725288159_5695430fa933ee820f22.jpg';

        // Cek jika ada file yang diupload
        $file = $this->request->getFile('foto');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Generate nama file yang unik
            $newName = $file->getRandomName();
            // Pindahkan file ke folder public/images
            $file->move(ROOTPATH . 'public/img', $newName);
            // Set foto dengan nama file yang diupload
            $foto = $newName;
        }

        $data = array(
            'username' => $username,
            'password' => md5($password),
            'level' => 'Pembimbing',
            // 'nis' => $email,
            // 'kelas' => $alamat,
            // 'jurusan' => $nohp,
            'foto' => $foto
        );

        $model = new MPE();
        $model->tambah('user', $data);
        return redirect()->to('home/login');
    }


    public function data()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('data')) {
                $this->logUserActivity('Masuk ke Data Alamat PKL');

                $model = new MPE();
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
                // Ambil filter dari input form
                $nis = $this->request->getVar('nis');
                $kelas = $this->request->getVar('kelas');
                $jurusan = $this->request->getVar('jurusan');

                // Ambil data berdasarkan filter
                $data['data'] = $model->getFilteredData($nis, $kelas, $jurusan);

                // Kirimkan filter yang digunakan ke view
                $data['nis'] = $nis;
                $data['kelas'] = $kelas;
                $data['jurusan'] = $jurusan;

                echo view('header', $data);
                echo view('menu', $data);
                echo view('data', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }

    public function terima($id)
    {
        $model = new MPE();
        $this->logUserActivity('Menerima PKL Murid');

        $where = array('id' => $id);
        $array = array(
            'persetujuan' => 'Setuju',
        );
        $model->edit('lokasi', $array, $where);
        return redirect()->to('Home/data');
    }

    public function tolak($id)
    {
        $model = new MPE();
        $this->logUserActivity('Menerima PKL Murid');

        $where = array('id' => $id);
        $array = array(
            'persetujuan' => 'Tidak Setuju',
        );
        $model->edit('lokasi', $array, $where);
        return redirect()->to('Home/data');
    }

    public function input_alamat()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('input_alamat')) {
                $this->logUserActivity('Masuk ke Input Alamat PKL');

                $model = new MPE();
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();  // Pastikan getWhere1() ada di model
                $id_user = session()->get('id');

                $data['data'] = $model->joinFilterByMurid(
                    'lokasi',          // tabel1
                    'user',            // tabel2
                    'lokasi.id_user = user.id_user', // on1
                    $id_user           // Filter berdasarkan id_user
                );

                echo view('header', $data);
                echo view('menu', $data);
                echo view('input_alamat', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }

    public function simpan_lokasi()
    {
        $this->logUserActivity('Menyimpan Lokasi');

        $db = \Config\Database::connect();
        $builder = $db->table('lokasi');
        $backupBuilder = $db->table('lokasi_backup');
        $ptBuilder = $db->table('pt');

        if ($this->request->getPost()) {
            $id_user = session()->get('id');

            // Log data yang diterima dari form
            log_message('debug', 'Data dari form: ' . json_encode($this->request->getPost()));

            // Cek apakah user sudah pernah menginput lokasi
            $existingLocation = $builder->getWhere(['id_user' => $id_user])->getRow();

            // Data yang akan disimpan atau diperbarui
            $data = [
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude'),
                'address' => $this->request->getPost('address'),
                'persetujuan' => 'Tidak Setuju',
                'id_user' => $id_user,
            ];

            // Validasi data
            if (empty($data['latitude']) || empty($data['longitude']) || empty($data['address'])) {
                log_message('error', 'Data tidak lengkap: ' . json_encode($data));
                return redirect()->to('/home/input_alamat')->with('error', 'Data lokasi tidak lengkap. Silakan isi semua field.');
            }

            try {
                if ($existingLocation) {
                    // Kode untuk update lokasi (tidak diubah)
                } else {
                    // Jika belum ada lokasi, simpan lokasi baru
                    $db->transStart(); // Start transaction

                    $result = $builder->insert($data);

                    if ($result) {
                        $lokasiId = $db->insertID();
                        $id_user = session()->get('id');

                        // Insert ke table pt
                        $ptData = [
                            'id' => $lokasiId, // Menggunakan ID yang sama dengan table lokasi
                            'id_user' => $id_user,
                        ];

                        $ptResult = $ptBuilder->insert($ptData);

                        if ($ptResult) {
                            $db->transCommit(); // Commit transaction
                            log_message('info', 'Lokasi dan PT berhasil disimpan. Data Lokasi: ' . json_encode($data) . ', Data PT: ' . json_encode($ptData));
                            return redirect()->to('/home/input_alamat')->with('message', 'Lokasi dan PT berhasil disimpan.');
                        } else {
                            $db->transRollback(); // Rollback transaction
                            log_message('error', 'Gagal menyimpan PT. Data PT: ' . json_encode($ptData));
                            log_message('error', 'Database Error PT: ' . print_r($db->error(), true));
                            return redirect()->to('/home/input_alamat')->with('error', 'Gagal menyimpan PT. Silakan coba lagi.');
                        }
                    } else {
                        $db->transRollback(); // Rollback transaction
                        // Log error detail dari database
                        log_message('error', 'Gagal menyimpan lokasi. Data: ' . json_encode($data));
                        log_message('error', 'Database Error: ' . print_r($db->error(), true));

                        // Cek apakah ada error spesifik dari database
                        $db_error = $db->error();
                        if (!empty($db_error['message'])) {
                            log_message('error', 'Pesan error database: ' . $db_error['message']);
                            return redirect()->to('/home/input_alamat')->with('error', 'Gagal menyimpan lokasi: ' . $db_error['message']);
                        } else {
                            return redirect()->to('/home/input_alamat')->with('error', 'Gagal menyimpan lokasi. Silakan coba lagi.');
                        }
                    }
                }
            } catch (\Exception $e) {
                $db->transRollback(); // Rollback transaction
                log_message('error', 'Exception saat menyimpan lokasi dan PT: ' . $e->getMessage());
                log_message('error', 'Stack trace: ' . $e->getTraceAsString());
                return redirect()->to('/home/input_alamat')->with('error', 'Terjadi kesalahan saat menyimpan lokasi dan PT: ' . $e->getMessage());
            }
        }

        // Default response jika tidak ada post request
        return redirect()->to('/home/input_alamat');
    }



    public function hapus_lokasi($id)
    {
        $model = new MPE();
        $this->logUserActivity('Menghapus Lokasi');

        $where = array('id' => $id);
        $array = array(
            'delete_at' => date('Y-m-d H:i:s'),
        );
        $model->edit('lokasi', $array, $where);

        $array2 = array(
            'delete_at' => date('Y-m-d H:i:s'),
        );
        $model->edit('pt', $array2, $where);
        return redirect()->to('Home/input_alamat');
    }






    public function setting()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('setting')) {
                $this->logUserActivity('Masuk ke Setting');

                $model = new MPE;
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
                echo view('header', $data);
                echo view('menu', $data);
                echo view('setting', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }

    public function aksi_e_setting()
    {
        $model = new MPE();
        $this->logUserActivity('Melakukan Setting');

        $namaWebsite = $this->request->getPost('namawebsite');
        $id = $this->request->getPost('id');
        $id_user = session()->get('id');
        $where = array('id_setting' => '1');

        $data = array(
            'nama_website' => $namaWebsite,
            'update_by' => $id_user,
            'update_at' => date('Y-m-d H:i:s')
        );

        // Cek apakah ada file yang diupload untuk favicon
        $favicon = $this->request->getFile('img');
        if ($favicon && $favicon->isValid() && !$favicon->hasMoved()) {
            // Beri nama file unik
            $faviconNewName = $favicon->getRandomName();
            // Pindahkan file ke direktori public/images
            $favicon->move(WRITEPATH . '../public/images', $faviconNewName);

            // Tambahkan nama file ke dalam array data
            $data['tab_icon'] = $faviconNewName;
        }

        // Cek apakah ada file yang diupload untuk logo
        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            // Beri nama file unik
            $logoNewName = $logo->getRandomName();
            // Pindahkan file ke direktori public/images
            $logo->move(WRITEPATH . '../public/images', $logoNewName);

            // Tambahkan nama file ke dalam array data
            $data['logo_website'] = $logoNewName;
        }

        // Cek apakah ada file yang diupload untuk logo
        $login = $this->request->getFile('login');
        if ($login && $login->isValid() && !$login->hasMoved()) {
            // Beri nama file unik
            $loginNewName = $login->getRandomName();
            // Pindahkan file ke direktori public/images
            $login->move(WRITEPATH . '../public/images', $loginNewName);

            // Tambahkan nama file ke dalam array data
            $data['login_icon'] = $loginNewName;
        }

        $model->edit('setting', $data, $where);

        // Optionally set a flash message here
        return redirect()->to('home/setting');
    }



    public function user()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('user')) {
                // Cek apakah user memiliki hak akses untuk 'pemesanan'
                $model = new MPE;
                $this->logUserActivity('Masuk ke User');

                $where3 = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();
                $data['yoga'] = $model->tampil('user');
                echo view('header', $data);
                echo view('menu', $data);
                echo view('user', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }
    public function t_user()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat
            $this->logUserActivity('Masuk ke Tanbah User');

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('user')) {
                // Cek apakah user memiliki hak akses untuk 'pemesanan'
                $model = new MPE;
                $where3 = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();
                $data['yoga'] = $model->getEnumValues('user', 'level');

                echo view('header', $data);
                echo view('menu', $data);
                echo view('t_user', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }
    public function aksi_t_user2()
    {
        $this->logUserActivity('Menambah User');

        $yoga = $this->request->getPost('username');
        $cahya = $this->request->getPost('password');
        $level = $this->request->getPost('level');

        $darren = array(
            'username' => $yoga,
            'password' => md5($cahya),
            'level' => $level,

        );
        $model = new MPE;
        $model->tambah('user', $darren);
        return redirect()->to('home/user');
    }
    public function t_murid()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat
            $this->logUserActivity('Masuk ke Tanbah User');

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('user')) {
                // Cek apakah user memiliki hak akses untuk 'pemesanan'
                $model = new MPE;
                $where3 = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();

                echo view('header', $data);
                echo view('menu', $data);
                echo view('t_murid', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }
    public function aksi_t_murid()
    {
        $this->logUserActivity('Menambah User');

        $yoga = $this->request->getPost('username');
        $cahya = $this->request->getPost('password');
        $nis = $this->request->getPost('nis');
        $kelas = $this->request->getPost('kelas');
        $jurusan = $this->request->getPost('jurusan');

        $darren = array(
            'username' => $yoga,
            'password' => md5($cahya),
            'level' => 'Murid',
            'nis' => $nis,
            'kelas' => $kelas,
            'jurusan' => $jurusan,

        );
        $model = new MPE;
        $model->tambah('user', $darren);
        return redirect()->to('home/user');
    }
    public function detail_user($id)
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('user')) {

                $model = new MPE;
                $this->logUserActivity('Melihat ke Detail User');

                $where3 = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();
                $where3 = array('id_user' => $id);
                $data['dua'] = $model->getWhere1('user', $where3)->getRow();
                $data['yoga2'] = $model->tampil('user'); // Data for levels, if needed
                $data['yoga'] = $model->getEnumValues('user', 'level');

                echo view('header', $data);
                echo view('menu', $data);
                echo view('detail_user', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }

    public function aksi_e_user()
    {
        if (session()->get('id') > 0) {
            $model = new MPE();
            $this->logUserActivity('Mengedit User');

            $yoga = $this->request->getPost('username');
            $a = $this->request->getPost('nis');
            $b = $this->request->getPost('kelas');
            $c = $this->request->getPost('jurusan');
            $yoga1 = $this->request->getPost('level');

            $id = $this->request->getPost('id'); // Pastikan nama parameter sesuai

            $where = array('id_user' => $id);

            $isi = array(
                'username' => $yoga,
                'nis' => $a,
                'kelas' => $b,
                'jurusan' => $c,
                'level' => $yoga1,

            );

            $model->edit('user', $isi, $where);

            return redirect()->to('home/user');
        } else {
            return redirect()->to('home/login');
        }
    }

    public function hapus_user($id)
    {
        $this->logUserActivity('Menghapus User');

        $model = new MPE();
        $where = array('id_user' => $id);
        $model->hapus('user', $where);

        return redirect()->to('Home/user');
    }
    public function resetpassword($id)
    {
        $this->logUserActivity('Mereset Password');

        $model = new MPE();
        $model->resetPassword($id);
        return redirect()->to('home/user');
    }



    public function level()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('level')) {
                $this->logUserActivity('Masuk ke Permissions');

                // Cek apakah user memiliki hak akses untuk 'pemesanan'
                $model = new MPE();
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
                helper('permission');

                echo view('header', $data);
                echo view('menu', $data);
                echo view('permission', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }
    public function hak_akses($level)
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('level')) {
                $this->logUserActivity('Masuk ke Hak Akses');

                // Cek apakah user memiliki hak akses untuk 'pemesanan'
                $model = new MPE();
                $where = array('id_setting' => '1');
                $data2['yogi'] = $model->getWhere1('setting', $where)->getRow();

                $permissionModel = new LevelPermissionModel();
                $permissions = $permissionModel->getPermissionsByLevel($level);

                $data = [
                    'level' => $level,
                    'permissions' => $permissions,
                ];

                echo view('header', $data2);
                echo view('menu', $data2);
                echo view('hak_akses', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }

    public function update_hak_akses($level)
    {
        $this->logUserActivity('Mengupdate Hak Akses');

        $permissions = $this->request->getPost('permissions');

        $permissionModel = new LevelPermissionModel();
        $permissionModel->updatePermissionsByLevel($level, $permissions);

        return redirect()->to('home/hak_akses/' . $level);
    }



    public function restore_data()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('restore_data')) {
                $this->logUserActivity('Masuk Ke Restore Data');

                $model = new MPE;
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
                $id_user = session()->get('id');

                $data['data'] = $model->joinFilterByUser2(
                    'lokasi',          // tabel1
                    'user',            // tabel2
                    'lokasi.id_user = user.id_user', // on1

                );
                echo view('header', $data);
                echo view('menu', $data);
                echo view('restore_data', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }

    public function restore($id)
    {
        $this->logUserActivity('Merestore Data');

        $model = new MPE();
        $where = array('id' => $id);
        $array = array(
            'delete_at' => null,
        );
        $model->edit('lokasi', $array, $where);
        $array2 = array(
            'delete_at' => null,
        );
        $model->edit('pt', $array2, $where);
        return redirect()->to('Home/restore_data');
    }

    public function restore_edit()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('restore_edit')) {
                $this->logUserActivity('Masuk ke Restore Edit');

                $model = new MPE;
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
                $id_user = session()->get('id');

                $data['data'] = $model->joinFilterByUser3(
                    'lokasi_backup',          // tabel1
                    'user',            // tabel2
                    'lokasi_backup.id_user = user.id_user', // on1

                );
                echo view('header', $data);
                echo view('menu', $data);
                echo view('restore_edit', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }

    public function restoreLokasi($id)
    {
        $this->logUserActivity('Merestore Data Edit');

        $db = \Config\Database::connect();

        try {
            // Ambil data dari lokasi_backup berdasarkan id
            $builderBackup = $db->table('lokasi_backup');
            $dataBackup = $builderBackup->getWhere(['id' => $id])->getRowArray();

            if (!$dataBackup) {
                throw new \Exception("Tidak ada data yang ditemukan di lokasi_backup untuk user dengan ID: $id.");
            }

            // Siapkan data untuk mengupdate tabel lokasi
            $dataLokasi = [
                'latitude' => $dataBackup['latitude'],
                'longitude' => $dataBackup['longitude'],
                'address' => $dataBackup['address'],
                'update_by' => $dataBackup['update_by'],
                'update_at' => $dataBackup['update_at']
            ];

            // Update data di tabel lokasi berdasarkan id_user
            $builderLokasi = $db->table('lokasi');
            $builderLokasi->where('id_user', $dataBackup['id_user']);
            $builderLokasi->update($dataLokasi);

            // Hapus data dari lokasi_backup setelah berhasil dipindahkan
            $builderBackup->where('id', $id)->delete();

            return redirect()->to('home/restore_edit')->with('message', 'Data berhasil direstore.');
        } catch (\Exception $e) {
            // Tangkap dan tampilkan error
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    private function logUserActivity($menu)
    {
        $id_user = session()->get('id');

        if ($id_user === null) {
            echo "ID pengguna tidak ditemukan dalam session.";
            return;
        }

        // Cek apakah data dengan ID dan menu yang sama sudah ada
        $existingActivity = $this->userActivityModel->where('id_user', $id_user)
            ->where('menu', $menu)
            ->first();
        if ($existingActivity) {
            return; // Jika sudah ada, jangan simpan lagi
        }

        $result = $this->userActivityModel->save([
            'id_user' => $id_user,
            'menu' => $menu,
        ]);
    }



    public function profile()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            $model = new MPE();
            $this->logUserActivity('Masuk ke profile');
            $where3 = array('id_setting' => '1');
            $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();

            $where = array('id_user' => session()->get('id'));
            $data['darren'] = $model->getwhere('user', $where);

            echo view('header', $data);
            echo view('menu', $data);
            echo view('profile', $data);
            echo view('footer');
        } else {
            return redirect()->to('home/login');
        }
    }
    public function editfoto()
    {
        $model = new MPE();
        $this->logUserActivity('Mengedit Foto');
        $userData = $model->getById(session()->get('id'));

        if ($this->request->getFile('foto')) {

            $file = $this->request->getFile('foto');
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/img', $newFileName);

            if ($userData->foto && file_exists(ROOTPATH . 'public/img/' . $userData->foto)) {
                unlink(ROOTPATH . 'public/img/' . $userData->foto);
            }
            $userId = ['id_user' => session()->get('id')];
            $userData = ['foto' => $newFileName];
            $model->edit('user', $userData, $userId);
        }
        return redirect()->to('home/profile');
    }
    public function aksi_e_profile()
    {
        if (session()->get('id') > 0) {
            $model = new MPE();
            $this->logUserActivity('Mengedit Profile');
            $yoga = $this->request->getPost('username');
            $yoga1 = $this->request->getPost('nis');
            $yoga2 = $this->request->getPost('kelas');
            $yoga3 = $this->request->getPost('jurusan');
            $id = $this->request->getPost('id');

            $where = array('id_user' => $id); // Jika id_user adalah kunci utama untuk menentukan record


            $isi = array(
                'username' => $yoga,
                'nis' => $yoga1,
                'kelas' => $yoga2,
                'jurusan' => $yoga2,
            );

            $model->edit('user', $isi, $where);
            return redirect()->to('home/profile');
            // print_r($yoga);
            // print_r($id);
        } else {
            return redirect()->to('home/login');
        }
    }
    public function changepassword()
    {
        if (session()->get('id') > 0) {

            $model = new MPE();
            $this->logUserActivity('Mengubah Password');
            $where3 = array('id_setting' => '1');
            $data['yogi'] = $model->getWhere1('setting', $where3)->getRow();
            $where = array('id_user' => session()->get('id'));
            $data['darren'] = $model->getwhere('user', $where);
            helper('permission'); // Pastikan helper dimuat

            echo view('header', $data);
            echo view('menu', $data);
            echo view('changepassword', $data);
            echo view('footer');
        } else {
            return redirect()->to('home/login');
        }
    }
    public function aksi_changepass()
    {
        $model = new MPE();
        $oldPassword = $this->request->getPost('old');
        $newPassword = $this->request->getPost('new');
        $userId = session()->get('id');

        // Dapatkan password lama dari database
        $currentPassword = $model->getPassword($userId);

        // Verifikasi apakah password lama cocok
        if (md5($oldPassword) !== $currentPassword) {
            // Set pesan error jika password lama salah
            session()->setFlashdata('error', 'Password lama tidak valid.');
            return redirect()->back()->withInput();
        }

        // Update password baru
        $data = [
            'password' => md5($newPassword),
            'update_by' => $userId,
            'update_at' => date('Y-m-d H:i:s')
        ];
        $where = ['id_user' => $userId];

        $model->edit('user', $data, $where);

        // Set pesan sukses
        session()->setFlashdata('success', 'Password berhasil diperbarui.');
        return redirect()->to('home/changepassword');
    }


    // Controller AGENDA PKL
    public function agenda($id = null)
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('agenda')) {
                $this->logUserActivity('Masuk ke Agenda');

                $model = new MPE();
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
                $id_user = session()->get('id');
                $data['pt'] = $model->join3tbl('pt', 'lokasi', 'user', 'pt.id = lokasi.id', 'pt.id_user = user.id_user', $id_user);

                // Tentukan hari default
                $selectedDay = $this->request->getGet('hari') ?: 1;
                $data['selectedDay'] = $selectedDay;

                // Pastikan $id adalah hari yang valid
                $day = $id ? intval($id) : $selectedDay;
                $where = array('hari' => $day);

                // Mengambil data agenda berdasarkan hari yang dipilih
                $agenda = $model->getWhereUser('agenda', $where, $id_user);
                $agenda2 = $model->getWhereUser2('agenda', $id_user);
                $agenda3 = $model->getWhereUser3('agenda', $id_user);
                // Membuat objek kosong untuk agenda
                $emptyAgenda = (object) [
                    'tanggal' => '',
                    'jam_masuk' => '',
                    'jam_pulang' => '',
                    'rencana' => '',
                    'realisasi' => '',
                    'penugasan' => '',
                    'masalah' => '',
                    'keramahan' => '',
                    'penampilan' => '',
                    'senyum' => '',
                    'komunikasi' => '',
                    'realisasi_kerja' => '',
                    'catatan_kerja' => '',
                    'persetujuan_pkl' => '',
                    'persetujuan_pembimbing' => '',
                    'absen' => '',
                    'absen_jumat' => ''
                ];

                // Jika tidak ada data, gunakan objek kosong
                $data['agenda'] = $agenda ?? $emptyAgenda;
                $data['agenda2'] = $agenda2 ?? $emptyAgenda;
                $data['agenda3'] = $agenda3 ?? $emptyAgenda;

                echo view('header', $data);
                echo view('menu', $data);
                echo view('agenda', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }


    public function hapus_agenda($id = null)
    {
        $model = new MPE();
        $this->logUserActivity('Menghapus Agenda');
        // Tentukan hari default
        $selectedDay = $this->request->getGet('hari') ?: 1;
        $data['selectedDay'] = $selectedDay;

        // Pastikan $id adalah hari yang valid
        $day = $id ? intval($id) : $selectedDay;
        $where = array('hari' => $day);

        $id_user = session()->get('id');

        $model->hapus2('agenda', $where, $id_user);
        return redirect()->to('Home/agenda');
    }



    public function aksi_e_datapt()
    {
        $this->logUserActivity('Mengedit Data PT');
        $a = $this->request->getPost('namaPT');
        $b = $this->request->getPost('nomorPT');
        $id = session()->get('id');
        $where = array('id_user' => $id);

        $array = array(

            'nama_pt' => $a,
            'nomor_pt' => $b,
        );

        $model = new MPE();
        var_dump($array);
        $model->edit('pt', $array, $where);
        return redirect()->to('home/agenda');
    }

    public function aksi_t_agenda()
    {
        $this->logUserActivity('Menambah Agenda Harian PT');
        $a = $this->request->getPost('tanggal');
        $b = $this->request->getPost('jam_masuk');
        $c = $this->request->getPost('jam_pulang');
        $d = $this->request->getPost('rencana');
        $e = $this->request->getPost('realisasi');
        $f = $this->request->getPost('penugasan');
        $g = $this->request->getPost('masalah');
        $h = $this->request->getPost('keramahan');
        $i = $this->request->getPost('penampilan');
        $j = $this->request->getPost('senyum');
        $k = $this->request->getPost('komunikasi');
        $l = $this->request->getPost('realisasi_kerja');
        $m = $this->request->getPost('catatan_kerja');
        $n = $this->request->getPost('hari');
        $o = $this->request->getPost('absen');
        $id = session()->get('id');
        $where = array('id_user' => $id);

        $model = new MPE();

        // Periksa apakah ada data untuk hari dan user yang sama
        $existingData = $model->getWhereUser('agenda', ['hari' => $n, 'id_user' => $id], $id);

        $array = array(

            'tanggal' => $a,
            'jam_masuk' => $b,
            'jam_pulang' => $c,
            'rencana' => $d,
            'realisasi' => $e,
            'penugasan' => $f,
            'masalah' => $g,
            'keramahan' => $h,
            'penampilan' => $i,
            'senyum' => $j,
            'komunikasi' => $k,
            'realisasi_kerja' => $l,
            'catatan_kerja' => $m,
            'hari' => $n,
            'id_user' => $id,
            'persetujuan_pkl' => 'Belum Disetujui',
            'persetujuan_pembimbing' => 'Belum Disetujui',
            'absen' => $o,
        );


        // Jika data ada, lakukan update, jika tidak, lakukan insert
        if (!empty($existingData)) {
            // Update data yang sudah ada
            $model->updateWhere('agenda', $array, ['hari' => $n, 'id_user' => $id]);
            $this->logUserActivity('Mengedit Agenda Harian PT');
        } else {
            // Tambah data baru
            $model->tambah('agenda', $array);
            $this->logUserActivity('Menambah Agenda Harian PT');
        }


        return redirect()->back()->with('success', 'Agenda berhasil disetujui.');
    }



    public function pemilihan()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('pemilihan')) {
                $this->logUserActivity('Masuk ke Pemilihan Pembimbing');

                $model = new MPE();
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
                $id_user = session()->get('id');
                $data['data'] = $model->db->table('pt')
                    ->join('lokasi', 'pt.id = lokasi.id')
                    ->join('user AS murid', 'pt.id_user = murid.id_user')
                    ->join('user AS pembimbing', 'murid.pembimbing = pembimbing.id_user', 'left')  // Join untuk pembimbing
                    ->select('murid.username as murid_name, murid.kelas, murid.jurusan, lokasi.address, murid.nis, pt.nama_pt, pembimbing.username as pembimbing_name, murid.id_user AS murid_id_user, pembimbing.id_user')
                    ->get()
                    ->getResult();

                $data['guru'] = $model->tampilWhere2('user', 'Guru');


                echo view('header', $data);
                echo view('menu', $data);
                echo view('pemilihan', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }


    public function updatePembimbing()
    {
        $guru_id = $this->request->getPost('guru_id');
        $murid_ids = $this->request->getPost('approval');

        $model = new MPE();

        if ($murid_ids && $guru_id) {
            foreach ($murid_ids as $murid_id) {
                // Update kolom 'pembimbing' di tabel users
                $array = ['pembimbing' => $guru_id];
                $where = ['id_user' => $murid_id];
                $model->edit('user', $array, $where);
            }
        }

        return redirect()->to('home/pemilihan')->with('message', 'Pembimbing berhasil diatur');
    }

    public function surat($lokasiId)
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            require_once ROOTPATH . 'vendor\tecnickcom\tcpdf\tcpdf.php';
            $model = new MPE();
            $this->logUserActivity('Melihat Surat PDF');
            // $id_user = session()->get('id');
            $where = array('id' => $lokasiId);
            $data['data'] =  $model->getPtUserLokasi($lokasiId)->getResult();
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Your Title');
            $pdf->SetSubject('Your Subject');
            $pdf->SetKeywords('Your Keywords');
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            // Add a page
            $pdf->AddPage();


            // Set some content to print
            $html = view('surat', $data); // Ganti 'your_pdf_view' dengan nama view Anda

            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('Surat_PKL.pdf', 'I');
            exit();
        } else {
            return redirect()->to('home/login');
        }
    }

    public function murid()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('murid')) {
                $this->logUserActivity('Masuk ke Pemilihan Murid');

                $model = new MPE();
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
                $id_user = session()->get('id');
                $data['data'] = $model->db->table('pt')
                    ->join('lokasi', 'pt.id = lokasi.id')
                    ->join('user AS murid', 'pt.id_user = murid.id_user')
                    ->join('user AS pembimbing', 'murid.pembimbing = pembimbing.id_user', 'inner')  // Join untuk pembimbing
                    ->select('murid.username as murid_name, murid.kelas, murid.jurusan, lokasi.address, murid.nis, pt.nama_pt, pembimbing.username as pembimbing_name, murid.id_user AS murid_id_user, pembimbing.id_user')
                    ->where('murid.pembimbing_pkl', $id_user)
                    ->get()
                    ->getResult();

                // $data['guru'] = $model->tampilWhere2('user', 'Murid');
                $data['murid'] = $model->db->table('pt')
                    ->join('lokasi', 'pt.id = lokasi.id')
                    ->join('user AS murid', 'pt.id_user = murid.id_user')
                    ->join('user AS pembimbing', 'murid.pembimbing = pembimbing.id_user', 'left')  // Join untuk pembimbing
                    ->select('murid.username as murid_name, murid.kelas, murid.jurusan, lokasi.address, murid.nis, pt.nama_pt, pembimbing.username as pembimbing_name, murid.id_user AS murid_id_user, pembimbing.id_user, murid.level')
                    ->where('murid.level', 'Murid')
                    ->get()
                    ->getResult();

                echo view('header', $data);
                echo view('menu', $data);
                echo view('murid', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }

    public function updatePembimbing_pkl()
    {
        // Mengambil data 'approval' yang merupakan array berisi ID murid yang dipilih
        $murid_ids = $this->request->getPost('approval');
        $id_user = session()->get('id');
        $model = new MPE();

        // Pastikan bahwa $murid_ids adalah array sebelum membangun query
        if (is_array($murid_ids) && count($murid_ids) > 0) {
            // Gunakan klausa 'IN' untuk memperbarui beberapa murid
            $model->db->table('user')
                ->whereIn('id_user', $murid_ids)  // Menggunakan klausa 'IN'
                ->update(['pembimbing_pkl' => $id_user]);  // Mengupdate kolom 'pembimbing_pkl' dengan id_user pembimbing saat ini
        }

        // Redirect ke halaman murid setelah proses update
        return redirect()->to('home/murid');
    }

    public function hapusPembimbing_pkl($id)
    {
        $model = new MPE();

        $where = array('id_user' => $id);
        $array = array(
            'pembimbing_pkl' => null,
        );
        $model->edit('user', $array, $where);

        return redirect()->to('home/murid');
    }

    public function agenda_murid($id)
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('agenda_murid')) {
                $this->logUserActivity('Masuk ke Agenda Murid');

                $model = new MPE();
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();

                // Ambil id_user dari parameter $id, yang dikirim melalui URL
                $id_user = $id;  // $id berasal dari URL

                // Query untuk mendapatkan data dengan id_user dari URL
                $data['pt'] = $model->join3tbl('pt', 'lokasi', 'user', 'pt.id = lokasi.id', 'pt.id_user = user.id_user', $id_user);

                // Tentukan hari default
                $selectedDay = $this->request->getGet('hari') ?: 1;
                $data['selectedDay'] = $selectedDay;

                // Pastikan $id adalah hari yang valid
                $day = $this->request->getGet('hari') ?: 1;
                $where = array('hari' => $day);

                // Mengambil data agenda berdasarkan hari yang dipilih dan id_user
                $agenda = $model->getWhereUser('agenda', $where, $id_user);
                $agenda2 = $model->getWhereUser2('agenda', $id_user);
                $agenda3 = $model->getWhereUser3('agenda', $id_user);
                // Membuat objek kosong untuk agenda
                $emptyAgenda = (object) [
                    'tanggal' => '',
                    'jam_masuk' => '',
                    'jam_pulang' => '',
                    'rencana' => '',
                    'realisasi' => '',
                    'penugasan' => '',
                    'masalah' => '',
                    'keramahan' => '',
                    'penampilan' => '',
                    'senyum' => '',
                    'komunikasi' => '',
                    'realisasi_kerja' => '',
                    'catatan_kerja' => '',
                    'persetujuan_pkl' => '',
                    'persetujuan_pembimbing' => '',
                    'absen' => '',
                    'absen_jumat' => ''
                ];

                // Jika tidak ada data, gunakan objek kosong
                $data['agenda'] = $agenda ?? $emptyAgenda;
                $data['agenda2'] = $agenda2 ?? $emptyAgenda;
                $data['agenda3'] = $agenda3 ?? $emptyAgenda;

                echo view('header', $data);
                echo view('menu', $data);
                echo view('agenda_murid', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }

    public function aksi_t_agenda_murid($id)
    {
        $this->logUserActivity('Menambah Agenda Harian PT');
        $h = $this->request->getPost('keramahan');
        $i = $this->request->getPost('penampilan');
        $j = $this->request->getPost('senyum');
        $k = $this->request->getPost('komunikasi');
        $l = $this->request->getPost('realisasi_kerja');
        $n = $this->request->getPost('hari');
        $id = $id;
        $where = array('id_user' => $id);

        $model = new MPE();

        // Periksa apakah ada data untuk hari dan user yang sama
        $existingData = $model->getWhereUser('agenda', ['hari' => $n, 'id_user' => $id], $id);

        $array = array(

            'keramahan' => $h,
            'penampilan' => $i,
            'senyum' => $j,
            'komunikasi' => $k,
            'realisasi_kerja' => $l,
            'hari' => $n,
            'id_user' => $id,
        );


        // Jika data ada, lakukan update, jika tidak, lakukan insert
        if (!empty($existingData)) {
            // Update data yang sudah ada
            $model->updateWhere('agenda', $array, ['hari' => $n, 'id_user' => $id]);
            $this->logUserActivity('Mengedit Agenda Harian PT');
        } else {
            // Tambah data baru
            $model->tambah('agenda', $array);
            $this->logUserActivity('Menambah Agenda Harian PT');
        }


        return redirect()->back()->with('success', 'Agenda berhasil disetujui.');
    }

    public function setuju_pkl($id)
    {
        if (session()->get('id') > 0) {
            $model = new MPE();
            $this->logUserActivity('Menyetujui Agenda');

            $where = array('id_agenda' => $id);

            $isi = array(
                'persetujuan_pkl' => 'Disetujui',

            );

            $model->edit('agenda', $isi, $where);
            return redirect()->back()->with('success', 'Agenda berhasil disetujui.');
        } else {
            return redirect()->to('home/login');
        }
    }

    public function tidak_setuju_pkl($id)
    {
        if (session()->get('id') > 0) {
            $model = new MPE();
            $this->logUserActivity('Tidak Menyetujui Agenda');

            $where = array('id_agenda' => $id);

            $isi = array(
                'persetujuan_pkl' => 'Belum Disetujui',

            );

            $model->edit('agenda', $isi, $where);
            return redirect()->back()->with('success', 'Agenda berhasil disetujui.');
        } else {
            return redirect()->to('home/login');
        }
    }


    public function setuju_sekolah($id)
    {
        if (session()->get('id') > 0) {
            $model = new MPE();
            $this->logUserActivity('Menyetujui Agenda');

            $where = array('id_agenda' => $id);

            $isi = array(
                'persetujuan_pembimbing' => 'Disetujui',

            );

            $model->edit('agenda', $isi, $where);
            return redirect()->back()->with('success', 'Agenda berhasil disetujui.');
        } else {
            return redirect()->to('home/login');
        }
    }

    public function tidak_setuju_sekolah($id)
    {
        if (session()->get('id') > 0) {
            $model = new MPE();
            $this->logUserActivity('Tidak Menyetujui Agenda');

            $where = array('id_agenda' => $id);

            $isi = array(
                'persetujuan_pembimbing' => 'Belum Disetujui',

            );

            $model->edit('agenda', $isi, $where);
            return redirect()->back()->with('success', 'Agenda berhasil disetujui.');
        } else {
            return redirect()->to('home/login');
        }
    }

    public function tidak_hadir_jumat($id)
    {
        if (session()->get('id') > 0) {
            $model = new MPE();
            $this->logUserActivity('Tidak Menyetujui Agenda');

            $where = array('id_agenda' => $id);

            $isi = array(
                'absen_jumat' => 'Tidak Hadir',

            );

            $model->edit('agenda', $isi, $where);
            return redirect()->back()->with('success', 'Agenda berhasil disetujui.');
        } else {
            return redirect()->to('home/login');
        }
    }

    public function hadir_jumat($id)
    {
        if (session()->get('id') > 0) {
            $model = new MPE();
            $this->logUserActivity('Menyetujui Agenda');

            $where = array('id_agenda' => $id);

            $isi = array(
                'absen_jumat' => 'Hadir',

            );

            $model->edit('agenda', $isi, $where);
            return redirect()->back()->with('success', 'Agenda berhasil disetujui.');
        } else {
            return redirect()->to('home/login');
        }
    }

    public function murid_bimbingan()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('murid_bimbingan')) {
                $this->logUserActivity('Masuk ke Daftar Murid Bimbingan');

                $model = new MPE();
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
                $id_user = session()->get('id');
                $data['data'] = $model->db->table('pt')
                    ->join('lokasi', 'pt.id = lokasi.id')
                    ->join('user AS murid', 'pt.id_user = murid.id_user')
                    ->join('user AS pembimbing', 'murid.pembimbing = pembimbing.id_user', 'inner')  // Join untuk pembimbing
                    ->select('murid.pembimbing, murid.username as murid_name, murid.kelas, murid.jurusan, lokasi.address, murid.nis, pt.nama_pt, pembimbing.username as pembimbing_name, murid.id_user AS murid_id_user, pembimbing.id_user')
                    ->where('murid.pembimbing', $id_user)
                    ->get()
                    ->getResult();

                echo view('header', $data);
                echo view('menu', $data);
                echo view('murid_bimbingan', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }

    public function murid_pkl()
    {
        if (session()->get('id') > 0) {
            helper('permission'); // Pastikan helper dimuat

            // Cek apakah user memiliki hak akses untuk 'pemesanan'
            if (has_permission('murid_pkl')) {
                $this->logUserActivity('Masuk ke Daftar Murid PKL');

                $model = new MPE();
                $where = array('id_setting' => '1');
                $data['yogi'] = $model->getWhere1('setting', $where)->getRow();
                $id_user = session()->get('id');
                $data['data'] = $model->db->table('pt')
                    ->join('lokasi', 'pt.id = lokasi.id')
                    ->join('user AS murid', 'pt.id_user = murid.id_user')
                    ->join('user AS pembimbing', 'murid.pembimbing = pembimbing.id_user', 'inner')  // Join untuk pembimbing
                    ->select('murid.pembimbing, murid.username as murid_name, murid.kelas, murid.jurusan, lokasi.address, murid.nis, pt.nama_pt, pembimbing.username as pembimbing_name, murid.id_user AS murid_id_user, pembimbing.id_user')
                    ->get()
                    ->getResult();

                echo view('header', $data);
                echo view('menu', $data);
                echo view('murid_bimbingan', $data);
                echo view('footer');
            } else {
                // Jika user tidak memiliki hak akses ke 'pemesanan'
                return redirect()->to('home/error'); // Halaman error atau halaman lain yang sesuai
            }
        } else {
            return redirect()->to('home/login');
        }
    }
}
