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
          <li class="breadcrumb-item active">barcode_qrcode</li>
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
						<h3 class="card-title">Barcode Generator <i class="fa fa-barcode"></i></h3>
						<div class="float-right">
							<a href="<?= site_url('item'); ?>" class="btn btn-warning text-white">
              <i class="fas fa-undo-alt mr-2"></i> Back
							</a>
						</div>
					</div>

          
          <div class="card-body">
						<div class="row">
							<div class="col-12 text-center">
								<div>
									<?php
									$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
									echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($item->barcode, $generator::TYPE_CODE_128)) . '" style="width: 200px;" >';
									?>
								</div>
								<div>
									<?= $item->barcode; ?>
								</div>
							</div>
						</div>
          </div>
        

				</div>

				<div class="card">

					<div class="card-header">
						<h3 class="card-title">QR-Code Generator <i class="fa fa-qrcode"></i></h3>
					</div>

          
          <div class="card-body">
						<div class="row">
							<div class="col-12 text-center">
								<div>
									<?php
									$qrCode = new Endroid\QrCode\QrCode($item->barcode);
									$qrCode->writeFile('./assets/dist/img/upload/qr-code/item-'.$item->barcode.'.png');
									?>
									<img src="<?= base_url('./assets/dist/img/upload/qr-code/item-'.$item->barcode.'.png'); ?>" style="width: 200px;">
								</div>
								<div>
									<?= $item->barcode; ?>
								</div>
							</div>
						</div>
          </div>
        

				</div>
			</div>
		</div>

  </div>

</section>
<!-- ./Main Content -->