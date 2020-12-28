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
									<button type="button" class="btn btn-primary" id="add_cart">
										<i class="fa fa-cart-plus"></i> Add
									</button>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-xl-4">
				<div class="card">
					<div class="card-body">
						<div align="right">
							<h4>Invoice <br><b><span id="invoice"><?= $invoice; ?></span></b></h4>
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
								<th width="15%">Total</th>
								<th>Action</th>
							</thead>
							<tbody id=cart_table>
								<?php $this->load->view('transaction/sale/cart_data') ?>
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
										<input type="number" id="sub_total" name="sub_total" class="form-control" readonly>
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: top;">
									<label for="discount">Discount (%)</label>
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
									<label for="change">Kembali</label>
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
							<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit Cart</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
             <div class="modal-body">
                     <div class="form-group">
                         <label>Barcode</label>
                         <div class="col-lg-12">
                          <input type="hidden" id="cart_id" name="cart_id">
                             <input type="text" class="form-control" id="barcode_item" name="barcode_item" readonly>
                         </div>
										 </div>
										 <div class="form-group">
                         <label>Product Item</label>
                         <div class="col-lg-12">
                             <input type="text" class="form-control" id="item_name" name="item_name" readonly>
                         </div>
                     </div>
                     <div class="form-group">
                         <label>Harga</label>
                         <div class="col-lg-12">
                             <input type="text" class="form-control" id="price_item" name="price_item">
                         </div>
										 </div>
										 <div class="form-group">
                         <label>Qty</label>
                         <div class="col-lg-12">
                             <input type="number" class="form-control" id="qty_item" name="qty_item">
                         </div>
										 </div>
										 <div class="form-group">
                         <label>Discount (%)</label>
                         <div class="col-lg-12">
                             <input type="number" class="form-control" id="discount_item" name="discount_item">
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-success" id="edit_cart" name="edit_cart"> Simpan&nbsp;</button>
                     <button type="button" class="btn btn-danger text-white" data-dismiss="modal"> Batal</button>
                 </div>
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
		$('#item_id').val($(this).data('id'));
		$('#barcode').val($(this).data('barcode'));
		$('#price').val($(this).data('price'));
		$('#stock').val($(this).data('stock'));
		$('#modal_item').modal('hide');
	})

})

// Ajax add Cart
$(document).on('click', '#add_cart', function() {
	var item_id = $('#item_id').val()
	var price = $('#price').val()
	var stock = $('#stock').val()
	var qty = $('#qty').val()
	if(item_id == '') {
		alert('Produk belum dipilih')
		$('#barcode').focus()
	} else if(stock < 1) {
		alert('Stock tidak mencukupi')
		$('#item_id').val('')
		$('#barcode').val('')
		$('#barcode').focus()
	} else {
		$.ajax({
			type : 'POST',
			url: '<?= site_url('sale/process')?>',
			data: {'add_cart' : true, 'item_id' : item_id, 'price' : price, 'qty' : qty},
			dataType: 'json',
			success: function(result) {
				if(result.success == true) {
					$('#cart_table').load('<?=site_url('sale/cart_data')?>', function() {
						calculate()
					})
					$('#item_id').val('')
					$('#barcode').val('')
					$('#qty').val(1)
					$('#barcode').focus()
				} else {
					alert('Gagal tambah item cart')
				}
			}
		})
	}
})

$(document).on('click', '#del_cart', function() {
	if(confirm('Apakah anda ingin menghapus data ?')) {
		var cart_id = $(this).data('cartid')
		$.ajax({
			type: 'POST',
			url: '<?= site_url('sale/cart_del')?>',
			dataType: 'json',
			data: {'cart_id': cart_id},
			success: function(result) {
				if(result.success == true) {
					$('#cart_table').load('<?=site_url('sale/cart_data')?>', function() {
						calculate()
					})
				} else {
					alert('Gagal hapus item cart');
				}
			}
		})
	}
})


// Untuk Edit
$('#edit-data').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
		var modal = $(this)

		// Isi nilai pada field
		modal.find('#cart_id').attr("value",div.data('cart_id'));
		modal.find('#barcode_item').attr("value",div.data('barcode'));
		modal.find('#item_name').attr("value",div.data('item_name'));
		modal.find('#price_item').attr("value",div.data('price'));
		modal.find('#qty_item').attr("value",div.data('qty'));
		modal.find('#discount_item').attr("value",div.data('discount'));
});

// Ajax edit Cart
$(document).on('click', '#edit_cart', function() {
	var cart_id = $('#cart_id').val()
	var price = $('#price_item').val()
	var qty = $('#qty_item').val()
	var discount = $('#discount_item').val()
	var total = (price * qty) - ((price*qty)*(discount/100))
	if(price == '' || price < 1) {
		alert('Harga tidak boleh kosong')
		$('#price_item').focus()
	} else if(qty == '' || qty < 1) {
		alert('Qty tidak boleh kosong')
		$('#qty_item').focus()
	} else {
		$.ajax({
			type : 'POST',
			url: '<?= site_url('sale/process')?>',
			data: {'edit_cart' : true, 'cart_id' : cart_id, 'price' : price, 'qty' : qty, 'discount' : discount, 'total' : total},
			dataType: 'json',
			success: function(result) {
				if(result.success == true) {
					$('#cart_table').load('<?=site_url('sale/cart_data')?>', function() {
						calculate()
					})
					alert('Item Cart berhasil terupdate')
					$('#edit-data').modal('hide');
				} else {
					alert('Gagal tambah item cart')
				}
			}
		})
	}
})

function calculate() {
	var subtotal = 0;
	$('#cart_table tr').each(function() {
		subtotal += parseInt($(this).find('#total').text())
	})
	isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

	var discount = $('#discount').val()
	var grand_total = subtotal - (subtotal * (discount/100))
	if(isNaN(grand_total)) {
		$('#grand_total').val(0)
		$('#grand_total2').text(0)
	} else {
		$('#grand_total').val(grand_total)
		$('#grand_total2').text(grand_total)
	}

	var cash = $('#cash').val();
	cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0)

	if(discount == '') {
		$('#discount').val(0)
	} else if(discount > 100 ) {
		alert('Discount hanya dari 0% - 100%')
		$('#discount').val(0)
	}
}

$(document).on('keyup mouseup', '#discount, #cash', function() {
	calculate()
})

$(document).ready(function() {
	calculate()
})

// Process Payment
$(document).on('click', '#process_payment',function() {
	var customer_id = $('#customer').val()
	var subtotal = $('#sub_total').val()
	var discount = $('#discount').val()
	var grandtotal = $('#grand_total').val()
	var cash = $('#cash').val()
	var change = $('#change').val()
	var note = $('#note').val()
	var date = $('#date').val()
	if(subtotal < 1) {
		alert('Product item belum ada yang dipilih')
		$('#barcode').focus()
	} else if(cash < 1) {
		alert('Jumlah uang cash belum diinput')
		$('#cash').focus()
	} else {
		if(confirm('Apakah ingin memproses transaksi ini?')) {
			$.ajax({
				type: 'POST',
				url: '<?= site_url('sale/process')?>',
				data: {'process_payment' : true, 'customer_id' : customer_id, 'subtotal' : subtotal, 'discount' : discount, 'grandtotal' : grandtotal, 'cash' : cash, 'change' : change, 'note' : note, 'date' : date},
				dataType: 'json',
				success: function(result) {
					if(result.success) {
						alert('Transaksi berhasil')
						window.open('<?=site_url('sale/cetak/')?>' + result.sale_id, '_blank')
					} else {
						alert('Transaksi gagal');
					}
					location.href='<?=site_url('sale')?>'
				}
			})
		}
	}
})


</script>