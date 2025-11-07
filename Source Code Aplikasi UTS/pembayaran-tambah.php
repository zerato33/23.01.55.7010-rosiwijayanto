<?php
$peserta = $_POST['peserta'];
$tanggal = $_POST['tanggal'];
$no_tagihan = $_POST['no_tagihan'];
$jumlah = $_POST['jumlah'];

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => 'http://localhost/uts/rosi/api.php/records/pembayaran',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_POSTFIELDS => array('id_peserta' => $peserta, 'tanggal' => $tanggal, 'no_tagihan' => $no_tagihan, 'jumlah' => $jumlah),
));
$response = curl_exec($curl);
curl_close($curl);

header('Location: pembayaran.php');
die();