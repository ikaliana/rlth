					<div id="search w-100">
						<div class="row no-gutters">
							<?= _loadView('general/search'); ?>
							<div class="col-md-9 d-none" id="table-view">
								<div class="data-form">
									<table id="mapTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
										<thead>
								            <tr>
								                <th>No</th>
								                <th>Nama</th>
								                <th>Alamat</th>
								                <th>Jenis Kelamin</th>
								                <th>Usia</th>
								                <th>Pekerjaan</th>
								                <th>Desa</th>
								                <th>Jumlah KK dalam 1 rumah</th>
								                <th>&nbsp;</th>
								            </tr>
								        </thead>
								        <tbody>
								        </tbody>
								    </table>
								</div>
							</div>
						</div>
					</div>
					<div id="table_action_content" style="display:none">
				    	<a target="_blank" href="<?php echo site_url('data/detail'); ?>/{ID}" class="btn btn-default btn-xs btnDetail" role="button" data-id="{ID}" title="Lihat detail">
				    		<i class="fa fa-fw fa-search"></i>
				    	</a>
				    	<a href="<?php echo site_url('data/cetak'); ?>/{ID}" class="btn btn-default btn-xs btnDetail{BSPS}" role="button" data-id="{ID}" title="Cetak proposal">
				    		<i class="fa fa-fw fa-file-word-o"></i>
				    	</a>
				    </div>
					<div class="float-menu">
						<a class="float-item table-view">
							<i class="fa fa-fw fa-th"></i> Table view
						</a>
						<a class="float-item save-excel d-none">
							<i class="fa fa-fw fa-save"></i> Save ke Excel
						</a>
						<a class="float-item map-view d-none">
							<i class="fa fa-fw fa-globe"></i> Map view
						</a>
					</div>