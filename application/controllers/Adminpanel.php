<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpanel extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('Madmin');  
        $this->load->library('form_validation');
    }

	public function index()
	{
		$this->load->view('admin/login');
	}

    public function dashboard()
	{
 		if(empty($this->session->userdata('userName'))){
            redirect('adminpanel');
        }

		$this->load->view('admin/layout/header');
        $this->load->view('admin/layout/menu');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/layout/footer');
	}

	public function login(){
        
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Username dan Password wajib diisi.');
            redirect('adminpanel');
        } else {
            $u = $this->input->post('username');
            $p = md5($this->input->post('password'));
    
         
            $admin = $this->Madmin->cek_login($u, $p)->row();
    
            if($admin){
              
                $data_session = array(
                    'idAdmin' => $admin->idAdmin,
                    'userName' => $u,
                    'status' => 'login',
                );
                $this->session->set_userdata($data_session);
                redirect('adminpanel/dashboard');
            } else {
              
                $this->session->set_flashdata('msg', "Username/Password salah.");
                redirect('adminpanel');
            }
        }
    }
    
	

	public function logout(){
		$this->session->sess_destroy();
		redirect('adminpanel');
	}


public function change() {
    if (!$this->session->userdata('idAdmin')) {
        redirect('adminpanel/index/'); 
    }
    
 
    $idAdmin = $this->session->userdata('idAdmin');
    $data['idAdmin'] = $idAdmin;
	$data['admin'] = $this->Madmin->get_by_id('tbl_admin', $data)->row_object();
    $this->load->view('admin/layout/header');
    $this->load->view('admin/layout/menu');
    $this->load->view('admin/pass', $data); 
    $this->load->view('admin/layout/footer');
}



public function save() {


    $this->form_validation->set_rules('id', 'ID Admin', 'required');
    $this->form_validation->set_rules('passwordLama', 'Password Lama', 'required');
    $this->form_validation->set_rules('passwordBaru', 'Password Baru', 'required');
    $this->form_validation->set_rules('passwordKonfirm', 'Konfirmasi Password Baru', 'required|matches[passwordBaru]');

    
    if ($this->form_validation->run() == false) {
        $this->session->set_flashdata('msg', validation_errors());
        redirect('adminpanel/change/');
    } else {
        $idAdmin = $this->input->post('id');
        $passwordLama = $this->input->post('passwordLama');
        $passwordBaru = $this->input->post('passwordBaru');
        $passwordKonfirm = $this->input->post('passwordKonfirm');

        $admin = $this->Madmin->get_by_id('tbl_admin', array('idAdmin' => $idAdmin))->row();

        if (!$admin || md5($passwordLama) !== $admin->password) {
            $this->session->set_flashdata('msg', 'Password lama tidak sesuai.');
            redirect('adminpanel/change');
        }

        if ($passwordBaru !== $passwordKonfirm) {
            $this->session->set_flashdata('msg', 'Konfirmasi password baru tidak cocok.');
            redirect('adminpanel/change');
        }

        $hashedPassword = md5($passwordBaru);

        $data = array(
            'password' => $hashedPassword
        );
        $this->Madmin->update_password($idAdmin, $data);

        $this->session->set_flashdata('msg', 'Password berhasil diubah.');
        redirect('adminpanel');
    }
}




}