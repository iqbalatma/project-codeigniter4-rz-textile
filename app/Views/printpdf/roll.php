<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    <div class="container-fluid">

        <?php for ($i = 0; $i < $quantity; $i++) {
        ?>
            <div class="row">
                <img src="barcode/2h2T1TQY.jpg" alt="">
            </div>
            <div class="row">
                <div class="col-6">
                    Nama Roll : <b> </b><?= $rollName ?>
                </div>
                <div class="col-6">
                    Kode Roll : <?= $rollCode ?>
                </div>
            </div>
        <?php
        } ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>