<?php

use LDAP\Result;

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//cek dlu apakah user yang mengakses sudah login atau belum, jika belum arahkan ke halaman login
		if (empty($this->session->userdata('nama'))) {
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'error', title: 'Anda belum login!' });");
			redirect('auth'); 
		}
	}

	public function index()
	{
		$data['home']	= 'active';
		$data['body']	= 'page/home';
		$this->load->view('index',$data);
	}

	public function anggota()
	{
		$data['master']		= 'active';
		$data['anggota']	= $this->data->anggota()->result();
		$data['body']		= 'page/anggota';
		$this->load->view('index',$data);
	}
	public function anggota_add()
	{
		if ($p = $this->input->post()) {
			$data = [
				'anggota_kode'		=> $this->kode->kode_angota(),
				'anggota_nik'		=> ucwords($p['anggota_nik']),
				'anggota_nama'		=> ucwords($p['anggota_nama']),
				'anggota_nohp'		=> $p['anggota_nohp'],
				'anggota_tgllahir'	=> $p['anggota_tgllahir'],
				'anggota_pekerjaan'	=> ucwords($p['anggota_pekerjaan']),
				'anggota_alamat'	=> ucwords($p['anggota_alamat']),
				'tgl_masuk_anggota' => date('Y-m-d'),
				'password'  => md5($p['anggota_password'])

			];
			$this->db->insert('anggota',$data);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil disimpan' });");
			redirect('anggota'); 
		}
		else
		{
			$data['master']		= 'active';
			$data['anggota']	= '';
			$data['body']		= 'page/anggota_form';
			$this->load->view('index',$data);
		}
	}
	public function anggota_edit($id)
	{
		if ($p = $this->input->post()) {
			$data = [
				'anggota_nik'		=> ucwords($p['anggota_nik']),
				'anggota_nama'		=> ucwords($p['anggota_nama']),
				'anggota_nohp'		=> $p['anggota_nohp'],
				'anggota_tgllahir'	=> $p['anggota_tgllahir'],
				'anggota_pekerjaan'	=> ucwords($p['anggota_pekerjaan']),
				'anggota_alamat'	=> ucwords($p['anggota_alamat']),

			];
			if ($p['anggota_password'] != '' OR $p['anggota_password'] != NULL) {
				$data['password']	= md5($p['anggota_password']);
			}
			$this->db->update('anggota',$data,['anggota_kode'=>$id]);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil diubah' });");
			redirect('anggota'); 
		}
		else
		{
			$data['master']		= 'active';
			$data['anggota']	= $this->db->get_where('anggota',['anggota_kode'=>$id])->row();
			$data['body']		= 'page/anggota_form';
			$this->load->view('index',$data);
		}
	}
	public function anggota_delete($id)
	{
		$this->db->delete('anggota',['anggota_kode'=>$id]);
		$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil dihapus' });");
		redirect('anggota'); 
	}

	public function user()
	{
		$data['master']		= 'active';
		$data['user']		= $this->data->user()->result();
		$data['body']		= 'page/user';
		$this->load->view('index',$data);
	}
	public function user_add()
	{
		if ($p = $this->input->post()) {
			$data = [
				'user_nama'			=> ucwords($p['user_nama']),
				'user_username'		=> ucwords($p['user_username']),
				'user_password'		=> md5($p['user_password']),
				'user_level'        => $p['user_level'],
			];
			$this->db->insert('user',$data);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil disimpan' });");
			redirect('user'); 
		}
		else
		{
			$data['master']		= 'active';
			$data['user']		= '';
			$data['body']		= 'page/user_form';
			$this->load->view('index',$data);
		}
	}
	public function user_edit($id)
	{
		if ($p = $this->input->post()) {
			$data = [
				'user_nama'			=> ucwords($p['user_nama']),
				'user_username'		=> ucwords($p['user_username']),
				'user_level'		=> $p['user_level'],
				
			];

			if ($p['user_password'] != '' OR $p['user_password'] != NULL) {
				$data['user_password']	= md5($p['user_password']);
			}
			$this->db->update('user',$data,['user_id'=>$id]);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil diubah' });");
			redirect('user'); 
		}
		else
		{
			$data['master']		= 'active';
			$data['user']		= $this->db->get_where('user',['user_id'=>$id])->row(); 
			$data['body']		= 'page/user_form';
			$this->load->view('index',$data);
		}
	}
	public function user_delete($id)
	{
		$this->db->delete('user',['user_id'=>$id]);
		$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil dihapus' });");
		redirect('user'); 
	}
	public function simpananWajib()
	{
		$data['jenis']		= 'wajib';
		$data['simpan']		= 'active';
		$data['data']		= $this->data->simpanan('wajib')->result(); 
		$data['body']		= 'page/simpanan';
		$this->load->view('index',$data);
	}
	public function wajib_add()
	{
		if ($p = $this->input->post()) {
			$data = [
				'simpanan_kode'			=> $this->kode->kode_simpanan('wajib'),
				'simpanan_anggota'		=> ucwords($p['simpanan_anggota']),
				'simpanan_jumlah'		=> $p['simpanan_jumlah'],
				'simpanan_jenis'		=> 'wajib',
				'simpanan_waktu'		=> date('Y-m-d H:i:s'),
			];
			$this->db->insert('simpanan',$data);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil disimpan' });");
			redirect('simpanan-wajib'); 
		}
		else
		{
			$data['jenis']		= 'wajib';
			$data['simpan']		= 'active';
			$data['data']		= '';
			$data['list']		= $this->data->anggota()->result();
			$data['body']		= 'page/simpanan_wajib';
			$this->load->view('index',$data);
		}
	}
	public function wajib_edit($id)
	{
		if ($p = $this->input->post()) {
			$data = [
				'simpanan_anggota'		=> ucwords($p['simpanan_anggota']),
				'simpanan_jumlah'		=> $p['simpanan_jumlah'],
				'simpanan_waktu'		=> date('Y-m-d H:i:s')
			];
			$this->db->update('simpanan',$data,['simpanan_kode'=>$id]);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil diubah' });");
			redirect('simpanan-wajib'); 
		}
		else
		{
			$data['jenis']		= 'wajib';
			$data['simpan']		= 'active';
			$data['data']		= $this->db->get_where('simpanan',['simpanan_kode'=>$id])->row();
			$data['list']		= $this->data->anggota()->result();
			$data['body']		= 'page/simpanan_wajib';
			$this->load->view('index',$data);
		}
	}
	public function simpanan_delete($id,$jenis)
	{
		$this->db->delete('simpanan',['simpanan_kode'=>$id]);
		$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil dihapus' });");
		redirect($this->agent->referrer()); 
	}
	public function simpananSukarela()
	{
		$data['jenis']		= 'sukarela';
		$data['simpan']		= 'active';
		$data['data']		= $this->data->simpanan('sukarela')->result(); 
		$data['body']		= 'page/simpanan';
		$this->load->view('index',$data);
	}
	public function sukarela_add()
	{
		if ($p = $this->input->post()) {
			$data = [
				'simpanan_kode'			=> $this->kode->kode_simpanan('sukarela'),
				'simpanan_anggota'		=> ucwords($p['simpanan_anggota']),
				'simpanan_jumlah'		=> $p['simpanan_jumlah'],
				'simpanan_jenis'		=> 'sukarela',
				'simpanan_waktu'		=> date('Y-m-d H:i:s'),
			];
			$this->db->insert('simpanan',$data);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil disimpan' });");
			redirect('simpanan-sukarela'); 
		}
		else
		{
			$data['jenis']		= 'sukarela';
			$data['simpan']		= 'active';
			$data['data']		= '';
			$data['list']		= $this->data->anggota()->result();
			$data['body']		= 'page/simpanan_sukarela';
			$this->load->view('index',$data);
		}
	}
	public function sukarela_edit($id)
	{
		if ($p = $this->input->post()) {
			$data = [
				'simpanan_anggota'		=> ucwords($p['simpanan_anggota']),
				'simpanan_jumlah'		=> $p['simpanan_jumlah'],
				'simpanan_waktu'		=> date('Y-m-d H:i:s')
			];
			$this->db->update('simpanan',$data,['simpanan_kode'=>$id]);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil diubah' });");
			redirect('simpanan-sukarela'); 
		}
		else
		{
			$data['jenis']		= 'sukarela';
			$data['simpan']		= 'active';
			$data['data']		= $this->db->get_where('simpanan',['simpanan_kode'=>$id])->row();
			$data['list']		= $this->data->anggota()->result();
			$data['body']		= 'page/simpanan_sukarela';
			$this->load->view('index',$data);
		}
	}
	public function simpananPokok()
	{
		$data['jenis']		= 'pokok';
		$data['simpan']		= 'active';
		$data['data']		= $this->data->simpanan('pokok')->result(); 
		$data['body']		= 'page/simpanan';
		$this->load->view('index',$data);
	}
	public function pokok_add()
	{
		if ($p = $this->input->post()) {
			$data = [
				'simpanan_kode'			=> $this->kode->kode_simpanan('pokok'),
				'simpanan_anggota'		=> ucwords($p['simpanan_anggota']),
				'simpanan_jumlah'		=> $p['simpanan_jumlah'],
				'simpanan_jenis'		=> 'pokok',
				'simpanan_waktu'		=> date('Y-m-d H:i:s'),
			];
			$this->db->insert('simpanan',$data);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil disimpan' });");
			redirect('simpanan-pokok'); 
		}
		else
		{
			$data['jenis']		= 'pokok';
			$data['simpan']		= 'active';
			$data['data']		= '';
			$data['list']		= $this->data->anggota()->result();
			$data['body']		= 'page/simpanan_pokok';
			$this->load->view('index',$data);
		}
	}
	public function pokok_edit($id)
	{
		if ($p = $this->input->post()) {
			$data = [
				'simpanan_anggota'		=> ucwords($p['simpanan_anggota']),
				'simpanan_jumlah'		=> $p['simpanan_jumlah'],
				'simpanan_waktu'		=> date('Y-m-d H:i:s')
			];
			$this->db->update('simpanan',$data,['simpanan_kode'=>$id]);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil diubah' });");
			redirect('simpanan-pokok'); 
		}
		else
		{
			$data['jenis']		= 'pokok';
			$data['simpan']		= 'active';
			$data['data']		= $this->db->get_where('simpanan',['simpanan_kode'=>$id])->row();
			$data['list']		= $this->data->anggota()->result();
			$data['body']		= 'page/simpanan_pokok';
			$this->load->view('index',$data);
		}
	}
	public function pinjaman()
	{
		$data['pinjaman']	= 'active';
		$data['data']		= $this->data->pinjaman()->result(); 
		$data['body']		= 'page/pinjaman';
		$this->load->view('index',$data);
	}
	public function pinjaman_add()
	{
		if ($p = $this->input->post()) {
			$data = [
				'pinjaman_kode'			=> $this->kode->kode_pinjaman(),
				'pinjaman_anggota'		=> ucwords($p['pinjaman_anggota']),
				'pinjaman_jumlah'		=> $p['pinjaman_jumlah'],
				'pinjaman_tempo'		=> $p['pinjaman_tempo'],
				'pinjaman_bunga'		=> $p['pinjaman_bunga'],
				'pinjaman_total'		=> ($p['pinjaman_bunga'] / 100 * $p['pinjaman_jumlah']) + $p['pinjaman_jumlah'],
				'pinjaman_jaminan'		=> $p['pinjaman_jaminan'],
				'pinjaman_waktu'		=> date('Y-m-d H:i:s'),
			];
			$this->db->insert('pinjaman',$data);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil disimpan' });");
			redirect('pinjaman'); 
		}
		else
		{
			$data['pinjaman']	= 'active';
			$data['data']		= '';
			$data['list']		= $this->data->anggota()->result();
			$data['body']		= 'page/pinjaman_form';
			$this->load->view('index',$data);
		}
	}
	public function pinjaman_edit($id)
	{
		if ($p = $this->input->post()) {
			$data = [
				'pinjaman_anggota'		=> ucwords($p['pinjaman_anggota']),
				'pinjaman_jumlah'		=> $p['pinjaman_jumlah'],
				'pinjaman_tempo'		=> $p['pinjaman_tempo'],
				'pinjaman_bunga'		=> $p['pinjaman_bunga'],
				'pinjaman_total'		=> ($p['pinjaman_bunga'] / 100 * $p['pinjaman_jumlah']) + $p['pinjaman_jumlah'],
				'pinjaman_jaminan'		=> $p['pinjaman_jaminan'],
				'pinjaman_waktu'		=> date('Y-m-d H:i:s'),
			];
			$this->db->update('pinjaman',$data,['pinjaman_kode'=>$id]);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil diubah' });");
			redirect('pinjaman'); 
		}
		else
		{
			$data['pinjaman']	= 'active';
			$data['data']		= $this->db->get_where('pinjaman',['pinjaman_kode'=>$id])->row();
			$data['list']		= $this->data->anggota()->result();
			$data['body']		= 'page/pinjaman_form';
			$this->load->view('index',$data);
		}
	}
	public function pinjaman_delete($id)
	{
		$this->db->delete('pinjaman',['pinjaman_kode'=>$id]);
		$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil dihapus' });");
		redirect('pinjaman'); 
	}
	public function angsuran()
	{
		$data['angsuran']	= 'active';
		$data['data']		= $this->data->pinjaman()->result(); 
		$data['body']		= 'page/angsuran';
		$this->load->view('index',$data);
	}
	public function angsuran_detail($id)
	{
		$data['angsuran']	= 'active';
		$data['data']		= $this->data->pinjaman_detail($id)->row(); 
		$data['body']		= 'page/angsuran_detail';
		$this->load->view('index',$data);
	}
	public function simpan_angsuran($id)
	{
		$angsuranke = $this->input->post('ke');
		$denda 		= $this->input->post('denda');
		$total 		= $this->input->post('total');
		$pokok 		= $this->input->post('pokok');

		$data 		= [
			'angsuran_pinjaman'	=> $id,
			'angsuran_waktu'	=> date('Y-m-d H:i:s'),
			'angsuran_ke'		=> $angsuranke,
			'angsuran_jumlah'	=> $pokok,
			'angsuran_denda'	=> $denda,
			'angsuran_total'	=> $total,
		];


		$sql = $this->db->insert('angsuran',$data);
		if ($sql) {
			echo 'oke';
		}
		else
		{
			echo 'error';
		}
	}
	public function laporan_anggota($aksi=null)
	{
		if ($aksi) {
			$data 	= $this->data->anggota()->result();
			$pdf 	= new FPDF('L', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetTitle('Cetak Laporan Anggota');
			$pdf->SetFont('times','B',16);
			$pdf->Cell(290,5,'Koperasi Arofah Kendal',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(290,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
			$pdf->Cell(290,5,'Hp : 082298630697',0,1,'C');

			$pdf->SetLineWidth(1);
			$pdf->Line(10,30,290,30);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,31,290,31);

			$pdf->ln(10);

			$pdf->SetFont('times','B',14);
			$pdf->Cell(290,5,'Laporan Anggota Koperasi',0,1,'C');

			$pdf->ln();

			$pdf->SetFont('times','B',11);
			$pdf->Cell(10,6,'No',1,0,'C');
			$pdf->Cell(30,6,'NIK',1,0,'C');
			$pdf->Cell(60,6,'Nama',1,0,'C');
			$pdf->Cell(30,6,'No HP',1,0,'C');
			$pdf->Cell(60,6,'Pekerjaan',1,0,'C');
			$pdf->Cell(90,6,'Alamat',1,1,'C');

			$pdf->SetFont('times','',10);
			$no = 1;
			if ($data) {
				foreach ($data as $d) { 
					$pdf->Cell(10,6,$no++,1,0,'C');
					$pdf->Cell(30,6,$d->anggota_nik,1,0,'C');
					$pdf->Cell(60,6,$d->anggota_nama,1,0);
					$pdf->Cell(30,6,$d->anggota_nohp,1,0,'C');
					$pdf->Cell(60,6,$d->anggota_pekerjaan,1,0,'C');
					$pdf->Cell(90,6,$d->anggota_alamat,1,1);
				}
				$pdf->ln(10);
				$pdf->Cell(280,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
				$pdf->ln(30);
				$pdf->Cell(270,5, 'Bendahara',0,0, 'R');
			}
			else
			{
				$pdf->Cell(290,6,'Data tidak ditemukan',1,1,'C');
			}

			$pdf->Output();
		}
		else
		{
			$data['laporan']	= 'active';
			$data['langgota']	= $this->data->anggota()->result();
			$data['body']		= 'page/lap_anggota';
			$this->load->view('index',$data);
		}
	}
	public function laporan_anggotap($aksi=null)
	{
		if ($aksi) {
			$awal 		= $this->input->get('awal');
			$akhir 		= $this->input->get('akhir');
			$data 		= $this->data->anggota_periode($awal,$akhir)->result();
			
			$pdf 	= new FPDF('L', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetTitle('Cetak Laporan Anggota');
			$pdf->SetFont('times','B',16);
			$pdf->Cell(290,5,'Koperasi Arofah Kendal',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(290,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
			$pdf->Cell(290,5,'Hp : 082298630697',0,1,'C');

			$pdf->SetLineWidth(1);
			$pdf->Line(10,30,290,30);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,31,290,31);

			$pdf->ln(10);

			$pdf->SetFont('times','B',14);
			$pdf->Cell(290,5,'Laporan Anggota Koperasi',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->ln();
			$pdf->Cell(290,5,'Periode '.tanggal($awal).' s/d '.tanggal($akhir),0,1,'C');

			$pdf->ln();

			$pdf->SetFont('times','B',11);
			$pdf->Cell(10,6,'No',1,0,'C');
			$pdf->Cell(30,6,'NIK',1,0,'C');
			$pdf->Cell(60,6,'Nama',1,0,'C');
			$pdf->Cell(30,6,'No HP',1,0,'C');
			$pdf->Cell(60,6,'Pekerjaan',1,0,'C');
			$pdf->Cell(90,6,'Alamat',1,1,'C');

			$pdf->SetFont('times','',10);
			$no = 1;
			if ($data) {
				foreach ($data as $d) { 
					$pdf->Cell(10,6,$no++,1,0,'C');
					$pdf->Cell(30,6,$d->anggota_nik,1,0,'C');
					$pdf->Cell(60,6,$d->anggota_nama,1,0);
					$pdf->Cell(30,6,$d->anggota_nohp,1,0,'C');
					$pdf->Cell(60,6,$d->anggota_pekerjaan,1,0,'C');
					$pdf->Cell(90,6,$d->anggota_alamat,1,1);
				}
				$pdf->ln(10);
				$pdf->Cell(280,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
				$pdf->ln(30);
				$pdf->Cell(270,5, 'Bendahara',0,0, 'R');
			}
			else
			{
				$pdf->Cell(290,6,'Data tidak ditemukan',1,1,'C');
			}

			$pdf->Output();
		}
		else
		{
			$data['laporan']	= 'active';
			$data['langgota']	= $this->data->anggota()->result();
			$data['body']		= 'page/lap_anggota';
			$this->load->view('index',$data);
		}
	}
	public function laporan_simpananp($aksi=null)
	{
		if ($aksi) {
			$awal 		= $this->input->get('awal');
			$akhir 		= $this->input->get('akhir');
			$data 		= $this->data->simpanan_periode($awal,$akhir)->result();

			$pdf 	= new FPDF('P', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetTitle('Cetak Laporan Simpanan Anggota');
			$pdf->SetFont('times','B',16);
			$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
			$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

			$pdf->SetLineWidth(1);
			$pdf->Line(10,30,200,30);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,31,200,31);

			$pdf->ln(10);

			$pdf->SetFont('times','B',14);
			$pdf->Cell(190,5,'Laporan Simpanan Anggota Koperasi',0,1,'C');

			$pdf->SetFont('times','',12);
			$pdf->ln();
			$pdf->Cell(190,5,'Periode '.tanggal($awal).' s/d '.tanggal($akhir),0,1,'C');

			$pdf->ln();

			$pdf->SetFont('times','B',11);
			$pdf->Cell(10,6,'No',1,0,'C');
			$pdf->Cell(50,6,'Nama',1,0,'C');
			$pdf->Cell(30,6,'Wajib',1,0,'C');
			$pdf->Cell(30,6,'Pokok',1,0,'C');
			$pdf->Cell(30,6,'Sukarela',1,0,'C');
			$pdf->Cell(40,6,'Total',1,1,'C');

			$pdf->SetFont('times','',10);
			$no = 1;
			if ($data) {
				foreach ($data as $d) { 
					$wajib    	= $this->data->simpanan_anggota($d->anggota_kode,'wajib')->row();
					$pokok    	= $this->data->simpanan_anggota($d->anggota_kode,'pokok')->row();
					$sukarela 	= $this->data->simpanan_anggota($d->anggota_kode,'sukarela')->row();
					$total    	= $this->data->simpanan_anggota($d->anggota_kode)->row();
					$pdf->Cell(10,6,$no++,1,0,'C');
					$pdf->Cell(50,6,$d->anggota_nama,1,0);
					$pdf->Cell(30,6,isset($wajib->jumlah)?'Rp. '.number_format($wajib->jumlah):'Rp. 0',1,0,'C');
					$pdf->Cell(30,6,isset($pokok->jumlah)?'Rp. '.number_format($pokok->jumlah):'Rp. 0',1,0,'C');
					$pdf->Cell(30,6,isset($sukarela->jumlah)?'Rp. '.number_format($sukarela->jumlah):'Rp. 0',1,0,'C');
					$pdf->Cell(40,6,isset($total->jumlah)?'Rp. '.number_format($total->jumlah):'Rp. 0',1,1,'C');
				}

				$pdf->ln(10);
				$pdf->Cell(190,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
				$pdf->ln(30);
				$pdf->Cell(180,5, 'Bendahara',0,0, 'R');
			}
			else
			{
				$pdf->Cell(190,6,'Data tidak ditemukan',1,1,'C');
			}

			$pdf->Output();
		}
		else
		{
			$data['laporan']	= 'active';
			$data['lsimpnan']	= $this->data->anggota()->result();
			$data['body']		= 'page/lap_simpanan';
			$this->load->view('index',$data);
		}
	}
	public function laporan_simpanan($aksi=null)
	{
		if ($aksi) {
			$data 		= $this->data->anggota()->result();

			$pdf 	= new FPDF('P', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetTitle('Cetak Laporan Simpanan Anggota');
			$pdf->SetFont('times','B',16);
			$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
			$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

			$pdf->SetLineWidth(1);
			$pdf->Line(10,30,200,30);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,31,200,31);

			$pdf->ln(10);

			$pdf->SetFont('times','B',14);
			$pdf->Cell(190,5,'Laporan Simpanan Anggota Koperasi',0,1,'C');

			$pdf->ln();

			$pdf->SetFont('times','B',11);
			$pdf->Cell(10,6,'No',1,0,'C');
			$pdf->Cell(50,6,'Nama',1,0,'C');
			$pdf->Cell(30,6,'Wajib',1,0,'C');
			$pdf->Cell(30,6,'Pokok',1,0,'C');
			$pdf->Cell(30,6,'Sukarela',1,0,'C');
			$pdf->Cell(40,6,'Total',1,1,'C');

			$pdf->SetFont('times','',10);
			$no = 1;
			if ($data) {
				foreach ($data as $d) { 
					$wajib    	= $this->data->simpanan_anggota($d->anggota_kode,'wajib')->row();
					$pokok    	= $this->data->simpanan_anggota($d->anggota_kode,'pokok')->row();
					$sukarela 	= $this->data->simpanan_anggota($d->anggota_kode,'sukarela')->row();
					$total    	= $this->data->simpanan_anggota($d->anggota_kode)->row();
					$pdf->Cell(10,6,$no++,1,0,'C');
					$pdf->Cell(50,6,$d->anggota_nama,1,0);
					$pdf->Cell(30,6,isset($wajib->jumlah)?'Rp. '.number_format($wajib->jumlah):'Rp. 0',1,0,'C');
					$pdf->Cell(30,6,isset($pokok->jumlah)?'Rp. '.number_format($pokok->jumlah):'Rp. 0',1,0,'C');
					$pdf->Cell(30,6,isset($sukarela->jumlah)?'Rp. '.number_format($sukarela->jumlah):'Rp. 0',1,0,'C');
					$pdf->Cell(40,6,isset($total->jumlah)?'Rp. '.number_format($total->jumlah):'Rp. 0',1,1,'C');
				}

				$pdf->ln(10);
				$pdf->Cell(190,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
				$pdf->ln(30);
				$pdf->Cell(180,5, 'Bendahara',0,0, 'R');
			}
			else
			{
				$pdf->Cell(190,6,'Data tidak ditemukan',1,1,'C');
			}

			$pdf->Output();
		}
		else
		{
			$data['laporan']	= 'active';
			$data['lsimpnan']	= $this->data->anggota()->result();
			$data['body']		= 'page/lap_simpanan';
			$this->load->view('index',$data);
		}
	}
	public function laporan_pinjaman($aksi=null)
	{
		if ($aksi) {
			$data 		= $this->data->pinjaman()->result();

			$pdf 	= new FPDF('P', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetTitle('Cetak Laporan Pinjaman Anggota');
			$pdf->SetFont('times','B',16);
			$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
			$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

			$pdf->SetLineWidth(1);
			$pdf->Line(10,30,200,30);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,31,200,31);

			$pdf->ln(10);

			$pdf->SetFont('times','B',14);
			$pdf->Cell(190,5,'Laporan Pinjaman Anggota Koperasi',0,1,'C');

			$pdf->ln();

			$pdf->SetFont('times','B',11);
			$pdf->Cell(10,6,'No',1,0,'C');
			$pdf->Cell(50,6,'Nama',1,0,'C');
			$pdf->Cell(30,6,'Jumlah',1,0,'C');
			$pdf->Cell(30,6,'Tempo',1,0,'C');
			$pdf->Cell(20,6,'Bunga',1,0,'C');
			$pdf->Cell(50,6,'Total',1,1,'C');

			$pdf->SetFont('times','',10);
			$no = 1;
			if ($data) {
				foreach ($data as $d) { 
					$pdf->Cell(10,6,$no++,1,0,'C');
					$pdf->Cell(50,6,$d->anggota_nama,1,0);
					$pdf->Cell(30,6,'Rp. '.number_format($d->pinjaman_jumlah),1,0,'C');
					$pdf->Cell(30,6,$d->pinjaman_tempo.' Bulan',1,0,'C');
					$pdf->Cell(20,6,$d->pinjaman_bunga.'%',1,0,'C');
					$pdf->Cell(50,6,'Rp. '.number_format($d->pinjaman_total),1,1,'C');
				}

				$pdf->ln(10);
				$pdf->Cell(190,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
				$pdf->ln(30);
				$pdf->Cell(180,5, 'Bendahara',0,0, 'R');
			}
			else
			{
				$pdf->Cell(190,6,'Data tidak ditemukan',1,1,'C');
			}

			$pdf->Output();
		}
		else
		{
			$data['laporan']	= 'active';
			$data['lpinjaman']	= $this->data->pinjaman()->result();
			$data['body']		= 'page/lap_pinjaman';
			$this->load->view('index',$data);
		}
	}
	public function laporan_pinjamanp($aksi=null)
	{
		if ($aksi) {
			$awal 		= $this->input->get('awal');
			$akhir 		= $this->input->get('akhir');
			$data 		= $this->data->pinjaman_periode($awal,$akhir)->result();

			$pdf 	= new FPDF('P', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetTitle('Cetak Laporan Pinjaman Anggota');
			$pdf->SetFont('times','B',16);
			$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
			$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

			$pdf->SetLineWidth(1);
			$pdf->Line(10,30,200,30);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,31,200,31);

			$pdf->ln(10);

			$pdf->SetFont('times','B',14);
			$pdf->Cell(190,5,'Laporan Pinjaman Anggota Koperasi',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(190,5,'Periode '.tanggal($awal).' s/d '.tanggal($akhir),0,1,'C');
			$pdf->ln();

			$pdf->SetFont('times','B',11);
			$pdf->Cell(10,6,'No',1,0,'C');
			$pdf->Cell(50,6,'Nama',1,0,'C');
			$pdf->Cell(30,6,'Jumlah',1,0,'C');
			$pdf->Cell(30,6,'Tempo',1,0,'C');
			$pdf->Cell(20,6,'Bunga',1,0,'C');
			$pdf->Cell(50,6,'Total',1,1,'C');

			$pdf->SetFont('times','',10);
			$no = 1;
			if ($data) {
				foreach ($data as $d) { 
					$pdf->Cell(10,6,$no++,1,0,'C');
					$pdf->Cell(50,6,$d->anggota_nama,1,0);
					$pdf->Cell(30,6,'Rp. '.number_format($d->pinjaman_jumlah),1,0,'C');
					$pdf->Cell(30,6,$d->pinjaman_tempo.' Bulan',1,0,'C');
					$pdf->Cell(20,6,$d->pinjaman_bunga.'%',1,0,'C');
					$pdf->Cell(50,6,'Rp. '.number_format($d->pinjaman_total),1,1,'C');
				}

				$pdf->ln(10);
				$pdf->Cell(190,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
				$pdf->ln(30);
				$pdf->Cell(180,5, 'Bendahara',0,0, 'R');
			}
			else
			{
				$pdf->Cell(190,6,'Data tidak ditemukan',1,1,'C');
			}

			$pdf->Output();
		}
		else
		{
			$data['laporan']	= 'active';
			$data['lpinjaman']	= $this->data->pinjaman()->result();
			$data['body']		= 'page/lap_pinjaman';
			$this->load->view('index',$data);
		}
	}
	public function kartu_pinjaman($aksi)
	{
		$data 		= $this->data->pinjaman_detail($aksi)->row();

		$pdf 	= new FPDF('P', 'mm', 'A4');
		$pdf->AddPage();
		$pdf->SetTitle('Cetak Kartu Pinjaman Anggota');
		$pdf->SetFont('times','B',16);
		$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
		$pdf->SetFont('times','',12);
		$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
		$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

		$pdf->SetLineWidth(1);
		$pdf->Line(10,30,200,30);
		$pdf->SetLineWidth(0);
		$pdf->Line(10,31,200,31);

		$pdf->ln(10);

		$pdf->SetFont('times','B',14);
		$pdf->Cell(190,5,'Kartu Pinjaman Anggota',0,1,'C');

		$pdf->ln();
		$pdf->SetFont('times','',11);

		$pdf->Cell(40,5,'Kode Pinjaman',0,0); $pdf->Cell(150,5,': '. $data->pinjaman_kode,0,1);
		$pdf->Cell(40,5,'Nama Anggota',0,0); $pdf->Cell(150,5,': '. $data->anggota_nama,0,1);
		$pdf->Cell(40,5,'No. Handphone',0,0); $pdf->Cell(150,5,': '. $data->anggota_nohp,0,1);
		$pdf->Cell(40,5,'Pekerjaan',0,0); $pdf->Cell(150,5,': '. $data->anggota_pekerjaan,0,1);
		$pdf->Cell(40,5,'Alamat',0,0); $pdf->Cell(150,5,': '. $data->anggota_alamat,0,1);
		$pdf->Cell(40,5,'Jumlah Pinjaman',0,0); $pdf->Cell(150,5,': Rp. '. number_format($data->pinjaman_jumlah),0,1);
		$pdf->Cell(40,5,'Tempo Pinjaman',0,0); $pdf->Cell(150,5,': '. $data->pinjaman_tempo.' Bulan',0,1);
		$pdf->Cell(40,5,'Bunga Pinjaman',0,0); $pdf->Cell(150,5,': '. $data->pinjaman_bunga.'%',0,1);
		$pdf->Cell(40,5,'Total Pengembalian',0,0); $pdf->Cell(150,5,': Rp. '. number_format($data->pinjaman_total),0,1);
		$pdf->Cell(40,5,'Jaminan',0,0); $pdf->Cell(150,5,': '. $data->pinjaman_jaminan,0,1);

		$pdf->SetFont('times','B',11);
		$pdf->ln();
		$pdf->Cell(190,5,'Daftar Pembayaran',0,1,'C');
		$pdf->ln();
		$pdf->SetFont('times','B',11);
		$pdf->Cell(10,6,'Ke',1,0,'C');
		$pdf->Cell(50,6,'Waktu',1,0,'C');
		$pdf->Cell(40,6,'Pokok',1,0,'C');
		$pdf->Cell(40,6,'Denda',1,0,'C');
		$pdf->Cell(50,6,'Total',1,1,'C');

		$pdf->SetFont('times','',10);
		$no = 1;
		$pokok = $data->pinjaman_total / $data->pinjaman_tempo;
		for ($i=1; $i <= $data->pinjaman_tempo ; $i++) {
			$cek = $this->db->get_where('angsuran',['angsuran_ke'=>$i,'angsuran_pinjaman'=>$data->pinjaman_kode])->row();

			$pdf->Cell(10,6,$i,1,0,'C');
			$pdf->Cell(50,6,isset($cek)?date('H:i',strtotime($cek->angsuran_waktu)).', '.tanggal(date('Y-m-d',strtotime($cek->angsuran_waktu))):'-',1,0,'C');
			$pdf->Cell(40,6,isset($cek)?'Rp. '.number_format($cek->angsuran_jumlah):'-',1,0,'C');
			$pdf->Cell(40,6,isset($cek)?'Rp. '.number_format($cek->angsuran_denda):'-',1,0,'C');
			$pdf->Cell(50,6,isset($cek)?'Rp. '.number_format($cek->angsuran_total):'-',1,1,'C');
		}

		$pdf->ln(20);
		$pdf->Cell(190,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
		$pdf->ln(20);
		$pdf->Cell(180,5, 'Bendahara',0,0, 'R');

		$pdf->Output();
	}
	public function laporan_angsuran($aksi=null)
	{
		if ($aksi) {
			$data 		= $this->data->angsuran()->result();

			$pdf 	= new FPDF('P', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetTitle('Cetak Laporan Angsuran Anggota');
			$pdf->SetFont('times','B',16);
			$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
			$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

			$pdf->SetLineWidth(1);
			$pdf->Line(10,30,200,30);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,31,200,31);

			$pdf->ln(10);

			$pdf->SetFont('times','B',14);
			$pdf->Cell(190,5,'Laporan Angsuran Anggota Koperasi',0,1,'C');
			$pdf->ln();

			$pdf->SetFont('times','B',11);
			$pdf->Cell(10,6,'No',1,0,'C');
			$pdf->Cell(50,6,'Nama',1,0,'C');
			$pdf->Cell(20,6,'Ke',1,0,'C');
			$pdf->Cell(35,6,'Jumlah',1,0,'C');
			$pdf->Cell(30,6,'Denda',1,0,'C');
			$pdf->Cell(45,6,'Total',1,1,'C');

			$pdf->SetFont('times','',10);
			$no = 1;
			if ($data) {
				foreach ($data as $d) { 
					$pdf->Cell(10,6,$no++,1,0,'C');
					$pdf->Cell(50,6,$d->anggota_nama,1,0);
					$pdf->Cell(20,6,$d->angsuran_ke,1,0,'C');
					$pdf->Cell(35,6,'Rp. '.number_format($d->angsuran_jumlah),1,0,'C');
					$pdf->Cell(30,6,'Rp. '.number_format($d->angsuran_denda),1,0,'C');
					$pdf->Cell(45,6,'Rp. '.number_format($d->angsuran_total),1,1,'C');
				}
				$pdf->ln(10);
				$pdf->Cell(180,2, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
				$pdf->ln(30);
				$pdf->Cell(170,2, 'Bendahara',0,0, 'R');
			}
			else
			{
				$pdf->Cell(190,6,'Data tidak ditemukan',1,1,'C');
			}

			$pdf->Output();
		}
		else
		{
			$data['laporan']	= 'active';
			$data['langsuran']	= $this->data->angsuran()->result();
			$data['body']		= 'page/lap_angsuran';
			$this->load->view('index',$data);
		}
	}
	public function laporan_angsuranp($aksi=null)
	{
		if ($aksi) {
			$awal 		= $this->input->get('awal');
			$akhir 		= $this->input->get('akhir');
			$data 		= $this->data->angsuran_periode($awal,$akhir)->result();

			$pdf 	= new FPDF('P', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetTitle('Cetak Laporan Angsuran Anggota');
			$pdf->SetFont('times','B',16);
			$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
			$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

			$pdf->SetLineWidth(1);
			$pdf->Line(10,30,200,30);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,31,200,31);

			$pdf->ln(10);

			$pdf->SetFont('times','B',14);
			$pdf->Cell(190,5,'Laporan Angsuran Anggota Koperasi',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(190,5,'Periode '.tanggal($awal).' s/d '.tanggal($akhir),0,1,'C');

			$pdf->ln();

			$pdf->SetFont('times','B',11);
			$pdf->Cell(10,6,'No',1,0,'C');
			$pdf->Cell(50,6,'Nama',1,0,'C');
			$pdf->Cell(20,6,'Ke',1,0,'C');
			$pdf->Cell(35,6,'Jumlah',1,0,'C');
			$pdf->Cell(30,6,'Denda',1,0,'C');
			$pdf->Cell(45,6,'Total',1,1,'C');

			$pdf->SetFont('times','',10);
			$no = 1;
			if ($data) {
				foreach ($data as $d) { 
					$pdf->Cell(10,6,$no++,1,0,'C');
					$pdf->Cell(50,6,$d->anggota_nama,1,0);
					$pdf->Cell(20,6,$d->angsuran_ke,1,0,'C');
					$pdf->Cell(35,6,'Rp. '.number_format($d->angsuran_jumlah),1,0,'C');
					$pdf->Cell(30,6,'Rp. '.number_format($d->angsuran_denda),1,0,'C');
					$pdf->Cell(45,6,'Rp. '.number_format($d->angsuran_total),1,1,'C');
				}
				$pdf->ln(10);
				$pdf->Cell(180,2, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
				$pdf->ln(30);
				$pdf->Cell(170,2, 'Bendahara',0,0, 'R');
			}
			else
			{
				$pdf->Cell(190,6,'Data tidak ditemukan',1,1,'C');
			}

			$pdf->Output();
		}
		else
		{
			$data['laporan']	= 'active';
			$data['langsuran']	= $this->data->angsuran()->result();
			$data['body']		= 'page/lap_angsuran';
			$this->load->view('index',$data);
		}
	}
	public function akun()
	{
		$data['mneraca']	= 'active';
		$data['akun']	= 'active';
		$data['akuns']	= $this->data->listAkun()->result();
		$data['body']	= 'page/akun';
		$this->load->view('index',$data);
	}
	public function akun_add()
	{
		if ($p = $this->input->post()) {
			$data = [
				'kode'			=> ucwords($p['kode']),
				'nama'			=> ucwords($p['nama']),				
			];
			$this->db->insert('akun',$data);

			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil disimpan' });");
			redirect('akun'); 
		}
		else
		{
			$data['akun']	= 'active';
			$data['body']	= 'page/akun_form';

			$this->load->view('index',$data);
		}		
	}
	public function akun_edit($id)
	{
		if ($p = $this->input->post()) {

			$data = [
				'kode'			=> ucwords($p['kode']),
				'nama'			=> ucwords($p['nama']),				
			];

			$this->db->update('akun',$data,['kode'=>$id]);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil diubah' });");

			redirect('akun'); 
		}
		else
		{
			$data['akun']	= 'active';
			$data['body']	= 'page/akun_form';
			$data['data']	=  $this->db->get_where('akun',['kode'=>$id])->row();

			$this->load->view('index',$data);
		}
	}
	public function akun_delete($id)
	{
		$this->db->delete('akun',['kode'=>$id]);
		$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil dihapus' });");

		redirect('akun'); 
	}
	public function neraca()
	{
		$data['neraca']		= 'active';
		$data['mneraca']    = 'active';
		$data['body']		= 'page/neraca';
		$data['neraca']		= $this->data->listNeraca()->result();


		$this->load->view('index',$data);
	}
	public function neraca_add()
	{
		if ($payload = $this->input->post() )
		{
			$tanggal 	= $payload['tanggal'];
			$keterangan = $payload['keterangan'];			

			$length = count($payload['kode']);

			for ( $i = 0; $i < $length; $i++ ):
				$data = [
					'kode'			=> 'T'.date('YmdHis').$i,					
					'tanggal'		=> $tanggal,
					'keterangan'	=> $keterangan,
					'kode_akun'		=> $payload['kode'][$i],
					'debit'			=> $payload['debit'][$i] ?? 0,
					'kredit'		=> $payload['kredit'][$i] ?? 0,
				];
				$this->db->insert('jurnal',$data);			
			endfor;

			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil disimpan' });");
			redirect('neraca');
		}
		else 
		{
			$data['neraca']		= 'active';
			$data['body']		= 'page/neraca_form';
			$data['akuns']		= $this->data->listAkun()->result();		
			$data['kode']		= 'T'.date('YmdHis');

			$this->load->view('index',$data);
		}
	}
	public function neraca_edit($id)
	{
		if ($payload = $this->input->post() )
		{
			$tanggal 	= $payload['tanggal'];
			$keterangan = $payload['keterangan'];
			$kode		= $payload['kode'];
			$debit		= $payload['debit'];
			$kredit		= $payload['kredit'];

			$data = [
				'tanggal'		=> $tanggal,
				'keterangan'	=> $keterangan,
				'kode_akun'		=> $kode,
				'debit'			=> $debit,
				'kredit'		=> $kredit,
			];
			
			$this->db->update('jurnal',$data,['jurnal_id'=>$id]);			

			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil diubah' });");
			redirect('neraca');
		}
		else 
		{
			$data['neraca']		= 'active';
			$data['body']		= 'page/neraca_edit';
			$data['akuns']		= $this->data->listAkun()->result();		
			$data['data']		= $this->db->get_where('jurnal',['jurnal_id'=>$id])->row();
			$data['kode']		= $id;

			$this->load->view('index',$data);
		}
	}
	public function neraca_delete($id)
	{
		$this->db->delete('jurnal',['jurnal_id'=>$id]);
		$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil dihapus' });");

		redirect('neraca');
	}
	public function laporan_neraca()
	{
		$data['laporan']	= 'active';
		$data['lneraca']	= 'active';
		$data['body']		= 'page/lap_neraca';
		$tahun              = date('Y');
		$tahunp 		    = $this->input->get('tahun');
		$data['tahunp']     = $tahunp;

		if ($tahunp) {
			$data['neraca']		= $this->db->query("
				SELECT 
				kode_akun,
				SUM(debit) as debit,
				SUM(kredit) as kredit,
				akun.nama as nama
				FROM jurnal 
				JOIN akun ON akun.kode = jurnal.kode_akun WHERE year(tanggal) = '$tahunp'
				GROUP BY kode_akun"
			)->result();

			$data['aktiva_lancar'] = $this->db->query("
				SELECT 
				kode_akun,
				SUM(debit) as debit,
				SUM(kredit) as kredit,
				akun.nama as nama
				FROM jurnal 					
				JOIN akun ON akun.kode = jurnal.kode_akun			
				WHERE kode_akun LIKE '1-1%' AND year(tanggal) = '$tahunp'
				GROUP BY kode_akun"
			)->result();

			$data['aktiva_tetap'] = $this->db->query("
				SELECT 
				kode_akun,
				SUM(debit) as debit,
				SUM(kredit) as kredit,
				akun.nama as nama
				FROM jurnal 
				JOIN akun ON akun.kode = jurnal.kode_akun
				WHERE kode_akun LIKE '1-2%' AND year(tanggal) = '$tahunp'
				GROUP BY kode_akun"
			)->result();	

			$data['modal'] = $this->db->query("
				SELECT 
				kode_akun,
				SUM(debit) as debit,
				SUM(kredit) as kredit,
				akun.nama as nama
				FROM jurnal 
				JOIN akun ON akun.kode = jurnal.kode_akun
				WHERE kode_akun LIKE '3-1%' AND year(tanggal) = '$tahunp'
				OR kode_akun LIKE '3-2%'
				GROUP BY kode_akun"
			)->result();			

			$data['kewajiban'] = $this->db->query("
				SELECT 
				kode_akun,
				SUM(debit) as debit,
				SUM(kredit) as kredit,
				akun.nama as nama
				FROM jurnal 
				JOIN akun ON akun.kode = jurnal.kode_akun
				WHERE akun.kode LIKE '2-1%'
				OR kode_akun LIKE '4-1%'
				OR kode_akun LIKE '5-1%' AND year(tanggal) = '$tahunp'
				GROUP BY kode_akun"
			)->result();

			$data['tgl'] = $this->db->query("
				SELECT tanggal FROM jurnal GROUP BY year(tanggal) 
				")->result();
			$url_cetak = 'print-neracap/cetak-periode?tahun='.$tahunp.'';
			$data['url_cetak'] = base_url($url_cetak);
			$this->load->view('index',$data);
			
		}else{
			$data['neraca']		= $this->db->query("
				SELECT 
				kode_akun,
				SUM(debit) as debit,
				SUM(kredit) as kredit,
				akun.nama as nama
				FROM jurnal 
				JOIN akun ON akun.kode = jurnal.kode_akun WHERE year(tanggal) = '$tahun'
				GROUP BY kode_akun"
			)->result();

			$data['aktiva_lancar'] = $this->db->query("
				SELECT 
				kode_akun,
				SUM(debit) as debit,
				SUM(kredit) as kredit,
				akun.nama as nama
				FROM jurnal 					
				JOIN akun ON akun.kode = jurnal.kode_akun			
				WHERE kode_akun LIKE '1-1%' AND year(tanggal) = '$tahun'
				GROUP BY kode_akun"
			)->result();

			$data['aktiva_tetap'] = $this->db->query("
				SELECT 
				kode_akun,
				SUM(debit) as debit,
				SUM(kredit) as kredit,
				akun.nama as nama
				FROM jurnal 
				JOIN akun ON akun.kode = jurnal.kode_akun
				WHERE kode_akun LIKE '1-2%' AND year(tanggal) = '$tahun'
				GROUP BY kode_akun"
			)->result();	

			$data['modal'] = $this->db->query("
				SELECT 
				kode_akun,
				SUM(debit) as debit,
				SUM(kredit) as kredit,
				akun.nama as nama
				FROM jurnal 
				JOIN akun ON akun.kode = jurnal.kode_akun
				WHERE kode_akun LIKE '3-1%' AND year(tanggal) = '$tahun'
				OR kode_akun LIKE '3-2%'
				GROUP BY kode_akun"
			)->result();			

			$data['kewajiban'] = $this->db->query("
				SELECT 
				kode_akun,
				SUM(debit) as debit,
				SUM(kredit) as kredit,
				akun.nama as nama
				FROM jurnal 
				JOIN akun ON akun.kode = jurnal.kode_akun
				WHERE akun.kode LIKE '2-1%'
				OR kode_akun LIKE '4-1%'
				OR kode_akun LIKE '5-1%' AND year(tanggal) = '$tahun'
				GROUP BY kode_akun"
			)->result();

			$data['tgl'] = $this->db->query("
				SELECT tanggal FROM jurnal GROUP BY year(tanggal) 
				")->result();

			$url_cetak = 'print-neracap/cetak-periode?tahun='.$tahun.'';
			$data['url_cetak'] = base_url($url_cetak);
			$this->load->view('index',$data);
		}
	}
	public function laporan_shu()
	{
		$data['laporan']	= 'active';
		$data['lshu']		= 'active';

		$data['body']		= 'page/lap_shu';
		$tahun              = date('Y');
		$tahunp 		    = $this->input->get('tahun');
		$data['tahunp']     = $tahunp;


		if ($tahunp) {
			$data['data'] = $this->db->query("
				SELECT
				sum(pinjaman_total - pinjaman_jumlah) as pinjaman
				FROM pinjaman WHERE year(pinjaman_waktu) = '$tahunp'
				")->row();


			$data['tgl'] = $this->db->query("
				SELECT pinjaman_waktu FROM pinjaman GROUP BY year(pinjaman_waktu) 
				")->result();
			$url_cetak = 'print-shu/cetak-periode?tahun='.$tahunp.'';
			$data['url_cetak'] = base_url($url_cetak);
			$this->load->view('index',$data);
		}else{
			$data['data'] = $this->db->query("
				SELECT
				sum(pinjaman_total - pinjaman_jumlah) as pinjaman
				FROM pinjaman WHERE year(pinjaman_waktu) = '$tahun';
				")->row();
			$data['tgl'] = $this->db->query("
				SELECT pinjaman_waktu FROM pinjaman GROUP BY year(pinjaman_waktu) 
				")->result();
			$url_cetak = 'print-shu/cetak-periode?tahun='.$tahun.'';
			$data['url_cetak'] = base_url($url_cetak);
			$this->load->view('index',$data);
		}
	}

	public function laporan_shu_perorangan()
	{
		$data['laporan']	= 'active';
		$data['lshup']		= 'active';

		$data['body']		= 'page/lap_shup';
		$tahun              = date('Y');
		$tahunp 		    = $this->input->get('tahun');
		$data['tahunp']     = $tahunp;


		if ($tahunp) {
			$data['data'] = $this->db->query("
				SELECT *								
				FROM pinjaman 
				JOIN anggota ON anggota.anggota_kode = pinjaman.pinjaman_anggota
				WHERE year(pinjaman_waktu) = '$tahunp'				
				;
				")->result();

			$data['tgl'] = $this->db->query("
				SELECT pinjaman_waktu FROM pinjaman GROUP BY year(pinjaman_waktu) 
				")->result();
			$url_cetak = 'print-shup/cetak-periode?tahun='.$tahunp.'';
			$data['url_cetak'] = base_url($url_cetak);
			$this->load->view('index',$data);
		}else{
			$data['data'] = $this->db->query("
				SELECT
				*				
				FROM pinjaman 
				JOIN anggota ON anggota.anggota_kode = pinjaman.pinjaman_anggota
				WHERE year(pinjaman_waktu) = '$tahun'		
				;
				")->result();
			$data['tgl'] = $this->db->query("
				SELECT pinjaman_waktu FROM pinjaman GROUP BY year(pinjaman_waktu) 
				")->result();
			$url_cetak = 'print-shup/cetak-periode?tahun='.$tahun.'';
			$data['url_cetak'] = base_url($url_cetak);
			$this->load->view('index',$data);
		}
	}

	public function laporan_shu_perorangan_2()
	{
		$data['laporan']	= 'active';
		$data['lshup']		= 'active';

		$anggota = $this->data->anggota()->result();
		$data['shu_perorangan'] = [];
		$data['total_simpanan'] = 0;
		$data['total_pinjaman'] = 0;
		$data['body'] = 'page/lap_shup_2';
		$tahun = date('Y');
		$tahunp = $this->input->get("tahun");
		$data['tahunp'] = $tahunp;

		if($tahunp) {
			$data['tanggal'] = $this->data->pilih_tanggal()->result();

			if($anggota) {
				foreach($anggota as $ang) :
					$shu_perorangan = $this->data->shu_perorangan($ang->anggota_kode);
					array_push($data['shu_perorangan'], $shu_perorangan);
					$data['total_simpanan'] += $shu_perorangan['besar_simpanan'];
					$data['total_pinjaman'] += $shu_perorangan['besar_pinjaman'];
				endforeach;
			}

			$data['shu_keseluruhan'] = $this->data->shu_keseluruhan($tahunp);

			$url_cetak = 'cetak-shup/cetak-periode?tahun='.$tahunp;
			$data['url_cetak'] = base_url($url_cetak);
		} else {
			$data['tanggal'] = $this->data->pilih_tanggal()->result();

			if($anggota) {
				foreach($anggota as $ang) :
					$shu_perorangan = $this->data->shu_perorangan($ang->anggota_kode);
					array_push($data['shu_perorangan'], $shu_perorangan);
					$data['total_simpanan'] += $shu_perorangan['besar_simpanan'];
					$data['total_pinjaman'] += $shu_perorangan['besar_pinjaman'];
				endforeach;
			}

			$data['shu_keseluruhan'] = $this->data->shu_keseluruhan($tahun);

			$url_cetak = 'cetak-shup/cetak-periode?tahun='.$tahun;
			$data['url_cetak'] = base_url($url_cetak);
		}
		
		$this->load->view('index', $data);
	}

	public function cetak_shup($aksi=null)
	{
		if($aksi) {
			$anggota = $this->data->anggota()->result();
			$data['shu_perorangan'] = [];
			$data['total_simpanan'] = 0;
			$data['total_pinjaman'] = 0;
			$tahun = date('Y');
			$tahunp = $this->input->get("tahun");
			$data['tahunp'] = $tahunp;

			if($tahunp) {
				$data['tanggal'] = $this->data->pilih_tanggal()->result();

				if($anggota) {
					foreach($anggota as $ang) :
						$shu_perorangan = $this->data->shu_perorangan($ang->anggota_kode);
						array_push($data['shu_perorangan'], $shu_perorangan);
						$data['total_simpanan'] += $shu_perorangan['besar_simpanan'];
						$data['total_pinjaman'] += $shu_perorangan['besar_pinjaman'];
					endforeach;
				}

				$data['shu_keseluruhan'] = $this->data->shu_keseluruhan($tahunp);
			} else {
				$data['tanggal'] = $this->data->pilih_tanggal()->result();

				if($anggota) {
					foreach($anggota as $ang) :
						$shu_perorangan = $this->data->shu_perorangan($ang->anggota_kode);
						array_push($data['shu_perorangan'], $shu_perorangan);
						$data['total_simpanan'] += $shu_perorangan['besar_simpanan'];
						$data['total_pinjaman'] += $shu_perorangan['besar_pinjaman'];
					endforeach;
				}

				$data['shu_keseluruhan'] = $this->data->shu_keseluruhan($tahun);
			}

			$this->load->view('page/cetak_shup', $data);
		} else {
			redirect('laporan-shu-perorangan-2');
		}	
	}

	public function penarikan()
	{
		$data['penarikan']	= 'active';
		$data['data']	= $this->data->listPenarikan()->result();
		$data['list']	= $this->data->anggota()->result();		
		$data['body']	= 'page/penarikan';

		$this->load->view('index',$data);
	}
	public function penarikan_add()
	{
		if ($p = $this->input->post()) {

			$simpanan = $this->db->query(
				"SELECT 
				sum(simpanan_jumlah) as total
				FROM simpanan
				WHERE simpanan_anggota = '$p[anggota_id]'
				AND simpanan_jenis = 'pokok'
				GROUP BY simpanan_jenis"
			)->row();			

			if($simpanan->total < $p['amount'])
			{
				$this->session->set_flashdata('msg', "Toast.fire({ icon: 'error', title: 'Maaf, saldo tidak mencukupi' });");
				redirect('penarikan');
			}		

			$data = [
				'kode'					=> $this->kode->kode_penarikan(),
				'anggota_id'			=> ucwords($p['anggota_id']),
				'amount'				=> ucwords($p['amount']),				
			];

			$this->db->insert('penarikan',$data);			


			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil disimpan' });");
			redirect('penarikan'); 
		}
		else
		{
			$data['penarikan']	= 'active';
			$data['body']	= 'page/penarikan_form';
			$data['list']	= $this->data->anggota()->result();		

			$this->load->view('index',$data);
		}		
	}

	public function penarikan_edit($id)
	{
		if ($p = $this->input->post()) {

			$data = [
				'amount'				=> ucwords($p['amount']),				
			];

			$this->db->update('penarikan',$data,['kode'=>$id]);
			$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil diubah' });");

			redirect('penarikan'); 
		}
		else
		{
			$data['penarikan']	= 'active';
			$data['body']	= 'page/penarikan_form';
			$data['data']	=  $this->db->get_where('penarikan',['kode'=>$id])->row();
			$data['list']	= $this->data->anggota()->result();		

			$this->load->view('index',$data);
		}
	}

	public function penarikan_delete($id)
	{
		$this->db->delete('penarikan',['kode'=>$id]);
		$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Data berhasil dihapus' });");

		redirect('penarikan'); 
	}

	public function laporan_penarikan()
	{
		$data['laporan'] = 'active';
		$data['lpenarikan']	= 'active';
		$data['data']	= $this->data->listPenarikan()->result();		
		$data['body']	= 'page/lap_penarikan';

		$this->load->view('index',$data);		
	}

	public function print_neracap($aksi=null)
	{
		if ($aksi) {

			$tahun              = date('Y');
			$tahunp 		    = $this->input->get('tahun');
			$data['tahunp']     = $tahunp;

			if ($tahunp) {
				$neraca		= $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun WHERE year(tanggal) = '$tahunp'
					GROUP BY kode_akun"
				)->result();

				$aktiva_lancar = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 					
					JOIN akun ON akun.kode = jurnal.kode_akun			
					WHERE kode_akun LIKE '1-1%' AND year(tanggal) = '$tahunp'
					GROUP BY kode_akun"
				)->result();

				$aktiva_tetap = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun
					WHERE kode_akun LIKE '1-2%' AND year(tanggal) = '$tahunp'
					GROUP BY kode_akun"
				)->result();	

				$modal = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun
					WHERE kode_akun LIKE '3-1%' AND year(tanggal) = '$tahunp'
					OR kode_akun LIKE '3-2%'
					GROUP BY kode_akun"
				)->result();			

				$kewajiban = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun
					WHERE akun.kode LIKE '2-1%'
					OR kode_akun LIKE '4-1%'
					OR kode_akun LIKE '5-1%' AND year(tanggal) = '$tahunp'
					GROUP BY kode_akun"
				)->result();

			}else{
				$neraca	= $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun WHERE year(tanggal) = '$tahun'
					GROUP BY kode_akun"
				)->result();

				$aktiva_lancar = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 					
					JOIN akun ON akun.kode = jurnal.kode_akun			
					WHERE kode_akun LIKE '1-1%' AND year(tanggal) = '$tahun'
					GROUP BY kode_akun"
				)->result();

				$aktiva_tetap = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun
					WHERE kode_akun LIKE '1-2%' AND year(tanggal) = '$tahun'
					GROUP BY kode_akun"
				)->result();	

				$modal = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun
					WHERE kode_akun LIKE '3-1%' AND year(tanggal) = '$tahun'
					OR kode_akun LIKE '3-2%'
					GROUP BY kode_akun"
				)->result();			

				$kewajiban = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun
					WHERE akun.kode LIKE '2-1%'
					OR kode_akun LIKE '4-1%'
					OR kode_akun LIKE '5-1%' AND year(tanggal) = '$tahun'
					GROUP BY kode_akun"
				)->result();
			}

			$pdf 	= new FPDF('P', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetTitle('Cetak Laporan Neraca');
			$pdf->SetFont('times','B',16);
			$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
			$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

			$pdf->SetLineWidth(1);
			$pdf->Line(10,30,200,30);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,31,200,31);

			$pdf->ln(10);

			$pdf->SetFont('times','B',14);
			$pdf->Cell(190,5,'Laporan Neraca',0,1,'C');

			$pdf->ln(1);
			$pdf->SetFont('times','B',12);
			$pdf->Cell(190,5,'Periode '.$tahunp,0,1,'C');
			$pdf->ln();

			$pdf->ln(1);
			$pdf->SetFont('times','B',12);
			$pdf->Cell(1,5,'Aktiva',0,0,'L');
			$pdf->Cell(360,5,'Pasiva',0,1,'C');
			$pdf->ln();

			$pdf->SetFont('times','B',11);
			$pdf->Cell(55,6,'keterangan',1,0);
			$pdf->Cell(40,6,'Saldo',1,0);
			$pdf->Cell(55,6,'keterangan',1,0);
			$pdf->Cell(40,6,'Saldo',1,1);


			$pdf->SetFont('times','',10);
			$no = 1;
			if ($neraca) {
				$pdf->SetFont('times','B',10);
				$pdf->Cell(55,6,'Aktiva Lancar',1,0);
				$pdf->Cell(40,6,'',1,0);
				$pdf->Cell(55,6,'Kewajiban',1,0);
				$pdf->Cell(40,6,'',1,1);

				$total_aktiva = 0;
				$total_pasiva = 0;
				$countNeraca  = count($neraca);

				$pdf->SetFont('times','',10);

				for($i=0; $i<$countNeraca; $i++){
					$total_aktiva += $neraca[$i]->debit;
					$total_pasiva += $neraca[$i]->kredit;

					if( isset($aktiva_lancar[$i]) ){
						$pdf->Cell(55,6,$aktiva_lancar[$i]->nama,1,0);
						$pdf->Cell(40,6,'Rp. '.number_format($aktiva_lancar[$i]->debit),1,0);
					}else{
						$pdf->Cell(55,6,'',1,0);
						$pdf->Cell(40,6,'',1,0);
					}

					if( isset($kewajiban[$i]) ){
						$pdf->Cell(55,6,$kewajiban[$i]->nama,1,0);
						$pdf->Cell(40,6,'Rp. '.number_format($kewajiban[$i]->kredit),1,1);
					}else{
						$pdf->Cell(55,6,'',1,0);
						$pdf->Cell(40,6,'',1,1);
					}

				}

				$pdf->SetFont('times','B',11);
				$pdf->Cell(55,6,'Aktiva Tetap',1,0);
				$pdf->Cell(40,6,'',1,0);
				$pdf->SetFont('times','B',11);
				$pdf->Cell(55,6,'Modal',1,0);
				$pdf->Cell(40,6,'',1,1);

				$pdf->SetFont('times','',10);

				for($i=0; $i<$countNeraca; $i++){
					if( isset($aktiva_tetap[$i]) ){
						$pdf->Cell(55,6,$aktiva_tetap[$i]->nama,1,0);
						$pdf->Cell(40,6,'Rp. '.number_format($aktiva_tetap[$i]->debit),1,0);
					}else{
						$pdf->Cell(55,6,'',1,0);
						$pdf->Cell(40,6,'',1,0);
					}

					if( isset($modal[$i]) ){
						$pdf->Cell(55,6,$modal[$i]->nama ,1,0);
						$pdf->Cell(40,6,'Rp. '.number_format($modal[$i]->kredit),1,1);
					}else{
						$pdf->Cell(55,6,'',1,0);
						$pdf->Cell(40,6,'',1,1);
					}

				}

				$pdf->SetFont('times','B',11);
				$pdf->Cell(55,6,'Total Aktiva',1,0);
				$pdf->Cell(40,6,'Rp. '.number_format($total_aktiva),1,0);
				$pdf->SetFont('times','B',11);
				$pdf->Cell(55,6,'Total Pasiva',1,0);
				$pdf->Cell(40,6,'Rp. '.number_format($total_pasiva),1,1);
				
				$pdf->ln(10);
				$pdf->Cell(190,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
				$pdf->ln(30);
				$pdf->Cell(180,5, 'Bendahara',0,0, 'R');
			}
			else
			{
				$pdf->Cell(190,6,'Data tidak ditemukan',1,1,'C');
			}

			$pdf->Output();
		}
		else
		{
			$data['laporan'] = 'active';
			$data['lneraca'] = 'active';
			$data['body']	 = 'page/lap_neraca';
			$tahun           = date('Y');
			$tahunp 		 = $this->input->get('tahun');
			$data['tahunp']  = $tahunp;

			if ($tahunp) {
				$data['neraca']		= $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun WHERE year(tanggal) = '$tahunp'
					GROUP BY kode_akun"
				)->result();

				$data['aktiva_lancar'] = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 					
					JOIN akun ON akun.kode = jurnal.kode_akun			
					WHERE kode_akun LIKE '1-1%' AND year(tanggal) = '$tahunp'
					GROUP BY kode_akun"
				)->result();

				$data['aktiva_tetap'] = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun
					WHERE kode_akun LIKE '1-2%' AND year(tanggal) = '$tahunp'
					GROUP BY kode_akun"
				)->result();	

				$data['modal'] = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun
					WHERE kode_akun LIKE '3-1%' AND year(tanggal) = '$tahunp'
					OR kode_akun LIKE '3-2%'
					GROUP BY kode_akun"
				)->result();			

				$data['kewajiban'] = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun
					WHERE akun.kode LIKE '2-1%'
					OR kode_akun LIKE '4-1%'
					OR kode_akun LIKE '5-1%' AND year(tanggal) = '$tahunp'
					GROUP BY kode_akun"
				)->result();

			}else{
				$data['neraca']	= $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun WHERE year(tanggal) = '$tahun'
					GROUP BY kode_akun"
				)->result();

				$data['aktiva_lancar'] = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 					
					JOIN akun ON akun.kode = jurnal.kode_akun			
					WHERE kode_akun LIKE '1-1%' AND year(tanggal) = '$tahun'
					GROUP BY kode_akun"
				)->result();

				$data['aktiva_tetap'] = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun
					WHERE kode_akun LIKE '1-2%' AND year(tanggal) = '$tahun'
					GROUP BY kode_akun"
				)->result();	

				$data['modal'] = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun
					WHERE kode_akun LIKE '3-1%' AND year(tanggal) = '$tahun'
					OR kode_akun LIKE '3-2%'
					GROUP BY kode_akun"
				)->result();			

				$data['kewajiban'] = $this->db->query("
					SELECT 
					kode_akun,
					SUM(debit) as debit,
					SUM(kredit) as kredit,
					akun.nama as nama
					FROM jurnal 
					JOIN akun ON akun.kode = jurnal.kode_akun
					WHERE akun.kode LIKE '2-1%'
					OR kode_akun LIKE '4-1%'
					OR kode_akun LIKE '5-1%' AND year(tanggal) = '$tahun'
					GROUP BY kode_akun"
				)->result();
				$this->load->view('index',$data);
			}
		}
	}


	public function print_shu($aksi=null)
	{
		if ($aksi) {
			$tahunp 		= $this->input->get('tahun');
			$tahun          = date('Y');
			$data['tahunp'] = $tahunp;
			if ($tahunp) {
				$data = $this->db->query("
					SELECT
					sum(pinjaman_total - pinjaman_jumlah) as pinjaman
					FROM pinjaman WHERE year(pinjaman_waktu) = '$tahunp';
					")->row();

			}else{
				$data = $this->db->query("
					SELECT
					sum(pinjaman_total - pinjaman_jumlah) as pinjaman
					FROM pinjaman WHERE year(pinjaman_waktu) = '$tahun';
					")->row();
			}


			$bagAnggota     = $data->pinjaman * 25/100;
			$cadangan       = $data->pinjaman * 30/100;
			$bagPengurus    = $data->pinjaman * 15/100;
			$bagPegawai     = $data->pinjaman * 10/100;
			$programDaerah  = $data->pinjaman * 10/100;
			$programSosial  = $data->pinjaman * 10/100;

			$shu = $bagAnggota + $cadangan + $bagPengurus + $bagPegawai + $programDaerah + $programSosial;

			$pdf 	= new FPDF('P', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetTitle('Cetak Laporan SHU');
			$pdf->SetFont('times','B',16);
			$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
			$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

			$pdf->SetLineWidth(1);
			$pdf->Line(10,30,200,30);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,31,200,31);

			$pdf->ln(10);

			$pdf->SetFont('times','B',14);
			$pdf->Cell(190,5,'Laporan SHU',0,1,'C');

			$pdf->ln(1);
			$pdf->SetFont('times','B',12);
			$pdf->Cell(190,5,'Periode '.$tahunp,0,1,'C');
			$pdf->ln();

			$pdf->SetFont('times','B',11);
			$pdf->Cell(100,6,'Dibagi Untuk',1,0);
			$pdf->Cell(90,6,'Total',1,1);


			$pdf->SetFont('times','',10);
			$no = 1;
			if ($data) {

				$pdf->Cell(100,6,'Bagian Anggota',1,0);
				$pdf->Cell(90,6,'Rp. '.number_format($bagAnggota),1,1);
				$pdf->Cell(100,6,'Cadangan Koperasi',1,0);
				$pdf->Cell(90,6,'Rp. '.number_format($cadangan),1,1);
				$pdf->Cell(100,6,'Bagian Pengurus',1,0);
				$pdf->Cell(90,6,'Rp. '.number_format($bagPengurus),1,1);
				$pdf->Cell(100,6,'Bagian Pegawai/Karyawan',1,0);
				$pdf->Cell(90,6,'Rp. '.number_format($bagPegawai),1,1);
				$pdf->Cell(100,6,'Program Pembangunan Daerah Kerja',1,0);
				$pdf->Cell(90,6,'Rp. '.number_format($programDaerah),1,1);
				$pdf->Cell(100,6,'Program Sosial',1,0);
				$pdf->Cell(90,6,'Rp. '.number_format($programSosial),1,1);
				$pdf->SetFont('times','B',11);
				$pdf->Cell(100,6,'Total',1,0,'C');
				$pdf->Cell(90,6,'Rp. '.number_format($shu),1,1);

				$pdf->ln(10);
				$pdf->Cell(190,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
				$pdf->ln(30);
				$pdf->Cell(180,5, 'Bendahara',0,0, 'R');
			}
			else
			{
				$pdf->Cell(190,6,'Data tidak ditemukan',1,1,'C');
			}

			$pdf->Output();
		}
		else
		{
			$data['laporan'] = 'active';
			$data['lshu']	= 'active';
			$data['body']	= 'page/lap_shu';
			$tahun 			= date('Y');
			$tahunp 		= $this->input->get('tahun');
			$data['tahunp'] = $tahunp;


			if ($tahunp) {
				$data['data'] = $this->db->query("
					SELECT
					sum(pinjaman_total - pinjaman_jumlah) as pinjaman
					FROM pinjaman WHERE year(pinjaman_waktu) = '$tahunp';
					")->row();

				$data['tgl'] = $this->db->query("
					SELECT pinjaman_waktu FROM pinjaman GROUP BY year(pinjaman_waktu) 
					")->result();
				$url_cetak = 'print-shu/cetak-periode?tahun='.$tahunp.'';
				$data['url_cetak'] = base_url($url_cetak);
				$this->load->view('index',$data);
			}else{
				$data['data'] = $this->db->query("
					SELECT
					sum(pinjaman_total - pinjaman_jumlah) as pinjaman
					FROM pinjaman WHERE year(pinjaman_waktu) = '$tahun';
					")->row();
				$data['tgl'] = $this->db->query("
					SELECT pinjaman_waktu FROM pinjaman GROUP BY year(pinjaman_waktu) 
					")->result();
				$url_cetak = 'print-shu/cetak-periode?tahun='.$tahun.'';
				$data['url_cetak'] = base_url($url_cetak);
				$this->load->view('index',$data);
			}
		}
	}

	public function print_penarikan($aksi=null)
	{
		if ($aksi) {
			$data 		= $this->data->listPenarikan()->result();

			$pdf 	= new FPDF('P', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetTitle('Cetak Laporan Penarikan Anggota');
			$pdf->SetFont('times','B',16);
			$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
			$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

			$pdf->SetLineWidth(1);
			$pdf->Line(10,30,200,30);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,31,200,31);

			$pdf->ln(10);

			$pdf->SetFont('times','B',14);
			$pdf->Cell(190,5,'Laporan Penarikan Anggota Koperasi',0,1,'C');

			$pdf->ln();

			$pdf->SetFont('times','B',11);
			$pdf->Cell(20,6,'No',1,0,'C');
			$pdf->Cell(60,6,'Nama',1,0,'C');
			$pdf->Cell(50,6,'Jumlah',1,0,'C');
			$pdf->Cell(60,6,'Waktu',1,1,'C');


			$pdf->SetFont('times','',10);
			$no = 1;
			if ($data) {
				foreach ($data as $d) { 
					$pdf->Cell(20,6,$no++,1,0,'C');
					$pdf->Cell(60,6,$d->anggota_nama,1,0);
					$pdf->Cell(50,6,$d->amount,1,0,'C');
					$pdf->Cell(60,6,$d->created_at,1,1,'C');
				}

				$pdf->ln(10);
				$pdf->Cell(190,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
				$pdf->ln(30);
				$pdf->Cell(180,5, 'Bendahara',0,0, 'R');
			}
			else
			{
				$pdf->Cell(190,6,'Data tidak ditemukan',1,1,'C');
			}

			$pdf->Output();
		}
		else
		{
			$data['laporan'] = 'active';
			$data['lpenarikan']	= 'active';
			$data['data']	= $this->data->listPenarikan()->result();
			$data['body']	= 'page/lap_penarikan';
			$this->load->view('index',$data);
		}
	}

	public function print_penarikanp($aksi=null)
	{
		if ($aksi) {

			$awal 		= $this->input->get('awal');
			$akhir 		= $this->input->get('akhir');
			$data 		= $this->data->penarikan_periode($awal,$akhir)->result();

			$pdf 	= new FPDF('P', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetTitle('Cetak Laporan Penarikan Anggota');
			$pdf->SetFont('times','B',16);
			$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
			$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

			$pdf->SetLineWidth(1);
			$pdf->Line(10,30,200,30);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,31,200,31);

			$pdf->ln(10);

			$pdf->SetFont('times','B',14);
			$pdf->Cell(190,5,'Laporan Penarikan Anggota Koperasi',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(190,5,'Periode '.tanggal($awal).' s/d '.tanggal($akhir),0,1,'C');
			$pdf->ln();

			$pdf->SetFont('times','B',11);
			$pdf->Cell(20,6,'No',1,0,'C');
			$pdf->Cell(60,6,'Nama',1,0,'C');
			$pdf->Cell(50,6,'Jumlah',1,0,'C');
			$pdf->Cell(60,6,'Waktu',1,1,'C');


			$pdf->SetFont('times','',10);
			$no = 1;
			if ($data) {
				foreach ($data as $d) { 
					$pdf->Cell(20,6,$no++,1,0,'C');
					$pdf->Cell(60,6,$d->anggota_nama,1,0);
					$pdf->Cell(50,6,$d->amount,1,0,'C');
					$pdf->Cell(60,6,$d->created_at,1,1,'C');
				}

				$pdf->ln(10);
				$pdf->Cell(190,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
				$pdf->ln(30);
				$pdf->Cell(180,5, 'Bendahara',0,0, 'R');
			}
			else
			{
				$pdf->Cell(190,6,'Data tidak ditemukan',1,1,'C');
			}

			$pdf->Output();
		}
		else
		{
			$data['laporan'] = 'active';
			$data['lpenarikan']	= 'active';
			$data['data']	= $this->data->listPenarikan()->result();
			$data['body']	= 'page/lap_penarikan';
			$this->load->view('index',$data);
		}
	}

	public function ganti_password()
	{
		$data['ganpassword']	= 'active';
		$data['body']	= 'page/ganti_password';
		$this->load->view('index', $data);
	}

	public function ganti_passwordAksi()
	{
		$passbaru = $this->input->post('passbaru');
		$konfirmasipass = $this->input->post('konfirmasipass');

		$level = $this->session->userdata('level');

		if ($level == 'bendahara' OR $level == 'pengawas' OR $level == 'manajer') {
			if ($passbaru == $konfirmasipass) {
				$data = ['user_password' => md5($passbaru)];
				$user_id = [ 'user_id'=> $this->session->userdata('id') ];
				$this->db->update('user',$data,$user_id);
				$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Password berhasil diganti' });");
				redirect('Auth'); 
			}else{
				$this->session->set_flashdata('msg', "Toast.fire({ icon: 'error', title: 'Konfirmasi password tidak sesuai' });");
				redirect('ganti-password');
			}
		}else{
			if ($passbaru == $konfirmasipass) {
				$data = ['password' => md5($passbaru)];
				$user_id = ['anggota_nik'=> $this->session->userdata('id') ];
				$this->db->update('anggota',$data,$user_id);
				$this->session->set_flashdata('msg', "Toast.fire({ icon: 'success', title: 'Password berhasil diganti' });");
				redirect('Auth'); 
			}else{
				$this->session->set_flashdata('msg', "Toast.fire({ icon: 'error', title: 'Konfirmasi password tidak sesuai' });");
				redirect('ganti-password');
			}

		}
	}

	public function bukti_anggota($aksi)
	{
		$data 		= $this->data->anggota_detail($aksi)->row();

		$pdf 	= new FPDF('P', 'mm', 'A4');
		$pdf->AddPage();
		$pdf->SetTitle('Cetak Bukti Anggota');
		$pdf->SetFont('times','B',16);
		$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
		$pdf->SetFont('times','',12);
		$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
		$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

		$pdf->SetLineWidth(1);
		$pdf->Line(10,30,200,30);
		$pdf->SetLineWidth(0);
		$pdf->Line(10,31,200,31);

		$pdf->ln(10);

		$pdf->SetFont('times','B',14);
		$pdf->Cell(190,5,'Bukti Buku Anggota',0,1,'C');

		$pdf->ln();
		$pdf->SetFont('times','',11);

		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Kode Anggota',0,0); $pdf->Cell(100,5,': '. $data->anggota_kode,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'NIK Anggota',0,0); $pdf->Cell(100,5,': '. $data->anggota_nik,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Nama Anggota',0,0); $pdf->Cell(100,5,': '. $data->anggota_nama,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'No. Handphone',0,0); $pdf->Cell(100,5,': '. $data->anggota_nohp,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Pekerjaan',0,0); $pdf->Cell(100,5,': '. $data->anggota_pekerjaan,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Alamat',0,0); $pdf->Cell(100,5,': '. $data->anggota_alamat,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Tanggal Masuk Anggota',0,0); $pdf->Cell(100,5,': '.tanggal($data->tgl_masuk_anggota),0,1);
		
		$pdf->ln(20);
		$pdf->Cell(170,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
		$pdf->ln(30);
		$pdf->Cell(160,5, 'Bendahara',0,0, 'R');

		$pdf->Output();
	}

	public function bukti_simpananwajib($aksi)
	{
		$data 		= $this->data->simpanan_detail($aksi)->row();

		$pdf 	= new FPDF('P', 'mm', 'A4');
		$pdf->AddPage();
		$pdf->SetTitle('Cetak Bukti Simpanan Wajib');
		$pdf->SetFont('times','B',16);
		$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
		$pdf->SetFont('times','',12);
		$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
		$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

		$pdf->SetLineWidth(1);
		$pdf->Line(10,30,200,30);
		$pdf->SetLineWidth(0);
		$pdf->Line(10,31,200,31);

		$pdf->ln(10);

		$pdf->SetFont('times','B',14);
		$pdf->Cell(190,5,'Bukti Pembayaran Simpanan Wajib Anggota',0,1,'C');

		$pdf->ln(10);
		$pdf->SetFont('times','',11);

		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Kode Pembayaran',0,0); $pdf->Cell(110,5,': '. $data->simpanan_kode,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Tanggal Pembayaran',0,0); $pdf->Cell(110,5,': '. tanggal(date('Y-m-d', strtotime($data->simpanan_waktu))),0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Jenis Pembayaran',0,0); $pdf->Cell(110,5,': Simpanan Wajib',0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Nama Anggota',0,0); $pdf->Cell(110,5,': '. $data->anggota_nama,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Jumlah',0,0); $pdf->Cell(110,5,': Rp.'. number_format($data->simpanan_jumlah),0,1);

		$pdf->ln(10);
		$pdf->Cell(190,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'C');
		$pdf->ln(20);
		$pdf->Cell(65,5, 'Anggota',0,0, 'R');
		$pdf->Cell(80,5, 'Bendahara',0,1, 'R');
		$pdf->ln(20);
		$pdf->Cell(70,5, $data->anggota_nama,0,0, 'R');
		$pdf->Cell(79,5, $this->session->userdata('nama'),0,0, 'R');

		$pdf->Output();
	}

	public function bukti_simpanansukarela($aksi)
	{
		$data 		= $this->data->simpanan_detail($aksi)->row();

		$pdf 	= new FPDF('P', 'mm', 'A4');
		$pdf->AddPage();
		$pdf->SetTitle('Cetak Bukti Simpanan Sukarela');
		$pdf->SetFont('times','B',16);
		$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
		$pdf->SetFont('times','',12);
		$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
		$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

		$pdf->SetLineWidth(1);
		$pdf->Line(10,30,200,30);
		$pdf->SetLineWidth(0);
		$pdf->Line(10,31,200,31);

		$pdf->ln(10);

		$pdf->SetFont('times','B',14);
		$pdf->Cell(190,5,'Bukti Pembayaran Simpanan Sukarela Anggota',0,1,'C');

		$pdf->ln(10);
		$pdf->SetFont('times','',11);

		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Kode Pembayaran',0,0); $pdf->Cell(110,5,': '. $data->simpanan_kode,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Tanggal Pembayaran',0,0); $pdf->Cell(110,5,': '. tanggal(date('Y-m-d', strtotime($data->simpanan_waktu))),0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Jenis Pembayaran',0,0); $pdf->Cell(110,5,': Simpanan Sukarela',0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Nama Anggota',0,0); $pdf->Cell(110,5,': '. $data->anggota_nama,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Jumlah',0,0); $pdf->Cell(110,5,': Rp.'. number_format($data->simpanan_jumlah),0,1);

		$pdf->ln(10);
		$pdf->Cell(190,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'C');
		$pdf->ln(20);
		$pdf->Cell(65,5, 'Anggota',0,0, 'R');
		$pdf->Cell(80,5, 'Bendahara',0,1, 'R');
		$pdf->ln(20);
		$pdf->Cell(70,5, $data->anggota_nama,0,0, 'R');
		$pdf->Cell(79,5, $this->session->userdata('nama'),0,0, 'R');

		$pdf->Output();
	}

	public function bukti_simpananpokok($aksi)
	{
		$data 		= $this->data->simpanan_detail($aksi)->row();

		$pdf 	= new FPDF('P', 'mm', 'A4');
		$pdf->AddPage();
		$pdf->SetTitle('Cetak Bukti Simpanan Pokok');
		$pdf->SetFont('times','B',16);
		$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
		$pdf->SetFont('times','',12);
		$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
		$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

		$pdf->SetLineWidth(1);
		$pdf->Line(10,30,200,30);
		$pdf->SetLineWidth(0);
		$pdf->Line(10,31,200,31);

		$pdf->ln(10);

		$pdf->SetFont('times','B',14);
		$pdf->Cell(190,5,'Bukti Pembayaran Simpanan Pokok Anggota',0,1,'C');

		$pdf->ln(10);
		$pdf->SetFont('times','',11);

		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Kode Pembayaran',0,0); $pdf->Cell(110,5,': '. $data->simpanan_kode,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Tanggal Pembayaran',0,0); $pdf->Cell(110,5,': '. tanggal(date('Y-m-d', strtotime($data->simpanan_waktu))),0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Jenis Pembayaran',0,0); $pdf->Cell(110,5,': Simpanan Pokok',0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Nama Anggota',0,0); $pdf->Cell(110,5,': '. $data->anggota_nama,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Jumlah',0,0); $pdf->Cell(110,5,': Rp.'. number_format($data->simpanan_jumlah),0,1);

		$pdf->ln(10);
		$pdf->Cell(190,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'C');
		$pdf->ln(20);
		$pdf->Cell(65,5, 'Anggota',0,0, 'R');
		$pdf->Cell(80,5, 'Bendahara',0,1, 'R');
		$pdf->ln(20);
		$pdf->Cell(70,5, $data->anggota_nama,0,0, 'R');
		$pdf->Cell(79,5, $this->session->userdata('nama'),0,0, 'R');

		$pdf->Output();
	}

	public function bukti_penarikan($aksi)
	{
		$data 		= $this->data->penarikan_detail($aksi)->row();

		$pdf 	= new FPDF('P', 'mm', 'A4');
		$pdf->AddPage();
		$pdf->SetTitle('Cetak Bukti Penarikan');
		$pdf->SetFont('times','B',16);
		$pdf->Cell(190,5,'Koperasi Arofah Kendal',0,1,'C');
		$pdf->SetFont('times','',12);
		$pdf->Cell(190,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
		$pdf->Cell(190,5,'Hp : 082298630697',0,1,'C');

		$pdf->SetLineWidth(1);
		$pdf->Line(10,30,200,30);
		$pdf->SetLineWidth(0);
		$pdf->Line(10,31,200,31);

		$pdf->ln(10);

		$pdf->SetFont('times','B',14);
		$pdf->Cell(190,5,'Bukti Penarikan Anggota',0,1,'C');

		$pdf->ln(10);
		$pdf->SetFont('times','',11);

		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Kode Penarikan',0,0); $pdf->Cell(110,5,': '. $data->kode,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Tanggal Pembayaran',0,0); $pdf->Cell(110,5,': '. tanggal(date('Y-m-d', strtotime($data->created_at))),0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Nama Anggota',0,0); $pdf->Cell(110,5,': '. $data->anggota_nama,0,1);
		$pdf->Cell(60,5,'',0,0); $pdf->Cell(40,5,'Jumlah',0,0); $pdf->Cell(110,5,': Rp.'. number_format($data->amount),0,1);

		$pdf->ln(10);
		$pdf->Cell(190,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'C');
		$pdf->ln(20);
		$pdf->Cell(65,5, 'Anggota',0,0, 'R');
		$pdf->Cell(80,5, 'Bendahara',0,1, 'R');
		$pdf->ln(20);
		$pdf->Cell(70,5, $data->anggota_nama,0,0, 'R');
		$pdf->Cell(79,5, $this->session->userdata('nama'),0,0, 'R');

		$pdf->Output();
	}	

	public function print_shup($aksi=null)
	{
		if ($aksi) {
			$tahunp 		= $this->input->get('tahun');
			$tahun          = date('Y');
			$data['tahunp'] = $tahunp;
			if ($tahunp) {
				$data = $this->db->query("
				SELECT *								
				FROM pinjaman 
				JOIN anggota ON anggota.anggota_kode = pinjaman.pinjaman_anggota
				WHERE year(pinjaman_waktu) = '$tahunp'				
				;
				")->result();

			}else{
				$data = $this->db->query("
				SELECT
				*				
				FROM pinjaman 
				JOIN anggota ON anggota.anggota_kode = pinjaman.pinjaman_anggota
				WHERE year(pinjaman_waktu) = '$tahun'		
				;
				")->result();
			}

			$pdf 	= new FPDF('L', 'mm', 'A4');
			$pdf->AddPage();
			$pdf->SetTitle('Cetak Laporan SHU');
			$pdf->SetFont('times','B',16);
			$pdf->Cell(290,5,'Koperasi Arofah Kendal',0,1,'C');
			$pdf->SetFont('times','',12);
			$pdf->Cell(290,5,'Jl. Sikopek Tengah No. 1 , Plantaran Kaliwungu Selatan, Kendal',0,1,'C');
			$pdf->Cell(290,5,'Hp : 082298630697',0,1,'C');

			$pdf->SetLineWidth(1);
			$pdf->Line(10,30,290,30);
			$pdf->SetLineWidth(0);
			$pdf->Line(10,31,290,31);

			$pdf->ln(10);

			$pdf->SetFont('times','B',14);
			$pdf->Cell(290,5,'Laporan SHU Perorangan',0,1,'C');

			$pdf->ln(1);
			$pdf->SetFont('times','B',12);
			$pdf->Cell(290,5,'Periode '.$tahunp,0,1,'C');
			$pdf->ln();

			$pdf->SetFont('times','B',6);
			$pdf->Cell(36,6,'Anggota',1,0);
			$pdf->Cell(36,6,'Bagian Anggota',1,0);
			$pdf->Cell(36,6,'Cadangan Koperasi',1,0);
			$pdf->Cell(36,6,'Bagian Pengurus',1,0);
			$pdf->Cell(36,6,'Bagian Pegawai/Karyawan',1,0);
			$pdf->Cell(36,6,'Program Pembangunan Daerah Kerja',1,0);
			$pdf->Cell(36,6,'Program Sosial',1,0);
			$pdf->Cell(30,6,'Total',1,1);


			$pdf->SetFont('times','',10);
			$no = 1;
			if ($data) {
				
				foreach ($data as $d):
					$bagAnggota     = ($d->pinjaman_total - $d->pinjaman_jumlah) * 25/100;
                    $cadangan       = ($d->pinjaman_total - $d->pinjaman_jumlah) * 30/100;
                    $bagPengurus    = ($d->pinjaman_total - $d->pinjaman_jumlah) * 15/100;
                    $bagPegawai     = ($d->pinjaman_total - $d->pinjaman_jumlah) * 10/100;
                    $programDaerah  = ($d->pinjaman_total - $d->pinjaman_jumlah) * 10/100;
                    $programSosial  = ($d->pinjaman_total - $d->pinjaman_jumlah) * 10/100;

					$shu = $bagAnggota + $cadangan + $bagPengurus + $bagPegawai + $programDaerah + $programSosial;


					$pdf->Cell(36,6,$d->anggota_nama,1,0);
					$pdf->Cell(36,6,'Rp. '.number_format($bagAnggota),1,0);
					$pdf->Cell(36,6,'Rp. '.number_format($cadangan),1,0);
					$pdf->Cell(36,6,'Rp. '.number_format($bagPengurus),1,0);
					$pdf->Cell(36,6,'Rp. '.number_format($bagPegawai),1,0);
					$pdf->Cell(36,6,'Rp. '.number_format($programDaerah),1,0);
					$pdf->Cell(36,6,'Rp. '.number_format($programSosial),1,0);
					$pdf->Cell(30,6,'Rp. '.number_format($shu),1,1);

				endforeach;

				$pdf->ln(10);
				$pdf->Cell(284,4, 'Kendal, '. tanggal(date('Y-m-d')),0,0, 'R');
				$pdf->ln(30);
				$pdf->Cell(275,5, 'Bendahara',0,0, 'R');
			}
			else
			{
				$pdf->Cell(282,6,'Data tidak ditemukan',1,1,'C');
			}

			// set paper to potrait
			$pdf->Output('Laporan SHU.pdf','I');
		}
		else
		{
			$data['laporan']	= 'active';
			$data['lshup']		= 'active';

			$data['body']		= 'page/lap_shup';
			$tahun              = date('Y');
			$tahunp 		    = $this->input->get('tahun');
			$data['tahunp']     = $tahunp;


			if ($tahunp) {
				$data['data'] = $this->db->query("
					SELECT *								
					FROM pinjaman 
					JOIN anggota ON anggota.anggota_kode = pinjaman.pinjaman_anggota
					WHERE year(pinjaman_waktu) = '$tahunp'				
					;
					")->result();

				$data['tgl'] = $this->db->query("
					SELECT pinjaman_waktu FROM pinjaman GROUP BY year(pinjaman_waktu) 
					")->result();
				$url_cetak = 'print-shup/cetak-periode?tahun='.$tahunp.'';
				$data['url_cetak'] = base_url($url_cetak);
				$this->load->view('index',$data);
			}else{
				$data['data'] = $this->db->query("
					SELECT
					*				
					FROM pinjaman 
					JOIN anggota ON anggota.anggota_kode = pinjaman.pinjaman_anggota
					WHERE year(pinjaman_waktu) = '$tahun'		
					;
					")->result();
				$data['tgl'] = $this->db->query("
					SELECT pinjaman_waktu FROM pinjaman GROUP BY year(pinjaman_waktu) 
					")->result();
				$url_cetak = 'print-shup/cetak-periode?tahun='.$tahun.'';
				$data['url_cetak'] = base_url($url_cetak);
				$this->load->view('index',$data);
			}
		}
	}
}

/* End of file dashboard.php */
		/* Location: ./application/controllers/dashboard.php */