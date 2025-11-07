<?php
$nama = $_POST['nama'];

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => 'http://localhost/uts/rosi/api.php/records/pendidikan',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_POSTFIELDS => array('nama' => $nama),
));
$response = curl_exec($curl);
curl_close($curl);

header('Location: pendidikan.php');
die();