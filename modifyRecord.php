<html lang="it">
<head>
<meta charset="UTF-8">
<title>Inventario di Concetta</title>
<meta name="description" content="Inventario di Concetta" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.min.css" />
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<style>
			@font-face {
    font-family: 'Barbie';
    src: url(fonts/Barbie.ttf);
}



		* {
		font-family: Barbie;
	}

	body {
		background-color: #FAE4D7;
		font-family: Barbie, Arial, Verdana, Georgia;
	}
	
	.buttons {
		padding: 10px;
		font-size: 16pt;
		background-color: rgb(255, 85, 153);
		border: 2px solid ivory;
		outline: 1px solid grey;
		box-shadow: 2px 2px 2px 2px rgba(255, 255, 255, 0.5);
	}
	
	h3 {
		font-variant: small-caps;
		font-weight: normal;
		
	}
	input[type='text'] {
		padding: 5px;
		border: none;
		border-bottom: 2.3px dotted black;
		font-size: 12pt;
		background-color: #FAE4D7;
	}
	#mainTable {
		width: 90%; 
		font-size: 10pt;
		font-family: Verdana;
		height: 100%;
		z-index: 1;
		position: relative;
		box-shadow: 2px 2px 2px 2px grey;
	}
	
	select {
		
			color: rgb(255, 85, 153);
		
	}
	
	#mainTable tr td {
		border: 0.2px solid grey;
		background-color: white;
		width: 10%;
		
		
	}
	
	#scroller {
		height: 80%;
	
			margin-left: 5%;
	}
	
	#intestazione td {
		background-color: rgb(255, 85, 153) !important;
		color: ivory;
		font-weight: bold;
		
	}
	
	.coverCell {
		
	}
	
	.hiddenImage {
	
		display: none;
		
	}
	
	
	
	.coverCell {
		position: relative;
		overflow: visible;
	}
	
	.coverCell:hover .hiddenImage {
		
		width: 200px;
		left: -50px;
		top:  -30px;
		display: block;
		position: absolute;
		border: 4px solid grey;
		z-index: 2;
	
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
		top: 0px;
		left: 21%;
		padding: 5px;
		background-color: rgba(13, 80, 188, 0.5);
		display: none;
	}
	

	
	.intestations:hover .intestationDropdown {
		display: block;
	}
	
	.deleteButton {
			background-color: transparent;
			background-image: url('inventarioImages/delete.png');
			background-size: cover;
			border: none;
			pointer-events: none;
			opacity: 0.5;
			font-size: 16pt;
			cursor: pointer;
	}
	
	.deleteButton.active {
		pointer-events: auto;
		opacity: 1;
	}
	
</style>
</head>
<body>
	Pagina di modifica;
</body>
</html>