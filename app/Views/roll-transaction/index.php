<?= $this->extend('layouts/app-layout') ?>


<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Transaksi Roll</h1>

        <!-- ROW1 -->
        <div class="row mt-4">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-search me-1"></i>
                        <b>
                            Filter Data Transaksi
                        </b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <label class="visually-hidden" for="month">Preference</label>
                                <select class="form-select" id="month" name="month">
                                    <option selected disabled>Pilih Bulan</option>
                                    <?php foreach (getListMonth() as $key => $value) { ?>
                                        <option value="<?= $key + 1 ?>"><?= $value ?></option>";
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-2">
                                <label class="visually-hidden" for="year">Pilih Tahun</label>
                                <select class="form-select" id="year" name="year">
                                    <option selected disabled>Pilih Tahun</option>
                                    <?php for ($i = 0; $i < 10; $i++) { ?>
                                        <option value="<?= 2021 + $i ?>"><?= 2021 + $i ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW2 -->
        <div class="row mt-4">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header"><i class="fas fa-sign-out-alt me-1"></i>
                        <b>
                            Transaksi Barang Keluar
                        </b>
                    </div>
                    <div class="card-body" style="overflow-x: auto;">
                        <div class="col-xl-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered cell-border " id="table-transout">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Invoices</th>
                                            <th scope="col">Id Transaksi</th>
                                            <th scope="col">Kode Roll</th>
                                            <th scope="col">Nama Roll</th>
                                            <th scope="col">Jenis Transaksi</th>
                                            <th scope="col">Jumlah Roll Transaksi</th>
                                            <th scope="col">Kuantitas Total Transaksi</th>
                                            <th scope="col">Sub Total</th>
                                            <th scope="col">Konsumen</th>
                                            <th scope="col">Admin</th>
                                            <th scope="col">Tanggal Transaksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($rollTransactionsOut as $key => $transaction) {

                                        ?>
                                            <tr>
                                                <td scope="row"><?= $key + 1 ?></td>
                                                <td scope="row"><?= $transaction["invoice_code"] ?></td>
                                                <td scope="row"><?= $transaction["transaction_id"] ?></td>
                                                <td scope="row"><?= $transaction["roll_code"] ?></td>
                                                <td scope="row"><?= $transaction["roll_name"] ?></td>
                                                <td scope="row"><?= $transaction["transaction_type"] == 1 ? "Keluar" : "Masuk"; ?></td>
                                                <td scope="row"><?= $transaction["transaction_quantity"] ?></td>
                                                <td scope="row"><?= $transaction["transaction_quantity_total"]  . " " . $transaction["unit_name"] ?></td>
                                                <td scope="row"><?= intToRupiah($transaction["sub_total"]) ?></td>
                                                <td scope="row"><?= $transaction["customer_name"] ?></td>
                                                <td scope="row"><?= $transaction["fullname"] ?></td>
                                                <td scope="row"><?= $transaction["transaction_date"] ?></td>
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

        <!-- ROW3 -->
        <div class="row mt-4">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header"><i class="fas fa-sign-in-alt me-1"></i>
                        <b>
                            Transaksi Barang Masuk
                        </b>
                    </div>
                    <div class="card-body" style="overflow-x: auto;">
                        <div class="col-xl-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered cell-border" id="table-transin">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Id Transaksi</th>
                                            <th scope="col">Kode Roll</th>
                                            <th scope="col">Nama Roll</th>
                                            <th scope="col">Jenis Transaksi</th>
                                            <th scope="col">Jumlah Roll Transaksi</th>
                                            <th scope="col">Kuantitas Total Transaksi</th>
                                            <th scope="col">Tanggal Transaksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($rollTransactions as $key => $transaction) {
                                        ?>
                                            <tr>
                                                <td scope="row"><?= $key + 1 ?></td>
                                                <td scope="row"><?= $transaction["transaction_id"] ?></td>
                                                <td scope="row"><?= $transaction["roll_code"] ?></td>
                                                <td scope="row"><?= $transaction["roll_name"] ?></td>
                                                <td scope="row"><?= $transaction["transaction_type"] == 1 ? "Keluar" : "Masuk"; ?></td>
                                                <td scope="row"><?= $transaction["transaction_quantity"] ?></td>
                                                <td scope="row"><?= $transaction["transaction_quantity_total"] . " " . $transaction["unit_name"] ?></td>
                                                <td scope="row"><?= $transaction["transaction_date"] ?></td>
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
</main>
<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script type="module">
    import alert from "/js/alert.js";
    $(document).ready(function() {
        const tableTransactionIn = $("#table-transin").DataTable();
        const tableTransactionOut = $("#table-transout").DataTable();

        $("#btn-filter").on("click", () => {
            let year = null;
            let month = null;

            if ($('#month option:selected').prop("disabled")) {
                return alert.error('Bulan belum dipilih. Silahkan pilih bulan terlebih dahulu !');
            } else {
                month = $("#month").val();
            }

            if ($('#year option:selected').prop("disabled")) {
                return alert.error('Tahun belum dipilih. Silahkan pilih tahun terlebih dahulu !');
            } else {
                year = $('#year').val();
            }

            tableTransactionOut.clear().draw();
            tableTransactionIn.clear().draw();

            $.ajax({
                url: "/api/roll-transactions",
                context: document.body,
                type: "GET",
                data: {
                    "month": month,
                    "year": year
                }
            }).done((result) => {
                const {
                    rollTransactionsOut: transOut,
                    rollTransactions: transIn
                } = result;
                if (result.rollTransactionsOut.length == 0) {
                    alert.error('Data transaksi keluar tidak ditemukan !');
                } else {
                    transOut.forEach((element, index) => {
                        tableTransactionOut.row.add([
                            index + 1,
                            element.invoice_code,
                            element.transaction_id,
                            element.roll_code,
                            element.roll_name,
                            element.transaction_type == 0 ? "Masuk" : "Keluar",
                            element.transaction_quantity,
                            element.transaction_quantity_total + " " + element.unit_name,
                            intToRupiah(element.sub_total),
                            element.customer_name,
                            element.fullname,
                            element.transaction_date
                        ]).draw();
                    });

                }



                if (result.rollTransactions.length == 0) {
                    alert.error('Data transaksi masuk tidak ditemukan !');
                } else {
                    transIn.forEach((element, index) => {
                        tableTransactionIn.row.add([
                            index + 1,
                            element.transaction_id,
                            element.roll_code,
                            element.roll_name,
                            element.transaction_type == 0 ? "Masuk" : "Keluar",
                            element.transaction_quantity,
                            element.transaction_quantity_total + " " + element.unit_name,
                            element.transaction_date,
                        ]).draw();
                    });
                }

                if (result.rollTransactions.length !== 0 || result.rollTransactionsOut.length !== 0) {
                    alert.success("Pencarian berhasil", "Data transaksi berhasil ditemukan !");
                }
            });
        })
    });
</script>
<?= $this->endSection() ?>