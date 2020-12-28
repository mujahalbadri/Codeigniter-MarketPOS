<?php 
if ( $cart ) {
$no = 1;
foreach( $cart as $c => $data) { ?>
<tr>
	<td class="text-center"><?= $no++; ?></td>
	<td class="text-center"><?= $data->barcode; ?></td>
	<td class="text-center"><?= $data->item_name; ?></td>
	<td class="text-center"><?= $data->cart_price; ?></td>
	<td class="text-center"><?= $data->qty; ?></td>
	<td class="text-center"><?= $data->discount; ?> %</td>
	<td class="text-center" id="total"><?= $data->total; ?></td>
	<td>
	<div class="d-flex flex-column flex-sm-row justify-content-center">
		<a 
				href=""
				data-cart_id="<?= $data->cart_id ?>"
				data-barcode="<?= $data->barcode ?>"
				data-item_name="<?= $data->item_name ?>"
				data-price="<?= $data->cart_price ?>"
				data-qty="<?= $data->qty ?>"
				data-discount="<?= $data->discount ?>"
				data-toggle="modal" data-target="#edit-data">
				<button  data-toggle="modal" data-target="#ubah-data" class="btn btn-success mr-1 mb-1">
				<i class="fas fa-edit mr-1"></i>Edit</button>
		</a>
		<button id="del_cart" data-cartid="<?= $data->cart_id; ?>" class="btn btn-danger mr-1 mb-1">
			<i class="fas fa-trash-alt mr-1"></i>Delete
		</button>
	</div>
	</td>
</tr>
<?php	} 
 } else { ?>
	<tr>
		<td colspan="8" class="text-center">Data Tidak ada</td>
	</tr>
<?php } ?>