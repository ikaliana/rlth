					<div id="search w-100">
						<div class="row">
							<div class="col-md-12">
								<div class="data-form">
									<div class="card">
										<div class="card-header">Profil User</div>										
										<div class="card-body">
											<form class="form-horizontal">
												<div class="form-group row">
													<label for="message-text" class="col-sm-2 control-label">Nama:</label>
													<div class="col-sm-6">
														<input type="text" class="form-control form-control-sm" id="nama" value="<?= $profil->nama ?>" disabled />
													</div>
												</div>
												<div class="form-group row">
													<label for="message-text" class="col-sm-2 control-label">Username:</label>
													<div class="col-sm-6">
														<input type="text" class="form-control form-control-sm" id="username" value="<?= $profil->username ?>" disabled />
													</div>
												</div>
												<div class="form-group row">
													<label for="message-text" class="col-sm-2 control-label">Role:</label>
													<div class="col-sm-6">
														<input type="text" class="form-control form-control-sm" id="role_name" value="<?= $profil->role_name ?>" disabled />
													</div>
												</div>
												<div class="form-group row">
													<label for="message-text" class="col-sm-2 control-label">Email:</label>
													<div class="col-sm-6">
														<input type="text" class="form-control form-control-sm" id="email" value="<?= $profil->email ?>" disabled />
													</div>
												</div>
											</form>
										</div>
										<div class="card-footer">
											<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#frmDetailUser" id="btnEdit">Edit</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="frmDetailUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  						<div class="modal-dialog" role="document">
  							<div class="modal-content">
  								<div class="modal-header">
									<h4 class="modal-title" id="exampleModalLabel">Edit profil</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form class="form-horizontal">
										<div class="form-group row">
											<label for="message-text" class="col-sm-3 control-label"><span style="color:red">*</span> Nama:</label>
											<div class="col-sm-9">
												<input type="text" class="form-control form-control-sm" id="nama" value="<?= $profil->nama ?>" />
											</div>
										</div>
										<div class="form-group row">
											<label for="message-text" class="col-sm-3 control-label"><span style="color:red">*</span> Username:</label>
											<div class="col-sm-9">
												<input type="text" class="form-control form-control-sm" id="nama" value="<?= $profil->username ?>" />
											</div>
										</div>
										<div class="form-group row">
											<label for="message-text" class="col-sm-3 control-label">Role:</label>
											<div class="col-sm-9">
												<input type="text" class="form-control form-control-sm" id="role" value="<?= $profil->role_name ?>" disabled />
											</div>
										</div>
										<div class="form-group row">
											<label for="message-text" class="col-sm-3 control-label">Email:</label>
											<div class="col-sm-9">
												<input type="text" class="form-control form-control-sm" id="email" value="<?= $profil->email ?>" />
											</div>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<img id="imgSimpan" src="<?= base_url(); ?>libs/images/loading.gif" style="height:32px;float:left;display:none;">
									<input type="hidden" id="hMode" value=""></input>
								    <input type="hidden" id="kode" value="<?= $profil->id ?>"></input>
								    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
								    <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
								</div>
  							</div>
  						</div>
					</div>