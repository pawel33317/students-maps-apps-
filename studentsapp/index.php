<?php
	//sesja musi byc odpalona bo sÄ… w niej info o pozycji
	session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/myCss.css">
	<script type="text/javascript" src="js/myScript.js" defer="defer"></script>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8" />>
</head>
<body>
    <div class="row">
            <h3 id="text1">APLIKACJA STUDENCKA</h3>
			<h3 id="text3">Znajdziemy dla Ciebie wszystko!</h3>

       

      </div>
    <div class="row">


	<div class="row">
        <div class="col-xs-12"><br>
            <div class="well"><b style="font-size: 15px" id="myposition">
			<?php
				if (!isset($_SESSION['myPosition'])) {
					echo 'Ustawiam pozycje, <a style="text-decoration:underline;cursor:pointer;" onclick="showMapT()">ustaw</a>';
				} else {
					if ($_SESSION['myPosition'] == false)
						echo 'Brak ustawionej pozycji, <a style="text-decoration:underline;cursor:pointer;" onclick="showMapT()">ustaw</a>';
					else
						echo 'Twoja pozycja to: ['.$_SESSION['myLatitude'].', '.$_SESSION['myLongitude'].'] <a style="text-decoration:underline;cursor:pointer;" onclick="showMapT()">zmień</a>';
				}
			?>
				</b></div>
        </div>
    </div>

	<div class="row" id="gmap" style="display:none;">
        <div class="col-xs-12"><br>
            <div style="height:400px;" class="well" id="googleMap" ></div>
        </div>
		
		
    </div>
	<div id="gmapCancel" style="display:none;">
		<button type="button" id="gmapCancel" class="btn btn-primary" onclick="hideMapT()">Anuluj zmianę pozycji</button>
	</div>


        <div class="row">
            <ul class="nav nav-tabs" id="navTabs">
                <li><a data-toggle="tab" href="#beer"><i class="fa fa-beer"></i></a></li>
                <li><a data-toggle="tab" href="#restaurant"><i class="fa fa-cutlery"></i></a></li>
                <li><a data-toggle="tab" href="#coffee"><i class="fa fa-coffee"></i></a></li>
                <li><a data-toggle="tab" href="#entertainment"><i class="fa fa-music"></i></a></li>
                <li><a data-toggle="tab" href="#sport"><i class="fa fa-futbol-o"></i></a></li>
            </ul>

            <div class="tab-content" id="tabContent">
                <div id="beer" class="tab-pane fade">
                    <p><button type="button" onclick="loadSite()" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-star-o"></i>&emsp;Najlepiej oceniane</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-users"></i>&emsp;Najpopularniejsze</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-money"></i>&emsp;Najtańsze</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-map-signs"></i>&emsp;Najbliżej</button></p>
                </div>
                <div id="restaurant" class="tab-pane fade">
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-star-o"></i>&emsp;Najlepiej oceniane</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-users"></i>&emsp;Najpopularniejsze</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-money"></i>&emsp;Najtańsze</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-map-signs"></i>&emsp;Najbliżej</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-cutlery"></i>&emsp;Chińczyk</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-cutlery"></i>&emsp;Pizza</button></p>
                </div>
                <div id="coffee" class="tab-pane fade">
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-star-o"></i>&emsp;Najlepiej oceniane</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-users"></i>&emsp;Najpopularniejsze</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-money"></i>&emsp;Najtańsze</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-map-signs"></i>&emsp;Najbliżej</button></p>
                </div>
                <div id="entertainment" class="tab-pane fade">
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-star-o"></i>&emsp;Najlepiej oceniane</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-users"></i>&emsp;Najpopularniejsze</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-money"></i>&emsp;Najtańsze</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-map-signs"></i>&emsp;Najbliżej</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-ticket"></i>&emsp;Kino/Kręgle/Bilard</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-music"></i>&emsp;Kluby</button></p>
                </div>
                <div id="sport" class="tab-pane fade">
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-star-o"></i>&emsp;Najlepiej oceniane</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-users"></i>&emsp;Najpopularniejsze</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-money"></i>&emsp;Najtańsze</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-map-signs"></i>&emsp;Najbliżej</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-heart-o"></i>&emsp;Siłownie</button></p>
                    <p><button type="button" class="btn btn-primary btn-block" id="buttonSearch"><i class="fa fa-life-ring "></i>&emsp;Baseny</button></p>
                </div>
            </div>
        </div>  
	<script>
	
		//czy pozycja ustawiona
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
		
		function loadSite(){
		window.open("places.php");
		
		//var s = 
		//window.location.href = '...';
	}
	
		//pokazuje mapę w celu ustawiania pozycji
		function showMapT(){
			document.getElementById("gmap").style.display="block";
			document.getElementById("gmapCancel").style.display="block";
			initMap();
		}		
		//anuluje zmianę pozycji
		function hideMapT(){
			document.getElementById("gmap").style.display="none";
			document.getElementById("gmapCancel").style.display="none";
		}


		//odpala mapę
		function initMap() {
			myPositionMaker = null;
			

			//srodek na poprzednię pozycję a jak nie było to na pozycję po IP 
			if (!isPositionSet){
				IPposition = new google.maps.LatLng(<?php echo json_decode(file_get_contents("http://ipinfo.io/{$_SERVER['REMOTE_ADDR']}"))->loc; ?>);
				map = new google.maps.Map(document.getElementById('googleMap'), {
					zoom: 12,
					center: {lat: IPposition.lat(), lng: IPposition.lng()},
					
				});
				//center: {lat: 51.9009878, lng: 16.8921037 }, //pozycja polski zoom 7 
				myPointMaker=new google.maps.Marker({
					position:IPposition,
					map: map
				});
			}else{
				map = new google.maps.Map(document.getElementById('googleMap'), {
					zoom: 12,
					center: {lat: pos.lat, lng: pos.lng},
				});
				myPointMaker=new google.maps.Marker({
					position:new google.maps.LatLng(pos.lat, pos.lng),
					map: map
				});
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
				
				//pozycja ustawiona
				isPositionSet = true;
				pos = {
					lat: myPosition.lat(),
					lng: myPosition.lng()
				}
			//zmiania w informacjach sesji pozycji
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					//alert(xhttp.responseText);
				}else{
					//alert("Error: "+xhttp.responseText);
				}
			}
			xhttp.open("GET", "setMyPosition.php?set=1&myLatitude="+myPosition.lat()+"&myLongitude="+myPosition.lng(), true);
			xhttp.send();	

/////////////////////
//dorobić info na jaka zmieniona


				document.getElementById("myposition").innerHTML = "Pozycja zmieniona <a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"showMapT()\">zmień</a>";
				document.getElementById("gmap").style.display="none";
				document.getElementById("gmapCancel").style.display="none";
				geocoder = new google.maps.Geocoder();
				setPosName();
			});
	}
	function handleLocationError(browserHasGeolocation) {
		alert("Niestety nie można pobrać Twojej lokalizacji :(");
	}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry&callback=initMap" async defer></script>


<script>	
	<?php
		//jezeli nie ma naszej pozycji ustawionej i nie było jej próby pobrania
		//ustawia że nie ma pozycji ale była próba pobrania
		if (!isset($_SESSION['myPosition'])) {
			echo 'var firstTry = true;';
			$_SESSION['myPosition'] = false;
		}else{
			echo 'var firstTry = false;';
		}
	?>

	var geocoder;
	
	function setPosName(){
		var locName = document.getElementById("myposition");	
		geocoder.geocode({'location': pos}, function(results, status) {
			
			if (status === google.maps.GeocoderStatus.OK) {
				if (results[1]) {
					locName.innerHTML = "Twoja pozycja to: "+results[1].formatted_address+" <a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"showMapT()\">zmień</a>";
			} else {
				locName.innerHTML = "Twoja pozycja to: [Latitude: " + pos.lat + ", Longitude: " + pos.lng+"] <a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"showMapT()\">zmień</a>";
			}
			
			//i ustawia w sesji ta pozycje jak siÄ™ udaĹ‚o pobraÄ‡
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					//alert(xhttp.responseText);
				}else{
					//alert("Error: "+xhttp.responseText);
				}
			}
			xhttp.open("GET", "setMyPosition.php?set=1&myLatitude="+pos.lat+"&myLongitude="+pos.lng, true);
			xhttp.send();
			} else {
				locName.innerHTML = "Twoja pozycja to: [Latitude: " + pos.lat + ", Longitude: " + pos.lng+"] <a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"showMapT()\">zmień</a>";
			}
		});
	}
	
	function initPos (){
		//jeżeli to piewsza próba pobrania pozycji
		if (firstTry)	{	
			geocoder = new google.maps.Geocoder();
			//szukanie naszej pozycji z browser location
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					pos = {
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};
					//pobranie nazwy naszej pozycji
					setPosName();
				}, function() {
					alert("error");//handleLocationError(true);
				});
			} else {
				alert("error");//handleLocationError(false);// Browser doesn\'t support Geolocation
			}
		}
		
		//jeżeli jest pobrana nasza pozycja 
		//pobiera jej nazwę z googla
		else if (isPositionSet){
			geocoder = new google.maps.Geocoder();
			setPosName();
		}
	}
	
	
	
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initPos" async defer></script>';


</body>
</html>