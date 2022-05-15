<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

        p {
            margin: 0pt;
        }

        table.items {
            border: 0.1mm solid #000000;
        }


        td {
            vertical-align: top;
        }

        .items td {
            border-left: 0.1mm solid #000000;
            border-right: 0.1mm solid #000000;
        }



        table thead td {
            background-color: #EEEEEE;
            text-align: center;
            border: 0.1mm solid #000000;
            font-variant: small-caps;
        }

        tr {
            border-bottom: 1pt solid black;
        }
    </style>
</head>

<body>
    <htmlpageheader name="myheader">
        <table width="100%">
            <tr>
                <td width="65%">
                    <span style="font-weight: bold; font-size: 14pt;">RZ TEXTILE.</span><br />
                    Jalan Raya Selatan Banjaran (Depan Toserba Rasa)<br />
                    No Nota : <?= $dataInvoice[0]["invoice_code"] ?><br />
                    Sales : <?= $dataInvoice[0]["fullname"] ?><br />
                </td>
                <td style="text-align: left;">
                    Tanggal : <br />
                    <span>Kepada Yth. </span>
                </td>
                <td>
                    <?php
                    $dateInvoice = $dataInvoice[0]["date_invoice"];
                    $dateInvoice = explode(" ", $dateInvoice);
                    $dateInvoice = $dateInvoice[0];

                    echo $dateInvoice;

                    ?><br />
                    <?= $dataInvoice[0]["customer_name"] ?>
                </td>
            </tr>
        </table>
    </htmlpageheader>
    <htmlpagefooter name="myfooter">
        <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
        </div>
    </htmlpagefooter>
    <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
    <sethtmlpagefooter name="myfooter" value="on" />



    <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
        <thead>
            <tr>
                <td width="10%">No</td>
                <td width="15%">Nama Barang</td>
                <td width="10%">Jumlah Roll</td>
                <td width="10%">Kuantitas Per Roll</td>
                <td width="10%">Sub Total Kuantitas</td>
                <td width="10%">Harga</td>
                <td width="10%">Jumlah</td>
            </tr>
        </thead>
        <tbody>
            <!-- ITEMS HERE -->
            <?php
            $i = 1;
            $totalPrice = 0;
            $totalRoll = 0;
            $unit_array = [];
            $unit_array2 = [];
            $totalSellingPrice = 0;

            foreach ($dataTransaction as $item) {
                $totalPrice += $item["sub_total"];
                $selling_price = $item["sub_total"] / $item["transaction_quantity_total"];
                $totalSellingPrice += $selling_price;
                $totalRoll += $item["transaction_quantity"];
                if (!isset($unit_array[$item["unit_name"]])) {
                    $unit_array[$item["unit_name"]] = 0;
                    $unit_array2[$item["unit_name"]] = 0;
                }
                $unit_array[$item["unit_name"]] += $item["transaction_quantity_total"];
                $unit_array2[$item["unit_name"]] += $item["transaction_quantity_total"] / $item["transaction_quantity"];;
            ?>
                <tr style=" border-bottom: 0.1mm solid #000000;">
                    <td align="center"><?= $i ?></td>
                    <td align="left"><?= $item["roll_name"] ?></td>
                    <td><?= $item["transaction_quantity"] ?></td>
                    <td><?= $item["transaction_quantity_total"] / $item["transaction_quantity"] . " " . $item["unit_name"] ?></td>
                    <td><?= $item["transaction_quantity_total"] . " " . $item["unit_name"] ?></td>
                    <td class="cost"><?= intToRupiah($selling_price) ?></td>
                    <td class="cost"><?= intToRupiah($item["sub_total"]) ?></td>
                </tr>
            <?php
                $i++;
            } ?>

            <tr>
                <td colspan="2" align="center">Total</td>
                <td><?= $totalRoll ?></td>
                <td><?php
                    $i = 0;
                    foreach ($unit_array2 as $key => $value) {
                        $i++;
                        if ($i == 1) {
                            echo $value . " " . $key;
                        }
                    } ?></td>
                <td><?php
                    $i = 0;
                    foreach ($unit_array as $key => $value) {
                        $i++;
                        if ($i == 1) {
                            echo $value . " " . $key;
                        }
                    } ?></td>
                <td><?= intToRupiah($totalSellingPrice) ?></td>
                <td><?= intToRupiah($totalPrice) ?></td>
            </tr>

        </tbody>
    </table>

    <br>
    <hr>
    <table width="100%">
        <tr>
            <td width="50%">Terimakasih Sudah Berbelanja.<br />Semoga Berkah <br /><br />Penerima, <br><br>(_____________)<br /></td>
            <td width="50%" style="text-align: right;">Total : <?= intToRupiah($totalPrice) ?><br /><span> <br><br>Hormat Kami </span><br><br>(_____________)</td>
        </tr>
    </table>

    <!-- <div style="text-align: center; font-style: italic;">Payment terms: payment due in 30 days</div> -->
</body>

</html>