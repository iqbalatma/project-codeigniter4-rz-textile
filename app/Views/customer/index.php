<?= $this->extend('layouts/app-layout') ?>


<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title ?></h1>

        <?= $this->include('layouts/alert-section') ?>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_tambah_konsumen">
            <i class="fa-solid fa-square-plus"></i> <b>Tambah Konsumen</b>
        </button>
        <div class="row mt-4">
            <div class="col-xl-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        <b>
                            Tabel Data Pelanggan
                        </b>
                    </div>
                    <div class="card-body" style="overflow-x: auto;">
                        <div class="col-xl-12 col-md-12 mt-3">
                            <div class="table-responsive">
                                <table class="table table-bordered cell-border" id="table-customer">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIK Customer</th>
                                            <th scope="col">Nama Customer</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">No Hp</th>
                                            <th scope="col">Total Belanjaan</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($dataCustomers as $keyCustomer => $customer) {
                                            $keyCustomer++;
                                            $totalTransaction = null;
                                            $key = array_search($customer['customer_id'], array_column($dataTransactions, 'customer_id'));

                                            if (!empty($key) || $key === 0) {
                                                $totalTransaction =  $dataTransactions[$key]['total_payment'];
                                            }
                                            $customerId = $customer["customer_id"];
                                            $customerName = $customer["customer_name"];
                                            $customerNIK = $customer["customer_NIK"];
                                            $customerAddress = $customer["address"];
                                            $customerNoHp = $customer["no_hp"];



                                            if ($totalTransaction === null) {
                                                $btnDelete = "<button class='btn btn-danger btn-delete' data-customer-id='$customerId' data-customer-name='$customerName'>
                                                                <i class='fa-solid fa-trash'></i>
                                                            </button>";
                                            } else {
                                                $btnDelete = "";
                                            }
                                            $totalTransaction = intToRupiah($totalTransaction);

                                            echo " <tr>
                                                        <td scope='col'> $keyCustomer </td>
                                                        <td scope='col'> $customerNIK </td>
                                                        <td scope='col'> $customerName </td>
                                                        <td scope='col'> $customerAddress </td>
                                                        <td scope='col'> $customerNoHp </td>
                                                        <td scope='col'> $totalTransaction</td>
                                                        <td scope='col'>
                                                            <button type='button' class='btn btn-success btn-edit' data-customer-id='$customerId' data-customer-name='$customerName' data-phonenumber='$customerNoHp' data-address='$customerAddress' data-customer-nik='$customerNIK'>
                                                                <i class='fa-solid fa-pen-to-square'></i>
                                                            </button>
                                                            $btnDelete
                                                        </td>
                                                    </tr>";
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

<?= $this->include('customer/modal-index') ?>
<?= $this->endSection() ?>



<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $("#table-customer").DataTable();

        $("#table-customer").on("click", ".btn-edit", function() {
            let btn = $(this);
            let modal = $("#modal-edit");
            let customerId = btn.data("customer-id");
            let customerName = btn.data("customer-name");
            let customerNIK = btn.data("customer-nik");
            let customerPhonenumber = btn.data("phonenumber");
            let customerAddress = btn.data("address");

            modal.find("#customer_id").val(customerId);
            modal.find("#customer_name").val(customerName);
            modal.find("#customer_NIK").val(customerNIK);
            modal.find("#no_hp").val(customerPhonenumber);
            modal.find("#address").val(customerAddress);
            modal.modal("show");
        });

        $("#table-customer").on("click", ".btn-delete", function() {
            let customerId = $(this).data("customer-id");
            let customerName = $(this).data("customer-name");

            $("#modal-delete").modal("show");
            $("#customer-id-delete").val(customerId);
            $("#customer-name-delete").val(customerName);
        })

    })
</script>
<?= $this->endSection(); ?>