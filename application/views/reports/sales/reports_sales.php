<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Sales Report
				</h1>
				<small class=" text-gray">(Laporan Penjualan)</small>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Home</a></li>
					<li class="breadcrumb-item active">reports</li>
					<li class="breadcrumb-item active">sales</li>
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
						<h3 class="card-title">Data Laporan Penjualan</h3>
					</div>

					<div class="card-body table-responsive-md">
						<table class="table table-bordered table-hover" id="table1">

							<?= $this->session->flashdata('message'); ?>

							<thead>
								<tr class="text-center">
									<th>#</th>
									<th>Invoice</th>
									<th>Tanggal</th>
									<th>Customer</th>
									<th>Total</th>
									<th>Discount</th>
									<th>Grand Total</th>
									<th>Actions</th>
								</tr>
							</thead>

							<tbody>

								<?php $i = 1;
								foreach($sale as $s ) { ?>

								<tr>
									<th class="text-center" style="width: 5%;"><?= $i++; ?></th>
									<td class="text-center"><?= $s->invoice; ?></td>
									<td class="text-center"><?= indo_date($s->date); ?></td>
									<?php if( $s->customer_name == '') { ?>
									<td class="text-center">Umum</td>
									<?php } else { ?>
									<td class="text-center"><?= $s->customer_name; ?></td>
									<?php } ?>
									<td class="text-center"><?= indo_currency($s->total_price); ?></td>
									<td class="text-center"><?= $s->discount; ?> %</td>
									<td class="text-center"><?= indo_currency($s->final_price); ?></td>
									<td>
									
										<div class="d-flex flex-column flex-sm-row justify-content-center">
										<a  id="set_detail" class="btn btn-primary text-white mr-1 mb-1" 
											data-toggle="modal" data-target="#modal_detail"
											data-invoice="<?= $s->invoice; ?>"
											data-user_name="<?= $s->user_name; ?>"
											data-sale_created="<?= $s->sale_created; ?>"
											data-customer_name="<?= $s->customer_name; ?>"
											data-total_price="<?= indo_currency($s->total_price); ?>"
											data-cash="<?= indo_currency($s->cash); ?>"
											data-discount="<?= $s->discount; ?>"
											data-remaining="<?= indo_currency($s->remaining); ?>"
											data-final_price="<?= indo_currency($s->final_price); ?>"
											data-note="<?= $s->note; ?>"
											>
											<i class="fas fa-eye mr-1"></i>Details
										</a>
										
										<a target="_blank" href="<?=site_url('sale/cetak/'.$s->sale_id)?>" class="btn btn-success text-white mr-1 mb-1">
											<i class="fas fa-print mr-1"></i>Print
										</a>
										<a href="#modalDelete" data-toggle="modal" class="btn btn-danger mr-1 mb-1" onclick="$('#modalDelete #formDelete').attr('action','<?= site_url('reports/del_sale/' . $s->sale_id) ?>')">
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

<!-- Detail Box -->

<div class="modal fade" id="modal_detail">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Sale Detail</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered table-striped" id="table1">
					<tbody>
						<tr>
							<th>Invoice</th>
							<td><span id="invoice"></span></td>
							<th>Cashier</th>
							<td><span id="user_name"></span></td>
						</tr>
						<tr>
							<th>Date</th>
							<td><span id="sale_created"></span></td>
							<th>Customer</th>
							<td><span id="customer_name"></span></td>
						</tr>
						<tr>
							<th>Total</th>
							<td><span id="total_price"></span></td>
							<th>Cash</th>
							<td><span id="cash"></span></td>
						</tr>
						<tr>
							<th>Discount</th>
							<td><span id="discount"></span></td>
							<th>Kembali</th>
							<td><span id="remaining"></span></td>
						</tr>
						<tr>
							<th>Grand Total</th>
							<td><span id="final_price"></span></td>
							<th>Note</th>
							<td><span id="note"></span></td>
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
			$('#invoice').text($(this).data('invoice'));
			$('#user_name').text($(this).data('user_name'));
			$('#sale_created').text($(this).data('sale_created'));
			$('#customer_name').text($(this).data('customer_name'));
			$('#total_price').text($(this).data('total_price'));
			$('#cash').text($(this).data('cash'));
			$('#discount').text($(this).data('discount') + ' %');
			$('#remaining').text($(this).data('remaining'));
			$('#final_price').text($(this).data('final_price'));
			$('#note').text($(this).data('note'));
			$('#item_name').text($(this).data('item_name'));
			$('#price').text($(this).data('price'));
			$('#qty').text($(this).data('qty'));
			$('#discount_item').text($(this).data('discount_item') + ' %');
			$('#total_item').text($(this).data('total_item'));
		})
	})
</script>