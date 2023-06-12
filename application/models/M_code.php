<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_code extends CI_Model {

    public function kode_angota()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(anggota_kode,6)) AS kd_max FROM anggota");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        return 'A'.$kd;
    }
    public function kode_simpanan($jenis)
    {
        $q = $this->db->query("SELECT MAX(RIGHT(simpanan_kode,6)) AS kd_max FROM simpanan where simpanan_jenis = '$jenis' ");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        if ($jenis == 'wajib') { return 'SW'.$kd; }
        elseif ($jenis == 'sukarela') { return 'SS'.$kd; }
        elseif ($jenis == 'pokok') { return 'SP'.$kd; }
        
    }
    public function kode_pinjaman()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(pinjaman_kode,6)) AS kd_max FROM pinjaman");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        return 'P'.$kd;
    }

    public function kode_penarikan()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kode,6)) AS kd_max FROM penarikan");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        return 'P'.$kd;
    }

}

/* End of file M_code.php */
/* Location: ./application/models/M_code.php */