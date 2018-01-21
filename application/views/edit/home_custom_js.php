	
	var map = L.map('map', {zoomControl: false});
	var table;
	
	$(document).ready(function(){
        table = $('#data').DataTable( 
	        {
		        "columns" : [
		            { "data" : "id" },
		            { "data" : "nama" },
		            { "data" : "alamat" },
		            { "data" : "jeniskelamin" },
		            { "data" : "usia" },
		            { "data" : "jumlahkk" },
		            { "data" : "sektor" },
		            { "data" : "desa" }
		        ]
		        ,"columnDefs": 
		        [ {
				    "targets": [8],
				    "sClass": 'text-center',
				    "render": function ( data, type, row ) {
	                    //console.log(row.id);
	                    var content = $("#table_action_content").html();
	                    content = content.replace("{ID}",row.id);
	                    return content;
	                }
				} ]
		    }
		);

		//$('#floatImport').hide(); 
		$('#floatExport').hide(); 
		$('#floatMap').hide();
		$('#sidebar-report').hide();
		LoadBaseMap();
	});

	function LoadBaseMap() {
		mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
		L.tileLayer(
			'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
			{ attribution: '&copy; ' + mapLink + ' Contributors',maxZoom: 18,}
		).addTo(map);

		$.getJSON("<?php echo base_url(); ?>libs/data/kutim.geojson", function(data){
	        mapData = L.geoJson(data);
	        mapBound = mapData.getBounds();
	        mapData.addTo(map);
	        map.fitBounds(mapBound);
		    map.setView([0.9200654358283382, 116.32873535156251]);
	    });

	}

	function ShowHideElement() {
		$("#map").toggle();
		$(".sigbun-container").toggle();
		$("#floatMap").toggle();
		$("#floatTable").toggle();
		$('#floatExport').toggle(); 
	}

	$("#floatTable").on("click",function() { ShowHideElement(); });
	$("#floatMap").on("click",function() { ShowHideElement(); });
	$("#floatAdd").on("click",function() { location.href="<?php echo site_url('edit/detail'); ?>" });

	function onEachFeature(feature, layer) {
		var popupContent = $("#popup_content").html();
		popupContent = popupContent.replace("{NAMA}",feature.properties.nama);
		popupContent = popupContent.replace("{ALAMAT}",feature.properties.alamat);
		popupContent = popupContent.replace("{JENISKELAMIN}",feature.properties.jeniskelamin);
		popupContent = popupContent.replace("{JUMLAHKK}",feature.properties.jumlahkk);
		popupContent = popupContent.replace("{PEKERJAAN}",feature.properties.sektor);
		popupContent = popupContent.replace("{DESA}",feature.properties.desa);
		popupContent = popupContent.replace("{ID}",feature.properties.id);

		layer.bindPopup(popupContent);
	}

	$("#sidebar_update").on("click", function(e) {
		//Contoh data hasil search dalam format geojson. Seharusnya data di generate otomatis dari hasil query data.
		var result = {"type": "FeatureCollection","features": [{	"type": "Feature","properties": {"id": 1,"nama": "Kardiman","jeniskelamin": "Laki-laki","alamat": "Jl. A. Yani","usia": 35,"jumlahkk": 2,"sektor": "Pengusaha","desa": "LONG NORAN"},"geometry": {"type": "Point","coordinates": [ 117.53411457, 0.510592106259, 66.7867995588]}},{"type": "Feature","properties": {"id": 3,"nama": "Bedjo","jeniskelamin": "Laki-laki","alamat": "Jl. Katamso","usia": 30,"jumlahkk": 1,"sektor": "Pedagang","desa": "LONG SEGAR"},"geometry": {"type": "Point","coordinates": [ 117.53487943, 0.51061806, 66 ]}},{"type": "Feature","properties": {"id": 3,"nama": "Asep","jeniskelamin": "Laki-laki","alamat": "Jl. Gunadi 20","usia": 25,"jumlahkk": 1,"sektor": "Buruh","desa": "TELUK PANDAN"},"geometry": {"type": "Point","coordinates": [ 117.53536514, 0.51111468, 68 ]}},]};
		
		//clear map;
		map.eachLayer(function (layer) { map.removeLayer(layer); });
		LoadBaseMap();
		resultLayer = L.geoJson(result,{ onEachFeature: onEachFeature });
		resultLayer.addTo(map);

		table.clear().draw();
		table_data = [];
		$.each(result.features, function (key, val) {
			table_data.push(val.properties);
        });

        table.rows.add(table_data).draw();

		return false;
	});
