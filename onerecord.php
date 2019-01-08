<?php
	if (isset($_POST['update'])) {
		
			$itemId = $_GET['itemId'];
		
			$connection = pg_connect("host=localhost dbname=inventario port=5432 user=postgres password=postgres") or die('connection failed');	
			
			function isEmptyInteger($string) {
					if ($string == "") {
						return "NULL";
					} else {
						return $string;
					}
			}
			
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
			
			
			$query = "UPDATE collezione SET titolo='" . pg_escape_string($_POST['titolo']) . "', artista=" . ifEmpty(pg_escape_string($_POST['artista'])) . ", anno=" . isEmptyInteger($_POST['anno']) . ", etichetta=" . isEmptyInteger($_POST['etichetta']) . ", tipo =" . ifEmpty(pg_escape_string($_POST['tipo'])) . ", copertina =" . isEmptyCover(pg_escape_string($_POST['copertina'])) . ", interno=" . isEmptyCover(pg_escape_string($_POST['interno'])) . " WHERE ID = '$itemId';";
	

		$rs = pg_query($connection, $query) or die("Cannot execute query: $query\n");
		
		
		//$location = "http://127.0.0.1:8080/InventarioNicola/onerecord.php?itemId=$itemId&pag=$pag&ricerca=false&sort=$sort&order=$order";
		
		
		
		$actual_link = $_SERVER["HTTP_REFERER"];
					
					
					header('Location: '.$actual_link);
					
					
					pg_close($connection); 
	}
?>


<!DOCTYPE html>

<html lang="it">
<head>
<meta charset="UTF-8">
<title>Inventario di Nicola</title>
<meta name="description" content="Inventario di Nicola" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="shortcut icon"  href='./images/favicon.png'/>
<link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<style>


	* {
		font-family: Arial;
	}

	body {
		background-color: lightgrey;
		font-family: Arial, Verdana, Georgia;
	}
	
	.buttons {
		padding: 10px;
		font-size: 16pt;
		background-color: lightblue;
		border: 0.5px solid black;
		box-shadow: 2px 2px 2px 2px grey;
	}
	
	
	h3 {
		font-variant: small-caps;
		font-weight: normal;
		font-size: 11pt;
	}
	
	#mainTable {
		width: 90%; 
		font-size: 10pt;
		font-family: Verdana;
		height: 100%;
	
	}
	
	#mainTable tr td {
		border: 0.2px solid darkgrey;
		background-color: lightblue;
		width: 10%;
		
		
	}
	
	#scroller {
		height: 80%;
		overflow-y: scroll;
			margin-left: 5%;
	}
	
	#intestazione td {
		background-color: lightgrey !important;
		color: ivory;
		font-weight: bold;
		
	}
	
	.coverCell {
		
	}
	
	.hiddenImage {
	
		display: none;
	}
	
	.coverCell:hover .hiddenImage {
		position: absolute;
		width: 300px;
		right: 20%;
		top: 20%;
		display: block;
	}
	
	.emptyCell {
		background-color: transparent !important;
		border: none !important;
	}
	
	#backward {
		position: absolute;
		top: 85%;
		left: 40%;
	}
	
	#forward {
		position: absolute;
		top: 85%;
		left: 42%;
	}
	
	.intestationLinks {
		color: white; text-decoration: none; font-size: inherit;
		
	}
	
	.intestationLinks:hover {
		color: orange;
	}
	
	.intestationLinks:nth-of-type(1) {
		border-bottom: 1px solid white;
	}
	
	
	.intestations {
		position: relative;
	}
	
	
	
	.intestationDropdown {
		position: absolute;
		width: inherit;
		top: 3.5px;
		left: 18%;
		padding: 5px;
		background-color: rgba(13, 80, 188, 0.5);
		display: none;
	}
	

	
	.intestations:hover .intestationDropdown {
		display: block;
	}
	
	.divOneRecord {
		width: 100%;
		background-color: white;
		height: 100%;
	}
	
	.descDiv {
		width: 45%;
		background-color: white;
		display: inline-block;
		height:80vh;
		float: left;
		padding: 20px;
		border: 1px solid black;
		overflow-y: scroll;
	}
	
	.updateDiv {
			width: 45%;
		background-color: white;
		display: inline-block;
		height:auto;
		float: left;
		padding: 20px;
		border: 1px solid black;
	}
	
	.imgDiv {
		width: 45%;
		text-align: center;
		vertical-align:middle;
		clear: right;
		margin-left: 2%;
		float: right;
	
	}
	
	.imgDiv img {
		padding: 2px;
		background-color: grey;
		border: 1px solid black;
		max-width: 600px;
	}
	
	p {
		font-size: 12pt;
		width: 80%;
	}
	
	#updateRecord {
		display: none;
	}
	
</style>
</head>
<body>
	
		
		

	<?php
		$pag = $_GET['pag'];
		$sort = $_GET['sort'];
		$order = $_GET['order'];
		$itemId = $_GET['itemId'];
		
		$ricercaBoolean;
		$campoRicerca;
		$valoreRicerca;
		$valoreRicercaContiene;
		
		if (isset($_GET['ricerca'])) {
		$ricercaBoolean = $_GET['ricerca'];
		} else {
		$ricercaBoolean = '';
		}
		
		if (isset($_GET['campoRicerca'])) {
		$campoRicerca = $_GET['campoRicerca'];
		} else {
		$campoRicerca = '';
		}
		
			if (isset($_GET['valoreRicerca'])) {
		$valoreRicerca = strtolower(str_replace(" ", "+", $_GET['valoreRicerca']));;
			} else {
			$valoreRicerca = '';
			}
			
		if (isset($_GET['valoreRicercaContiene'])) {
		$valoreRicercaContiene = strtolower(str_replace(" ", "+", $_GET['valoreRicercaContiene']));
		} else {
			$valoreRicercaContiene = '';
		}
		$url = "/InventarioNicola/showData.php";
		$urlRicerca = "/InventarioNicola/searchResults.php";
		
		if ($ricercaBoolean == "true" and $valoreRicerca !== '') {
			echo "<h3 style='margin-bottom: 40px'><a class='buttons' style='text-decoration: none; color: ivory' href=\"" . $urlRicerca . "?pag=" . ($pag) . "&valoreRicerca=$valoreRicerca&campoRicerca=$campoRicerca&sort=$sort&order=$order\">";
		} else if ($ricercaBoolean == "true" and $valoreRicerca == '') {
		echo "<h3 style='margin-bottom: 40px'><a class='buttons' style='text-decoration: none; color: ivory' href=\"" . $urlRicerca . "?pag=" . ($pag) . "&valoreRicercaContiene=$valoreRicercaContiene&campoRicerca=$campoRicerca&sort=$sort&order=$order\">";
		} else {
		echo "<h3 style='margin-bottom: 40px; margin-top: 40px'><a class='buttons' style='text-decoration: none; color: black' href=\"" . $url . "?pag=" . ($pag) . "&sort=$sort&order=$order\">";
		}
		echo "Torna indietro</a></h3><br/><br/>";
		echo "<button class='buttons' onclick='showUpdateForm(this)'>Modifica</button>";
		echo "<br /><br />";
		
		$itemId = $_GET['itemId'];

		$connection = pg_connect("host=localhost dbname=inventario port=5432 user=postgres password=postgres") or die('connection failed');	
		
		$query = "SELECT * FROM collezione WHERE collezione.id = $itemId";
		
		$rs = pg_query($connection, $query) or die("Cannot execute query: $query\n");
		while ($row = pg_fetch_row($rs)) {
			
						
			echo "<form method='POST' id='updateRecord'>
					<h3 style='font-weight: bold'>Titolo: </h3><br/><input name='titolo' type'text' value='$row[1]' />
					<br /><br />
					<h3>Artista/Gruppo: </h3><br/><input name='artista' type='text' value='$row[2]' />
					<br /><br />
					<h3 style='font-weight: bold'>Anno: </h3><br/><input name='anno' type='number' value='$row[3]' />
					<br /><br />
					<h3 style='font-weight: bold'>Etichetta: </h3><br /><input name='etichetta' type='number' value='$row[4]' />
					<br /><br />
					<h3 style='font-weight: bold'>Tipo: </h3><br /><input type='text' name='tipo' value='$row[5]' />
					<br /><br />
					<h3 style='font-weight: bold'>Copertina: </h3><br /><input type='text' name='copertina' value='$row[6]' />
					<br /><br />
						<h3 style='font-weight: bold'>Interno Copertina: </h3><br /><input type='text' name='interno' value='$row[7]' />
					<br /><br />
					<input type='submit' name='update' class='buttons' value='Aggiorna' />
					</form>";

		
		echo "<div id='showOneRecord' class='descDiv'>";
		
		
			
			
			
				
				
			echo "<h3 style='font-weight: bold;'>Titolo: </h3><p><span style='font-style: italic'>$row[1]</span></p>";
				echo "<br />";
				
				if ($row[2] != NULL) {
			echo "<h3 style='font-weight: bold;'>Artista/Gruppo: </h3><p>$row[2]</p>";
				echo "<br />";
				}
			if ($row[3] != NULL) {
			echo "<h3 style='font-weight: bold;'>Anno: </h3><p>$row[3]</p>";
					echo "<br />";
			}
				if ($row[4] != NULL) {
			echo "<h3 style='font-weight: bold;'>Etichetta: </h3><p>$row[4]</p>";
					echo "<br />";
			}
		
			if ($row[5] != NULL) {
			echo "<h3 style='font-weight: bold;'>Tipo: </h3><p>$row[5]</p>";
				echo "<br />";
			}
			
			
			if ($row[6] != "empty.png") {
				echo "</div>";
		
				echo "<div class='imgDiv'>";
		
				echo "<img src='inventarioImages/$row[6]' />";
		
				echo "</div>";
				
				}
				
				if ($row[7] != "empty.png") {
				echo "<div class='imgDiv'>";
		
				echo "<img src='inventarioImages/$row[7]' />";
		
				echo "</div>";
				}
		}
		
	
		
		
	?>
	
	<br /><br />
	<script type="text/javascript">
		function showUpdateForm(elem) {
				document.getElementById('updateRecord').style.display = 'block';
				document.getElementById('showOneRecord').style.display = 'none';
				elem.removeAttribute('onclick');
				elem.setAttribute('onclick', 'showOneRecord(this)');
				elem.innerHTML = 'Annulla modifica';
		}
		
		function showOneRecord(elem) {
			document.getElementById('updateRecord').style.display = 'none';
				document.getElementById('showOneRecord').style.display = 'block';
				elem.removeAttribute('onclick');
				elem.setAttribute('onclick', 'showUpdateForm(this)');
				elem.innerHTML = 'Modifica';
		}
	</script>
</body>
</html>