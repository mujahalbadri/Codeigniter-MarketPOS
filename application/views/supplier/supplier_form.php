<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Supplier</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= site_url('supplier'); ?>">Supplier</a></li>
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
						<h3 class="card-title"><?= ucfirst($page); ?> Supplier</h3>
						<div class="float-right">
							<a href="<?= site_url('supplier'); ?>" class="btn btn-warning text-white">
              <i class="fas fa-undo-alt mr-2"></i> Back
							</a>
						</div>
					</div>

          
          <div class="card-body">
            <form action="<?= site_url('supplier/process') ?>" method="post">
              <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">

                  <div class="form-group">
                    <label for="name">Nama Supplier *</label>
                    <input type="hidden" name="supplier_id" value="<?= $supplier->supplier_id; ?>">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $supplier->name; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="phone">Nomor Telephone Supplier *</label>
                    <input type="number" class="form-control" id="phone" name="phone" value="<?= $supplier->phone; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="address">Alamat Supplier *</label>
                    <textarea type="number" class="form-control" id="address" name="address" required><?= $supplier->address; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea type="number" class="form-control" id="description" name="description"><?= $supplier->description; ?></textarea>
                  </div>

 
                  <div class="form-group d-flex justify-content-center">
                    <button type="submit" name="<?= $page; ?>" class="btn btn-success btn-md mr-3">Save</button>
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