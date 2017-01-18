<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helloworld extends CI_Controller
{   
	function __construct(){
        parent::__construct();
        // konfigurasi helper & library
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->database();
    }

    public function index(){
    	 // konfigurasi class pagination
        $config['base_url']=base_url()."index.php/helloworld/index";
	    $config['total_rows']= $this->db->query("SELECT * FROM mahasiswa;")->num_rows();
	    $config['per_page']=3;
	    $config['num_links'] = 2;
	    $config['uri_segment']=3;
 
        //Tambahan untuk styling
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
 
        $config['first_link']='< Pertama ';
        $config['last_link']='Terakhir > ';
        $config['next_link']='> ';
        $config['prev_link']='< ';
        $this->pagination->initialize($config);

	    $data = $this->load->model('Mymodel');

	    $data = $this->Mymodel->GetMahasiswa('mahasiswa', $config);

	    $data = array('data' => $data);
		
	    $this->load->view('data_mahasiswa', $data);
	}
   	public function add_data(){
    	$this->load->view('form_add');
	}
	public function insert(){
	    $this->load->model('Mymodel');
	    $data = array(
	        'no_induk' => $this->input->post('ni'),
	        'nama' => $this->input->post('nama'),
	        'alamat' => $this->input->post('alamat')
	     );
	    $data = $this->Mymodel->Insert('mahasiswa', $data);
	    redirect(base_url(),'refresh');
	}

	public function delete_data($noinduk){
	    $noinduk = array('no_induk' => $noinduk);
	    $this->load->model('Mymodel');
	    $this->Mymodel->Delete('mahasiswa', $noinduk);
	    redirect(base_url(),'refresh');
	}

	public function edit_data($noinduk){
	    $this->load->model('Mymodel');
	    $siswa = $this->Mymodel->GetWhere('mahasiswa', array('no_induk' => $noinduk));
	    $data = array(
	        'no_induk' => $siswa[0]['no_induk'],
	        'nama' => $siswa[0]['nama'],
	        'alamat' => $siswa[0]['alamat'],
	        );
	    $this->load->view('form_edit', $data); 
	}

	public function update_data(){
		$no_induk = $this->input->post('ni');
	    $nama = $this->input->post('nama');
	    $alamat = $this->input->post('alamat');
	    $data = array(
	        'nama' => $this->input->post('nama'),
	        'alamat' => $this->input->post('alamat')
	     );
	   	$where = array(
        	'no_induk' => $no_induk,
    	);
    	
	    $this->load->model('Mymodel');
	    $res = $this->Mymodel->Update('mahasiswa', $data, $where);
	    if ($res>0) {
	        redirect('helloworld/index','refresh');
	    }
	   
	}
}