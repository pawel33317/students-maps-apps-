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
            <div class="well"><b style="font-size: 15px" id="pointsList">&emsp;<?php echo @$_GET['name'];?></b></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12"><br>
            <div style="height:400px;" class="well" id="googleMap"></div>
        </div>
    </div>
	<div class="row" id="route" style="display:none">
        <div class="col-xs-12"><br>
          <button type="button" class="btn btn-primary" style="margin-bottom: 20%; width: 100%; color: black; background-color: #DAE1F5; border-color: #BCCBF5; border-width: 2px; text-align:center;" onclick="showRoute()">Wyznacz trasę</button>
        </div>
    </div>

<script>
<?php
if ($_SESSION['myPosition'] ==true) {
  //$_SESSION['myPosition'] = false;
} else {
  //$_SESSION['myPosition'] = true;
}
?>
var myPositionMaker;
var myPointMaker;
var myPoint;
var myPosition;
var map;
	function Round(n, k){
		var factor = Math.pow(10, k);
		return Math.round(n*factor)/factor;
	}
	function initMap() {
		//punkt docelowy otrzymany z php
		myPoint=new google.maps.LatLng(<?php echo @$_GET['latitude'];?>,<?php echo @$_GET['longitude'];?>);
///		myPoint=new google.maps.LatLng(51.2,19.1);
		
		//mapa center początkowo na punkt docelowy
		map = new google.maps.Map(document.getElementById('googleMap'), {
			zoom: 14,
			center: {lat: myPoint.lat(), lng: myPoint.lng()},
		});
	
		//oznaczenie punktu docelowego
		myPointMaker=new google.maps.Marker({
			position:myPoint,
			icon:'pointer.png',
			map: map
		});
		
		
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
		document.getElementById('route').style.display = 'block';
				//pobranie nazwy naszej pozycji
				geocodeAddress(geocoder, pos);
	
				myPositionMaker = new google.maps.Marker({
					position: pos,
					map: map
				});
				//zapisanie naszej pozycji
				myPosition =new google.maps.LatLng(pos.lat,pos.lng);
			
				
				computeDistance(myPoint,myPosition);

				//wyliczenie środka mapy dla punktów
				var bounds = new google.maps.LatLngBounds();
				bounds.extend(myPoint);
				bounds.extend(myPosition);
				map.setCenter(bounds.getCenter());
				map.fitBounds(bounds);
				
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
					map: map,
				});
				
				//zapisanie naszej pozycji
				myPosition =new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
				document.getElementById('route').style.display = 'block';

				computeDistance(myPoint,myPosition);
				//wyliczenie śeodka mapy dla punktów
				var bounds = new google.maps.LatLngBounds();
				bounds.extend(myPoint);
				bounds.extend(myPosition);
				map.setCenter(bounds.getCenter());
				map.fitBounds(bounds);
				
				
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
					
					
			computeDistance(myPoint,myPosition);
			document.getElementById('route').style.display = 'block';
			geocodeAddress(geocoder, myPosition);
		});
		
		
		
		
	}
	function handleLocationError(browserHasGeolocation) {
		alert("Niestety nie można pobrać Twojej lokalizacji :(");
	}
	function computeDistance(a,b){
		var distance = google.maps.geometry.spherical.computeDistanceBetween(a, b);
		document.getElementById("pointsList").innerHTML = '<a style="color:green;cursor:pointer;"><?php echo @$_GET['name']?> [ '+Round(distance/1000,1)+' km ] </a>';
///		document.getElementById("pointsList").innerHTML = '<a style="color:green;cursor:pointer;">Nazwa [ '+Round(distance/1000,1)+' km ] </a>';
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

//wyznaczona trasa
var directionsDisplay;

function showRoute(){
	var directionsService = new google.maps.DirectionsService();
	
	myPositionMaker.setMap(null);
	myPointMaker.setMap(null);
	
	//czyść starą trasę o ile była
	if(directionsDisplay){
        directionsDisplay.setMap(null);
    }
	
	directionsDisplay = new google.maps.DirectionsRenderer();
	
	//oblicza środek
	var bounds = new google.maps.LatLngBounds();
	bounds.extend(myPoint);
	bounds.extend(myPosition);
	map.setCenter(bounds.getCenter());
	map.fitBounds(bounds);
    directionsDisplay.setMap(map);
	
	
	var request = {
		origin: myPosition,
		destination: myPoint,
		travelMode: google.maps.TravelMode.WALKING 
    };
	
    directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK ) {
			directionsDisplay.setDirections(response);
			directionsDisplay.setMap(map);
		} else {
			alert("Nie można wyznaczyć trasy." + status);
		}
    });    

}
	
	
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry&callback=initMap" async defer></script>
</body>
</html>