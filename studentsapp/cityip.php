<?php
$ip = $_SERVER['REMOTE_ADDR'];
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
echo file_get_contents("http://ipinfo.io/{$ip}").'<br><br>';
echo '<br><br>';
echo json_decode(file_get_contents("http://ipinfo.io/{$_SERVER['REMOTE_ADDR']}"))->loc;
echo '<br><br>';
?>


<html>
	<head>

	</head>
	<body>
		<a>Text</a><br>
		<div id="googleMap" style="height:400px;width:600px;"></div>
		<script>
			function initMap() {
				//punkt docelowy otrzymany z php

				myPoint=new google.maps.LatLng(<?php echo json_decode(file_get_contents("http://ipinfo.io/{$_SERVER['REMOTE_ADDR']}"))->loc; ?>);


				//myPoint=new google.maps.LatLng(51.7500,19.4667);


				//mapa center początkowo na punkt docelowy
				map = new google.maps.Map(document.getElementById('googleMap'), {
					zoom: 12,
					center: {lat: myPoint.lat(), lng: myPoint.lng()},
				});


				//oznaczenie punktu docelowego
				myPointMaker=new google.maps.Marker({
					position:myPoint,
					icon:'pointer.png',
					map: map
				});
			}
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry&callback=initMap" async defer></script>
	</body>
</html>


!!!!!!//mamy 2 oddzielne aplikacje (aplikacja rozproszona) mozna dorobić kolejna na androida windows phona bo mamy aplikacje backendowa z bazą w php z którą by się łączyły

!!!!!!!//skalowalny wygląd można odpalić na wszystkim telefony kompy tablety... android ios windowsphone ...
//znajduje się na gicie 

!!//rozległe mapy wyliczenia odległości od punktów
!!//nawigacja do punktu
!!//pobranie pozycji z gps (html location) a jeżeli nie ma to pobranie miasta/adresu po ip 
//reczne ustwianie pozycji 
!!//wystiwtlanie wszystkich punktów w promieniu km/xkm 
//ladne mapy własne pointery locationinfo ...

!!//postawione na prywatnym serwerze prywatny hosting dedykowana baza danych
!!//nowoczesne technologie jquery bootstrap, mapsApi v3, 
//wszystko działą na najnowszych wersjach mysql, php 
