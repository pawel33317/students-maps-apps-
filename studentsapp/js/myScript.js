	function loadMap(x,y,name){
		//alert("X = " + x + "       Y = " + y);
		window.open("show.php?latitude="+ x +"&longitude="+ y +"&name=" + name,"MyTargetWindowName");
		
		//var s = 
		//window.location.href = '...';
	}

$(document).ready(function () {

	var placesList = [];
	/*$.ajax({
        url: "http://projzesp2015.cba.pl/getPlaces"
    }).then(function(data) {
	   placesList = data;
	   alert(placesList)
    });
	*/
	placesList = [{"id":1,"name":"Fiero!","address":"Rzgowska 180/17","postal_code":"90-001","city":"Lodz","latitude":51.719095,"longitude":19.485048},{"id":2,"name":"Piknik","address":"Traugutta 3","postal_code":"90-106","city":"Lodz","latitude":51.7688,"longitude":19.458521}
	,{"id":3,"name":"Pozytywka","address":"Piotrkowska 72","postal_code":"90-102","city":"Lodz","latitude":51.768428,"longitude":19.456684},{"id":4,"name":"Tawerna","address":"Prof. Bohdana Stefanowskiego 17","postal_code":"90-537","city":"Lodz","latitude":51.751792,"longitude":19.458521}];
	loadPlaces();
	

	
	
	function loadPlaces() {
		$('#rowsContainer').innerHTML == " "; //TO POWINNO USUNAC CALA ZAWARTOSC DIVA (moze przydac sie przy sortowaniu i przeladownaiu listy)
		
		for(var i = 0; i < placesList.length; i++){
			var row = '<div class="row" id="' + placesList[i].id + '">' +
						'<div class="col-xs-12">' +
							'<div class="well">' + 
							'<div id="nazwa">'+
								'<i class="fa fa-cutlery fa-2x"></i>' +
								'<b id="1" style="font-size: 15px"> ' + placesList[i].name + ' </b>' +
								'<button data-toggle="collapse" data-target="#demo' + placesList[i].id + '" id="rozwin"><i class="fa  fa-level-down"></i></button>' +
								'</div>'+
							'<a><button  onclick="loadMap(\''+placesList[i].latitude+'\',\''+placesList[i].longitude+'\',\''+placesList[i].name+'\')" type="button" class="btn btn-primary" id="buttonGPS"' + placesList[i].id + '" x="' + placesList[i].latitude + '" y="' + placesList[i].longitude + '"><i class="fa fa-map-o"></i></button></a>' + 
								'<div id="demo' + placesList[i].id + '" class="collapse">' +
									'<p>Adres restauracji:</p>' +
									'<p>' + placesList[i].address + ', ' + placesList[i].postal_code + ' ' + placesList[i].city + '</p>' +
									'<div id="rating">' +
										'<i class="fa fa-star fa-1x"></i><i class="fa fa-star fa-1x"></i><i class="fa fa-star fa-1x"></i><i class="fa fa-star fa-1x"></i><i class="fa fa-star fa-1x"></i>' +
									'</div>' +
								'</div>' +    
							'</div>' +
						'</div>' +
					'</div>';
				
			$('#rowsContainer').append(row);
		}
	}
	

});
