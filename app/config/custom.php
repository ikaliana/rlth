<?php
	date_default_timezone_set('Asia/Jakarta');

	$config['encryption_key'] = "6Fx42Vyhx9ZLWSaT";
	$config['encryption_iv'] = "qRxzxT3x8Q7NszkH";
	
	#resources
	$config['resx_path'] = 'libs/';
	$config['base_path'] = $_SERVER['DOCUMENT_ROOT'];

	$config['image_url'] = 'http://surveform.supernovateknologi.com/attachment/small?media_file=888/attachments/';
	
	$config['css'] = $config['resx_path'].'css';
	$config['js'] = $config['resx_path'].'js';
	$config['image'] = $config['resx_path'].'images';
	$config['font'] = $config['resx_path'].'fonts';
	$config['data'] = $config['resx_path'].'data';
	$config['upload'] = $config['resx_path'].'uploads';

	$config['upload_path'] = $config['base_path']."/".$config['upload'];
	$config['template_path'] = $config['base_path']."/".$config['data'];

	#combo tables
	$config['table']['gender'] = 'opt_gender';
	$config['table']['kecamatan'] = 'opt_kecamatan';
	$config['table']['desa'] = 'opt_desa';
	$config['table']['pendidikan'] = 'opt_pendidikan';
	$config['table']['pekerjaan'] = 'opt_pekerjaan';
	$config['table']['penghasilan'] = 'opt_penghasilan';
	$config['table']['rumah'] = 'opt_rumah_milik';
	$config['table']['tanah'] = 'opt_tanah_milik';
	$config['table']['ada_tidak'] = 'opt_ada_tidak';
	$config['table']['bantuan_rumah'] = 'opt_penghasilan';
	$config['table']['kontribusi'] = 'opt_kontribusi_rumah';
	$config['table']['kondisi'] = 'opt_kondisi';
	$config['table']['mck'] = 'opt_mck';
	$config['table']['air'] = 'opt_sumber_air';
	$config['table']['jarak_pembuangan'] = 'opt_jarak_pembuangan';
	$config['table']['penerangan'] = 'opt_penerangan';
	$config['table']['atap'] = 'opt_materi_atap';
	$config['table']['dinding'] = 'opt_materi_dinding';
	$config['table']['lantai'] = 'opt_materi_lantai';

	#answer tables
	$config['table']['lokasi'] = 'ans_lokasi_umum';
	$config['table']['data'] = 'ans_data_umum';
	$config['table']['foto'] = 'ans_foto';
	$config['table']['bangunan'] = 'ans_aspek_bangunan';
	$config['table']['komponen'] = 'ans_aspek_komponen';
	$config['table']['waktu'] = 'ans_waktu';

	#other tables
	$config['table']['field'] = 'field_mapping';
?>