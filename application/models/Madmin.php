<?php

class Madmin extends CI_Model{
    public function cek_login($u,$p){
        $q = $this->db->get_where('tbl_admin',array('userName'=>$u,'password'=>$p));
        return $q;
    }

    public function cek_login2($username,$password){
        $q = $this->db->get_where('tbl_member',array('username'=>$username,'password'=>$password));
        return $q;
    }

    public function get_all_data($tabel){
       $q=$this->db->get($tabel);
       return $q;
    }

    public function insert($tabel,$data){
        $this->db->insert($tabel,$data);
    }

    public function get_by_id($tabel,$id){
        return $this->db->get_where($tabel,$id);
    }

    public function update($tabel,$data,$pk,$id){
        $this->db->where($pk,$id);
        $this->db->update($tabel,$data);
    }

    public function delete($tabel,$id,$val){
        $this->db->delete($tabel,array($id=>$val));
    }

    public function validate_password($adminId, $password) {
        $this->db->select('password');
        $this->db->where('idAdmin', $adminId);
        $query = $this->db->get('tbl_admin');

        if ($query->num_rows() == 1) {
            $adminData = $query->row();
            return password_verify($password, $adminData->password);
        }
        return false;
    }

    public function update_password($idAdmin, $data) {
        $this->db->where('idAdmin', $idAdmin);
        $this->db->update('tbl_admin', $data);
    }
}