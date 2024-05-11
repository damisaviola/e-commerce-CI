<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Madmin');

        if(empty($this->session->userdata('userName'))){
            redirect('adminpanel');
        }
    }

    public function index()
	{
        $data['member'] = $this->Madmin->get_all_data('tbl_member')->result();
		$this->load->view('admin/layout/header');
        $this->load->view('admin/layout/menu');
        $this->load->view('admin/member/tampil',$data);
        $this->load->view('admin/layout/footer');
	}

    public function ubah_status($id)
	{
        $dataWhere = array("idKonsumen"=>$id);
        $result = $this->Madmin->get_by_id('tbl_member',$dataWhere)->row_object();
        $status = $result->statusAktif;
        if($status=='Y'){
            $dataUpdate = array("statusAktif" => 'N');
        }else{
            $dataUpdate = array("statusAktif" => 'Y');
        }

        $this->Madmin->update('tbl_member',$dataUpdate,'idKonsumen',$id);
        $this->session->set_flashdata('msg','Sukses mengubah status.');
        redirect('member');
    }

    public function edit($idKonsumen) {
        $dataWhere = array('idKonsumen'=>$idKonsumen);
        $data['konsumen'] = $this->Madmin->get_by_id('tbl_member',$dataWhere)->row_object();
        $this->load->view('home/layout/heder'); 
        $this->load->view('admin/member/edit', $data);
        $this->load->view('home/layout/footer');
        
    }

    public function update() {
        $idKonsumen = $this->input->post('idKonsumen');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('namaKonsumen', 'Nama Konsumen', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('idKota', 'ID Kota', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('tlpn', 'Telepon', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('member/edit/'.$idKonsumen);
        } else {
            $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
        }
    
        $data = array(
            'username' => $this->input->post('username'),
            'namaKonsumen' => $this->input->post('namaKonsumen'),
            'alamat' => $this->input->post('alamat'),
            'idKota' => $this->input->post('idKota'),
            'email' => $this->input->post('email'),
            'tlpn' => $this->input->post('tlpn')
        );
    
        $this->Madmin->update('tbl_member', $data, 'idKonsumen', $idKonsumen);
        redirect('member/edit/'.$idKonsumen); 
    }
    
    public function delete($id)
	{
		$this->Madmin->delete('tbl_member','idKonsumen',$id);
        $this->session->set_flashdata('msg','Sukses delete data.');
        redirect('member');
	}
}    