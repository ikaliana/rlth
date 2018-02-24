	<script type="text/javascript">
		$(document).ready(function() {
			<?php if($tpl['load_map']) { ?>
			var mapTable = $("#mapTables").DataTable({
				"columns" : [
		            { "data" : "rownum" },
		            { "data" : "nama" },
		            { "data" : "alamat" },
		            { "data" : "jeniskelamin" },
		            { "data" : "usia" },
		            { "data" : "sektor" },
		            { "data" : "desa" },
		            { "data" : "jumlahkk" }
		        ],
		        "columnDefs": [{
				    "targets": [8],
				    "sClass": 'text-center',
				    "render": function ( data, type, row ) {
	                    var content = $("#table_action_content").html();
	                    content = content.replace(/{ID}/g,row.id);

	                    if(row.bsps == "0")
	                    	content = content.replace("{BSPS}", " d-none");
	                    else
	                    	content = content.replace("{BSPS}", "");

	                    return content;
	                }
				}],
				"ordering": false,
				buttons: [{
					extend: 'collection',
					text: 'Export',
					buttons: [ 'excel']
				}]
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

			function onEachFeature(feature, layer) {
				var popupContent = $("#popup_content").html();
				popupContent = popupContent.replace("{NAMA}",feature.properties.nama);
				popupContent = popupContent.replace("{ALAMAT}",feature.properties.alamat);
				popupContent = popupContent.replace("{JENISKELAMIN}",feature.properties.jeniskelamin);
				popupContent = popupContent.replace("{JUMLAHKK}",feature.properties.jumlahkk);
				popupContent = popupContent.replace("{PEKERJAAN}",feature.properties.sektor);
				popupContent = popupContent.replace("{DESA}",feature.properties.desa);
				popupContent = popupContent.replace("{ID}",feature.properties.id);
				popupContent = popupContent.replace("{ID}",feature.properties.id);
				popupContent = popupContent.replace("{ID}",feature.properties.id);
				popupContent = popupContent.replace("{ID}",feature.properties.id);
				

				if(feature.properties.bsps == "0")
					popupContent = popupContent.replace("{BSPS}", " d-none");
				else
					popupContent = popupContent.replace("{BSPS}", "");

				layer.bindPopup(popupContent);
			}

			var map = L.map('map', {zoomControl: false});
			mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
			L.tileLayer(
				'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
				{ attribution: '&copy; ' + mapLink + ' Contributors',maxZoom: 18,}
			).addTo(map);
			
			$.getJSON("<?= _resx('data'); ?>/kutim.geojson", function(data){
		        mapData = L.geoJson(data);
		        mapBound = mapData.getBounds();
		        mapData.addTo(map);
		        map.fitBounds(mapBound);
		    });

		    $("#sidebar_update").on('click', function() {
				$.post('<?= _link('ajax/search') ?>', $('#search').serialize(), function(result) {
					result = jQuery.parseJSON(result);

					console.log(result);

					map.eachLayer(function (layer) { map.removeLayer(layer); });

					LoadBaseMap();
					resultLayer = L.geoJson(result,{ onEachFeature: onEachFeature });
					resultLayer.addTo(map);

					mapTable.clear().draw();
					table_data = [];
					$.each(result.features, function (key, val) {
						table_data.push(val.properties);
			        });

			        mapTable.rows.add(table_data).draw();
				});
			});
		    <?php } ?>

			<?php if($tpl['load_search']) { ?>
			$('.selectpicker').selectpicker({ 
				actionsBox : true
				,deselectAllText : "Hilangkan pilihan"
				,selectAllText : "Pilih semua" 
			});

			$('#search-collapse').on('hide.bs.collapse', function () {
				$("#col-search").addClass("minimal")
			});

			$('#search-collapse').on('shown.bs.collapse', function () {
				$("#col-search").removeClass("minimal")
			});

			$(".table-view").on('click', function() {
				$("#map").addClass('d-none');
				$(".table-view").addClass('d-none');

				$("#table-view").removeClass('d-none');
				$(".save-excel").removeClass('d-none');
				$(".map-view").removeClass('d-none');
			});

			$(".map-view").on('click', function() {
				$("#map").removeClass('d-none');
				$(".table-view").removeClass('d-none');

				$("#table-view").addClass('d-none');
				$(".save-excel").addClass('d-none');
				$(".map-view").addClass('d-none');
			});

			$(".save-excel").on('click', function() {
				mapTable.button( '0-0' ).trigger();
			});

			$("#kecamatan").on('changed.bs.select', function (e, s) {
				var value = JSON.stringify($(this).val());
				
				$.post( "<?= _link('ajax/combo') ?>", { s: "desa", f: "kecamatan_id", v: value }).done(function( data ) {
					$("#desa").html(data);

					$('#desa').selectpicker('refresh');
				});
			});
			<?php } ?>
		});
	</script>