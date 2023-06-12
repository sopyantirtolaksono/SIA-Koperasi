<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 	= 'auth';

$route['anggota'] 				= 'dashboard/anggota';
$route['anggota_add'] 			= 'dashboard/anggota_add';
$route['anggota_edit/(:any)'] 	= 'dashboard/anggota_edit/$1';
$route['anggota_delete/(:any)'] = 'dashboard/anggota_delete/$1';
$route['bukti-anggota/(:any)']	= 'dashboard/bukti_anggota/$1';

$route['user'] 					= 'dashboard/user';
$route['user_add'] 				= 'dashboard/user_add';
$route['user_edit/(:any)'] 		= 'dashboard/user_edit/$1';
$route['user_delete/(:any)'] 	= 'dashboard/user_delete/$1';

$route['simpanan-wajib'] 		= 'dashboard/simpananWajib';
$route['wajib_add'] 			= 'dashboard/wajib_add';
$route['wajib_edit/(:any)'] 	= 'dashboard/wajib_edit/$1';
$route['bukti_simpananwajib/(:any)']	= 'dashboard/bukti_simpananwajib/$1';

$route['simpanan-sukarela'] 	= 'dashboard/simpananSukarela';
$route['sukarela_add'] 			= 'dashboard/sukarela_add';
$route['sukarela_edit/(:any)'] 	= 'dashboard/sukarela_edit/$1';
$route['bukti_simpanansukarela/(:any)']	= 'dashboard/bukti_simpanansukarela/$1';

$route['simpanan-pokok'] 		= 'dashboard/simpananPokok';
$route['pokok_add'] 			= 'dashboard/pokok_add';
$route['pokok_edit/(:any)'] 	= 'dashboard/pokok_edit/$1';
$route['bukti_simpananpokok/(:any)']	= 'dashboard/bukti_simpananpokok/$1';

$route['simpanan_delete/(:any)/(:any)'] 	= 'dashboard/simpanan_delete/$1/$1';

$route['pinjaman'] 				= 'dashboard/pinjaman';
$route['pinjaman_add'] 			= 'dashboard/pinjaman_add';
$route['pinjaman_edit/(:any)']	= 'dashboard/pinjaman_edit/$1';
$route['pinjaman_delete/(:any)']= 'dashboard/pinjaman_delete/$1';

$route['angsuran'] 				= 'dashboard/angsuran';
$route['angsuran-detail/(:any)']= 'dashboard/angsuran_detail/$1';

$route['laporan-anggota'] 		= 'dashboard/laporan_anggota';
$route['laporan-anggota/(:any)']= 'dashboard/laporan_anggota/$1';
$route['laporan-anggotap/(:any)']= 'dashboard/laporan_anggotap/$1';

$route['laporan-simpanan'] 			= 'dashboard/laporan_simpanan';
$route['laporan-simpanan/(:any)']	= 'dashboard/laporan_simpanan/$1';
$route['laporan-simpananp/(:any)']	= 'dashboard/laporan_simpananp/$1';
$route['kartu-pinjaman/(:any)']		= 'dashboard/kartu_pinjaman/$1';

$route['laporan-pinjaman'] 			= 'dashboard/laporan_pinjaman';
$route['laporan-pinjaman/(:any)']	= 'dashboard/laporan_pinjaman/$1';
$route['laporan-pinjamanp/(:any)']	= 'dashboard/laporan_pinjamanp/$1';
$route['kartu-pinjaman/(:any)']		= 'dashboard/kartu_pinjaman/$1';

$route['laporan-angsuran'] 			= 'dashboard/laporan_angsuran';
$route['laporan-angsuran/(:any)']	= 'dashboard/laporan_angsuran/$1';
$route['laporan-angsuranp/(:any)']	= 'dashboard/laporan_angsuranp/$1';

$route['neraca']                     = 'dashboard/neraca';
$route['neraca-add']                 = 'dashboard/neraca_add';
$route['neraca-edit/(:any)']         = 'dashboard/neraca_edit/$1';
$route['neraca-delete/(:any)']       = 'dashboard/neraca_delete/$1';
$route['print-neracap/(:any)']	     = 'dashboard/print_neracap/$1';

$route['akun'] 						= 'dashboard/akun';
$route['akun-add'] 					= 'dashboard/akun_add';
$route['akun-edit/(:any)'] 			= 'dashboard/akun_edit/$1';
$route['akun-delete/(:any)'] 		= 'dashboard/akun_delete/$1';

$route['laporan-neraca'] 			= 'dashboard/laporan_neraca';
$route['laporan-shu']               = 'dashboard/laporan_shu';
// $route['laporan-shu-perorangan']    = 'dashboard/laporan_shu_perorangan';
$route['laporan-shu-perorangan-2']  = 'dashboard/laporan_shu_perorangan_2';
$route['print-shu/(:any)']	        = 'dashboard/print_shu/$1';
// $route['print-shup/(:any)']	        = 'dashboard/print_shup/$1';
$route['cetak-shup/(:any)']         = 'dashboard/cetak_shup/$1';

$route['penarikan'] 				= 'dashboard/penarikan';
$route['penarikan-add'] 			= 'dashboard/penarikan_add';
$route['penarikan-edit/(:any)'] 	= 'dashboard/penarikan_edit/$1';
$route['penarikan-delete/(:any)'] 	= 'dashboard/penarikan_delete/$1';
$route['laporan-penarikan']         = 'dashboard/laporan_penarikan';
$route['print-penarikan/(:any)']	= 'dashboard/print_penarikan/$1';
$route['print-penarikanp/(:any)']	= 'dashboard/print_penarikanp/$1';
$route['bukti-penarikan/(:any)']	= 'dashboard/bukti_penarikan/$1';

$route['ganti-password'] 			= 'dashboard/ganti_password';


$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;
