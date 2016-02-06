<?php
session_start();
if (!isset($_SESSION['myPosition'])) {
  $_SESSION['myPosition'] = false;
} else {
  $_SESSION['myPosition'] = true;
}
?>
<!Doctype>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/myCss2.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<div class="row">
        <div class="col-xs-12"><br>
            <div class="well"><b style="font-size: 15px" id="locationInfo">&emsp;Ładowanie ...</b></div>
        </div>
    </div>
	    <div class="row">
        <div class="col-xs-12"><br>
            <div class="well"><b style="font-size: 15px" id="pointsList">&emsp;</b></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12"><br>
            <div style="height:400px;" class="well" id="googleMap"></div>
        </div>
    </div>
<script>
	var myPositionMaker;
	var myPosition;
	var map;
	var jsonPoints = [];
	var markePoints=[];


	function Round(n, k){
		var factor = Math.pow(10, k);
		return Math.round(n*factor)/factor;
	}
	function initMap() {

		//mapa center początkowo na jakiś punkt ale zmieni się tak szybko, że  nie będzie widać
		map = new google.maps.Map(document.getElementById('googleMap'), {
			zoom: 14,
			center: {lat: 51.00, lng: 20.00},
		});
	
	
	
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() { if (xhttp.readyState == 4 && xhttp.status == 200) {
			
				//po załadowaniu przez ajaxa
				
				jsonPoints = JSON.parse(xhttp.responseText);	
				
				
				//wyświetlanie w postaci listy i obliczenie punktu środka i dodanie markerów
				document.getElementById("pointsList").innerHTML = "<ul>";
				var bounds = new google.maps.LatLngBounds();
				for(i = 0; i < jsonPoints.length; i++) {
					document.getElementById("pointsList").innerHTML += '<li><a style="color:green;cursor:pointer;" onclick="initialize('+i+')">'+jsonPoints[i].name+'</a></li>';
					bounds.extend(new google.maps.LatLng(jsonPoints[i].latitude,jsonPoints[i].longitude));
					markePoints[i] = new google.maps.Marker({position: new google.maps.LatLng(jsonPoints[i].latitude,jsonPoints[i].longitude), map: map,icon:'pointer.png'});
					var infowindow = new google.maps.InfoWindow({
						content:jsonPoints[i].name
					});
					infowindow.open(map,markePoints[i]);
				}
				document.getElementById("pointsList").innerHTML += "</ul>";
				map.setCenter(bounds.getCenter());
				map.fitBounds(bounds);
				
				var geocoder = new google.maps.Geocoder();
				
				
				var isPositionSet = false;
				var pos = {
						lat: 51.9009878,
						lng: 16.8921037
					};
				<?php if ($_SESSION['myPosition'] == true) echo 'isPositionSet = true;
					pos = {
						lat: '.$_SESSION["myLatitude"].',
						lng: '.$_SESSION["myLongitude"].'
					};
				'; ?>
				
			
				
				if (isPositionSet){
							//pobranie nazwy naszej pozycji
							geocodeAddress(geocoder, pos);
							
							myPositionMaker = new google.maps.Marker({
								position: pos,
								map: map
							});
							//zapisanie naszej pozycji
							myPosition =new google.maps.LatLng(pos.lat,pos.lng);

							//wyliczamy środek dla punktów i mojej pozycji
							var bounds = new google.maps.LatLngBounds();
							for(i = 0; i < jsonPoints.length; i++) {
								bounds.extend(new google.maps.LatLng(jsonPoints[i].latitude,jsonPoints[i].longitude));
							}
							bounds.extend(myPosition);
							map.setCenter(bounds.getCenter());
							map.fitBounds(bounds);
							
							
							computeDistance(myPosition);
							//wyliczenie środka mapy dla punktów
							/*var bounds = new google.maps.LatLngBounds();
							bounds.extend(myPoint);
							bounds.extend(myPosition);
							map.setCenter(bounds.getCenter());
							map.fitBounds(bounds);	*/
				}
				else{
					//szukanie naszej pozycji z browser location
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(function(position) {
							var pos = {
								lat: position.coords.latitude,
								lng: position.coords.longitude
							};

							//pobranie nazwy naszej pozycji
							geocodeAddress(geocoder, pos);
							
							myPositionMaker = new google.maps.Marker({
								position: pos,
								map: map
							});
				
							
							//zapisanie naszej pozycji
							myPosition =new google.maps.LatLng(position.coords.latitude,position.coords.longitude);

							//wyliczamy środek dla punktów i mojej pozycji
							var bounds = new google.maps.LatLngBounds();
							for(i = 0; i < jsonPoints.length; i++) {
								bounds.extend(new google.maps.LatLng(jsonPoints[i].latitude,jsonPoints[i].longitude));
							}
							bounds.extend(myPosition);
							map.setCenter(bounds.getCenter());
							map.fitBounds(bounds);
							
							computeDistance(myPosition);
							//wyliczenie środka mapy dla punktów
							/*var bounds = new google.maps.LatLngBounds();
							bounds.extend(myPoint);
							bounds.extend(myPosition);
							map.setCenter(bounds.getCenter());
							map.fitBounds(bounds);*/
								
						}, function() {
							handleLocationError(true);
						});
					} else {
						handleLocationError(false);// Browser doesn't support Geolocation
					}
				}
				
				//nasłuch na kliknięcie na mapie (zmiana naszej pozycji) 
				map.addListener('click', function(e) {
					if (myPositionMaker)
					myPositionMaker.setMap(null);
					myPositionMaker = new google.maps.Marker({
						position: e.latLng,
						map: map
					});
					myPosition = e.latLng;
					
					var xxhttp = new XMLHttpRequest();
					xxhttp.onreadystatechange = function() {
						if (xxhttp.readyState == 4 && xxhttp.status == 200) {
							//alert(xxhttp.responseText);
						}else{
							//alert("Error: "+xxhttp.responseText);
						}
					}
					xxhttp.open("GET", "setMyPosition.php?set=1&myLatitude="+myPosition.lat()+"&myLongitude="+myPosition.lng(), true);
					xxhttp.send();
					
					geocodeAddress(geocoder, myPosition);
					
					
						var bounds = new google.maps.LatLngBounds();
						for(i = 0; i < jsonPoints.length; i++) {
							bounds.extend(new google.maps.LatLng(jsonPoints[i].latitude,jsonPoints[i].longitude));
						}
						bounds.extend(myPosition);
						map.setCenter(bounds.getCenter());
						map.fitBounds(bounds);
					
					computeDistance(myPosition);
				});	
			}
		}
		xhttp.open("GET", "loaction.php", true);
		xhttp.send();

		

	}
	function handleLocationError(browserHasGeolocation) {
		alert("Niestety nie można pobrać Twojej lokalizacji :(");
	}
	
	function computeDistance(myPos){
		document.getElementById("pointsList").innerHTML = '<ul>';
		for(i = 0; i < jsonPoints.length; i++) {
			var tmp = new google.maps.LatLng(jsonPoints[i].latitude,jsonPoints[i].longitude);
			var distance = google.maps.geometry.spherical.computeDistanceBetween(tmp, myPos);
			document.getElementById("pointsList").innerHTML += '<li><a style="color:green;cursor:pointer;">'+jsonPoints[i].name+' [ '+Round(distance/1000,1)+' km ] </a></li>';
		}
		document.getElementById("pointsList").innerHTML += '</ul>';
	}
	
	
	function geocodeAddress(geocoder, position) {
		var locName = document.getElementById("locationInfo");
		geocoder.geocode({'location': position}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				if (results[1]) {
					locName.innerHTML = "Twoja pozycja to: "+results[1].formatted_address+"";
				} else {
					locName.innerHTML = "Twoja pozycja to: [Latitude: " + myPosition.lat() + ", Longitude: " + myPosition.lng()+"]";
				}
			} else {
				locName.innerHTML = "Twoja pozycja to: [Latitude: " + myPosition.lat() + ", Longitude: " + myPosition.lng()+"]";
			}
		});
	}
	
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry&callback=initMap" async defer></script>
</body>
</html>
