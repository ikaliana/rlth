					<div id="search w-100">
						<div class="row">
							<div class="col-md-12">
								<div class="data-form">
									<div class="card">
										<div class="card-header">Edit data</div>
										<form action="<?= _link('data/save') ?>" method="POST" enctype="multipart/form-data">
										<div class="card-body">
											<ul class="nav nav-tabs flex-column flex-md-row" id="myTab" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" id="lokasi-tab" data-toggle="tab" href="#lokasi" role="tab" aria-controls="lokasi" aria-selected="true">
														Lokasi Umum
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="false">
														Data Umum
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="foto-tab" data-toggle="tab" href="#foto" role="tab" aria-controls="foto" aria-selected="false">
														Foto
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="aspek-tab" data-toggle="tab" href="#aspek" role="tab" aria-controls="aspek" aria-selected="false">
														Aspek Lainnya
													</a>
												</li>
											</ul>

											<div class="tab-content" id="myTabContent">
												<div class="tab-pane fade show active" id="lokasi" role="tabpanel" aria-labelledby="lokasi-tab">
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Lintang</label>
														<div class="col-md-10">
															<input type="text" class="form-control" placeholder="Kata kunci" name="lokasi-lokasi_longitude" value="<?= $data['lokasi']['lokasi_longitude'] ?>" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Bujur</label>
														<div class="col-md-10">
															<input type="text" class="form-control" placeholder="Kata kunci" name="lokasi-lokasi_latitude" value="<?= $data['lokasi']['lokasi_latitude'] ?>" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Kemiringan</label>
														<div class="col-md-10">
															<input type="text" class="form-control" placeholder="Kata kunci" name="lokasi-lokasi_altitude" value="<?= $data['lokasi']['lokasi_altitude'] ?>" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Presisi</label>
														<div class="col-md-10">
															<input type="text" class="form-control" placeholder="Kata kunci" name="lokasi-lokasi_precision" value="<?= $data['lokasi']['lokasi_precision'] ?>" />
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="data" role="tabpanel" aria-labelledby="data-tab">
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Nama</label>
														<div class="col-md-10">
															<input type="text" class="form-control" placeholder="Kata kunci" name="umum-nama" value="<?= $data['umum']['nama'] ?>" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Jenis Kelamin</label>
														<div class="col-md-10">
															<select class="data_sp" name="umum-gender">
																<?= _generateOptions('gender', $data['umum']['gender']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Nomor KTP</label>
														<div class="col-md-10">
															<input type="text" class="form-control" placeholder="Kata kunci" name="umum-no_ktp" value="<?= $data['umum']['no_ktp'] ?>" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Umur</label>
														<div class="col-md-10">
															<input type="text" class="form-control" placeholder="Kata kunci" name="umum-umur" value="<?= $data['umum']['umur'] ?>" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Alamat</label>
														<div class="col-md-10">
															<textarea class="form-control" name="umum-alamat"><?= $data['umum']['alamat'] ?></textarea>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Kecamatan</label>
														<div class="col-md-10">
															<select class="data_sp" id="kecamatan" name="lokasi-kecamatan">
																<?= _generateOptions('kecamatan', $data['lokasi']['kecamatan']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Desa</label>
														<div class="col-md-10">
															<select class="data_sp" id="desa" name="umum-desa">
																<?= _generateOptions('desa', $data['umum']['desa']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Nomor Kartu Keluarga</label>
														<div class="col-md-10">
															<input type="text" class="form-control" placeholder="Kata kunci" name="umum-no_kk" value="<?= $data['umum']['no_kk'] ?>" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Jumlah Kepala Keluarga</label>
														<div class="col-md-10">
															<input type="text" class="form-control" placeholder="Kata kunci" name="umum-jumlah_kk" value="<?= $data['umum']['jumlah_kk'] ?>" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Pendidikan Terakhir</label>
														<div class="col-md-10">
															<select class="data_sp" name="umum-pendidikan">
																<?= _generateOptions('pendidikan', $data['umum']['pendidikan']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Pekerjaan</label>
														<div class="col-md-10">
															<select class="data_sp" name="umum-pekerjaan">
																<?= _generateOptions('pekerjaan', $data['umum']['pekerjaan']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Besar Penghasilan atau Pengeluaran Perbulan</label>
														<div class="col-md-10">
															<select class="data_sp" name="umum-penghasilan">
																<?= _generateOptions('penghasilan', $data['umum']['penghasilan']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Status Kepemilikan Tanah</label>
														<div class="col-md-10">
															<select class="data_sp" name="umum-tanah_milik">
																<?= _generateOptions('tanah', $data['umum']['tanah_milik']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Status Kepemilikan Rumah</label>
														<div class="col-md-10">
															<select class="data_sp" name="umum-rumah_milik">
																<?= _generateOptions('rumah', $data['umum']['rumah_milik']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Aset Rumah Di Tempat Lain</label>
														<div class="col-md-10">
															<select class="data_sp" name="umum-rumah_lain">
																<?= _generateOptions('ada_tidak', $data['umum']['rumah_lain']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Aset Tanah Di Tempat Lain</label>
														<div class="col-md-10">
															<select class="data_sp" name="umum-tanah_lain">
																<?= _generateOptions('ada_tidak', $data['umum']['tanah_lain']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Pernah Mendapatkan Bantuan Perumahan</label>
														<div class="col-md-10">
															<select class="data_sp" name="umum-bantuan_perumahan">
																<?= _generateOptions('bantuan_rumah', $data['umum']['bantuan_perumahan']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Seandainya Saudara Layak Mendapatkan BSPS, Kontribusi Apa Yang Akan Diberikan?</label>
														<div class="col-md-10">
															<select class="data_sp" name="umum-kontribusi_rumah">
																<?= _generateOptions('kontribusi', $data['umum']['kontribusi_rumah']); ?>
															</select>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="foto" role="tabpanel" aria-labelledby="foto-tab">
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Foto Perspektif Rumah</label>
														<div class="col-md-10">
															<img src="<?= _config('image_url').$data['foto']['perspektif'] ?>" alt="<?= $data['foto']['perspektif'] ?>" class="img-thumbnail" />
															<input type="file" class="filestyle" data-btnClass="btn-primary" name="perspektif" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Foto Tampak Depan</label>
														<div class="col-md-10">
															<img src="<?= _config('image_url').$data['foto']['depan'] ?>" alt="<?= $data['foto']['depan'] ?>" class="img-thumbnail" />
															<input type="file" class="filestyle" data-btnClass="btn-primary" name="depan" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Foto Samping Kiri</label>
														<div class="col-md-10">
															<img src="<?= _config('image_url').$data['foto']['kiri'] ?>" alt="<?= $data['foto']['kiri'] ?>" class="img-thumbnail" />
															<input type="file" class="filestyle" data-btnClass="btn-primary" name="kiri" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Foto Samping Kanan</label>
														<div class="col-md-10">
															<img src="<?= _config('image_url').$data['foto']['kanan'] ?>" alt="<?= $data['foto']['kanan'] ?>" class="img-thumbnail" />
															<input type="file" class="filestyle" data-btnClass="btn-primary" name="kanan" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Foto Atap</label>
														<div class="col-md-10">
															<img src="<?= _config('image_url').$data['foto']['atap'] ?>" alt="<?= $data['foto']['atap'] ?>" class="img-thumbnail" />
															<input type="file" class="filestyle" data-btnClass="btn-primary" name="atap" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Foto Lantai</label>
														<div class="col-md-10">
															<img src="<?= _config('image_url').$data['foto']['lantai'] ?>" alt="<?= $data['foto']['lantai'] ?>" class="img-thumbnail" />
															<input type="file" class="filestyle" data-btnClass="btn-primary" name="lantai" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Foto Dinding</label>
														<div class="col-md-10">
															<img src="<?= _config('image_url').$data['foto']['dinding'] ?>" alt="<?= $data['foto']['dinding'] ?>" class="img-thumbnail" />
															<input type="file" class="filestyle" data-btnClass="btn-primary" name="dinding" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Foto Responden</label>
														<div class="col-md-10">
															<img src="<?= _config('image_url').$data['foto']['responden'] ?>" alt="<?= $data['foto']['responden'] ?>" class="img-thumbnail" />
															<input type="file" class="filestyle" data-btnClass="btn-primary" name="responden" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Foto KTP</label>
														<div class="col-md-10">
															<img src="<?= _config('image_url').$data['foto']['ktp'] ?>" alt="<?= $data['foto']['ktp'] ?>" class="img-thumbnail" />
															<input type="file" class="filestyle" data-btnClass="btn-primary" name="ktp" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Foto KK (Kartu Keluarga)</label>
														<div class="col-md-10">
															<img src="<?= _config('image_url').$data['foto']['kartu_keluarga'] ?>" alt="<?= $data['foto']['kartu_keluarga'] ?>" class="img-thumbnail" />
															<input type="file" class="filestyle" data-btnClass="btn-primary" name="kartu_keluarga" />
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="aspek" role="tabpanel" aria-labelledby="aspek-tab">
													<div class="form-group row">
														<label for="keyword" class="col-md-12 col-form-label sub-title">Aspek Keselamatan Bangunan</label>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Pondasi</label>
														<div class="col-md-10">
															<select class="data_sp" name="bangunan-pondasi" data-width="fit">
																<?= _generateOptions('ada_tidak', $data['bangunan']['pondasi']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Kolom dan Balok</label>
														<div class="col-md-10">
															<select class="data_sp" name="bangunan-kolom_balok" data-width="fit">
																<?= _generateOptions('kondisi', $data['bangunan']['kolom_balok']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Konstruksi Atap</label>
														<div class="col-md-10">
															<select class="data_sp" name="bangunan-atap" data-width="fit">
																<?= _generateOptions('kondisi', $data['bangunan']['atap']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-12 col-form-label sub-title">Aspek Kesehatan</label>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Jendela/Lubang Cahaya</label>
														<div class="col-md-10">
															<select class="data_sp" name="bangunan-jendela" data-width="fit">
																<?= _generateOptions('ada_tidak', $data['bangunan']['jendela']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Persyaratan Penghawaan Ventilasi</label>
														<div class="col-md-10">
															<select class="data_sp" name="bangunan-ventilasi" data-width="fit">
																<?= _generateOptions('ada_tidak', $data['bangunan']['ventilasi']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Kepemilikan Kamar Mandi dan Jamban</label>
														<div class="col-md-10">
															<select class="data_sp" name="bangunan-mck" data-width="fit">
																<?= _generateOptions('mck', $data['bangunan']['mck']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Sumber Air Minum</label>
														<div class="col-md-10">
															<select class="data_sp" name="bangunan-sumber_air" data-width="fit">
																<?= _generateOptions('air', $data['bangunan']['sumber_air']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Jarak Sumber Air Minum Ke Tempat Pembuangan Tinja</label>
														<div class="col-md-10">
															<select class="data_sp" name="bangunan-jarak_pembuangan" data-width="fit">
																<?= _generateOptions('jarak_pembuangan', $data['bangunan']['jarak_pembuangan']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Sumber Utama Penerangan Rumah Tangga</label>
														<div class="col-md-10">
															<select class="data_sp" name="bangunan-penerangan" data-width="fit">
																<?= _generateOptions('penerangan', $data['bangunan']['penerangan']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-12 col-form-label sub-title">Aspek Persyaratan Luas dan Kebutuhan Ruang</label>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Luas Rumah (M<sup>2</sup>)</label>
														<div class="col-md-10">
															<input type="text" class="form-control" placeholder="Kata kunci" name="bangunan-luas_rumah" value="<?= $data['bangunan']['luas_rumah'] ?>" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Jumlah Penghuni (Orang)</label>
														<div class="col-md-10">
															<input type="text" class="form-control" placeholder="Kata kunci" name="bangunan-jumlah_penghuni" value="<?= $data['bangunan']['jumlah_penghuni'] ?>" />
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Material Atap Terluas</label>
														<div class="col-md-10">
															<select class="data_sp" name="komponen-materi_atap" data-width="fit">
																<?= _generateOptions('atap', $data['komponen']['materi_atap']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Kondisi Atap</label>
														<div class="col-md-10">
															<select class="data_sp" name="komponen-kondisi_atap" data-width="fit">
																<?= _generateOptions('kondisi', $data['komponen']['kondisi_atap']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Material Dinding Terluas</label>
														<div class="col-md-10">
															<select class="data_sp" name="komponen-materi_dinding" data-width="fit">
																<?= _generateOptions('dinding', $data['komponen']['materi_dinding']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Kondisi Dinding</label>
														<div class="col-md-10">
															<select class="data_sp" name="komponen-kondisi_dinding" data-width="fit">
																<?= _generateOptions('kondisi', $data['komponen']['kondisi_dinding']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Material Lantai Terluas</label>
														<div class="col-md-10">
															<select class="data_sp" name="komponen-materi_lantai" data-width="fit">
																<?= _generateOptions('lantai', $data['komponen']['materi_lantai']); ?>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="keyword" class="col-md-2 col-form-label">Kondisi Lantai</label>
														<div class="col-md-10">
															<select class="data_sp" name="komponen-kondisi_lantai" data-width="fit">
																<?= _generateOptions('kondisi', $data['komponen']['kondisi_lantai']); ?>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="card-footer text-right">
											<input type="hidden" name="answer_index" value="<?= $data['lokasi']['answer_index'] ?>" />
											<input type="hidden" name="action" value="edit" />
											<a href="javascript:window.top.close();" class="btn btn-sm btn-warning">Kembali</a>
											<input type="submit" name="btnSimpan" value="Simpan" class="btn btn-sm btn-success" />
										</div>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>