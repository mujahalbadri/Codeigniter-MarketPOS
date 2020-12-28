<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Stock In
				</h1>
				<small class=" text-gray">(Barang masuk / pembelian)</small>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Home</a></li>
					<li class="breadcrumb-item active">Stock</li>
					<li class="breadcrumb-item active">In</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">

  <div class="container-fluid">

		<div class="row">
			<div class="col-lg">
				<div class="card">

					<div class="card-header">
						<h3 class="card-title">Data Stock In</h3>
						<div class="float-right">
							<a href="<?= site_url('stock/in/add'); ?>" class="btn btn-primary">
							<i class="fas fa-plus mr-2"></i> Add Stock In
							</a>
						</div>
					</div>

					<div class="card-body table-responsive-md">
						<table class="table table-bordered table-hover" id="table1">

							<?= $this->session->flashdata('message'); ?>

							<thead>
								<tr class="text-center">
									<th>#</th>
									<th>Barcode</th>
									<th>Produk Item</th>
									<th>Qty</th>
									<th>Tanggal Masuk</th>
									<th>Actions</th>
								</tr>
							</thead>

							<tbody>

								<?php $i = 1;
								foreach($stock as $s ) { ?>

								<tr>
									<th class="text-center" style="width: 5%;"><?= $i++; ?></th>
									<td class="text-center"><?= $s->barcode; ?></td>
									<td class="text-center"><?= $s->item_name; ?></td>
									<td class="text-center"><?= $s->qty; ?></td>
									<td class="text-center"><?= indo_date($s->date); ?></td>
									<td style="width: 35%;">
										<div class="d-flex flex-column flex-sm-row justify-content-center">
										<a id="set_detail" class="btn btn-primary text-white mr-1 mb-1" 
											data-toggle="modal" data-target="#modal_detail"
											data-barcode="<?= $s->barcode; ?>"
											data-itemname="<?= $s->item_name; ?>"
											data-detail="<?= $s->detail; ?>"
											data-suppliername="<?= $s->supplier_name; ?>"
											data-qty="<?= $s->qty; ?>"
											data-date="<?= indo_date($s->date); ?>">
											<i class="fas fa-eye mr-1"></i>Details
										</a>
										<a href="#modalDelete" data-toggle="modal" class="btn btn-danger mr-1 mb-1" onclick="$('#modalDelete #formDelete').attr('action','<?= site_url('stock/in/delete/' . $s->stock_id . '/' . $s->item_id) ?>')">
										<i class="fas fa-trash-alt mr-1"></i>Delete</a>
										</div>
									</td>
								</tr>

								<?php } ?>



							</tbody>

						</table>
					</div>

				</div>
			</div>
		</div>

  </div>

</section>
<!-- ./Main Content -->

<!-- Modal Box -->
<div class="modal fade" id="modal_detail">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Stock In Detail</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered table-striped" id="table1">
					<tbody>
						<tr>
							<th>Barcode</th>
							<td><span id="barcode"></span></td>
						</tr>
						<tr>
							<th>Nama Item</th>
							<td><span id="item_name"></span></td>
						</tr>
						<tr>
							<th>Detail</th>
							<td><span id="detail"></span></td>
						</tr>
						<tr>
							<th>Nama Supplier</th>
							<td><span id="supplier_name"></span></td>
						</tr>
						<tr>
							<th>Qty</th>
							<td><span id="qty"></span></td>
						</tr>
						<tr>
							<th>Tanggal Masuk</th>
							<td><span id="date"></span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.Modal Box -->

<!-- Delete Modal-->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Apakah yakin ingin menghapus data ini ?</div>
			<div class="modal-footer">
				<form id="formDelete" action="" method="post">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
					<button class="btn btn-danger" type="submit">Hapus</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- ./Delete Modal -->

<!-- Script Modal Box -->
<script>
	$(document).ready(function() {
		$(document).on('click', '#set_detail', function() {
			var barcode = $(this).data('barcode');
			var itemname = $(this).data('itemname');
			var detail = $(this).data('detail');
			var suppliername = $(this).data('suppliername');
			var qty = $(this).data('qty');
			var date = $(this).data('date');
			$('#barcode').text(barcode);
			$('#item_name').text(itemname);
			$('#detail').text(detail);
			$('#supplier_name').text(suppliername);
			$('#qty').text(qty);
			$('#date').text(date);
			$('#detail').text(detail);
		})
	})
</script>