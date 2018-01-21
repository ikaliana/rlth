<?php
	$sidebar_class = "";
	if(isset($show_sidebar))
		if($show_sidebar) $sidebar_class = "sidebar";
?>
<div id="map"></div>
<div class="container-fluid sigbun-container <?php echo $sidebar_class; ?>" style="display:none">
	<h2>Hasil Pencarian</h2>

    <table id="data" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
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
				<a target="_blank" href="<?php echo site_url('pencarian/detail'); ?>/{ID}" class="btn btn-default btn-sm map-popup-btn-detail" role="button" data-id="{ID}">Detail</a>
				<a href="#{ID}" class="btn btn-default btn-sm map-popup-btn-cetak" role="button" data-id="{ID}">Cetak Proposal</a>
			</div>
		</div>
    </div>
    <div id="table_action_content" style="display:none">
    	<a target="_blank" href="<?php echo site_url('pencarian/detail'); ?>/{ID}" class="btn btn-default btn-xs btnDetail" role="button" data-id="{ID}">
    		<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
    	</a>
    	<button type="button" class="btn btn-default btn-xs btnCetak" title="Cetak proposal" data-id="{ID}">
            <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
        </button>
    </div>
</div>