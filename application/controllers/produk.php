<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('Madmin');
    }

    public function index($idToko) {
        $data['idToko']=$idToko;
        $where = array('idToko' => $idToko); 
        $data['produk'] = $this->Madmin->get_by_id('tbl_produk', $where)->result();
        $this->load->view('home/layout/heder'); 
        $this->load->view('home/produk/index', $data);
        $this->load->view('home/layout/footer');
    }
    

    public function add($idToko) {
        $data['idToko']=$idToko;
        $data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
        $this->load->view('home/layout/heder'); 
        $this->load->view('home/produk/form_tambah', $data);
        $this->load->view('home/layout/footer');
    }
    

    public function save() {
        $idToko = $this->input->post('idToko');
        $idKategori = $this->input->post('kategori');
        $namaProduk = $this->input->post('namaProduk');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        $berat = $this->input->post('berat');
        $deskripsiProduk = $this->input->post('deskripsiProduk');
    
        $this->load->library('form_validation');
        $this->form_validation->set_rules('idToko', 'ID Toko', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('namaProduk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        $this->form_validation->set_rules('berat', 'Berat', 'required|numeric');
        $this->form_validation->set_rules('deskripsiProduk', 'Deskripsi Produk', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $error = array('error' => validation_errors());
            $this->session->set_flashdata('error', $error['error']);
            redirect('produk/add/' . $idToko);
        }
    
        $config['upload_path'] = './assets/foto_produk/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $this->load->library('upload', $config);
    
        if (!$this->upload->initialize($config)) {
            echo "Gagal memuat library Upload.";
        }
    
        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);
            redirect('produk/add/' . $idToko);
        }
    
        $data_file = $this->upload->data();
        $data_insert = array(
            'idKat' => $idKategori,
            'namaProduk' => $namaProduk,
            'idToko' => $idToko,
            'harga' => $harga,
            'stok' => $stok,
            'berat' => $berat,
            'foto' => $data_file['file_name'],
            'deskripsiProduk' => $deskripsiProduk,
        );
    
        $this->Madmin->insert('tbl_produk', $data_insert);
        $this->session->set_flashdata('msg', 'Sukses Menambahkan data.');
        
        redirect('produk/index/'.$idToko);
    }
    

    public function delete($idToko)
	{
		$this->Madmin->delete('tbl_Produk','idProduk',$idToko);
        $this->session->set_flashdata('msg','Sukses delete data.');
        redirect('produk/index/'.$idToko);
	}
    

    public function get_by_id($idProduk){   
    $data['produk'] = $this->Madmin->get_by_id('tbl_produk', array('idProduk' => $idProduk))->row();
    $data['kategori'] = $this->Madmin->get_all_data('tbl_kategori')->result();
    $this->load->view('home/layout/heder');
    $this->load->view('home/produk/form_edit', $data);
    $this->load->view('home/layout/footer');
}

public function update() {
    $idToko = $this->input->post('idToko');
    $idKategori = $this->input->post('kategori');
    $namaProduk = $this->input->post('namaProduk');
    $harga = $this->input->post('harga');
    $stok = $this->input->post('stok');
    $berat = $this->input->post('berat');
    $deskripsiProduk = $this->input->post('deskripsiProduk');

    $this->load->library('form_validation');
    $this->form_validation->set_rules('namaProduk', 'Nama Produk', 'required');
    $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
    $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
    $this->form_validation->set_rules('berat', 'Berat', 'required|numeric');
    $this->form_validation->set_rules('deskripsiProduk', 'Deskripsi Produk', 'required');

    if ($this->form_validation->run() == FALSE) {
        $error = array('error' => validation_errors());
        $this->session->set_flashdata('error', validation_errors());
        redirect('produk/get_by_id/' . $idToko);
        return;
    }

    $config['upload_path'] = './assets/foto_produk/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $this->load->library('upload', $config);

    if (!$this->upload->initialize($config)) {
        echo "Gagal memuat library Upload.";
    } else {
        echo "Library Upload berhasil dimuat.";
    }

    if (!$this->upload->do_upload('foto')) {
        $error = array('error' => $this->upload->display_errors());
        $this->session->set_flashdata('error', $error['error']);
        redirect('produk/get_by_id/' . $idToko);
        return;
    }
    
    $data_file = $this->upload->data();
    $data_update = array(
        'idKat' => $idKategori,
        'namaProduk' => $namaProduk,
        'harga' => $harga,
        'stok' => $stok,
        'berat' => $berat,
        'deskripsiProduk' => $deskripsiProduk,
        'foto' => $data_file['file_name']
    );

    $this->Madmin->update('tbl_produk', $data_update, 'idProduk', $idToko);
    $this->session->set_flashdata('msg', 'Sukses memperbarui data.');

    redirect('produk/index/' . $idToko);
}

}



?>