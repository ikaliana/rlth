							<div id="col-search">
								<div class="row">
									<div class="col">
										<div class="search-toggle">
											<a href="#search-collapse" id="search-toggle-btn" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">
												<i class="fa fa-angle-double-left"></i>
											</a>
										</div>
									</div>
								</div>
								<div class="row h-100 search-collapse collapse show" id="search-collapse">
									<div class="col h-100">
										<form action="<?= _link('ajax/search') ?>" method="POST" id="search" enctype="multipart/form-data">
										<div class="search-form h-100">
											<div class="form-group">
												<label for="keyword">Kata kunci</label>
												<input type="text" name="keyword" class="form-control" placeholder="Kata kunci">
											</div>
											<div class="form-group">
												<label for="keyword">Kecamatan</label>
												<select class="selectpicker" name="kecamatan[]" data-width="100%" title="Pilih kecamatan" data-none-selected-text="Pilih kecamatan" data-live-search="true" multiple>
													<?= _generateOptions('kecamatan'); ?>
												</select>
											</div>
											<div class="form-group">
												<label for="keyword">Desa</label>
												<select class="selectpicker" name="desa[]" data-width="100%" title="Pilih desa" data-live-search="true" multiple>
													<?= _generateOptions('desa'); ?>
												</select>
											</div>
											<label for="kriteria">Kriteria</label>
											<div class="checkbox">
												<label><input type="checkbox"> Penerima BSPS</label>
											</div>
											<div class="checkbox">
												<label><input type="checkbox"> Parameter 1</label>
											</div>
											<div class="checkbox">
												<label><input type="checkbox"> Parameter 2</label>
											</div>
											<button class="btn btn-success btn-sm" id="sidebar_update" type="button">Update</button>
										</div>
										</form>
									</div>
								</div>
							</div>