<?php
session_start();
if (!isset($_SESSION['myPosition'])) {
  $_SESSION['myPosition'] = false;
} else {
  $_SESSION['myPosition'] = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/myCss2.css">
	<script type="text/javascript" src="js/myScript.js" defer="defer"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
</head>
<body>
    <div class="row">
	<br>
        <div class="col-xs-12">
            <div class="well"><i class="fa fa-cutlery fa-3x"></i><b style="font-size: 34px">&emsp;Restauracje</b></div>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <button type="button" class="btn btn-primary" id="buttonSort"><i class="fa fa-filter"></i>&emsp;Posortuj</button>
                <a href=showall.php><button type="button" class="btn btn-primary" id="buttonSort"><i class="fa fa-map-o"></i>&emsp;Zobacz wszystkie na mapie</button></a>
            </div>
        </div>
        <div class="col-xs-2">
    
        </div>
    </div>
	
	<div id="rowsContainer"></div> 
</body>
</html>