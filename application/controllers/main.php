<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function index() {
        $this->load->view('home/layout/heder');
        $this->load->view('home/layanan');
        $this->load->view('home/home');
        $this->load->view('home/layout/footer');
    }

    public function register() {
        $this->load->view('home/layout/heder');
        $this->load->view('home/register');
        $this->load->view('home/layout/footer');
    }

    public function member(){
        $this->load->library('form_validation');
    
        $this->form_validation->set_rules('namaKonsumen', 'Nama Konsumen', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tbl_member.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('tlpn', 'Telepon', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('idKota', 'ID Kota', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', validation_errors());
            redirect('main/register'); // Mengarahkan kembali ke halaman register jika validasi gagal
        } else {
            $namaKonsumen = $this->input->post('namaKonsumen');
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $tlpn = $this->input->post('tlpn');
            $alamat = $this->input->post('alamat');
            $idKota = $this->input->post('idKota');
            $hashedPassword = md5($password);
    
            $dataInput = array(
                'namaKonsumen' => $namaKonsumen,
                'email' => $email,
                'username' => $username,
                'password' => $hashedPassword,
                'tlpn' => $tlpn,
                'alamat' => $alamat,
                'idKota' => $idKota
            );
            $this->load->model('Madmin');
            $this->Madmin->insert('tbl_member', $dataInput);
            $this->session->set_flashdata('msg', 'sukses menambah data.');
            redirect('main/register');
        }
    }
    

    public function login () {
        $this->load->view('home/layout/heder');
        $this->load->view('home/login');
        $this->load->view('home/layout/footer');
        
    }

    public function login_member() {
        $this->load->library('form_validation');
        $this->load->model('Madmin');
    
    
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
     
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('msg', 'Username dan Password wajib diisi.');
            redirect('main/login');
        } else {
            $u = $this->input->post('username');
            $p = md5($this->input->post('password'));
            $user = $this->Madmin->cek_login2($u, $p)->row();
            
            if($user) {
                if($user->statusAktif == 'Y') {
                    $data_session = array(
                        'idKonsumen' => $user->idKonsumen, 
                        'username' => $u,
                        'status' => 'login',
                    );
                    $this->session->set_userdata($data_session);
                    $this->session->set_flashdata('msg', 'Login berhasil.');
                    redirect('main');
                } else {
                    $this->session->set_flashdata('msg', 'Akun tidak aktif, silakan hubungi administrator.');
                    redirect('main/login');
                }
            } else {
                $this->session->set_flashdata('msg', 'Username/Password salah.');
                redirect('main/login');
            }
        }
    }
    

    public function logout(){
        $this->session->sess_destroy();
        $this->session->set_flashdata('msg', 'Logout berhasil.');
        redirect('main/login');
    
    
    
}
}


    ?>