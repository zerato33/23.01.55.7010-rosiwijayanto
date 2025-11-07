<?php
	include 'menu.html';
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://localhost/uts/rosi/api.php/records/tagihan',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response = curl_exec($curl);
	curl_close($curl);
	$data = json_decode($response);

	$curl3 = curl_init();
	curl_setopt_array($curl3, array(
		CURLOPT_URL => 'http://localhost/uts/rosi/api.php/records/peserta',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response3 = curl_exec($curl3);
	curl_close($curl3);
	$peserta = json_decode($response3);
?>

<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalTambah">Tambah</button>
<h3>Tagihan</h3>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No.</th>
			<th>Peserta</th>
			<th>No. Tagihan</th>
			<th>Tahun</th>
			<th>Bulan</th>
			<th>Jumlah</th>
			<th>Status</th>
			<th>Opsi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 1;
			foreach ($data->records as $x) {
		?>
			<tr>
				<td class="text-center"><?= $no++ ?></td>
				<td>
					<?php
						$curl2 = curl_init();
						curl_setopt_array($curl2, array(
							CURLOPT_URL => 'http://localhost/uts/rosi/api.php/records/peserta/'.$x->id_peserta,
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => '',
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 0,
							CURLOPT_FOLLOWLOCATION => true,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => 'GET',
						));
						$response2 = curl_exec($curl2);
						curl_close($curl2);
						$data2 = json_decode($response2);
						echo $data2->nama;
					?>
				</td>
				<td><?= $x->no_tagihan ?></td>
				<td class="text-center"><?= $x->tahun ?></td>
				<td><?= $x->bulan ?></td>
				<td class="text-right"><?= $x->jumlah ?></td>
				<td><?= $x->status ?></td>
				<td>
					<button type="button" class="btn btn-sm btn-info ubah" data-toggle="modal" data-target="#modalUbah"
						data-id="<?= $x->id ?>"
						data-peserta="<?= $x->id_peserta ?>"
						data-no_tagihan="<?= $x->no_tagihan ?>"
						data-tahun="<?= $x->tahun ?>"
						data-bulan="<?= $x->bulan ?>"
						data-jumlah="<?= $x->jumlah ?>"
						data-status="<?= $x->status ?>"
					>
						Ubah
					</button>
					<a href="tagihan-hapus.php?id=<?= $x->id ?>" class="btn btn-sm btn-danger">
						Hapus
					</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<div class="modal fade" id="modalTambah">
	<div class="modal-dialog">
		<form class="modal-content" method="POST" action="tagihan-tambah.php">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Tagihan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Peserta</label>
					<select name="peserta" class="form-control" required>
						<?php foreach ($peserta->records as $x) { ?>
							<option value="<?= $x->id ?>"><?= $x->nama ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>No. Tagihan</label>
					<input type="text" name="no_tagihan" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Tahun</label>
					<input type="number" name="tahun" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Bulan</label>
					<select name="bulan" class="form-control" required>
						<option>Januari</option>
						<option>Februari</option>
						<option>Maret</option>
						<option>April</option>
						<option>Mei</option>
						<option>Juni</option>
						<option>Juli</option>
						<option>Agustus</option>
						<option>September</option>
						<option>Oktober</option>
						<option>November</option>
						<option>Desember</option>
					</select>
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="number" name="jumlah" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Status</label>
					<select name="status" class="form-control" required>
						<option>Belum Lunas</option>
						<option>Lunas</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info">Simpan</button>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="modalUbah">
	<div class="modal-dialog">
		<form class="modal-content" method="POST" action="tagihan-ubah.php">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Tagihan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" id="id">
				<div class="form-group">
					<label>Peserta</label>
					<select name="peserta" class="form-control" id="peserta" required>
						<?php foreach ($peserta->records as $x) { ?>
							<option value="<?= $x->id ?>"><?= $x->nama ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>No. Tagihan</label>
					<input type="text" name="no_tagihan" class="form-control" id="no_tagihan" required>
				</div>
				<div class="form-group">
					<label>Tahun</label>
					<input type="number" name="tahun" class="form-control" id="tahun" required>
				</div>
				<div class="form-group">
					<label>Bulan</label>
					<select name="bulan" class="form-control" id="bulan" required>
						<option>Januari</option>
						<option>Februari</option>
						<option>Maret</option>
						<option>April</option>
						<option>Mei</option>
						<option>Juni</option>
						<option>Juli</option>
						<option>Agustus</option>
						<option>September</option>
						<option>Oktober</option>
						<option>November</option>
						<option>Desember</option>
					</select>
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="number" name="jumlah" class="form-control" id="jumlah" required>
				</div>
				<div class="form-group">
					<label>Status</label>
					<select name="status" class="form-control" id="status" required>
						<option>Belum Lunas</option>
						<option>Lunas</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info">Simpan</button>
			</div>
		</form>
	</div>
</div>

<script>
	$(document).on('click', '.ubah', function () {
		$('#id').val($(this).data('id'))
		$('#peserta').val($(this).data('peserta'))
		$('#no_tagihan').val($(this).data('no_tagihan'))
		$('#tahun').val($(this).data('tahun'))
		$('#bulan').val($(this).data('bulan'))
		$('#jumlah').val($(this).data('jumlah'))
		$('#status').val($(this).data('status'))
	})
</script>

</div>
</body>
</html>