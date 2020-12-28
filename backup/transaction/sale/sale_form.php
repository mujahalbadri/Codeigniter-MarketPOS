<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Sales
				</h1>
				<small class=" text-gray">(Penjualan)</small>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Home</a></li>
					<li class="breadcrumb-item active">Sale</li>
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

			<div class="col-sm-12 col-xl-4">
				<div class="card h-lg-100">
					<div class="card-body">
						<table width="100%">
							<tr>
								<td style="vertical-align: top;">
									<label for="date">Date</label>
								</td>
								<td>
									<div class="form-group">
										<input type="date" class="form-control" name="date" id="date" value="<?= date('Y-m-d') ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top; width:30%;">
									<label for="user">Kasir</label>
								</td>
								<td>
									<div class="form-group">
										<input type="text" class="form-control" id="user" name="user" value="<?= $this->fungsi->user_login()->name; ?>" readonly>
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top;">
									<label for="customer">Customer</label>
								</td>
								<td>
									<div>
										<select name="customer" id="customer" class="form-control">
											<option value="">Umum</option>
											<?php foreach($customer as $c) { ?>
											<option value="<?= $c->customer_id; ?>"><?= $c->name; ?></option>
											<?php } ?>
										</select>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-xl-4">
				<div class="card h-lg-100">
					<div class="card-body">
						<table width="100%">
						<form action="<?= site_url('sale/add_cart'); ?>" method="post">
							<tr>
								<td style="vertical-align: top;  width:30%;">
									<label for="barcode">Barcode</label>
								</td>
								<td>
									<div class="form-group input-group">
										<input type="hidden" id="item_id" name="item_id">
										<input type="hidden" id="price" name="price">
										<input type="hidden" id="stock" name="stock">
										<input type="text" class="form-control" id="barcode" name="barcode" autofocus>
										<span class="input-group-btn">
											<button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal_item">
												<i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top;">
									<label for="qty">Qty</label>
								</td>
								<td>
									<div class="form-group">
										<input type="number" id="qty" name="qty" value="1" min="1" class="form-control">
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<button type="submit" class="btn btn-primary" name="add_cart" id="add_cart">
										<i class="fa fa-cart-plus"></i> Add
									</button>
								</td>
							</tr>
						</form>
						</table>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-xl-4">
				<div class="card">
					<div class="card-body">
						<div align="right">
							<h4>Invoice <br><b><span id="invoice" name="invoice"><?= $invoice; ?></span></b></h4>
							<h1><b><span id="grand_total2" name="grand_total2" style="font-size:50pt">0</span></b></h1>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="row">
	
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body table-responsive">
						<table class="table table-bordered">
							<thead class="text-center">
								<th>#</th>
								<th>Barcode</th>
								<th>Product Item</th>
								<th>Harga</th>
								<th>Qty</th>
								<th width="10%">Discount Item</th>
								<th width="15%">Sub Total</th>
								<th>Action</th>
							</thead>
							<tbody id=cart_table>
								<?php $no = 1;
								$total_harga = 0;
								foreach( $cart as $c ) { ?>
								<tr>
									<td class="text-center"><?= $no++; ?></td>
									<td class="text-center"><?= $c->barcode; ?></td>
									<td class="text-center"><?= $c->item_name; ?></td>
									<td class="text-center"><?= indo_currency($c->price); ?></td>
									<td class="text-center"><?= $c->qty; ?></td>
									<td class="text-center"><?= $c->discount; ?> %</td>
									<td class="text-center"><?= indo_currency($c->sub_total); ?></td>
									<td>
									<div class="d-flex flex-column flex-sm-row justify-content-center">
										<a 
												href="javascript:;"
												data-cart_id="<?= $c->cart_id ?>"
												data-barcode="<?= $c->barcode ?>"
												data-item_name="<?= $c->item_name ?>"
												data-price="<?= $c->price ?>"
												data-qty="<?= $c->qty ?>"
												data-discount="<?= $c->discount ?>"
												data-toggle="modal" data-target="#edit-data">
												<button  data-toggle="modal" data-target="#ubah-data" class="btn btn-success mr-1 mb-1">
												<i class="fas fa-edit mr-1"></i>Edit</button>
										</a>
										<a href="#modalDelete" data-toggle="modal" class="btn btn-danger mr-1 mb-1" onclick="$('#modalDelete #formDelete').attr('action','<?= site_url('sale/delete_cart/') . $c->cart_id; ?>')">
											<i class="fas fa-trash-alt mr-1"></i>Delete
										</a>
										</div>
									</td>
								</tr>
								<?php 
								$total_harga += $c->sub_total;
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="col-sm-6 col-lg-3">
				<div class="card" style="height: 13em;">
					<div class="card-body">
						<table width="100%">
							<tr>
								<td style="vertical-align: top; width:30%;">
									<label for="sub_total">Sub Total</label>
								</td>
								<td>
									<div class="form-group">
										<input type="number" id="sub_total" name="sub_total" value="<?= $total_harga; ?>" class="form-control" readonly>
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top;">
									<label for="discount">Discount</label>
								</td>
								<td>
									<div class="form-group">
										<input type="number" id="discount" name="discount" value="0"
										min="0" class="form-control">
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top;">
									<label for="grand_total">Grand Total</label>
								</td>
								<td>
									<div class="form-group">
										<input type="number" id="grand_total" name="grand_total" class="form-control" readonly>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-lg-3">
				<div class="card" style="height: 13em;">
					<div class="card-body">
						<table width="100%">
							<tr>
								<td style="vertical-align: top; width:30%;">
									<label for="cash">Cash</label>
								</td>
								<td>
									<div class="form-group">
										<input type="number" id="cash" name="cash" value="0" min="0" class="form-control">
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top;">
									<label for="change">Change</label>
								</td>
								<td>
									<div>
										<input type="number" class="form-control" id="change" name="change" readonly>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-lg-3">
				<div class="card" style="height: 13em;">
					<div class="card-body">
						<table width="100%">
							<tr>
								<td style="vertical-align: top;">
									<label for="note">Note</label>
								</td>
								<td>
									<div>
										<textarea class="form-control" name="note" id="note" rows="6"></textarea>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-lg-3">
				<div>
					<button id="cancle_payment" name="cancle_payment" class="btn btn-warning text-white">
						<i class="fas fa-sync-alt"></i> Cancel
					</button><br><br>
					<button id="process_payment" name="process_payment" class="btn btn-lg btn-success">
						<i class="fas fa-money-bill-wave"></i> Process Payment
					</button>
				</div>
			</div>

		</div>
		

  </div>

</section>
<!-- ./Main Content -->

<!-- Modal Box -->
<div class="modal fade" id="modal_item">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Select Product Item</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered table-striped" id="table1">
					<thead>
						<tr>
							<th>Barcode</th>
							<th>Name</th>
							<th>Unit</th>
							<th>Price</th>
							<th>Stock</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($item as $i) { ?>
						<tr>
							<td><?= $i->barcode; ?></td>
							<td><?= $i->name; ?></td>
							<td><?= $i->unit_name; ?></td>
							<td><?= indo_currency($i->price); ?></td>
							<td><?= $i->stock; ?></td>
							<td>
								<button class="btn btn-xs btn-primary" id="select"
									data-id="<?= $i->item_id; ?>"
									data-barcode="<?= $i->barcode; ?>"
									data-name="<?= $i->name; ?>"
									data-unit="<?= $i->unit_name; ?>"
									data-price="<?= $i->price; ?>"
									data-stock="<?= $i->stock; ?>">
									<i class="fa fa-check"></i> Select
								</button>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.Modal Box -->

<!-- Modal Ubah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Cart</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
            <form class="form-horizontal" action="<?= base_url('sale/edit_cart')?>" method="post" enctype="multipart/form-data" role="form">
             <div class="modal-body">
                     <div class="form-group">
                         <label>Barcode</label>
                         <div class="col-lg-10">
                          <input type="hidden" id="cart_id" name="cart_id">
                             <input type="text" class="form-control" id="barcode" name="barcode" readonly>
                         </div>
										 </div>
										 <div class="form-group">
                         <label>Product Item</label>
                         <div class="col-lg-10">
                             <input type="text" class="form-control" id="item_name" name="item_name" readonly>
                         </div>
                     </div>
                     <div class="form-group">
                         <label>Harga</label>
                         <div class="col-lg-10">
                             <input type="text" class="form-control" id="price" name="price" readonly>
                         </div>
										 </div>
										 <div class="form-group">
                         <label>Qty</label>
                         <div class="col-lg-10">
                             <input type="number" class="form-control" id="qty" name="qty">
                         </div>
										 </div>
										 <div class="form-group">
                         <label>Discount</label>
                         <div class="col-lg-10">
                             <input type="number" class="form-control" id="discount" name="discount">
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-info" type="submit" name="edit"> Simpan&nbsp;</button>
                     <button type="button" class="btn btn-warning text-white" data-dismiss="modal"> Batal</button>
                 </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Modal Ubah -->


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
		$(document).on('click', '#select', function() {
			var item_id = $(this).data('id');
			var barcode = $(this).data('barcode');
			var name = $(this).data('name');
			var price = $(this).data('price');
			var unit_name = $(this).data('unit');
			var stock = $(this).data('stock');
			$('#item_id').val(item_id);
			$('#barcode').val(barcode);
			$('#item_name').val(name);
			$('#unit_name').val(unit_name);
			$('#price').val(price);
			$('#stock').val(stock);
			$('#modal_item').modal('hide');
		})

		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)

            // Isi nilai pada field
            modal.find('#cart_id').attr("value",div.data('cart_id'));
            modal.find('#barcode').attr("value",div.data('barcode'));
						modal.find('#item_name').attr("value",div.data('item_name'));
						modal.find('#price').attr("value",div.data('price'));
            modal.find('#qty').attr("value",div.data('qty'));
						modal.find('#discount').attr("value",div.data('discount'));
        });
	})
</script>