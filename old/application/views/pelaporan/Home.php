<?php
	$sidebar_class = "";
	if(isset($show_sidebar))
		if($show_sidebar) $sidebar_class = "sidebar";
?>
<div class="container-fluid sigbun-container <?php echo $sidebar_class; ?>">
	<h2>Rekapitulasi</h2>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Responden per Kecamatan</h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-6">
                <div id="chart1" class="chart-container"></div>
            </div>
            <div class="col-sm-6">
                <table id="table1" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kecamatan</th>
                            <th>Jumlah Responden</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Responden per Jenis Kelamin</h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-6">
                <div id="chart2" class="chart-container"></div>
            </div>
            <div class="col-sm-6">
                <table id="table2" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <th>Jumlah Responden</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Responden per Tingkat Pendidikan</h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-6">
                <div id="chart3" class="chart-container"></div>
            </div>
            <div class="col-sm-6">
                <table id="table3" class="table table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tingkat Pendidikan</th>
                            <th>Jumlah Responden</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>