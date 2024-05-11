<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Madmin');

        if(empty($this->session->userdata('userName'))){
            redirect('adminpanel');
        }

        $this->load->library('form_validation');
    }

	public function index()
	{
        $data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
		$this->load->view('admin/layout/header');
        $this->load->view('admin/layout/menu');
        $this->load->view('admin/kategori/tampil',$data);
        $this->load->view('admin/layout/footer');
	}

    
    public function add()
	{
		$this->load->view('admin/layout/header');
        $this->load->view('admin/layout/menu');
        $this->load->view('admin/kategori/formAdd');
        $this->load->view('admin/layout/footer');
	}

    public function save()
    {
        $this->form_validation->set_rules('namaKat', 'Nama Kategori', 'required');
    
      
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', 'Nama Kategori wajib diisi.');
            redirect('kategori/add'); 
        } else {
           
            $namaKat = $this->input->post('namaKat');
            $dataInput = array('namaKat' => $namaKat);
            $this->Madmin->insert('tbl_kategori', $dataInput);
            $this->session->set_flashdata('msg', 'Sukses menambah data.');
            redirect('kategori');
        }
    }
    
    
    public function get_by_id($id)
	{   
        $dataWhere = array('idkat'=>$id);
        $data['kategori'] = $this->Madmin->get_by_id('tbl_kategori',$dataWhere)->row_object();

		$this->load->view('admin/layout/header');
        $this->load->view('admin/layout/menu');
        $this->load->view('admin/kategori/formEdit',$data);
        $this->load->view('admin/layout/footer');
	}

    public function edit()
{

    $id = $this->input->post('id');
    $kategori = $this->Madmin->get_by_id('tbl_kategori', array('idkat' => $id))->row();
    if (!$kategori) {
        $this->session->set_flashdata('msg', 'Data kategori tidak ditemukan.');
        redirect('kategori');
        return; 
    }
    $namaKategori = $this->input->post('namaKat');

    if (empty($namaKategori)) {
        $this->session->set_flashdata('msg', 'Nama Kategori wajib diisi.');
        redirect('kategori/get_by_id/' .$id); 
    } else {
        
        $dataUpdate = array('namaKat' => $namaKategori);
        $this->Madmin->update('tbl_kategori', $dataUpdate, 'idkat', $id);
        $this->session->set_flashdata('msg', 'Sukses edit data.');
        redirect('kategori');
    }
}

    public function delete($id)
	{
		$this->Madmin->delete('tbl_kategori','idkat',$id);
        $this->session->set_flashdata('msg','Sukses delete data.');
        redirect('kategori');
	}

    
}
