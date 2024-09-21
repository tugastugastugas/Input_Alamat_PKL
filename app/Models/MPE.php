<?php

namespace App\Models;

use CodeIgniter\Model;

class MPE extends Model
{
    protected $table = 'user';

    public function getWhere($tabel, $where)
    {
        return $this->db->table($tabel)
            ->getwhere($where)
            ->getRow();
    }

    // public function tampil_user($tabel1, $where, $where2)
    // {
    //     return $this->db->table($tabel1)
    //         ->where('user.id_user', $where)
    //         ->orWhere('user.id_user', $where2)
    //         ->get()
    //         ->getResult();
    // }
    public function tampil($tabel1)
    {
        return $this->db->table($tabel1)
            ->get()
            ->getResult();
    }
    public function join($tabel1, $tabel2, $on)
    {
        return $this->db->table($tabel1)
            ->join($tabel2, $on, 'inner')
            ->get()
            ->getResult();
    }
    public function getFilteredData($nis = null, $kelas = null, $jurusan = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('user.*, lokasi.address, lokasi.latitude, lokasi.longitude, lokasi.id, lokasi.persetujuan');

        // Filter hanya untuk user yang levelnya murid
        $builder->where('user.level', 'murid');

        if ($nis) {
            $builder->where('user.nis', $nis);
        }
        if ($kelas) {
            $builder->where('user.kelas', $kelas);
        }
        if ($jurusan) {
            $builder->where('user.jurusan', $jurusan);
        }

        $builder->join('lokasi', 'lokasi.id_user = user.id_user');
        return $builder->get()->getResult();
    }


    public function getWhere1($table, $where)
    {
        return $this->db->table($table)->where($where)->get();
    }

    public function edit($tabel, $isi, $where)
    {
        return $this->db->table($tabel)
            ->update($isi, $where);
    }

    public function joinFilterByUser($tabel1, $tabel2, $on1, $id_user)
    {
        try {
            // Eksekusi query
            $query = $this->db->table($tabel1)
                ->join($tabel2, $on1, 'inner') // $on1 menghubungkan $tabel1 dan $tabel2
                ->where("$tabel1.id_user", $id_user) // Filter berdasarkan id_user dari $tabel1
                ->where("$tabel1.delete_at", null) // Memastikan data tidak terhapus (jika kolom deleted_at ada)
                ->where("$tabel1.persetujuan", 'Setuju')
                ->get();

            if (!$query) {
                // Jika query gagal, tampilkan error dan berhenti
                throw new \Exception("Query failed: " . $this->db->getLastQuery());
            }

            return $query->getResult(); // Mengembalikan hasil query
        } catch (\Exception $e) {
            // Tangkap dan tampilkan error
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function joinFilterByMurid($tabel1, $tabel2, $on1, $id_user)
    {
        try {
            // Eksekusi query
            $query = $this->db->table($tabel1)
                ->join($tabel2, $on1, 'inner') // $on1 menghubungkan $tabel1 dan $tabel2
                ->where("$tabel1.id_user", $id_user) // Filter berdasarkan id_user dari $tabel1
                ->where("$tabel1.delete_at", null) // Memastikan data tidak terhapus (jika kolom deleted_at ada)
                ->get();

            if (!$query) {
                // Jika query gagal, tampilkan error dan berhenti
                throw new \Exception("Query failed: " . $this->db->getLastQuery());
            }

            return $query->getResult(); // Mengembalikan hasil query
        } catch (\Exception $e) {
            // Tangkap dan tampilkan error
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function joinFilterByUser2($tabel1, $tabel2, $on1)
    {
        try {
            // Eksekusi query
            $query = $this->db->table($tabel1)
                ->join($tabel2, $on1, 'inner') // $on1 menghubungkan $tabel1 dan $tabel2
                ->where("$tabel1.delete_at IS NOT NULL") // Memastikan data tidak terhapus (jika kolom deleted_at ada)
                ->get();

            if (!$query) {
                // Jika query gagal, tampilkan error dan berhenti
                throw new \Exception("Query failed: " . $this->db->getLastQuery());
            }

            return $query->getResult(); // Mengembalikan hasil query
        } catch (\Exception $e) {
            // Tangkap dan tampilkan error
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function joinFilterByUser3($tabel1, $tabel2, $on1)
    {
        try {
            // Eksekusi query
            $query = $this->db->table($tabel1)
                ->join($tabel2, $on1, 'inner') // $on1 menghubungkan $tabel1 dan $tabel2
                ->get();

            if (!$query) {
                // Jika query gagal, tampilkan error dan berhenti
                throw new \Exception("Query failed: " . $this->db->getLastQuery());
            }

            return $query->getResult(); // Mengembalikan hasil query
        } catch (\Exception $e) {
            // Tangkap dan tampilkan error
            echo "Error: " . $e->getMessage();
            return false;
        }
    }



    public function tambah($table, $isi)
    {
        return $this->db->table($table)
            ->insert($isi);
    }
    public function hapus($table, $where)
    {
        return $this->db->table($table)
            ->delete($where);
    }
    public function hapus2($table, $where, $id_user)
    {
        return $this->db->table($table)
            ->where("$table.id_user", $id_user)
            ->delete($where);
    }
    public function getEnumValues($table, $column)
    {
        $query = $this->db->query("SHOW COLUMNS FROM $table LIKE '$column'");
        $row = $query->getRow();
        preg_match("/^enum\(\'(.*)\'\)$/", $row->Type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }
    protected $primaryKey = 'id_user';  // Primary key tabel
    protected $allowedFields = ['password'];
    public function resetPassword($id)
    {
        // Mengatur password menjadi '1' dan mengenkripsinya dengan MD5
        $hashedPassword = md5('1'); // Password yang diatur menjadi '1' setelah di-hash
        return $this->update($id, ['password' => $hashedPassword]);
    }
    public function getById($id)
    {
        return $this->db->table('user')
            ->where('id_user', $id)
            ->get()
            ->getRow();
    }
    public function getPassword($userId)
    {
        return $this->db->table('user')
            ->select('password')
            ->where('id_user', $userId)
            ->get()
            ->getRow()
            ->password;
    }

    public function join3tbl($tabel1, $tabel2, $tabel3, $on1, $on2, $id_user)
    {
        return $this->db->table($tabel1)
            ->join($tabel2, $on1, 'inner')
            ->join($tabel3, $on2, 'inner')
            ->where("$tabel1.id_user", $id_user)
            ->get()
            ->getResult();
    }
    public function join3($tabel1, $tabel2, $tabel3, $on1, $on2)
    {
        return $this->db->table($tabel1)
            ->join($tabel2, $on1, 'inner')
            ->join($tabel3, $on2, 'inner')
            ->get()
            ->getResult();
    }
    public function tampilWhere($tabel1, $id_user)
    {
        return $this->db->table($tabel1)
            ->where("$tabel1.id_user", $id_user)
            ->get()
            ->getResult();
    }
    public function getWhereUser($tabel, $where, $id_user)
    {
        return $this->db->table($tabel)
            ->where("$tabel.id_user", $id_user)
            ->getwhere($where)
            ->getRow();
    }
    public function getWhereUser2($tabel, $id_user)
    {
        return $this->db->table($tabel)
            ->where("$tabel.id_user", $id_user)
            ->where("DAYOFWEEK($tabel.tanggal) =", 6) // 6 adalah nilai untuk hari Jumat
            ->get()
            ->getResult();
    }
    public function getWhereUser3($tabel, $id_user)
    {
        return $this->db->table($tabel)
            ->where("$tabel.id_user", $id_user)
            ->get()
            ->getResult();
    }

    public function tampilWhere2($tabel1, $level)
    {
        return $this->db->table($tabel1)
            ->where("$tabel1.level", $level)
            ->get()
            ->getResult();
    }


    public function updateWhere($table, $data, $where)
    {
        // Gunakan builder untuk memilih tabel
        $builder = $this->db->table($table);

        // Terapkan kondisi "where"
        $builder->where($where);

        // Lakukan update dengan data baru
        return $builder->update($data);
    }

    public function getPtUserLokasi($lokasiId)
    {
        return $this->db->table('pt')
            ->join('user', 'pt.id_user = user.id_user', 'inner')
            ->join('lokasi', 'pt.id = lokasi.id', 'inner')
            ->where('lokasi.id', $lokasiId)
            ->get();
    }

    public function searchLocations($query)
    {
        return $this->db->table('lokasi')
            ->like('address', $query)
            ->get();
    }
}
