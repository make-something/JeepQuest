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
			redirect(base_url());
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
		$data['detail'] = $this->M_general->gDataW('paket',array('id_paket'=>$id_jeep))->row();
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

    public function get_detail_paket() {
    $id_paket = $this->input->post('id_paket');
    $paket = $this->M_general->get_paket_by_id($id_paket);

    if ($paket) {
        $data['paket'] = $paket;
        $this->load->view('paketour/detail_paket', $data); 
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Paket tidak ditemukan']);
    }
}



}
