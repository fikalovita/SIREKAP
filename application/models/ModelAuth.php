<?php
class ModelAuth extends CI_Model
{
    public function auth($username, $password)
    {
        $this->db->select('user.id_user, user.password, pegawai.nama');
        $this->db->from('user');
        $this->db->join(
            'pegawai',
            'pegawai.nik = CAST(AES_DECRYPT(user.id_user, "nur") AS CHAR)',
            'inner'
        );
        $this->db->where(
            'user.id_user',
            "AES_ENCRYPT('$username', 'nur')",
            false
        );
        $this->db->where(
            'user.password',
            "AES_ENCRYPT('$password', 'windi')",
            false
        );

        return $this->db->get();
    }

    public function admin($username, $password)
    {
        $this->db->select('admin.usere, admin.passworde');
        $this->db->from('admin');
        $this->db->where(
            'admin.usere',
            "AES_ENCRYPT('$username', 'nur')",
            false
        );
        $this->db->where(
            'admin.passworde',
            "AES_ENCRYPT('$password', 'windi')",
            false
        );

        return $this->db->get();
    }
}
