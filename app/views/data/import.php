					<div id="search w-100">
						<div class="row">
							<div class="col-md-12">
								<div class="data-form">
									<div class="card">
										<div class="card-header">Import data</div>
										<form action="<?= _link('data/extract') ?>" method="POST" enctype="multipart/form-data">
										<div class="card-body">
											<div class="form-group row">
												<label for="keyword" class="col-md-3 col-form-label">Pilih file yang ingin diimport: </label>
												<div class="col-md-6">
													<input name="rtlh_file" id="rtlh_file" type="file" class="filestyle"  data-btnClass="btn-primary" data-size="sm" value="" />
												</div>
												<div class="col-md">
													<input type="button" name="btnSave" value="Import" class="btn btn-primary btn-sm submit_btn" disabled="" />
												</div>
											</div>
										</div>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>