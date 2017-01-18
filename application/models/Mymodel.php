<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_Model{

	public function GetMahasiswa($table, $config){
        $res=$this->db->get($table, $config['per_page'], $this->uri->segment(3));
       if ($res->num_rows() > 0) {
            foreach ($res->result() as $value) {
                $data[]=$value;
            }
            return $data;
        }
    }
 
    public function Insert($table,$data){
        $res = $this->db->insert($table, $data); // Kode ini digunakan untuk memasukan record baru kedalam sebuah tabel
        return $res; // Kode ini digunakan untuk mengembalikan hasil $res
    }

    public function GetWhere($table, $data){
	    $res=$this->db->get_where($table, $data);
	    return $res->result_array();
	}
 
    public function Update($table, $data, $where){
        $res = $this->db->update($table, $data, $where); // Kode ini digunakan untuk merubah record yang sudah ada dalam sebuah tabel
        return $res;
    }
 
    public function Delete($table, $where){
    	return $table;
        $res = $this->db->delete($table, $where); // Kode ini digunakan untuk menghapus record yang sudah ada
        return $res;
    }
}
?>
