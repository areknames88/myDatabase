<?php
// per prima cosa verifico che il file sia stato effettivamente caricato
if (!isset($_FILES['fileInput']) || !is_uploaded_file($_FILES['fileInput']['tmp_name'])) {
  echo 'Non hai inviato nessun file...';
  exit;    
}

//percorso della cartella dove mettere i file caricati dagli utenti
$uploaddir = './inventarioImages';

//Recupero il percorso temporaneo del file
$userfile_tmp = $_FILES['fileInput']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['fileInput']['name'];

//copio il file dalla sua posizione temporanea alla mia cartella upload
if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
  //Se l'operazione è andata a buon fine...
  echo 'File inviato con successo.';
}else{
  //Se l'operazione è fallta...
  echo 'Upload NON valido!'; 
}
?>