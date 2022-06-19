<?= $this->extend('layouts/app-layout') ?>


<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title ?></h1>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Log Activity</li>
            </ol>
        </nav>


        <div class="row mt-4">
            <div class="col-xl-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-clock-rotate-left"></i>
                        <b>
                            Tabel Log Aktifitas
                        </b>
                    </div>
                    <div class="card-body" style="overflow-x: auto;">
                        <div class="table-responsive">
                            <table class="table table-bordered cell-border" id="table-log">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Log</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Log Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($dataLog as $key => $item) {
                                    ?>
                                        <tr class="table-<?= $item["log_tr_collor"] ?>">
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $item["log_name"] ?></td>
                                            <td><?= $item["log_description"] ?></td>
                                            <td><?= $item["fullname"] ?></td>
                                            <td><?= $item["log_date"] ?></td>
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
</main>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $("#table-log").DataTable();
    });
</script>
<?= $this->endSection() ?>