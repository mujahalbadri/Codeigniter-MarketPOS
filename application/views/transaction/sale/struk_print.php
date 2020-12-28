<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Print - Market POS</title>
    <!-- Icon -->
    <link rel="shortcut icon" href="<?= base_url('assets'); ?>/dist/img/icon/favicon.ico" />
    <style>
        div {
            width: 500px;
        }

        .center {
            text-align: center;
        }

        table.produk {
            table-layout: auto;
            width: 500px;
            text-align: center;
        }
        table.total {
            width: 30%;
            margin-right: 0px;
            margin-left: auto;
        }
    </style>
</head>
<body>
    <div>
        <h3 class="center">Market POS</h3>
        <p class="center">Jl. Kemang Timur No.21</p>
        <hr>
        <?php foreach($sale as $s => $data ) { ?>
        <table>
            <tr>
                <td>Nama Kasir</td>
                <td>:</td>
                <td><?= $data->user_name; ?></td>
            </tr>
            <tr>
                <td>Invoice</td>
                <td>:</td>
                <td><?= $data->invoice; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><?= $data->sale_created; ?></td>
            </tr>
            <tr>
                <td>Customer</td>
                <td>:</td>
                <?php if($data->customer_name == '') { ?>
                <td>-</td>
                <?php } else { ?>
                <td><?= $data->customer_name; ?></td>
                <?php } ?>
            </tr>
        </table>
        <hr>
        <?php } ?>
        
        <table class="produk">
            <tr>
                <th>Nama Item</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Diskon</th>
                <th>Total</th>
            </tr>
            <?php foreach($sale_detail as $sd => $data) { ?>
            <tr>
                <td><?= $data->name; ?></td>
                <td><?= indo_currency($data->price); ?></td>
                <td><?= $data->qty; ?></td>
                <td><?= $data->discount; ?> %</td>
                <td><?= indo_currency($data->total); ?></td>
            </tr>
            <?php } ?>
        </table>
       
        <?php foreach($sale as $s => $data ) { ?>
        <hr>
        <table class="total">
            <tr>
                <td>Sub Total</td>
                <td><?= indo_currency($data->total_price); ?></td>
            </tr>
            <tr>
                <td>Discount</td>
                <td><?= $data->discount; ?> %</td>
            </tr>
            <tr>
                <td>Total</td>
                <td><?= indo_currency($data->final_price) ?></td>
            </tr>
            <tr>
                <td>Cash</td>
                <td><?= indo_currency($data->cash) ?></td>
            </tr>
            <tr>
                <td>Kembali</td>
                <td><?= indo_currency($data->remaining) ?></td>
            </tr>
        </table>
        <hr>
        <p class="center">Terima Kasih</p>
        <p class="center">Market POS</p>
        <?php } ?>
    </div>
</body>

<script>
    window.print()
</script>
</html>