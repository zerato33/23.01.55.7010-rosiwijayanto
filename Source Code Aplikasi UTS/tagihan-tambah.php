<?php
$peserta = $_POST['peserta'];
$no_tagihan = $_POST['no_tagihan'];
$tahun = $_POST['tahun'];
$bulan = $_POST['bulan'];
$jumlah = $_POST['jumlah'];
$status = $_POST['status'];

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => 'http://localhost/uts/rosi/api.php/records/tagihan',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	// CURLOPT_POSTFIELDS => array('id_peserta' => $peserta, 'no_tagihan' => $no_tagihan, 'tahun' => $tahun, 'bulan' => $bulan, 'jumlah' => $jumlah, 'status' => $status),
	CURLOPT_POSTFIELDS => array('id_peserta' => $peserta, 'no_tagihan' => $no_tagihan, 'tahun' => $tahun, 'bulan' => $bulan, 'jumlah' => $jumlah, 'status' => $status),
));
$response = curl_exec($curl);
curl_close($curl);

header('Location: tagihan.php');
die();