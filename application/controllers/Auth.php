<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$this->load->view('page/login');
	}
	
	public function aksiLogin()
	{
		if ($p = $this->input->post()) {
			$array = [];
			$data = [
				'user_username'	=> $p['username'],
				'user_password'	=> md5($p['password']),
			];

			$sqladmin = $this->db->get_where('user',$data); 

			$dataanggota = [
				'anggota_nik'	=> $p['username'],
				'password'	=> md5($p['password']),
			];

			$sqlanggota = $this->db->get_where('anggota',$dataanggota); 


			if ($sqladmin->num_rows() > 0) {
				$res 				= $sqladmin->row_array(); 
				if ($res['user_level'] == 'manajer') {
					$array['id']		= $res['user_id'];
					$array['nama']		= $res['user_nama'];
					$array['username']	= $res['user_username'];
					$array['level'] = $res['user_level'];
					$this->session->set_userdata( $array );
					redirect('dashboard');
				}elseif ($res['user_level'] == 'bendahara') {
					$array['id']		= $res['user_id'];
					$array['nama']		= $res['user_nama'];
					$array['username']	= $res['user_username'];
					$array['level'] = $res['user_level'];
					$this->session->set_userdata( $array );
					redirect('dashboard');
				}
				elseif ($res['user_level'] == 'pengawas') {
					$array['id']		= $res['user_id'];
					$array['nama']		= $res['user_nama'];
					$array['username']	= $res['user_username'];
					$array['level'] = $res['user_level'];
					$this->session->set_userdata( $array );
					redirect('dashboard');
				}else{
					$this->session->set_flashdata('msg', "Toast.fire({ icon: 'error', title: 'User atau password tidak ditemukan' });"); 
					redirect('auth');
				}

				
			}elseif ($sqlanggota->num_rows() > 0) {
				$res = $sqlanggota->row_array();
				$array['id']		= $res['anggota_nik'];
				$array['nama']		= $res['anggota_nama'];
				$array['level'] = 'anggota';
				$this->session->set_userdata( $array );
				redirect('dashboard');
			}
			else
			{
				$this->session->set_flashdata('msg', "Toast.fire({ icon: 'error', title: 'User atau password tidak ditemukan' });"); 
				redirect('auth');
			}

		}
		else
		{
			redirect('auth');
		}
	}
	public function logout()
	{
		session_destroy();
		redirect('auth');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */