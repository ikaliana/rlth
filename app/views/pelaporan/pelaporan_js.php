	<script src="<?= _resx('js') ?>/jquery.datatables.min.js"></script>
	<script src="<?= _resx('js') ?>/datatables.bootstrap4.min.js"></script>
	<script src="<?= _resx('js') ?>/highcharts.js"></script>
	<script src="<?= _resx('js') ?>/modules/data.js"></script>
	<script src="<?= _resx('js') ?>/modules/exporting.js"></script>

	<script type="text/javascript">

		var table1,table2,table3,table4,table5,table6,table7,table8,table9,table10;

	    $("#sidebar_update").on('click', function() {
			LoadAll();
		});

		function InitTable(id,colums,columnsdefs) {
			return $(id).DataTable({
			        "searching" : false
			        ,"bInfo" : false
			        ,"bLengthChange" : false
			        ,"columns" : colums
			        ,"columnDefs": columnsdefs
			    });
		}

		function InitChart(id,tablesource,title,ytitle,charttype) {
			Highcharts.chart(id, {
			    data: { table: tablesource },
			    chart: { type: charttype },
			    title: { text: title },
			    yAxis: {
			        allowDecimals: false,
			        title: { text: ytitle }
			    },
			    tooltip: {
			        formatter: function () {
			            return '<b>' + this.point.name + '</b> (' + this.point.y + ')';
			        }
			    }
			});
		}

		function LoadAll() {
			LoadRespondenPerKecamatan();
			LoadRespondenPerJenisKelamin();
			LoadRespondenPerPendidikan();
			LoadRespondenPerPekerjaan();
			LoadRespondenPerPenghasilan();
			LoadRespondenPerStatusRumah();
			LoadRespondenPerStatusTanah();
			LoadRespondenPerRumahLain();
			LoadRespondenPerTanahLain();
			LoadRespondenPerBantuanRumah();
		}

		function LoadRespondenPerKecamatan() {
			$.post('<?= _link('pelaporan/responden_kecamatan') ?>', $('#search').serialize(), function(result,status,xhr) {
				table_data = eval(result);
				table1.clear().draw();
		        table1.rows.add(table_data).draw();

		        InitChart('chart1','table1','','Responden','column');
			});
		}

		function LoadRespondenPerJenisKelamin()
		{
			$.post('<?= _link('pelaporan/responden_gender') ?>', $('#search').serialize(), function(result,status,xhr) {
				table_data = eval(result);
				table2.clear().draw();
		        table2.rows.add(table_data).draw();

		        InitChart('chart2','table2','','Responden','column');
			});
		}

		function LoadRespondenPerPendidikan()
		{
			$.post('<?= _link('pelaporan/responden_pendidikan') ?>', $('#search').serialize(), function(result,status,xhr) {
				table_data = eval(result);
				table3.clear().draw();
		        table3.rows.add(table_data).draw();

		        InitChart('chart3','table3','','Responden','column');
			});
		}

		function LoadRespondenPerPekerjaan()
		{
			$.post('<?= _link('pelaporan/responden_pekerjaan') ?>', $('#search').serialize(), function(result,status,xhr) {
				table_data = eval(result);
				table4.clear().draw();
		        table4.rows.add(table_data).draw();

		        InitChart('chart4','table4','','Responden','column');
			});
		}

		function LoadRespondenPerPenghasilan()
		{
			$.post('<?= _link('pelaporan/responden_penghasilan') ?>', $('#search').serialize(), function(result,status,xhr) {
				table_data = eval(result);
				table5.clear().draw();
		        table5.rows.add(table_data).draw();

		        InitChart('chart5','table5','','Responden','column');
			});
		}

		function LoadRespondenPerStatusRumah()
		{
			$.post('<?= _link('pelaporan/responden_status_rumah') ?>', $('#search').serialize(), function(result,status,xhr) {
				table_data = eval(result);
				table6.clear().draw();
		        table6.rows.add(table_data).draw();

		        InitChart('chart6','table6','','Responden','column');
			});
		}

		function LoadRespondenPerStatusTanah()
		{
			$.post('<?= _link('pelaporan/responden_status_tanah') ?>', $('#search').serialize(), function(result,status,xhr) {
				table_data = eval(result);
				table7.clear().draw();
		        table7.rows.add(table_data).draw();

		        InitChart('chart7','table7','','Responden','column');
			});
		}

		function LoadRespondenPerRumahLain()
		{
			$.post('<?= _link('pelaporan/responden_rumah_lain') ?>', $('#search').serialize(), function(result,status,xhr) {
				table_data = eval(result);
				table8.clear().draw();
		        table8.rows.add(table_data).draw();

		        InitChart('chart8','table8','','Responden','column');
			});
		}

		function LoadRespondenPerTanahLain()
		{
			$.post('<?= _link('pelaporan/responden_tanah_lain') ?>', $('#search').serialize(), function(result,status,xhr) {
				table_data = eval(result);
				table9.clear().draw();
		        table9.rows.add(table_data).draw();

		        InitChart('chart9','table9','','Responden','column');
			});
		}

		function LoadRespondenPerBantuanRumah()
		{
			$.post('<?= _link('pelaporan/responden_bantuan_rumah') ?>', $('#search').serialize(), function(result,status,xhr) {
				table_data = eval(result);
				table10.clear().draw();
		        table10.rows.add(table_data).draw();

		        InitChart('chart10','table10','','Responden','column');
			});
		}

		$(document).ready(function(){

			$('.selectpicker').find('[value=0]').remove();
			$('.selectpicker').selectpicker('refresh');
			$('.selectpicker').selectpicker('selectAll');

			var columndef = [{"targets": [0,1],"sClass": 'text-center'}];

			var column = [{ "data" : "kecamatan" },{ "data" : "jumlah" }];
			table1 = InitTable("#table1",column,columndef);

			var column = [{ "data" : "gender" },{ "data" : "jumlah" }];
			table2 = InitTable("#table2",column,columndef);

			var column = [{ "data" : "pendidikan" },{ "data" : "jumlah" }];
			table3 = InitTable("#table3",column,columndef);

			var column = [{ "data" : "pekerjaan" },{ "data" : "jumlah" }];
			table4 = InitTable("#table4",column,columndef);

			var column = [{ "data" : "penghasilan" },{ "data" : "jumlah" }];
			table5 = InitTable("#table5",column,columndef);

			var column = [{ "data" : "status" },{ "data" : "jumlah" }];
			table6 = InitTable("#table6",column,columndef);

			var column = [{ "data" : "status" },{ "data" : "jumlah" }];
			table7 = InitTable("#table7",column,columndef);

			var column = [{ "data" : "status" },{ "data" : "jumlah" }];
			table8 = InitTable("#table8",column,columndef);

			var column = [{ "data" : "status" },{ "data" : "jumlah" }];
			table9 = InitTable("#table9",column,columndef);

			var column = [{ "data" : "status" },{ "data" : "jumlah" }];
			table10 = InitTable("#table10",column,columndef);

			$( "#sidebar_update" ).trigger( "click" );
		});

	</script>
