<!DOCTYPE html>
<html>
<head>
<style>
body {
 background: #f5f5f5; font-family: 'Roboto', sans-serif;}

.mini {
  font-size: 1em;
  color: #000;
  line-height: 9em;
  text-indent: 2.5em;
  position: absolute;
  left: 50%;
  top: 50%; 
}
.mega, .bola{
  line-height: 1.65em;
  font-weight: bold;
  font-size: 11em;
  color: black;
  font-family: 'Roboto', sans-serif;
  width: 300px;
  height: 300px;
  position: absolute;
  left: 50%;
  top: 50%; 
  margin-left: -150px;
  margin-top: -150px;}
 
.boom {color: #f5f5f5; }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r58/three.min.js"></script>
</head>





<body>
<p class="mega">4<span class="boom">0</span>4<div class="bola">
</div></p>
<p class="mini">That's an error.</p>


<script>
var $container = $('.bola');
var renderer = new THREE.WebGLRenderer({antialias: true});
var camera = new THREE.PerspectiveCamera(80,1,0.1,10000);
var scene = new THREE.Scene();

scene.add(camera);
renderer.setSize(300,300);
$container.append(renderer.domElement);

///////////////////////////////////////////////

// Camera
camera.position.z = 200;

// Material
var pinkMat = new THREE.MeshPhongMaterial({
  color      :  new THREE.Color("rgb(226,35,213)"),
  emissive   :  new THREE.Color("rgb(0,0,0)"),
  specular   :  new THREE.Color("rgb(255,155,255)"),
  shininess  :  100,
  shading    :  THREE.FlatShading,
  transparent: 1,
  opacity    : 1
});

var L1 = new THREE.PointLight( 0xffffff, 1);
L1.position.z = 100;
L1.position.y = 100;
L1.position.x = 100;
scene.add(L1);

var L2 = new THREE.PointLight( 0xffffff, 0.8);
L2.position.z = 200;
L2.position.y = 400;
L2.position.x = -100;
scene.add(L2);

// IcoSphere -> THREE.IcosahedronGeometry(80, 1) 1-4
var Ico = new THREE.Mesh(new THREE.IcosahedronGeometry(75,1), pinkMat);
Ico.rotation.z = 0.5;
scene.add(Ico);

function update(){
   Ico.rotation.x+=2/100;
   Ico.rotation.y+=2/100;
}

// Render
function render() {
  requestAnimationFrame(render);			
  renderer.render(scene, camera);	
  update();
}

render();
</script>



<?php
function errorHandling($error) {
	echo "<h1>An internal error has occured</h1>";
	echo "<p>Please report this to an administrator:</p>";
	echo "<p class='errortext'>" . $error . "</p>";
	die();
} 

$servername = "localhost";
$username = "root";
$password = "K3wagrju";
$DB = "dumbstuff";
$conn = new mysqli($servername, $username, $password, $DB);
$twat = $_SERVER['REMOTE_ADDR'];


$sql1 = "select * from fuckoff where address='" . $twat . "'";
$result1 = $conn->query($sql1);


if ($conn->connect_error) {             //check mysql didn't keel over and die
    errorHandling($conn->connect_error);
}
$row1 = $result1->fetch_assoc();

if($result1->num_rows == 0) {
	$sql2 = "INSERT INTO fuckoff (address, offences) VALUES ('" . $twat . "', 1)";
	$result2 = $conn->query($sql2);
} else { //repeat offender!
	$count = $row1['offences'] + 1;
	$sql3 = "UPDATE fuckoff SET `offences` = $count WHERE `address` = '$twat'";
	$result3 = $conn->query($sql3);
}

?>


</body>
</html>