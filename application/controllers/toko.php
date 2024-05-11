<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('Madmin');
        $this->load->library('form_validation');

        if(empty($this->session->userdata('userName'))){
            redirect('adminpanel');
        }
    }
    public function index()  {
        $data['toko']=$this->Madmin->get_all_data('tbl_toko')->result();
        $this->load->view('home/layout/heder');
        $this->load->view('home/toko/index', $data);
        $this->load->view('home/layout/footer');
    }

    public function add () {
        $this->load->view('home/layout/heder');
        $this->load->view('home/toko/form_tambah');
        $this->load->view('home/layout/footer');
    }

    public function get_by_id($id)
	{   
        $dataWhere = array('idToko'=>$id);
        $data['toko'] = $this->Madmin->get_by_id('tbl_toko',$dataWhere)->row_object();
		$this->load->view('home/layout/heder');
        $this->load->view('home/toko/form_edit',$data);
        $this->load->view('home/layout/footer');
	}        

    
    public function save() {
        $id = $this->session->userdata('idKonsumen');
        if (!$id) {
            redirect('toko/add');
        }
        $nama_toko = $this->input->post('namaToko');
        $deskripsi = $this->input->post('deskripsi');
    
       
        $this->form_validation->set_rules('namaToko', 'Nama Toko', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
    
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Nama Toko dan Deskripsi wajib diisi.');
            redirect('toko/add');
        }
    
        $config['upload_path'] = './assets/logo_toko/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $this->load->library('upload', $config);
    
        if (!$this->upload->initialize($config)) {
            $this->session->set_flashdata('error', 'Gagal memuat library Upload.');
            redirect('toko/add');
        }
    
        if (!$this->upload->do_upload('logo')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);
            redirect('toko/add');
        }
    
        $data_file = $this->upload->data();
        $data_insert = array(
            'namaToko' => $nama_toko,
            'logo' => $data_file['file_name'],
            'deskripsi' => $deskripsi,
        );
        $this->Madmin->insert('tbl_toko', $data_insert);
        $this->session->set_flashdata('msg', 'Sukses Menambahkan data.');
        redirect('toko');
    }
    
    public function delete($idToko)
	{
		$this->Madmin->delete('tbl_toko','idToko',$idToko);
        $this->session->set_flashdata('msg','Sukses delete data.');
        redirect('toko');
	}
    
    public function update() {
        $idToko = $this->input->post('id');
        $namaToko = $this->input->post('namaToko');
        $deskripsi = $this->input->post('deskripsi');
        
        
        $this->form_validation->set_rules('namaToko', 'Nama Toko', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        
    
        // Validasi upload gambar hanya jika ada file yang diunggah
        if (!empty($_FILES['logo']['name'])) {
            $config['upload_path'] = './assets/logo_toko/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
    
            if (!$this->upload->initialize($config)) {
                $this->session->set_flashdata('upload_error', 'Gagal memuat library Upload.');
                redirect('toko/get_by_id/' . $idToko);
                return;
            }
    
            if (!$this->upload->do_upload('logo')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('toko/get_by_id/' . $idToko);
                return;
            } else {
                $data_upload = $this->upload->data();
                $data['logo'] = $data_upload['file_name'];
            }
        }
        
  
        if ($this->form_validation->run() == FALSE) {
           
            $this->session->set_flashdata('error', validation_errors());
            redirect('toko/get_by_id/' . $idToko);
            return;
        } elseif (!$this->upload->do_upload('logo')) {
            
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);
            redirect('toko/get_by_id/' . $idToko);
            return;
        }
    
  
        $data['namaToko'] = $namaToko;
        $data['deskripsi'] = $deskripsi;
        
        $this->Madmin->update('tbl_toko', $data, 'idToko', $idToko);
        $this->session->set_flashdata('msg','Sukses Update data.');
        
        redirect('toko');
    }
    
    
}