<?php
$upload_dir = "inventarioImages/";
$img = $_POST['hidden_data'];
$nomeFile = $_POST['nomeFile'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = $upload_dir . $nomeFile . ".png";
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';
?>