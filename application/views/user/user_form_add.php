<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Users</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= site_url('user'); ?>">Users</a></li>
          <li class="breadcrumb-item active">Add</li>
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
						<h3 class="card-title">Add User</h3>
						<div class="float-right">
							<a href="<?= site_url('user'); ?>" class="btn btn-warning text-white">
              <i class="fas fa-undo-alt mr-2"></i> Back
							</a>
						</div>
					</div>

          
          <div class="card-body">
            <form action="" method="post">
              <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">

                  <div class="form-group">
                    <label for="name">Nama Lengkap *</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>">
                    <?= form_error('name', '<small class="text-danger text-bold">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="username">Username *</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>">
                    <?= form_error('username', '<small class="text-danger text-bold">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="password1">Password *</label>
                    <input type="password" class="form-control" id="password1" name="password1">
                    <?= form_error('password1', '<small class="text-danger text-bold">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="password2">Konfirmasi Password *</label>
                    <input type="password" class="form-control" id="password2" name="password2">
                    <?= form_error('password2', '<small class="text-danger text-bold">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea class="form-control" rows="3" id="address" name="address"><?= set_value('address'); ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="level">Level *</label>
                    <select name="level" id="level" class="form-control">
                      <option value="">- Pilih Level -</option>
                      <option value="1" <?= set_value('level') == 1 ? "selected" : null; ?>>Admin</option>
                      <option value="2" <?= set_value('level') == 2 ? "selected" : null; ?>>Kasir</option>
                    </select>
                    <?= form_error('level', '<small class="text-danger text-bold">', '</small>'); ?>
                  </div>
                  <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-md mr-3">Save</button>
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