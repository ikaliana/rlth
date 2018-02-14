					<div id="search w-100">
						<div class="row">
							<div class="col-md-12">
								<div class="data-form">
									<div class="card">
										<div class="card-header">
											<div class="row">
												<div class="col-6">Daftar User</div>
												<div class="col-6 text-right">
													<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#frmDetailUser">
														Tambah user
													</button>
												</div>
											</div>
										</div>										
										<div class="card-body">
											<table id="data" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
												<thead>
										            <tr>
										                <th>Nama Pengguna</th>
										                <th>Username</th>
										                <th>Role</th>
										                <th>Email</th>
										                <th>&nbsp;</th>
										            </tr>
										        </thead>
										        <tbody>
										        	<?php foreach ($data->result() as $row) { ?>
										        	<tr>
										        		<td><?= $row->nama ?></td>
										        		<td><?= $row->username ?></td>
										        		<td><?= $row->role_name ?></td>
										        		<td><?= $row->email ?></td>
										        		<td class="text-center">
											        		<button type="button" class="btn btn-light btn-sm btn-outline-secondary" title="Update user" data-toggle="modal" data-target="#frmDetailUser" data-kode="<?= $row->id; ?>" data-nama="<?= $row->nama; ?>" data-user="<?= $row->username; ?>" data-email="<?= $row->email; ?>" data-role="<?= $row->role_id; ?>">
										                        <i class="fa fa-fw fa-pencil"></i>
										                    </button>
										                    <button type="button" class="btn btn-light btn-sm btn-outline-secondary btnDelete" title="Hapus user" data-kode="<?= $row->id; ?>">
										                        <i class="fa fa-fw fa-trash"></i>
										                    </button>
										        		</td>
										        	</tr>
										        	<?php } ?>
										        </tbody>
											</table>
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
									<h4 class="modal-title" id="exampleModalLabel">Tambah data pengguna</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form class="form-horizontal">
										<div class="form-group row">
											<label for="message-text" class="col-sm-2 control-label">Nama:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control form-control-sm" id="nama" />
											</div>
										</div>
										<div class="form-group row">
											<label for="message-text" class="col-sm-2 control-label">Username:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control form-control-sm" id="username" />
											</div>
										</div>
										<div class="form-group row">
											<label for="message-text" class="col-sm-2 control-label">Password:</label>
											<div class="col-sm-10">
												<input type="password" class="form-control form-control-sm" id="password" />
											</div>
										</div>
										<div class="form-group row">
											<label for="message-text" class="col-sm-2 control-label">Role:</label>
											<div class="col-sm-10">
												<select class="form-control" id="role">
													<option value="">[ Pilih Role ]</option>
													<?php foreach ($role->result() as $row) { ?>
													<option value="<?= $row->role_id; ?>"><?= $row->role_name; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label for="message-text" class="col-sm-2 control-label">Email:</label>
											<div class="col-sm-10">
												<input type="text" class="form-control form-control-sm" id="email" />
											</div>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<img id="imgSimpan" src="<?= base_url(); ?>libs/images/loading.gif" style="height:32px;float:left;display:none;">
									<input type="hidden" id="hMode" value=""></input>
								    <input type="hidden" id="kode" value=""></input>
								    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
								    <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
								</div>
  							</div>
  						</div>
					</div>