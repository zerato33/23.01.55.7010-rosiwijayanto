<?php
	include 'menu.html';
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://localhost/uts/rosi/api.php/records/kontak',
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

<h3>Kontak</h3>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>Alamat</th>
			<th>No. Telepon</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 1;
			foreach ($data->records as $x) {
		?>
			<tr>
				<td><?= $x->alamat ?></td>
				<td><?= $x->telp ?></td>
				<td><?= $x->email ?></td>
				<td>
					<button type="button" class="btn btn-sm btn-info ubah" data-toggle="modal" data-target="#modalUbah"
						data-id="<?= $x->id ?>"
						data-alamat="<?= $x->alamat ?>"
						data-telp="<?= $x->telp ?>"
						data-email="<?= $x->email ?>"
					>
						Ubah
					</button>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<div class="modal fade" id="modalUbah">
	<div class="modal-dialog">
		<form class="modal-content" method="POST" action="kontak-ubah.php">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Kontak</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id" id="id">
				<div class="form-group">
					<label>Alamat</label>
					<input type="text" name="alamat" class="form-control" id="alamat" required>
				</div>
				<div class="form-group">
					<label>No. Telepon</label>
					<input type="text" name="telp" class="form-control" id="telp" required>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" class="form-control" id="email" required>
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
		$('#alamat').val($(this).data('alamat'))
		$('#telp').val($(this).data('telp'))
		$('#email').val($(this).data('email'))
	})
</script>

</div>
</body>
</html>