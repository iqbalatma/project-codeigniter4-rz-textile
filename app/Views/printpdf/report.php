<html>

<head>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
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
            background-color: #76b5c5;
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


    <p style="font-size: 15pt; text-align: center;">RZ TEXTILE</p>
    <p style="font-size: 12pt; text-align: center;">Laporan Penjualan</p>
    <p style="font-size: 12pt; text-align: center;">
        <?php
        $lowerLimit = explode("/", $lowerLimit);
        $newLowerLimit = $lowerLimit[1] . "/" . $lowerLimit[0] . "/" . $lowerLimit[2];


        $upperLimit = explode("/", $upperLimit);
        $newUpperLimit = $upperLimit[1] . "/" . $upperLimit[0] . "/" . $upperLimit[2];
        ?>
        <?= $newLowerLimit ?> - <?= $newUpperLimit ?></p>

    <hr>
    <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; margin-top: 10px; " cellpadding="8">
        <thead>
            <tr>
                <td width="3%">No</td>
                <td width="5%">Invoice Code</td>
                <td width="10%">Roll Name</td>
                <td width="3%">Kuantitas Roll</td>
                <td width="9%">Kuantitas Isi</td>
                <td width="10%">Harga Beli</td>
                <td width="10%">Harga Jual</td>
                <td width="25%">Keuntungan</td>
                <td width="25%">Tanggal Invoice</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalCapital = 0;
            $totalPayment = 0;
            $totalProfit = 0;
            foreach ($dataInvoices as $key => $value) {
                $filterBy = $value["invoice_id"];

                $childData = array_filter($dataTransactions, function ($var) use ($filterBy) {
                    return ($var['invoice_id'] == $filterBy);
                });
                $childLength = count($childData) + 1;
                $totalCapital += $value["total_capital"];
                $totalPayment += $value["total_payment"];
                $totalProfit += $value["total_profit"];
            ?>
                <tr>
                    <td rowspan="<?= $childLength + 1 ?>"><?= $key + 1 ?></td>
                    <td rowspan="<?= $childLength + 1 ?>"><?= $value["invoice_code"] ?></td>
                </tr>
                <?php foreach ($childData as $keyTransaction => $valueTransaction) {
                ?>
                    <tr>
                        <td><?= $valueTransaction["roll_name"] ?></td>
                        <td><?= $valueTransaction["transaction_quantity"] ?></td>
                        <td><?= $valueTransaction["transaction_quantity_total"] . " " . $valueTransaction["unit_name"] ?></td>
                        <td><?= intToRupiah($valueTransaction["sub_capital"]) ?></td>
                        <td><?= intToRupiah($valueTransaction["sub_total"]) ?></td>
                        <?php
                        if ($keyTransaction === array_key_first($childData)) {
                        ?>
                            <td rowspan="<?= $childLength ?>"><?= intToRupiah($value["total_profit"]) ?></td>
                            <td rowspan="<?= $childLength  ?>"><?= $value["date_invoice"] ?></td>
                        <?php
                        } ?>

                    </tr>
                <?php
                } ?>

                <tr>
                    <td colspan="3">Sub Total</td>
                    <td><?= intToRupiah($value["total_capital"]) ?></td>
                    <td><?= intToRupiah($value["total_payment"]) ?></td>

                </tr>
            <?php
            }
            ?>
            <tr class="summary-row" style=" background-color: #76b5c5;">
                <td colspan="5">
                    <b>
                        Total
                    </b>
                </td>
                <td>
                    <b>
                        <?= intToRupiah($totalCapital) ?>
                    </b>
                </td>
                <td>
                    <b>
                        <?= intToRupiah($totalPayment) ?>
                    </b>
                </td>
                <td>
                    <b>
                        <?= intToRupiah($totalProfit) ?>
                    </b>
                </td>
            </tr>
        </tbody>
    </table>

    <?php
    $dataMonth = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];
    ?>
    <div style="
    margin-top:80px;
    right: 150;
    position: absolute;
    padding: 5px;
   ">
        Bandung, <?= date("d") . " " . $dataMonth[intval(date("m")) - 1] . " " . date("Y") ?>
    </div>
    <div style="
    margin-top:200px;
    right: 150;
    position: absolute;
    padding: 5px;
   ">
        Nama Pimpinan
    </div>
</body>

</html>