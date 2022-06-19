<?= $this->extend('layouts/app-layout') ?>


<?= $this->section('style') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title ?></h1>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a href="#">Home</a></li>
                <li class="breadcrumb-item "><a href="#">Data Barang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search</li>
            </ol>
        </nav>

        <div class="row mb-4">
            <div class="col-xl-12 col-md-12">
                <div class="card" id="card-search">
                    <div class="card-header">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <b>
                            Cari Category Model
                        </b>
                    </div>
                    <div class="card-body">
                        <div class="row gx-3 gy-2 align-items-center mb-4">
                            <div class="col-sm-4 col-md-4 col-xl-4 col-xxl-4" id="select-roll-group">
                                <select id="select-roll">
                                    <?php foreach ($dataRolls as $key => $roll) { ?>
                                        <option value="<?= $roll["roll_id"] ?>">
                                            <?= $roll["roll_name"] . " (" . $roll["all_quantity"] . " " . $roll["unit_name"] . ")" . " | " . $roll["barcode_code"] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-xl-12 col-md-12">
                <div class="card" id="card-data">
                    <div class="card-header">
                        <i class="fa-solid fa-table-list"></i>
                        <b>
                            Data Category Model
                        </b>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Data</th>
                                    <th scope="col">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Kode Roll</td>
                                    <td id="roll_code">-</td>
                                </tr>
                                <tr>
                                    <td>Nama Roll</td>
                                    <td id="roll_name">-</td>
                                </tr>
                                <tr>
                                    <td>Harga Modal</td>
                                    <td id="basic_price">-</td>
                                </tr>
                                <tr>
                                    <td>Harga Jual</td>
                                    <td id="selling_price">-</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Roll</td>
                                    <td id="roll_quantity">-</td>
                                </tr>
                                <tr>
                                    <td>Total Kuantitas</td>
                                    <td id="all_quantity">-</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="container-table-model">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>



<?= $this->section('script') ?>
<!-- selectize -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        function onChangeRoll(context) {
            let rollId = $(context).val();
            $.ajax({
                url: "/api/rolls/" + rollId,
                context: document.body,
            }).done(function(result) {
                $("#roll_code").text(result[0].roll_code);
                $("#roll_name").text(result[0].roll_name);
                $("#basic_price").text("Rp " + result[0].basic_price);
                $("#selling_price").text("Rp " + result[0].selling_price);
                $("#roll_quantity").text(result[0].roll_quantity);
                $("#all_quantity").text(
                    `${result[0].all_quantity} ${result[0].unit_name}`
                );
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Data yang dicari ditemukan!",
                    showConfirmButton: false,
                    timer: 500,
                });
            });
        }

        $("#select-roll").on("change", function() {
            onChangeRoll(this);
        });

        let selectized = $("#select-roll-group select").selectize({
            openOnFocus: false,
        });
        selectized[0].selectize.focus();
        selectized[0].selectize.on("focus", function() {
            $("#select-roll").unbind("change");
            selectized[0].selectize.clear();
            selectized[0].selectize.focus();
            $("#select-roll").bind("change", function() {
                onChangeRoll(this);
            });
        });

        $("#select-roll-group input").blur(function() {
            selectized[0].selectize.focus();
        });
    });
</script>
<?= $this->endSection() ?>