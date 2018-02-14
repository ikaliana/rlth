<?php
	$config['view']['get_options'] = '
		select option_id, option_name 
		from %t 
	';

	$config['view']['get_options_nested'] = "
		select option_id, option_name 
		from %t 
		where %f = '%v'
	";

	$config['view']['get_column_config'] = "
		select field_name, column_no 
		from ".$this->config['table']['field']." 
		where table_name = '%s'
	";

	$config['view']['get_max_answer'] = "
		select max(answer_index) as max_index 
		from ".$this->config['table']['lokasi']." 
		limit 0, 1
	";

	$config['view']['get_data_lokasi'] = "
		select answer_index, kecamatan, lokasi, lokasi_latitude, lokasi_longitude, lokasi_altitude, lokasi_precision 
		from ".$this->config['table']['lokasi']." where answer_index = %i
	";

	$config['view']['get_data_umum'] = "
		SELECT answer_index, nama, gender, no_ktp, umur, alamat, desa, no_kk, jumlah_kk, pendidikan, pekerjaan, penghasilan, tanah_milik, rumah_milik, rumah_lain, tanah_lain, bantuan_perumahan, kontribusi_rumah 
		from ".$this->config['table']['data']." where answer_index = %i
	";

	$config['view']['get_data_foto'] = "
		select answer_index, perspektif, depan, kiri, kanan, atap, lantai, dinding, responden, ktp, kartu_keluarga 
		from ".$this->config['table']['foto']." where answer_index = %i
	";

	$config['view']['get_data_bangunan'] = "
		select answer_index, pondasi, kolom_balok, atap, jendela, ventilasi, mck, sumber_air, jarak_pembuangan, penerangan, note_3, luas_rumah, jumlah_penghuni 
		from ".$this->config['table']['bangunan']." where answer_index = %i
	";

	$config['view']['get_data_komponen'] = "
		select answer_index, materi_atap, kondisi_atap, materi_dinding, kondisi_dinding, materi_lantai, kondisi_lantai 
		from ".$this->config['table']['komponen']." where answer_index = %i
	";
?>