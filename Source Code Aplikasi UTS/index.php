<?php
	include 'menu.html';
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://localhost/uts/rosi/api.php/records/peserta',
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

	$curl4 = curl_init();
	curl_setopt_array($curl4, array(
		CURLOPT_URL => 'http://localhost/uts/rosi/api.php/records/kelas',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response4 = curl_exec($curl4);
	curl_close($curl4);
	$kelas = json_decode($response4);

	$curl5 = curl_init();
	curl_setopt_array($curl5, array(
		CURLOPT_URL => 'http://localhost/uts/rosi/api.php/records/pendidikan',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	));
	$response5 = curl_exec($curl5);
	curl_close($curl5);
	$pendidikan = json_decode($response5);
?>

<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalTambah">Tambah</button>
<h3>Peserta</h3>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No.</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Tanggal Lahir</th>
			<th>Pendidikan</th>
			<th>Kelas</th>
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
				<td><?= $x->nama ?></td>
				<td><?= $x->alamat ?></td>
				<td><?= $x->tgl_lahir ?></td>
				<td>
					<?php
						$curl2 = curl_init();
						curl_setopt_array($curl2, array(
							CURLOPT_URL => 'http://localhost/uts/rosi/api.php/records/pendidikan/'.$x->id_pendidikan,
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
				<td class="text-center">
					<?php
						$curl3 = curl_init();
						curl_setopt_array($curl3, array(
							CURLOPT_URL => 'http://localhost/uts/rosi/api.php/records/kelas/'.$x->id_kelas,
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
						$data3 = json_decode($response3);
						echo $data3->nama;
					?>
				</td>
				<td>
					<button type="button" class="btn btn-sm btn-info ubah" data-toggle="modal" data-target="#modalUbah"
						data-id="<?= $x->id ?>"
						data-nama="<?= $x->nama ?>"
						data-alamat="<?= $x->alamat ?>"
						data-tgl_lahir="<?= $x->tgl_lahir ?>"
						data-pendidikan="<?= $x->id_pendidikan ?>"
						data-kelas="<?= $x->id_kelas ?>"
					>
						Ubah
					</button>
					<a href="peserta-hapus.php?id=<?= $x->id ?>" class="btn btn-sm btn-danger">
						Hapus
					</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<div class="modal fade" id="modalTambah">
	<div class="modal-dialog">
		<form class="modal-content" method="POST" action="peserta-tambah.php">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Peserta</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<input type="text" name="alamat" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Tanggal Lahir</label>
					<input type="date" name="tgl_lahir" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Pendidikan</label>
					<select name="pendidikan" class="form-control" required>
						<?php foreach ($pendidikan->records as $x) { ?>
							<option value="<?= $x->id ?>"><?= $x->nama ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Kelas</label>
					<select name="kelas" class="form-control" required>
						<?php foreach ($kelas->records as $x) { ?>
							<option value="<?= $x->id ?>"><?= $x->nama ?></option>
						<?php } ?>
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
		<form class="modal-content" method="POST" action="peserta-ubah.php">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Peserta</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" id="id">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" id="nama" required>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<input type="text" name="alamat" class="form-control" id="alamat" required>
				</div>
				<div class="form-group">
					<label>Tanggal Lahir</label>
					<input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" required>
				</div>
				<div class="form-group">
					<label>Pendidikan</label>
					<select name="pendidikan" class="form-control" id="pendidikan" required>
						<?php foreach ($pendidikan->records as $x) { ?>
							<option value="<?= $x->id ?>"><?= $x->nama ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Kelas</label>
					<select name="kelas" class="form-control" id="kelas" required>
						<?php foreach ($kelas->records as $x) { ?>
							<option value="<?= $x->id ?>"><?= $x->nama ?></option>
						<?php } ?>
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
		$('#nama').val($(this).data('nama'))
		$('#alamat').val($(this).data('alamat'))
		$('#tgl_lahir').val($(this).data('tgl_lahir'))
		$('#pendidikan').val($(this).data('pendidikan'))
		$('#kelas').val($(this).data('kelas'))
	})
</script>

</div>
</body>
</html>