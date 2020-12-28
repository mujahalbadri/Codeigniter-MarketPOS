<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
				<h1 class="m-0 text-dark">Stock In</h1>
				<small class=" text-gray">(Barang masuk / pembelian)</small>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= site_url('stock/in'); ?>">Stock</a></li>
					<li class="breadcrumb-item"><a href="<?= site_url('stock/in'); ?>">In</a></li>
          <li class="breadcrumb-item active">add </li>
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
						<h3 class="card-title">Add Stock In</h3>
						<div class="float-right">
							<a href="<?= site_url('stock/in'); ?>" class="btn btn-warning text-white">
              <i class="fas fa-undo-alt mr-2"></i> Back
							</a>
						</div>
					</div>

          
          <div class="card-body">
          	<form action="<?= site_url('stock/process'); ?>" method="post">
            <?= $this->session->flashdata('message'); ?>
              <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">

                
									<div class="form-group">
										<label for="date">Date *</label>
										<input type="date" class="form-control" id="date" name="date" value="<?= date('Y-m-d'); ?>" required>
									</div>
									<div>
										<label for="barcode">Barcode *</label>
									</div>
									<div class="form-group input-group">
											<input type="hidden" name="item_id" id="item_id">
											<input type="text" class="form-control" name="barcode" id="barcode" required autofocus>
											<span class="input-group-btn">
												<button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal_item">
													<i class="fa fa-search"></i>
												</button>
											</span>
									</div>
                  <div class="form-group">
                    <label for="item_name">Nama Item *</label>
                    <input type="text" class="form-control" id="item_name" name="item_name" readonly>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-8">
												<label for="unit_name">Item Unit</label>
												<input type="text" class="form-control" name="unit_name" id="unit_name" value="-" readonly>
											</div>
											<div class="col-md-4">
												<label for="stock">Initial Stock</label>
												<input type="text" class="form-control" name="stock" id="stock" value="-" class="form-control" readonly>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="detail">Detail *</label>
										<input type="text" class="form-control" name="detail" placeholder="kulakan / tambahan / etc" required>
									</div>
									<div class="form-group">
										<label for="supplier">Supplier</label>
										<select name="supplier" id="supplier" class="form-control">
											<option value="">- Pilih -</option>
											<?php foreach($supplier as $s) { ?>
												<option value="<?= $s->supplier_id; ?>"><?= $s->name; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group">
										<label for="qty">Qty *</label>
										<input type="number" class="form-control" name="qty" id="qty" required>
									</div>


 
                  <div class="form-group d-flex justify-content-center">
                    <button type="submit" name="in_add" class="btn btn-success btn-md mr-3">Save</button>
                    <button type="reset" class="btn btn-danger btn-md">Reset</button>
                  </div>
                  
                </div>
              </div>
						</form>
          </div>
        

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

<!-- Script Modal Box -->
<script>
	$(document).ready(function() {
		$(document).on('click', '#select', function() {
			var item_id = $(this).data('id');
			var barcode = $(this).data('barcode');
			var name = $(this).data('name');
			var unit_name = $(this).data('unit');
			var stock = $(this).data('stock');
			$('#item_id').val(item_id);
			$('#barcode').val(barcode);
			$('#item_name').val(name);
			$('#unit_name').val(unit_name);
			$('#stock').val(stock);
			$('#modal_item').modal('hide');
		})
	})
</script>