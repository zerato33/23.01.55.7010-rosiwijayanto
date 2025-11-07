<?php
	include 'menu.html';
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://localhost/uts/rosi/api.php/records/pengeluaran',
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
?>

<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalTambah">Tambah</button>
<h3>Pengeluaran</h3>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Nama</th>
			<th>Jumlah</th>
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
				<td><?= $x->tanggal ?></td>
				<td><?= $x->nama ?></td>
				<td class="text-right"><?= $x->jumlah ?></td>
				<td>
					<button type="button" class="btn btn-sm btn-info ubah" data-toggle="modal" data-target="#modalUbah"
						data-id="<?= $x->id ?>"
						data-tanggal="<?= $x->tanggal ?>"
						data-nama="<?= $x->nama ?>"
						data-jumlah="<?= $x->jumlah ?>"
					>
						Ubah
					</button>
					<a href="pengeluaran-hapus.php?id=<?= $x->id ?>" class="btn btn-sm btn-danger">
						Hapus
					</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<div class="modal fade" id="modalTambah">
	<div class="modal-dialog">
		<form class="modal-content" method="POST" action="pengeluaran-tambah.php">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Pengeluaran</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Tanggal</label>
					<input type="date" name="tanggal" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="number" name="jumlah" class="form-control" required>
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
		<form class="modal-content" method="POST" action="pengeluaran-ubah.php">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Pengeluaran</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" id="id">
				<div class="form-group">
					<label>Tanggal</label>
					<input type="date" name="tanggal" class="form-control" id="tanggal" required>
				</div>
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" id="nama" required>
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input type="number" name="jumlah" class="form-control" id="jumlah" required>
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
		$('#tanggal').val($(this).data('tanggal'))
		$('#nama').val($(this).data('nama'))
		$('#jumlah').val($(this).data('jumlah'))
	})
</script>

</div>
</body>
</html>