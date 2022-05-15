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
            font-size: 9pt;
            border-collapse: collapse;
            margin-top: 10px;
        }


        td {
            vertical-align: top;
        }

        .items td {
            border-left: 0.1mm solid #000000;
            border-right: 0.1mm solid #000000;
        }


        table thead td {
            background-color: #c4c4c4;
            text-align: center;
            border: 0.1mm solid #000000;
            /* font-variant: small-caps; */
        }

        table tbody td {
            text-align: center;
            border: 0.1mm solid #000000;
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
                    <span style="font-weight: bold; font-size: 10pt;">RZ TEXTILE.</span><br />
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



    <table class="items" width="100%" cellpadding="8">
        <thead>
            <tr>
                <td width="5%">No</td>
                <td width="15%">Nama Barang</td>
                <td width="10%">Jumlah Roll</td>
                <td width="10%">Kuantitas Per Roll</td>
                <td width="10%">Sub Total Kuantitas</td>
                <td width="10%">Harga Jual</td>
                <td width="10%">Sub Total</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $totalPayment = 0;
            $totalSellingPrice = 0;
            $totalRoll = 0;
            $unit_array = [];

            foreach ($dataTransaction as $item) {
                $totalPayment += $item["sub_total"];
                $sellingPrice = $item["sub_total"] / $item["transaction_quantity_total"];
                $totalSellingPrice += $sellingPrice;
                $totalRoll += $item["transaction_quantity"];
                if (!isset($unit_array[$item["unit_name"]])) {
                    $unit_array[$item["unit_name"]]["sub_total"] = 0;
                    $unit_array[$item["unit_name"]]["total"] = 0;
                }
                $unit_array[$item["unit_name"]]["sub_total"] += $item["transaction_quantity_total"] / $item["transaction_quantity"];
                $unit_array[$item["unit_name"]]["total"] += $item["transaction_quantity_total"];
            ?>
                <tr style=" border-bottom: 0.1mm solid #000000;">
                    <td align="center"><?= $i ?></td>
                    <td align="left"><?= $item["roll_name"] ?></td>
                    <td><?= $item["transaction_quantity"] ?></td>
                    <td><?= $item["transaction_quantity_total"] / $item["transaction_quantity"] . " " . $item["unit_name"] ?></td>
                    <td><?= $item["transaction_quantity_total"] . " " . $item["unit_name"] ?></td>
                    <td class="cost"><?= intToRupiah($sellingPrice) ?></td>
                    <td class="cost"><?= intToRupiah($item["sub_total"]) ?></td>
                </tr>
            <?php
                $i++;
            } ?>

            <tr style="background-color:#c4c4c4;">
                <td colspan="2" align="center">Total</td>
                <td><?= $totalRoll ?></td>
                <td>
                    <?php
                    foreach ($unit_array as $key => $value) {
                        echo  $value["sub_total"] . " " . $key . "<br>";;
                    } ?>
                </td>
                <td>
                    <?php
                    foreach ($unit_array as $key => $value) {
                        echo $value["total"] . " " . $key . "<br>";
                    } ?>
                </td>

                <td><?= intToRupiah($totalSellingPrice) ?></td>
                <td><?= intToRupiah($totalPayment) ?></td>
            </tr>
        </tbody>
    </table>

    <br>
    <hr>
    <table width="100%">
        <tr>
            <td width="50%">Terimakasih Sudah Berbelanja.<br />Semoga Berkah <br /><br />Penerima, <br><br>(_____________)<br /></td>
            <td width="50%" style="text-align: right;">Total : <?= intToRupiah($totalPayment) ?><br /><span> <br><br>Hormat Kami </span><br><br>(_____________)</td>
        </tr>
    </table>

    <!-- <div style="text-align: center; font-style: italic;">Payment terms: payment due in 30 days</div> -->
</body>

</html>