	<script src="<?= _resx('js') ?>/bootstrap-filestyle.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('.data_sp').selectpicker();

			$('#kecamatan').on('changed.bs.select', function(e) {
				var selected = $(e.currentTarget).val();

				$.post( "<?= _link('ajax/combo') ?>", { s: "desa", f: "kecamatan_id", v: selected }).done(function( data ) {
					$('#desa').html(data);
					$('#desa').selectpicker('refresh');
				});
			});
		});
	</script>