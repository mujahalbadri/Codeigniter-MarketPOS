<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Item
				</h1>
				<small class=" text-gray">(Item Barang)</small>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Home</a></li>
          <li class="breadcrumb-item active">Item</li>
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
						<h3 class="card-title">Data Item</h3>
						<div class="float-right">
							<a href="<?= site_url('item/add'); ?>" class="btn btn-primary">
							<i class="fas fa-plus mr-2"></i> Add Product Item
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
									<th>Nama Produk</th>
									<th>Kategori</th>
									<th>Unit</th>
									<th>Harga</th>
                  <th>Stock</th>
                  <th>Image</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody>

								<?php $i = 1;
								foreach($item->result() as $it ) { ?>

								<tr>
									<th class="text-center" style="width: 5%;"><?= $i++; ?></th>
									<td class="text-center">
										<?= $it->barcode; ?><br>
										<a href="<?= site_url('item/barcode_qrcode/') . $it->item_id; ?>" class="btn btn-default btn-sm mr-1 mt-2">
											Generate <i class="fas fa-barcode mr-1"></i>
										</a>
									</td>
									<td><?= $it->name; ?></td>
									<td><?= $it->category_name; ?></td>
									<td><?= $it->unit_name; ?></td>
									<td><?= indo_currency($it->price); ?></td>
                  <td><?= $it->stock; ?></td>
                  <td style="width:15%;">
                    <?php if($it->image != null) { ?>
                      <img src="<?= site_url('assets/') ?>dist/img/upload/product/<?= $it->image; ?>" alt="Picture" class="img-fluid img-thumbnail">
                    <?php } ?>
                  </td>
									<td>
										<div class="d-flex flex-column flex-sm-row justify-content-center">
										<a href="<?= site_url('item/edit/') . $it->item_id; ?>" class="btn btn-success mr-1 mb-1">
											<i class="fas fa-edit mr-1"></i>Edit
										</a>
										<a href="#modalDelete" data-toggle="modal" class="btn btn-danger mr-1 mb-1" onclick="$('#modalDelete #formDelete').attr('action','<?= site_url('item/delete/') . $it->item_id; ?>')">
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