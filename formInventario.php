<?php

?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>Inventario di Nicola</title>
<meta name="description" content="Inventario di Nicola" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.min.css" />
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<style>


	* {
		font-family: Arial;
	}
	
	h3 {
		color: 
	}

	body {
		background-color: lightgrey;
		font-family: Arial, Verdana, Georgia;
		padding: 0;
		margin: 0;
	}
	
	#primaryForm {
		list-style-type: none;

		margin-left: 30%;
	}
	
	#primaryForm li {
		text-align: justify;
	}
	
	#primaryForm li input[type='text'] {
		padding: 5px;
		border: none;
		border-bottom: 2.3px dotted black;
		font-size: 16pt;
		width: 50%;
		background-color: lightgrey;
	}
	
	h3 {
		font-weight: normal;
		
	}
	
	#submitButton, .buttons {
		padding: 10px;
		font-size: 16pt;
		background-color: lightblue;
		border: 0.5px solid black;
		box-shadow: 2px 2px 2px 2px grey;
	}
	
	#addCover {
			float: left; cursor: pointer; margin-left: 60px; background-color: lightblue; 
	border: 0.5px solid black;width: 20%; height: 300px; font-size: 20pt; font-variant: small-caps
	}
	
	#canvasCont {
		position: relative;
		
	}
	
	#popUp {
		display: none;
	}	
	
	
	#goToDatabase:hover #popUp {
		display: block;
	}
	
	.bordoGreca {
		height: 38px;
		width: 98%;
		margin-left: 1%;
		
		background-size: 80px;
	}
	
	.labelInput {
		display: none;
		width: 40%;

	}
	
	#submitButton {
			display: inline-block;
	}
	
	.databaseButton {
			display: inline-block; margin-left: 10vh; border: none !important; background-color: transparent;
	}
	
	.homeIcon {
			margin-left: 20px; background-image: url('images/home.png'); background-repeat: no-repeat; background-size: contain; 
			position: relative;  bottom: 0; font-size: 20pt; text-decoration: none
	}
	
	@media screen and (max-width: 600px) {
			#primaryForm {
				margin-left: 0;
			}
			
			body {
				background-image: none;
			}
			
			#addCover {
				display: none;
			}
	}
	
	@media screen and (max-width: 400px) {
		textarea[name='descrizione'] {
			max-width: 90%;
				
		}
		
		#submitButton {
				display: block;
		}
		
		.databaseButton {
				display: block; margin-left: 0;
		}
		
		.homeIcon {
				margin-left: 40px;
		}
		
	}
	
</style>
</head>
<body>
<div style="z-index: 1" class="bordoGreca">&#160;</div>


<div id="wrapper">

<div style="float: left">
<video style="display: none;" id="player" controls autoplay></video>
<br />
<div style="display: none" id="thumbButtons">
<button class="buttons" style="display: none" id="play">Riprova</button>
</button>
<button class="buttons" id="capture">Cattura</button>
<button class="buttons" style="display: none" id="save" onclick="uploadEx()">Salva</button>
<br /> <br />
</div>
</div>
	<div id="canvasCont">
		<canvas style="display: none" id="canvas" width=320 height=240></canvas>

		<div id="rettangolo" style="position: absolute; display: none; width: 320px; height: 320px; border: 2px solid red"></div>
	</div>
	
	<button style="display: none" id="addCover">
		Aggiungi Foto
	</button>
	
  <form method="post" accept-charset="utf-8" name="form1">
            <input name="hidden_data" id='hidden_data' type="hidden"/>
			<input name="nomeFile" id='nomeFile' type="hidden"/>
        </form>
<script>
window.onload = function() {
                var canvas = document.getElementById("canvas");
                var context = canvas.getContext("2d");
                context.fillStyle = "rgb(200,0,0)";
			

            }
  const player = document.getElementById('player');
  const canvas = document.getElementById('canvas');
  const context = canvas.getContext('2d');
  const captureButton = document.getElementById('capture');

  const constraints = {
    video: true,
  };

  captureButton.addEventListener('click', () => {
	var topForCanvas = document.getElementById("player").offsetTop - parseInt($("#rettangolo").css("top")); 
	var leftForCanvas = 0 - (document.getElementById("player").offsetLeft - parseInt($("#rettangolo").css("left")));
	console.log($("#rettangolo").offset().top, topForCanvas, leftForCanvas);
	canvas.width = $("#rettangolo").width();
	canvas.height = $("#rettangolo").height();
    context.drawImage(player, $("#rettangolo").offset().left - 10,$("#rettangolo").offset().top - 50,canvas.width,canvas.height,0,0, canvas.width, canvas.height);
  

    // Stop all video streams.
    player.srcObject.getVideoTracks().forEach(track => track.stop());
	$("#player").hide();
	$("#rettangolo").hide();
	$("#play").show();
	$("#capture").hide();
	$("#save").show();
	$("#canvas").show();
	$("#canvas").css("float", "left");
  });

  navigator.mediaDevices.getUserMedia(constraints)
    .then((stream) => {
      // Attach the video stream to the video element and autoplay.
      player.srcObject = stream;
    });
	

		function uploadEx() {
	
	
				    var canvas = document.getElementById("canvas");
                var dataURL = canvas.toDataURL("image/png");
     
                document.getElementById('hidden_data').value = dataURL;
                var fd = new FormData(document.forms["form1"]);
				
				var dateNow = Date.now();
				
				document.getElementById("copertinaInput").value = dateNow + ".png";
				
				fd.set("nomeFile", dateNow);
				
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload_data.php', true);
				
                xhr.onload = function() {
 
                };
				
				
                xhr.send(fd);
				
				$("#save").hide();
				$("#play").hide();
				
			
            };
</script>
<ul id="primaryForm">
<form action="formInventario.php"  enctype="multipart/form-data" method="POST">
<li>
	<h3>Titolo:</h3>
	<input spellcheck="false" autocomplete="off" type="text" name="titolo"  />
</li>
<li>
	<h3>Artista/Gruppo:</h3>
	<input spellcheck="false" oninput="ifCollector(this)" autocomplete="off" type="text" name="artista" />
</li>
<li>
	<h3>Anno:</h3>
	<input spellcheck="false" autocomplete="off" type="number" name="anno" />
</li>
<li>
	<h3>Etichetta:</h3>
	<input spellcheck="false" autocomplete="off" type="text" name="etichetta" />
</li>
<li>
	<h3>Tipo:</h3>
	<select name="tipo">
		<option value="Vinile 33 giri">Vinile 33 giri</option>
		<option value="Vinile 45 giri">Vinile 45 giri</option>
		<option value="Vinile 78 giri">Vinile 78 giri</option>
		<option value="Cd">Cd</option>
	</select>
</li>	
<li>
	<h3>Copertina</h3>
	<input id="copertinaInput" autocomplete="off" type="text" name="copertina" />
	<br /><br />
	
	<input type="file" name="fileInput" accept="image/*" onchange="fillCopertina(this)" />
	
	<br /> <br />
	<h3>Retro/Interno</h3>
	<input id="internoInput" autocomplete="off" type="text" name="interno" />
	<br /><br />
	
	<input type="file" name="fileInternoInput" accept="image/*" onchange="fillInterno(this)" />
	
	<br /> <br />
	<input name="submit" id="submitButton" type="submit" value="Aggiungi"  />
	<h3 class="databaseButton"><a class="buttons" style="text-decoration: none; color: black" href="./showData.php">Vai al database</a>
</li>

</form>
<?php






function correctImageOrientation($filename, $singleFileName) {
	
  if (function_exists('exif_read_data')) {
	 
	  ini_set('memory_limit', '200M');
    $exif = exif_read_data($filename);


    if($exif && isset($exif['Orientation'])) {
      $orientation = $exif['Orientation'];
	 
      if($orientation != 1){
        $img = imagecreatefromjpeg($filename);
        $deg = 0;
        switch ($orientation) {
          case 3:
            $deg = 180;
            break;
          case 6:
            $deg = 270;
            break;
          case 8:
            $deg = 90;
            break;
        }
        if ($deg) {
          $img = imagerotate($img, $deg, 0);        
        }
        // then rewrite the rotated image back to the disk as $filename 
        imagejpeg($img, "./inventarioImages/" . $singleFileName, 95);
      } // if there is some rotation necessary
    } // if have the exif orientation info
  } // if function exists      
}

if(isset($_POST['submit'])){
	

	$file_name = $_FILES['fileInput']['name'];
      $file_size =$_FILES['fileInput']['size'];
      $file_tmp =$_FILES['fileInput']['tmp_name'];
      $file_type=$_FILES['fileInput']['type'];
	
	
	
	
	if (!empty($file_name)) {
		
		if ($_FILES["fileInput"]["error"] > 0)
    {
        echo "Apologies, an error has occurred.";
        echo "Error Code: " . $_FILES["fileInput"]["error"];
    }

	 move_uploaded_file($file_tmp,"./inventarioImages/".$_POST['copertina']);
	 correctImageOrientation($_SERVER['DOCUMENT_ROOT'] . "/InventarioNicola/inventarioImages/" . $_POST['copertina'], $_POST['copertina']);
	 
			$imagepath = $_POST['copertina'];
          $save = "./inventarioImages/" . $imagepath; //This is the new file you saving
          $file = "./inventarioImages/" . $imagepath; //This is the original file
          list($width, $height) = getimagesize($file) ;
          $modwidth = 1000;
          $diff = $width / $modwidth;
          $modheight = $height / $diff;   
          $tn = imagecreatetruecolor($modwidth, $modheight) ;
          $image = imagecreatefromjpeg($file) ;
          imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                          
          imagejpeg($tn, $save, 100) ;

        //thumbnail image making part

       

	}
	
	$fileInterno_name = $_FILES['fileInternoInput']['name'];
     $fileInterno_size =$_FILES['fileInternoInput']['size'];
     $fileInterno_tmp =$_FILES['fileInternoInput']['tmp_name'];
     $fileInterno_type=$_FILES['fileInternoInput']['type'];
	 
	 if (!empty($fileInterno_name)) {
		
		if ($_FILES["fileInternoInput"]["error"] > 0)
    {
        echo "Apologies, an error has occurred.";
        echo "Error Code: " . $_FILES["fileInternoInput"]["error"];
    }

	 move_uploaded_file($fileInterno_tmp,"./inventarioImages/".$_POST['interno']);
	 correctImageOrientation($_SERVER['DOCUMENT_ROOT'] . "/InventarioNicola/inventarioImages/" . $_POST['interno'], $_POST['interno']);
	 
			$imagepath = $_POST['interno'];
          $save = "./inventarioImages/" . $imagepath; //This is the new file you saving
          $file = "./inventarioImages/" . $imagepath; //This is the original file
          list($width, $height) = getimagesize($file) ;
          $modwidth = 1000;
          $diff = $width / $modwidth;
          $modheight = $height / $diff;   
          $tn = imagecreatetruecolor($modwidth, $modheight) ;
          $image = imagecreatefromjpeg($file) ;
          imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
                          
          imagejpeg($tn, $save, 100) ;

        //thumbnail image making part

       

	}
	
    $connection = pg_connect("host=localhost dbname=inventario port=5432 user=postgres password=postgres") or die('connection failed');
	function ifEmpty($string) {
    if ($string == '' || $string == "''") {
        return 'NULL';
    } else {
        return "'$string'";
    }

}

	function isEmptyCover($string) {
		if ($string == '' || $string == "''") {
        return "'empty.png'";
    } else {
		
		
        return "'$string'";
    }
	}
  
		function isEmptyNome($string) {
		if ($string == '' || $string == "''") {
        return "'Senza titolo'";
    } else {
        return "'$string'";
    }
	}
  
	$tipo = $_POST['tipo'];
  
  
		$query = "INSERT INTO collezione VALUES (DEFAULT," . isEmptyNome(pg_escape_string($_POST['titolo'])) . "," . ifEmpty(pg_escape_string($_POST['artista'])) . "," . ifEmpty($_POST['anno']) .  "," . ifEmpty(pg_escape_string($_POST['etichetta'])) . "," . ifEmpty(pg_escape_string($tipo)) . "," . isEmptyCover($_POST['copertina']) . "," . isEmptyCover($_POST['interno']) . ")";

	
	$result = pg_query($query) or die ('Inserimento Fallito'); 
	
pg_close($connection);
}
?>
</ul>

<a class="homeIcon" title="Vai alla pagina iniziale" href="./index.html">&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;</a>

</div>

<div style="z-index: 1; position: relative" class="bordoGreca">&#160;</div>
<script type="application/javascript">

	function fillCopertina(elem) {
			var fileName = prompt("Inserisci il nome del file con la corretta estensione");

	if (fileName == null || fileName == "") {
	
	} else {
		document.getElementById("copertinaInput").value = fileName;
	} 
	
		
		
	}
	
	function fillInterno(elem) {
			var fileName = prompt("Inserisci il nome del file con la corretta estensione");

	if (fileName == null || fileName == "") {
	
	} else {
		document.getElementById("internoInput").value = fileName;
	} 
	
		
		
	}

	$("#rettangolo").draggable();
	$("#rettangolo").resizable();
	$("#videoCont").resizable();
	
	
	
	$("#addCover").on("click", function() {
		$("#thumbButtons").show();
		$("#player").show();
		$("#canvas").show();
		$("#rettangolo").css("left", 8);
		$("#rettangolo").css("top", 8);
		$("#rettangolo").show();
		$(this).hide();

	});
	
	$("#play").on("click", function() {
	document.getElementById('player').style.display = 'block'; 
	
	const player = document.getElementById('player'); 
	
	navigator.mediaDevices.getUserMedia(constraints)
    .then((stream) => {
      player.srcObject = stream;
    });
	
	var canvas = document.getElementById("canvas");
	const context = canvas.getContext('2d');

	context.clearRect(0, 0, canvas.width, canvas.height);
	$("#canvas").hide();
	
	$("#rettangolo").show();
	$("#capture").show();
	$("#play").hide();
	$("#save").hide();
	
	});
	
	document.getElementById("checkConvention").onclick = function() {
	if (document.getElementById("checkConvention").checked == true){
    $("#inputConvention").val("TRUE");
  } else {
   $("#inputConvention").val("FALSE");
  }
	}
	
	function ifCollector(elem) {
			var valore = $(elem).val();
			
			if (valore == "collector" || valore == "Collector") {
				$(elem).siblings(".labelInput").fadeIn();
			} else {
				$(elem).siblings(".labelInput").hide();
			}
	}
	
</script>

</body>
</html>