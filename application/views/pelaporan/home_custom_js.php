	$(document).ready(function(){
		$('#sidebar-search').hide();

		LoadAll();
	});

	$("#sidebar_report_update").on("click", function(e) {
		LoadAll();
		return false;
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
		LoadRespondenJenisKelamin();
		LoadRespondenPendidikan();
	}

	function LoadRespondenPerKecamatan() {
		var table1_data = [
			{"kecamatan" : "BATU AMPAR", "jumlah" : "102"},
			{"kecamatan" : "BENGALON", "jumlah" : "56"},
			{"kecamatan" : "KARANGAN", "jumlah" : "34"},
			{"kecamatan" : "MUARA ANCALONG", "jumlah" : "86"},
			{"kecamatan" : "SANGATTA UTARA", "jumlah" : "130"}
		];
		
		var column = [{ "data" : "kecamatan" },{ "data" : "jumlah" }];
		var columndef = [{"targets": [1],"sClass": 'text-center'}];
		table1 = InitTable("#table1",column,columndef)
		table1.clear().draw();
        table1.rows.add(table1_data).draw();

        InitChart('chart1','table1','Jumlah Responden per Kecamatan','Responden','column');

	}

	function LoadRespondenJenisKelamin() {
		var table2_data = [
			{"jeniskelamin" : "1. Laki-laki", "jumlah" : "102"},
			{"jeniskelamin" : "2. Perempuan", "jumlah" : "56"},
		];
		
		var column = [{ "data" : "jeniskelamin" },{ "data" : "jumlah" }];
		var columndef = [{"targets": [1],"sClass": 'text-center'}];
		table2 = InitTable("#table2",column,columndef)
		table2.clear().draw();
        table2.rows.add(table2_data).draw();

        InitChart('chart2','table2','Jumlah Responden per Jenis Kelamin','Responden','column');

	}

	function LoadRespondenPendidikan() {
		var table3_data = [
			{"kecamatan" : "1. TIDAK PUNYA IJAZAH", "jumlah" : "5"},
			{"kecamatan" : "2. SD/SEDERAJAT", "jumlah" : "15"},
			{"kecamatan" : "3. SMP/SEDERAJAT", "jumlah" : "34"},
			{"kecamatan" : "4. SLTA/SEDERAJAT", "jumlah" : "89"},
			{"kecamatan" : "5. D1/D2/D3", "jumlah" : "80"}
		];
		
		var column = [{ "data" : "kecamatan" },{ "data" : "jumlah" }];
		var columndef = [{"targets": [1],"sClass": 'text-center'}];
		table1 = InitTable("#table3",column,columndef)
		table1.clear().draw();
        table1.rows.add(table3_data).draw();

        InitChart('chart3','table3','Jumlah Responden per Kecamatan','Responden','column');

	}

