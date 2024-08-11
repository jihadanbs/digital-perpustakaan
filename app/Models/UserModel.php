<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tb_user';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama_lengkap', 'username', 'id_jabatan', 'password', 'email', 'no_telepon', 'token', 'file_profil', 'terakhir_login', 'is_logged_in', 'status'];

    public function getAll()
    {
        $builder = $this->db->table('tb_user');
        $builder->select('tb_user.*, tb_jabatan.nama_jabatan');
        $builder->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_user.id_jabatan');
        $query = $builder->get();
        $results = $query->getResult();

        return $results;
    }

    public function getId($id_user = false)
    {
        if ($id_user == false) {
            return $this->findAll();
        }

        return $this->where(['id_user' => $id_user])->first();
    }
    public function getData($parameter)
    {
        $builder = $this->table($this->table);
        $builder->where('username', $parameter);
        $builder->orwhere('email', $parameter);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function loginAdmin($username, $password)
    {
        $session = session();
        $user = $this->db->table('tb_user')->where('username', $username)->get()->getRowArray();

        if ($user) {
            if (password_verify($password, $user['password']) && $user['id_jabatan'] == '1') {
                return $user;
            } elseif (password_verify($password, $user['password']) && $user['id_jabatan'] == '2') {
                return $user;
            } else {
                return null;
            }
        }

        return null;
    }

    public function updateData($id_user, $dataUpdate)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_user', $id_user);
        if ($builder->update($dataUpdate)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserById($id_user)
    {
        $query = $this->where('id_user', $id_user)->get();
        return $query->getRow(); // Pastikan menggunakan getRow() untuk mendapatkan satu baris
    }

    public function updatePassword($id_user, $new_password_hash)
    {
        $data = [
            'password' => $new_password_hash
        ];

        return $this->update($id_user, $data); // Menggunakan primary key sebagai kondisi update
    }

    public function setLoginStatus($id_user, $status)
    {
        return $this->update($id_user, ['is_logged_in' => $status]);
    }

    // Baru
    public function getUsersWithUserRole()
    {
        return $this->select('tb_user.*, tb_jabatan.nama_jabatan')
            ->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_user.id_jabatan')
            ->where('tb_jabatan.nama_jabatan', 'User')
            ->findAll();
    }

    // Method to get the filtered user data
    public function getFilteredUsers($start, $length, $searchValue = null)
    {
        $this->select('tb_user.*, tb_jabatan.nama_jabatan')
            ->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_user.id_jabatan')
            ->where('tb_jabatan.nama_jabatan', 'User');

        // Add search functionality
        if ($searchValue) {
            $this->groupStart()
                ->like('tb_user.nama_lengkap', $searchValue)
                ->orLike('tb_user.email', $searchValue)
                ->groupEnd();
        }

        return $this->findAll($length, $start);
    }

    // Method to count all users
    public function countAllUsers()
    {
        return $this->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_user.id_jabatan')
            ->where('tb_jabatan.nama_jabatan', 'User')
            ->countAllResults();
    }

    // Method to count filtered users
    public function countFilteredUsers($searchValue = null)
    {
        $this->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_user.id_jabatan')
            ->where('tb_jabatan.nama_jabatan', 'User');

        if ($searchValue) {
            $this->groupStart()
                ->like('tb_user.nama_lengkap', $searchValue)
                ->orLike('tb_user.email', $searchValue)
                ->groupEnd();
        }

        return $this->countAllResults();
    }
}
