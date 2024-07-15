<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paketour extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!$user&&!$level){
			redirect('account/login');
		}else if($level!=1){
			// redirect(base_url());
		}

	}
	public function index(){ 
		$data['list'] = $this->M_general->gDataA('paket')->result();
		$this->load->view('src/header',$data);
		$this->load->view('paketour/index',$data);
		$this->load->view('src/footer');
	}
	public function add(){ 
		$data['title'] = "Tambah Paket";
		if(!empty($this->input->post())){
			$insert = $this->input->post();
			$foto = $_FILES['foto']['name'];
			if ($foto !== ""){
				$path = 'assets/images/apartement/';
				if (!file_exists($path)) {
					mkdir($path, 0777, true);
				}
				$config['upload_path'] = $path;   
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '0';          
				$config['overwrite'] = false;
				$this->load->library('upload', $config);
				$this->upload->do_upload('foto');
				$upload_data = $this->upload->data();
				$insert['foto'] = $upload_data['file_name'];
			}else{
				$insert['foto'] = 'default.png';
			}
			$in = $this->M_general->iData('paket',$insert);
			if($in){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Paket berhasil ditambahkan</div>');
				redirect('paket');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
			}
		}
		$data['paket'] = $this->M_general->gDataA('paket')->result();
		$this->load->view('src/header',$data);
		$this->load->view('paketour/add',$data);
		$this->load->view('src/footer');
	}
	public function edit($id_paket){ 
		$data['title'] = "Edit paket";
		if(!empty($this->input->post())){
			$update = $this->input->post();
			$foto = $_FILES['foto']['name'];
			if(!empty($foto)){
				if ($foto !== ""){
					$path = 'assets/images/apartement/';
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
					}
					$config['upload_path'] = $path;   
					$config['allowed_types'] = 'jpg|png|jpeg';
					$config['max_size'] = '0';          
					$config['overwrite'] = false;
					$this->load->library('upload', $config);
					$this->upload->do_upload('foto');
					$upload_data = $this->upload->data();
					$update['foto'] = $upload_data['file_name'];
				}else{
					$update['foto'] = 'default.png';
				}
			}
			$up = $this->M_general->uData('paket',$update,array('id_paket'=>$id_paket));
			if($up){
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Paket berhasil diupdate</div>');
				redirect('paketour');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
			}
		}
		$data['paketour'] = $this->M_general->gDataA('paket')->result();
		$data['detail'] = $this->M_general->gDataW('paket',array('id_paket'=>$id_paket))->row();
		$this->load->view('src/header',$data);
		$this->load->view('paketour/edit',$data);
		$this->load->view('src/footer');
	}
	public function delete($id_paket){ 
		$del = $this->M_general->dData('paket',array('id_paket'=>$id_paket));
		if($del){
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Paket berhasil dihapus</div>');
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Terjadi Kesalahan</div>');
		}
		redirect('paket');
	}

	public function get_package() {
		$id_paket = $this->input->post('id');
		$data = $this->M_general->gDataW('paket', array('id_paket' => $id_paket))->row();
		echo json_encode($data);
	}

	public function get_detail_paket($id_paket) {
        $id_paket = $this->input->get('id_paket'); // Ambil id_paket dari GET parameter
        
        // Validasi input id_paket
        if (!$id_paket) {
            header('Content-Type: application/json');
            return json_encode(['status' => 'error', 'message' => 'ID Paket tidak valid']);
        }

        $paket = $this->M_general->get_paket_by_id($id_paket); // Ambil detail paket dari model

        if ($paket) {
            $data['paket'] = $paket;
            header('Content-Type: text/html');
            $this->load->view('paketour/detail_paket', $data); // Muat view dengan detail paket dan kirim sebagai respons
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Paket tidak ditemukan']);
        }
    }

    public function get_detail_paket_api() {
        $id_paket = $this->input->get('id_paket'); // Ambil id_paket dari GET parameter
        
        // Validasi input id_paket
        if (!$id_paket) {
            header('Content-Type: application/json');
            return json_encode(['status' => 'error', 'message' => 'ID Paket tidak valid']);
        }

        $paket = $this->M_general->get_paket_by_id($id_paket); // Ambil detail paket dari model

        if ($paket) {
            $data['paket'] = $paket;
            header('Content-Type: text/html');
            $this->load->view('paketour/detail_paket', $data); // Muat view dengan detail paket dan kirim sebagai respons
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Paket tidak ditemukan']);
        }
    }

}
// $this->load->view('paketour/detail_paket', $data); 

