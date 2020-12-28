<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
				<h1 class="m-0 text-dark">Item</h1>
				<small class=" text-gray">(Item Barang)</small>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= site_url('item'); ?>">Item</a></li>
          <li class="breadcrumb-item active"><?= ucfirst($page); ?> </li>
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
						<h3 class="card-title"><?= ucfirst($page); ?> Item</h3>
						<div class="float-right">
							<a href="<?= site_url('item'); ?>" class="btn btn-warning text-white">
              <i class="fas fa-undo-alt mr-2"></i> Back
							</a>
						</div>
					</div>

          
          <div class="card-body">
          <?= form_open_multipart('item/process');?>
            <?= $this->session->flashdata('message'); ?>
              <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">

                

								<div class="form-group">
                    <label for="barcode">Barcode *</label>
                    <input type="hidden" name="item_id" value="<?= $item->item_id; ?>">
                    <input type="text" class="form-control" id="barcode" name="barcode" value="<?= $item->barcode; ?>" required>
				    			</div>
                  <div class="form-group">
                    <label for="name">Nama Produk *</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $item->name; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="category">Kategori *</label>
                    <select name="category" id="category" class="form-control" required>
                      <option value="">- Pilih kategori -</option>
                      <?php foreach($category->result() as $c ) { ?>
                        <option value="<?= $c->category_id; ?>" <?= $c->category_id == $item->category_id ? "selected" : null; ?>><?= $c->name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="unit">Unit *</label>
                    <select name="unit" id="unit" class="form-control" required>
                      <option value="">- Pilih unit -</option>
                      <?php foreach($unit->result() as $u ) { ?>
                        <option value="<?= $u->unit_id; ?>" <?= $u->unit_id == $item->unit_id ? "selected" : null; ?>><?= $u->name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
									<div class="form-group">
                    <label for="price">Harga *</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?= $item->price; ?>" required>
				    			</div>
                  <div class="form-group row">
										<div class="div col-sm-2">
                      <label>Picture</label>
                    </div>
										<div class="col-sm-10">
											<div class="row">
                      <?php if($page == 'edit') { ?>
                        <?php if($item->image != null ) { ?>
												<div class="col-sm-3">
													<img src="<?= site_url('assets/dist/img/upload/product/'. $item->image); ?>" class="img-thumbnail">
                        </div>
                        <?php } else { ?>
                          <div class="col-sm-3">
													<img src="<?= site_url('assets/dist/img/upload/product/image.png'); ?>" class="img-thumbnail">
                        </div>
                        <?php } ?>
                      <?php } else { ?>
												<div class="col-sm-3">
													<img src="<?= site_url('assets/dist/img/upload/product/image.png'); ?>" class="img-thumbnail">
                        </div>
                      <?php } ?>
												<div class="col-sm-9">
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="image" name="image">
														<label class="custom-file-label" for="image">Choose file</label>
                          </div>
                          <small>(Biarkan Kosong jika tidak <?= $page == 'edit' ? 'diganti' : 'ada' ?>)</small>
												</div>
											</div>
										</div>
									</div>

 
                  <div class="form-group d-flex justify-content-center">
                    <button type="submit" name="<?= $page; ?>" class="btn btn-success btn-md mr-3">Save</button>
                    <button type="reset" class="btn btn-danger btn-md">Reset</button>
                  </div>
                  
                </div>
              </div>
          <?= form_close(); ?>
          </div>
        

				</div>
			</div>
		</div>

  </div>

</section>
<!-- ./Main Content -->