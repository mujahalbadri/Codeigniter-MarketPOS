<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Stocks Report
				</h1>
				<small class=" text-gray">(Laporan Stock Barang)</small>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Home</a></li>
					<li class="breadcrumb-item active">reports</li>
					<li class="breadcrumb-item active">stocks</li>
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
						<h3 class="card-title">Data Laporan Stock Barang</h3>
					</div>

					<div class="card-body table-responsive-md">
						<table class="table table-bordered table-hover" id="table1">

							<?= $this->session->flashdata('message'); ?>

							<thead>
								<tr class="text-center">
									<th>#</th>
									<th>Produk Item</th>
									<th>Date</th>
									<th>Status</th>
									<th>Detail / Info</th>
									<th>Qty</th>
									<th>Actions</th>
								</tr>
							</thead>

							<tbody>

								<?php $i = 1;
								foreach($stock as $s ) { ?>

								<tr>
									<th class="text-center" style="width: 5%;"><?= $i++; ?></th>
										<td class="text-center"><?= $s->item_name; ?></td>
										<td class="text-center"><?= indo_date($s->date); ?></td>
										<?php if( $s->type == 'in') { ?>
										<td class="text-center bg-gradient-success"><?= $s->type; ?></td>
										<td class="text-center"><?= $s->detail; ?></td>
										<?php } else { ?>
										<td class="text-center bg-gradient-danger"><?= $s->type; ?></td>
										<td class="text-center"><?= $s->info; ?></td>
										<?php } ?>
										<td class="text-center"><?= $s->qty; ?></td>
									<td>
										<div class="d-flex flex-column flex-sm-row justify-content-center">
										<a id="set_detail" class="btn btn-primary text-white mr-1 mb-1" 
											data-toggle="modal" data-target="#modal_detail"
											data-barcode="<?= $s->barcode; ?>"
											data-itemname="<?= $s->item_name; ?>"
											data-detail="<?= $s->detail; ?>"
											data-type="<?= $s->type; ?>"
											data-info="<?= $s->info; ?>"
											data-suppliername="<?= $s->supplier_name; ?>"
											data-qty="<?= $s->qty; ?>"
											data-date="<?= indo_date($s->date); ?>">
											<i class="fas fa-eye mr-1"></i>Details
										</a>
										<a href="#modalDelete" data-toggle="modal" class="btn btn-danger mr-1 mb-1" onclick="$('#modalDelete #formDelete').attr('action','<?= site_url('reports/del_stock/' . $s->stock_id) ?>')">
											<i class="fas fa-trash-alt mr-1"></i>Delete
										</a>
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
							<th>Status</th>
							<td><span id="type"></span></td>
						</tr>
						<tr>
							<th>Nama Item</th>
							<td><span id="item_name"></span></td>
						</tr>
						<tr>
							<th>Detail / Info</th>
							<td><span id="detail"></span><span id="info"></span></td>
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
							<th>Tanggal</th>
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
			$('#barcode').text($(this).data('barcode'));
			$('#item_name').text($(this).data('itemname'));
			$('#type').text($(this).data('type'));
			$('#detail').text($(this).data('detail'));
			$('#info').text($(this).data('info'));
			$('#supplier_name').text($(this).data('suppliername'));
			$('#qty').text($(this).data('qty'));
			$('#date').text($(this).data('date'));
		})
	})
</script>