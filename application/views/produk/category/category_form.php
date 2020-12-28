<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
				<h1 class="m-0 text-dark">Categories</h1>
				<small class=" text-gray">(Kategori Barang)</small>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= site_url('category'); ?>">Categories</a></li>
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
						<h3 class="card-title"><?= ucfirst($page); ?> Categories</h3>
						<div class="float-right">
							<a href="<?= site_url('category'); ?>" class="btn btn-warning text-white">
              <i class="fas fa-undo-alt mr-2"></i> Back
							</a>
						</div>
					</div>

          
          <div class="card-body">
            <form action="<?= site_url('category/process') ?>" method="post">
              <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">

                  <div class="form-group">
                    <label for="name">Nama Category *</label>
                    <input type="hidden" name="category_id" value="<?= $category->category_id; ?>">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $category->name; ?>" required>
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