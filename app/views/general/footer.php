				</div>
			</div>
		</div>
	</div>
	<?php if($tpl['load_map']) { ?>
	<div id="popup_content" style="display:none">
		<div class="panel panel-primary">
			<div class="panel-heading">
		    	<h3 class="panel-title">Informasi</h3>
			</div>
			<div class="panel-body">
				<dl class="dl-horizontal">
					<dt>Nama</dt><dd>{NAMA}</dd>
					<dt>Alamat</dt><dd>{ALAMAT}</dd>
					<dt>Jenis Kelamin</dt><dd>{JENISKELAMIN}</dd>
					<dt>Jumlah KK</dt><dd>{JUMLAHKK}</dd>
					<dt>Pekerjaan</dt><dd>{PEKERJAAN}</dd>
					<dt>Desa</dt><dd>{DESA}</dd>
				</dl>
			</div>
			<div class="panel-footer text-center">
				<?php if($tpl['active_menu'] == "pencarian") { ?>
				<a target="_blank" href="<?php echo site_url('data/detail'); ?>/{ID}" class="btn btn-default btn-sm map-popup-btn-detail" role="button" data-id="{ID}">Detail</a>
				<?php } else if($tpl['active_menu'] == "data") { ?>
				<a target="_blank" href="<?php echo site_url('data/edit'); ?>/{ID}" class="btn btn-default btn-sm map-popup-btn-detail" role="button" data-id="{ID}">Edit</a>
				<?php } ?>
				<a href="#{ID}" class="btn btn-default btn-sm map-popup-btn-cetak" role="button" data-id="{ID}">Cetak Proposal</a>
			</div>
		</div>
    </div>
    <?php } ?>

	<!-- jQuery first, then Bootstrap JS -->
	<script src="<?= _resx('js') ?>/jquery.min.js"></script>
	<script src="<?= _resx('js') ?>/popper.min.js"></script>
	<script src="<?= _resx('js') ?>/bootstrap.min.js"></script>

	<script src="<?= _resx('js') ?>/bootstrap-select.min.js"></script>
	<script src="<?= _resx('js') ?>/leaflet.js"></script>

	<?php if($tpl['load_map']) { ?>
	<script src="<?= _resx('js') ?>/jquery.datatables.min.js"></script>
	<script src="<?= _resx('js') ?>/datatables.bootstrap4.min.js"></script>

	<!-- datatables export function -->
	<script src="<?= _resx('js') ?>/datatables.buttons.min.js"></script>
	<script src="<?= _resx('js') ?>/buttons.flash.min.js"></script>
	<script src="<?= _resx('js') ?>/jszip.min.js"></script>
	<script src="<?= _resx('js') ?>/vfs_fonts.js"></script>
	<script src="<?= _resx('js') ?>/buttons.html5.min.js"></script>
	<?php } ?>

	<?= _loadView('general/general_js'); ?>	

	<?= _loadView($tpl['custom_js']); ?>
</body>
</html>