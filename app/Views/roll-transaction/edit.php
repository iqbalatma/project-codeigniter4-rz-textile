<?= $this->extend('layouts/app-layout') ?>


<?= $this->section('style') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title ?></h1>
        <?= $this->include('layouts/alert-section') ?>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a href="#">Home</a></li>
                <li class="breadcrumb-item "><a href="#">Data Barang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Restok Roll</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-truck-loading"></i>
                        <b>
                            Restok Barang
                        </b>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" action="<?= route_to("rolltransaction.store") ?>" method="POST">
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">Roll</label>
                                <select class="" id="roll_id" name="roll_id">
                                    <?php foreach ($dataRolls as $key => $roll) { ?>
                                        <option data-data='{"basicPrice": "<?= $roll["basic_price"] ?>" ,"sellingPrice": "<?= $roll["selling_price"] ?>", "unitQuantity" : "<?= $roll["unit_quantity"] ?>","unitName" : "<?= $roll["unit_name"] ?>" }' value="<?= $roll["roll_id"] ?>">
                                            <?= $roll["roll_name"] . " (" . $roll["all_quantity"] . " " . $roll["unit_name"] . ")" . " | " . $roll["barcode_code"] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="basic_price" class="form-label">Harga Dasar</label>
                                <input type="text" class="form-control" id="basic_price" name="basic_price" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="selling_price" class="form-label">Harga Jual</label>
                                <input type="text" class="form-control" id="selling_price" name="selling_price" disabled>
                            </div>

                            <div class="col-md-6">
                                <label for="roll_quantity" class="form-label">Jumlah Roll</label>
                                <input type="number" class="form-control" id="roll_quantity" name="roll_quantity" min="1" required>
                            </div>
                            <div class="col-md-6">
                                <label for="all_quantity" class="form-label">Total Kuantitas</label>
                                <div class="input-group mb-3">
                                    <input type="number" min="0" id="all_quantity" name="all_quantity" class="form-control" placeholder="Masukkan total kuantias" required>
                                    <span class="input-group-text" id="unit_name"></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary" id="btn-restok">Tambahkan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

<script type="module">
    import alert from "/js/alert.js";
    $(document).ready(function() {
        function onChangeSelectize(value, isOnInitialize) {
            const basicPrice = $(`.item-roll-selectized[data-value=${value}]`).data('basic-price');
            const sellingPrice = $(`.item-roll-selectized[data-value=${value}]`).data('selling-price');
            const unitName = $(`.item-roll-selectized[data-value=${value}]`).data('unit-name');
            console.log(unitName);
            $("#basic_price").val(intToRupiah(basicPrice));
            $("#selling_price").val(intToRupiah(sellingPrice));
            $("#unit_name").text(unitName);
            $("#roll_quantity").focus();
        }
        const selectized = $("#roll_id").selectize({
            sortField: 'text',
            openOnFocus: false,
            render: {
                option: function(data, escape) {
                    return "<div class='item-roll-selectized' data-basic-price='" + escape(data.basicPrice) + "' data-selling-price='" + escape(data.sellingPrice) + "' data-unit-quantity='" + escape(data.unitQuantity) + "' data-unit-name='" + escape(data.unitName) + "'> " + escape(data.text) + "</div>"
                }
            },
            onChange: function(value, isOnInitialize) {
                onChangeSelectize(value, isOnInitialize, this);
            },
        });

        selectized[0].selectize.focus();
        selectized[0].selectize.off();
        selectized[0].selectize.clear();
        selectized[0].selectize.on("change", function(value, isOnInitialize) {
            onChangeSelectize(value, isOnInitialize);
        });


        $("#btn-restok").on("click", function(e) {
            if ($('#roll_id option:selected').prop('disabled') === true) {
                e.preventDefault();
                alert.error('Data Roll Belum Dipilih');
            }
        })
    });
</script>

<?= $this->endSection() ?>