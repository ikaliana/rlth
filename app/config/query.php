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

	$config['view']['search_base'] = "
		select 
            l.answer_index
            , l.lokasi_longitude as longitude
            , l.lokasi_latitude as latitude
            , ifnull(nullif(l.lokasi_altitude, ''), 0) as altitude
            , d.nama
            , ifnull(gender.option_name, '0. NOT SPECIFIED') as gender
            , ifnull(d.alamat, '') as alamat
            , ifnull(nullif(d.umur, ''), 0) as usia
            , ifnull(nullif(d.jumlah_kk, ''), 0) as jumlah_kk
            , kerja.option_name as sektor
            , desa.option_name as desa 
            , case
				when (
					d.penghasilan > 1 and d.tanah_milik = 1 and d.bantuan_perumahan = 3 and d.kontribusi_rumah <> 0
					and (
						k.kondisi_atap > 1 or k.kondisi_dinding > 1 or k.kondisi_lantai > 1
					)) then '1'
				else '0'
			  end as penerima_bsps
		from ".$this->config['table']['lokasi']." l 
			left join ".$this->config['table']['data']." d on d.answer_index = l.answer_index 
			left join ".$this->config['table']['komponen']." k on k.answer_index = l.answer_index 
			left join ".$this->config['table']['pekerjaan']." kerja on kerja.option_id = d.pekerjaan 
			left join ".$this->config['table']['gender']." gender on gender.option_id = d.gender 
			left join ".$this->config['table']['desa']." desa on desa.option_id = d.desa 
		where l.lokasi_longitude <> '' and l.lokasi_latitude <> ''
	";

	$config['view']['cetak'] = "
		select
			u.nama
			, d.option_name as desa
			, c.option_name as kecamatan
			, u.umur
			, p.option_name as pekerjaan
			, u.alamat
			, u.no_ktp
			, ma.option_name as material_atap
			, md.option_name as material_dinding
			, ml.option_name as material_lantai
			, f.perspektif
			, f.depan
			, f.kiri
			, f.kanan
			, f.atap
			, f.lantai
			, f.dinding
			, f.responden
			, f.ktp
			, f.kartu_keluarga
		from ans_lokasi_umum l
			left join ".$this->config['table']['data']." u on u.answer_index = l.answer_index
			left join ".$this->config['table']['komponen']." k on k.answer_index = l.answer_index
			left join ".$this->config['table']['foto']." f on f.answer_index = l.answer_index
			left join ".$this->config['table']['desa']." d on d.option_id = u.desa
			left join ".$this->config['table']['kecamatan']." c on c.option_id = l.kecamatan
			left join ".$this->config['table']['pekerjaan']." p on p.option_id = u.pekerjaan
			left join ".$this->config['table']['atap']." ma on ma.option_id = k.materi_atap
			left join ".$this->config['table']['dinding']." md on md.option_id = k.materi_dinding
			left join ".$this->config['table']['lantai']." ml on ml.option_id = k.materi_lantai
		where l.answer_index = %i
	";

	$config['view']['laporan_responden_per_kecamatan'] = "
		select k.option_name as nama_kecamatan,count(distinct u.answer_id) as jumlah
		from ".$this->config['table']['data']." u
			left join ".$this->config['table']['desa']." d on u.desa=d.option_id
			left join ".$this->config['table']['kecamatan']." k on d.kecamatan_id=k.option_id
		where d.option_id in (%1) and k.option_id in (%2)
		group by k.option_name
	";

	$config['view']['laporan_responden_per_gender'] = "
		select g.option_name as gender,count(distinct u.answer_id) as jumlah
		from ".$this->config['table']['data']." u
			left join ".$this->config['table']['gender']." g on u.gender=g.option_id
			left join ".$this->config['table']['desa']." d on u.desa=d.option_id
			left join ".$this->config['table']['kecamatan']." k on d.kecamatan_id=k.option_id
		where d.option_id in (%1) and k.option_id in (%2)
		group by g.option_name
	";

	$config['view']['laporan_responden_per_pendidikan'] = "
		select p.option_name as pendidikan,count(distinct u.answer_id) as jumlah
		from ".$this->config['table']['data']." u
			left join ".$this->config['table']['pendidikan']." p on u.pendidikan=p.option_id
			left join ".$this->config['table']['desa']." d on u.desa=d.option_id
			left join ".$this->config['table']['kecamatan']." k on d.kecamatan_id=k.option_id
		where d.option_id in (%1) and k.option_id in (%2)
		group by p.option_name
	";

	$config['view']['laporan_responden_per_pekerjaan'] = "
		select p.option_name as pekerjaan,count(distinct u.answer_id) as jumlah
		from ".$this->config['table']['data']." u
			left join ".$this->config['table']['pekerjaan']." p on u.pekerjaan=p.option_id
			left join ".$this->config['table']['desa']." d on u.desa=d.option_id
			left join ".$this->config['table']['kecamatan']." k on d.kecamatan_id=k.option_id
		where d.option_id in (%1) and k.option_id in (%2)
		group by p.option_name
	";

	$config['view']['laporan_responden_per_penghasilan'] = "
		select p.option_name as penghasilan,count(distinct u.answer_id) as jumlah
		from ".$this->config['table']['data']." u
			left join ".$this->config['table']['penghasilan']." p on u.penghasilan=p.option_id
			left join ".$this->config['table']['desa']." d on u.desa=d.option_id
			left join ".$this->config['table']['kecamatan']." k on d.kecamatan_id=k.option_id
		where d.option_id in (%1) and k.option_id in (%2)
		group by p.option_name
	";

	$config['view']['laporan_responden_per_status_rumah'] = "
		select p.option_name as status,count(distinct u.answer_id) as jumlah
		from ".$this->config['table']['data']." u
			left join ".$this->config['table']['rumah']." p on u.rumah_milik=p.option_id
			left join ".$this->config['table']['desa']." d on u.desa=d.option_id
			left join ".$this->config['table']['kecamatan']." k on d.kecamatan_id=k.option_id
		where d.option_id in (%1) and k.option_id in (%2)
		group by p.option_name
	";

	$config['view']['laporan_responden_per_status_tanah'] = "
		select p.option_name as status,count(distinct u.answer_id) as jumlah
		from ".$this->config['table']['data']." u
			left join ".$this->config['table']['tanah']." p on u.tanah_milik=p.option_id
			left join ".$this->config['table']['desa']." d on u.desa=d.option_id
			left join ".$this->config['table']['kecamatan']." k on d.kecamatan_id=k.option_id
		where d.option_id in (%1) and k.option_id in (%2)
		group by p.option_name
	";

	$config['view']['laporan_responden_per_rumah_lain'] = "
		select p.option_name as status,count(distinct u.answer_id) as jumlah
		from ".$this->config['table']['data']." u
			left join ".$this->config['table']['ada_tidak']." p on u.rumah_lain=p.option_id
			left join ".$this->config['table']['desa']." d on u.desa=d.option_id
			left join ".$this->config['table']['kecamatan']." k on d.kecamatan_id=k.option_id
		where d.option_id in (%1) and k.option_id in (%2)
		group by p.option_name
	";

	$config['view']['laporan_responden_per_tanah_lain'] = "
		select p.option_name as status,count(distinct u.answer_id) as jumlah
		from ".$this->config['table']['data']." u
			left join ".$this->config['table']['ada_tidak']." p on u.tanah_lain=p.option_id
			left join ".$this->config['table']['desa']." d on u.desa=d.option_id
			left join ".$this->config['table']['kecamatan']." k on d.kecamatan_id=k.option_id
		where d.option_id in (%1) and k.option_id in (%2)
		group by p.option_name
	";

	$config['view']['laporan_responden_per_bantuan_rumah'] = "
		select p.option_name as status,count(distinct u.answer_id) as jumlah
		from ".$this->config['table']['data']." u
			left join ".$this->config['table']['bantuan_rumah']." p on u.bantuan_perumahan=p.option_id
			left join ".$this->config['table']['desa']." d on u.desa=d.option_id
			left join ".$this->config['table']['kecamatan']." k on d.kecamatan_id=k.option_id
		where d.option_id in (%1) and k.option_id in (%2)
		group by p.option_name
	";
?>