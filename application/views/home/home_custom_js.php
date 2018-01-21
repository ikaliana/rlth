	
	var map = L.map('map', {zoomControl: false});
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
    });

	/*
	var map = L.map('map', {zoomControl: false}).setView([0.5387, 116.4194], 7);
	attribution = '';
	attribution += 'Map data: &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, ';
	attribution += '<a href="http://viewfinderpanoramas.org">SRTM</a> | ';
	attribution += 'Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> ';
	attribution += '(<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)';
	L.tileLayer(
		'http://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', 
		{ maxZoom: 17, attribution: attribution}
	).addTo(map);
	*/