<?php
class Point{
	function __construct($name,$xPosition,$yPosition) {
       	$this->name = $name;
		$this->latitude = $xPosition;
		$this->longitude = $yPosition; 
   }
}
$pointList = array(new Point('Fiero!',51.719095, 19.485048), new Point('Piknik',51.7688, 19.458521), new Point('Pozytywka',51.768428, 19.456684), new Point('Tawerna',51.751792, 19.458521));
echo json_encode($pointList)
?>
