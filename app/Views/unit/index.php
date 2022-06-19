<?= $this->extend('layouts/app-layout') ?>


<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title ?></h1>
        <?= $this->include('layouts/alert-section') ?>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a href="#">Home</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="#">Data Barang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Unit</li>
            </ol>
        </nav>


        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddUnit">
            <i class="fa-solid fa-square-plus"></i> <b> Tambah Unit </b>
        </button>

        <div class="row mt-4">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-balance-scale"></i>
                        <b>
                            Data Satuan
                        </b>
                    </div>
                    <div class="card-body" style="overflow-x: auto;">
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered cell-border" id="table-unit">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Satuan</th>
                                                <th scope="col">Kode Satuan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($units as $key => $unit) { ?>
                                                <tr>
                                                    <th scope="row"><?= $key + 1 ?></th>
                                                    <td><?= $unit["unit_name"] ?></td>
                                                    <td><?= $unit["unit_code"] ?></td>
                                                    <td>
                                                        <button data-unit-id="<?= $unit["unit_id"] ?>" data-unit-name="<?= $unit["unit_name"] ?>" data-unit-code="<?= $unit["unit_code"] ?>" type="button" class="btn btn-success btn-edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->include('unit/modal-index') ?>
<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $("#table-unit").DataTable();

        $("#table-unit").on("click", ".btn-edit", function() {
            $("#modal-edit").modal("show");
            const btn = $(this);
            const unitId = btn.data("unit-id");
            const unitName = btn.data("unit-name");
            const unitCode = btn.data("unit-code");

            $("#unit-id-edit").val(unitId);
            $("#unit-name-edit").val(unitName);
            $("#unit-code-edit").val(unitCode);
        })
    });
</script>
<?= $this->endSection() ?>