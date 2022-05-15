<?= $this->extend('layouts/app-layout') ?>


<?= $this->section('style') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title ?></h1>
        <?= $this->include('layouts/alert-section') ?>


        <div class="row mb-3">
            <div class="col">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-roll">
                    <i class="fa-solid fa-square-plus"></i>
                    <b>
                        Tambah Roll Kain
                    </b>
                </button>
                <a type="button" class="btn btn-primary" href="<?= route_to('rolltransaction.edit') ?>">
                    <i class="fa-solid fa-square-plus"></i>
                    <b>
                        Tambah Stok Kain
                    </b>
                </a>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        <b>
                            Tabel Data Roll
                        </b>
                    </div>
                    <div class="card-body" style="overflow-x: auto;">
                        <div class="col-xl-12 col-md-12 mt-3">
                            <div class="table-responsive">
                                <table class="table table-bordered cell-border" id="table-roll">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Roll</th>
                                            <th scope="col">Code Roll</th>
                                            <th scope="col">Barcode Code</th>
                                            <th scope="col">Harga Dasar</th>
                                            <th scope="col">Harga Jual</th>
                                            <th scope="col">Jumlah Roll</th>
                                            <th scope="col">Total Kuantitas</th>
                                            <th scope="col">Roll Terjual</th>
                                            <th scope="col">Total Terjual</th>
                                            <th scope="col">Total Modal</th>
                                            <th scope="col">Total Profit</th>
                                            <th scope="col">Barcode</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($dataRolls as $key => $roll) {
                                            $keyFinance = array_search($roll["roll_id"], array_column($dataFinances, 'roll_id'));
                                            $quantitySold = 0;
                                            $quantityTotal = 0;
                                            $capital = 0;
                                            $profit = 0;
                                            $isDeleteable = true;
                                            if ($keyFinance !== false) {
                                                $quantitySold = $dataFinances[$keyFinance]["quantity_sold"];
                                                $quantityTotal = $dataFinances[$keyFinance]["quantity_total"];
                                                $capital = $dataFinances[$keyFinance]["capital"];
                                                $profit = $dataFinances[$keyFinance]["profit"];
                                                $isDeleteable = false;
                                            }
                                        ?>
                                            <tr>
                                                <th scope="row"><?= $key + 1 ?></th>
                                                <td><?= $roll['roll_name'] ?></td>
                                                <td><?= $roll['roll_code'] ?></td>
                                                <td><?= $roll['barcode_code'] ?></td>
                                                <td><?= intToRupiah($roll['basic_price']) ?></td>
                                                <td><?= intToRupiah($roll['selling_price']) ?></td>
                                                <td><?= $roll['roll_quantity'] ?></td>
                                                <td><?= $roll['all_quantity'] . " " . $roll["unit_name"] ?></td>
                                                <td><?= $quantitySold ?></td>
                                                <td><?= $quantityTotal . " " . $roll["unit_name"] ?></td>
                                                <td><?= intToRupiah($capital) ?></td>
                                                <td><?= intToRupiah($profit) ?></td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success openModalBarcode mt-4" data-roll-code="<?= $roll["roll_code"] ?>" data-bs-toggle="modal" data-bs-target="#openBarcode" data-roll-name="<?= $roll['roll_name'] ?>" data-roll-barcode="<?= $roll["barcode_image"] ?>">
                                                        <i class="fas fa-barcode"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal edit -->
                                                    <button type="button" class="btn btn-success btn-edit mt-4" data-roll-code="<?= $roll["roll_code"] ?>" data-roll-name="<?= $roll["roll_name"] ?>" data-basic-price="<?= $roll["basic_price"] ?>" data-selling-price="<?= $roll["selling_price"] ?>" data-unit-quantity="<?= $roll["unit_quantity"] ?>" data-roll-id="<?= $roll["roll_id"] ?>" data-unit-code="<?= $roll["unit_code"] ?>" data-unit-id="<?= $roll["unit_id"] ?>" data-bs-target="#modal-edit-roll" data-bs-toggle="modal">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>

                                                    <?php if ($isDeleteable) { ?>
                                                        <button type="button" class="btn btn-danger btn-delete mt-4" data-roll-id="<?= $roll["roll_id"] ?>" data-roll-code="<?= $roll["roll_code"] ?>" data-roll-name="<?= $roll["roll_name"] ?>">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>




<!-- Modal Barcode -->
<div class="modal fade" id="openBarcode" tabindex="-1" aria-labelledby="openBarcodeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="openBarcodeLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="image-barcode" src="">
                <br>
                <hr>
                <div class="mb-3">
                    <label for="quantity-print-barcode" class="form-label">Jumlah Print</label>
                    <input type="number" min="1" class="form-control" id="quantity-print-barcode" placeholder="Masukkan jumlah barcode yang akan di print !">
                </div>
                <p id="barcode"></p>
                <a id="download-link" class="btn btn-success" download="" href="">Download</a>
                <a id="print-link" href="" class="btn btn-primary" target="_blank" rel="noopener noreferrer" onclick="window.open(this.href).print(); return false">Print Barcode</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Roll Kain -->
<div class="modal fade" id="modal-add-roll" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Rolls Kain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST" action="<?= route_to("roll.store") ?>">
                    <div class="col-md-4">
                        <label for="roll_name" class="form-label">Nama Roll</label>
                        <input type="text" class="form-control" id="roll_name" name="roll_name">
                    </div>
                    <div class="col-md-4">
                        <label for="unit_id" class="form-label">Satuan</label>
                        <select id="unit_id" name="unit_id" class="form-select">
                            <option selected disabled>Pilih satuan terlebih dahulu</option>
                            <?php foreach ($dataUnits as $key => $unit) {
                            ?>
                                <option value="<?= $unit["unit_id"] ?>"><?= $unit["unit_name"] . "|" . $unit["unit_code"] ?></option>
                            <?php
                            } ?>

                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="roll_code" class="form-label">Kode Roll</label>
                        <input type="text" class="form-control" id="roll_code" name="roll_code" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="roll_quantity" class="form-label">Jumlah Roll</label>
                        <input type="number" min="0" class="form-control" id="roll_quantity" name="roll_quantity" placeholder="Masukkan total roll">
                    </div>
                    <div class="col-md-6">
                        <label for="all_quantity" class="form-label">Total kuantitas</label>
                        <div class="input-group mb-3">
                            <input type="number" min="0" id="all_quantity" name="all_quantity" class="form-control" placeholder="Masukkan total kuantias">
                            <span class="input-group-text" id="unit_sufix"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3 col-md-6 col-xl-6">
                        <span class="input-group-text" id="basic-addon1">Harga Dasar Rp. </span>
                        <input type="number" min="0" class="form-control" placeholder="Masukkan harga dasar (modal)" name="basic_price">
                    </div>
                    <div class="input-group mb-3 col-md-6 col-xl-6">
                        <span class="input-group-text" id="basic-addon1">Harga Jual Rp. </span>
                        <input type="number" min="0" class="form-control" placeholder="Masukkan harga jual" name="selling_price">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Roll Kain -->
<div class="modal fade" id="modal-edit-roll" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Rolls Kain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST" action="<?= route_to("roll.update") ?>">
                    <input type="hidden" name="roll_id" id="roll_id_edit">

                    <div class="col-md-4">
                        <label for="roll_name_edit" class="form-label">Nama Rolls</label>
                        <input type="text" class="form-control" id="roll_name_edit" name="roll_name">
                    </div>
                    <div class="col-md-4">
                        <label for="unit_id_edit" class="form-label">Satuan</label>
                        <select id="unit_id_edit" name="unit_id" class="form-select">
                            <option selected disabled>Pilih satuan terlebih dahulu</option>
                            <?php foreach ($dataUnits as $key => $unit) { ?>
                                <option value="<?= $unit["unit_id"] ?>"><?= $unit["unit_name"] . "|" . $unit["unit_code"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="roll_code_edit" class="form-label">Kode Roll</label>
                        <input type="text" class="form-control" id="roll_code_edit" name="roll_code" readonly>
                    </div>
                    <div class="input-group mt-4 mb-3 col-md-6 col-xl-6">
                        <span class="input-group-text" id="basic-addon1">Rp. </span>
                        <input type="number" min="0" class="form-control" placeholder="Masukkan harga dasar (modal)" name="basic_price" id="basic_price_edit">
                    </div>
                    <div class="input-group mb-3 col-md-6 col-xl-6">
                        <span class="input-group-text" id="basic-addon1">Rp. </span>
                        <input type="number" min="0" class="form-control" placeholder="Masukkan harga jual" name="selling_price" id="selling_price_edit">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete Roll Kain -->
<div class="modal fade" id="modal-delete-roll" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Rolls Kain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST" action="<?= route_to("roll.destroy") ?>">
                    <input type="hidden" name="roll_id" id="roll_id_delete">
                    <input type="hidden" name="roll_code" id="roll_code_delete">
                    <input type="hidden" name="roll_name" id="roll_name_delete">
                    <p>Apakah anda yakin ingin menghapus data roll ini ? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Konfirmasi</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>



<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="/js/general-helper.js"></script>
<script>
    $(document).ready(function() {
        $("#table-roll").DataTable();


        $("#quantity-print-barcode").on("change", function() {
            const quantity = $(this).val();
            const split = $("#print-link").attr("href").split("/");
            let newUrl = split.slice(0, split.length - 1).join("/") + "/";
            newUrl = newUrl + quantity;
            $("#print-link").attr("href", newUrl);
        });

        $("#table-roll").on("click", ".openModalBarcode", function() {
            const rollCode = $(this).data("roll-code").trim();
            const rollName = $(this).data("roll-name").trim();
            const dataBarcode = $(this).data("roll-barcode");
            const barcodeName = dataBarcode.split("/")[1];

            $("#image-barcode").attr("src", "/" + dataBarcode);
            $("#openBarcodeLabel").text(rollCode);
            $("#download-link").attr("href", "/" + dataBarcode);
            $("#print-link").attr("href", `roll/barcode/print/${barcodeName}/${rollCode}/${rollName}/1`);
        });

        $("#table-roll").on("click", ".btn-edit", function() {
            const btn = $(this);
            const rollId = btn.data("roll-id");
            const rollName = btn.data("roll-name");
            const rollCode = btn.data("roll-code");
            const basicPrice = btn.data("basic-price");
            const sellingPrice = btn.data("selling-price");
            const unitQuantity = btn.data("unit-quantity");
            const unitId = btn.data("unit-id");
            $("#roll_id_edit").val(rollId);
            $("#roll_name_edit").val(rollName);
            $("#roll_code_edit").val(rollCode);
            $("#basic_price_edit").val(basicPrice);
            $("#selling_price_edit").val(sellingPrice);
            $("#unit_quantity_edit").val(unitQuantity);
            $("#unit_id_edit").val(unitId).change();

            $("#roll_name_edit").on("keyup", function() {
                const unitCode = $("#unit_id_edit").find("option:selected").text().split("|")[1];
                const rollName = replaceCons($(this).val());
                $("#roll_code_edit").val(`${rollName}-${unitCode}`);
            });

            $("#unit_id_edit").on("change", function() {
                const unitCode = $(this).find("option:selected").text().split("|")[1];
                const rollName = replaceCons($("#roll_name_edit").val());
                $("#roll_code_edit").val(`${rollName}-${unitCode}`);
            })
        });

        $("#table-roll").on("click", ".btn-delete", function() {
            const btn = $(this);
            const modal = $("#modal-delete-roll");
            const rollId = btn.data("roll-id");
            const rollCode = btn.data("roll-code");
            const rollName = btn.data("roll-name");

            modal.find("#roll_id_delete").val(rollId);
            modal.find("#roll_code_delete").val(rollCode);
            modal.find("#roll_name_delete").val(rollName);
            modal.modal("show");
        });

        $("#modal-add-roll").on("shown.bs.modal", function() {
            $("#unit_id").on("change", function() {
                const unitName = $(this).find("option:selected").text().split("|")[0];
                const unitCode = $(this).find("option:selected").text().split("|")[1];
                $("#unit_sufix").empty();
                $("#unit_sufix").append(unitName);

                const rollName = replaceCons($("#roll_name").val());
                $("#roll_code").val(`${rollName}-${unitCode}`);
            })


            $("#roll_name").on("keyup", function() {
                let unitCode = $("#unit_id").find("option:selected").text().split("|")[1];
                if (typeof unitCode == "undefined") {
                    unitCode = "-";
                }
                const rollName = replaceCons($(this).val());
                $("#roll_code").val(`${rollName}-${unitCode}`);
            });
        });
    });
</script>
<?= $this->endSection() ?>