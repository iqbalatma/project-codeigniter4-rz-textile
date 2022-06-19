<?= $this->extend('layouts/app-layout') ?>


<?= $this->section('content') ?>
<!-- #RENDER -->
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title ?></h1>
        <?= $this->include('layouts/alert-section') ?>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Invoice</li>
            </ol>
        </nav>

        <!-- ROW FILTER -->
        <div class="row mt-4">
            <div class="col-xl-12 col-md-12">

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-search me-1"></i>
                        <b>
                            Filter Data Invoice
                        </b>
                    </div>

                    <div class="card-body">
                        <div class="col-xl-12 col-md-12 mt-3">
                            <form class="row row-cols-lg-auto g-3 align-items-center">
                                <div class="col-12">
                                    <label class="visually-hidden" for="month">Preference</label>
                                    <select class="form-select" id="month" name="month">
                                        <option selected disabled>Pilih Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="visually-hidden" for="year">Pilih Tahun</label>
                                    <select class="form-select" id="year" name="year">
                                        <option selected disabled>Pilih Tahun</option>
                                        <?php for ($i = 0; $i < 10; $i++) {
                                        ?>
                                            <option value="<?= 2021 + $i ?>"><?= 2021 + $i ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="button" id="filter" class="btn btn-primary">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body card-finance" id="card-payment">

                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/invoice">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body card-finance" id="card-capital">

                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/invoice">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body card-finance" id="card-profit">

                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/invoice">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-xl-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        <b>
                            Data Invoice
                        </b>
                    </div>

                    <div class="card-body" style="overflow-x: auto;">
                        <div class="col-xl-12 col-md-12 mt-3">
                            <div class="table-responsive">
                                <table class="table table-bordered cell-border display compact" id="tableInvoice">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Invoice</th>
                                            <th scope="col">Total Modal</th>
                                            <th scope="col">Total Pembayaran</th>
                                            <th scope="col">Total Keuntungan</th>
                                            <th scope="col">Jenis <br> Pembayaran</th>
                                            <th scope="col">Nama Customer</th>
                                            <th scope="col">Nama Admin</th>
                                            <th scope="col">Status <br>
                                                Pembayaran</th>
                                            <th scope="col">Tanggal Invoice</th>
                                            <th scope="col">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        foreach ($invoices as $key => $invoice) {
                                        ?>
                                            <tr>
                                                <td scope="row">
                                                    <?= $key + 1 ?>
                                                </td>
                                                <td scope="row"><?= $invoice["invoice_code"] ?></td>
                                                <td scope="row"><?= intToRupiah($invoice["total_capital"]) ?></td>
                                                <td scope="row"><?= intToRupiah($invoice["total_payment"]) ?></td>
                                                <td scope="row"><?= intToRupiah($invoice["total_profit"]) ?></td>
                                                <td scope="row"><?= ucfirst($invoice["type_payment"]) ?></td>
                                                <td scope="row"><?= $invoice["customer_name"] ?></td>
                                                <td scope="row"><?= $invoice["fullname"] ?></td>
                                                <td class="<?= $invoice["is_paid"] ? "" : "table-danger" ?>" scope="row"><?= $invoice["is_paid"] ? "Lunas" : "Belum Lunas" ?></td>
                                                <td scope="row"><?= $invoice["date_invoice"] ?></td>
                                                <td scope="row">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success open-modal-invoice mt-2" data-bs-toggle="modal" data-invoice-code="<?= $invoice["invoice_code"] ?>" data-invoice-id="<?= $invoice["invoice_id"] ?>" data-total-capital="<?= $invoice["total_capital"] ?>" data-total-payment="<?= $invoice["total_payment"] ?>" data-total-profit="<?= $invoice["total_profit"] ?>" data-customer-name="<?= $invoice["customer_name"] ?>" data-admin-name="<?= $invoice["fullname"] ?>" data-date-invoice="<?= $invoice["date_invoice"] ?>" data-bs-target="#detailInvoice">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>

                                                    <a href="/invoice/edit/<?= $invoice["invoice_id"] ?>" class="btn btn-success mt-2">Refund</a>

                                                    <?php if (!$invoice["is_paid"]) {
                                                    ?>
                                                        <button type="button" class="btn btn-primary open-modal-payment mt-2" data-bs-toggle="modal" data-bs-target="#modal-payment" data-id="<?= $invoice["invoice_id"] ?>">
                                                            Pembayaran
                                                        </button>
                                                    <?php
                                                    } ?>
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
</main>





<!-- Modal -->
<div class="modal fade" id="detailInvoice" tabindex="-1" aria-labelledby="detailInvoiceLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailInvoiceLabel">Detail Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="overflow-x: auto;">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Data</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kode Invoice</td>
                                <td id="invoice-code">-</td>
                            </tr>
                            <tr>
                                <td>Nama Customer</td>
                                <td id="customer-name">-</td>
                            </tr>
                            <tr>
                                <td>Admin</td>
                                <td id="admin-name">-</td>
                            </tr>
                            <tr>
                                <td>Total Modal</td>
                                <td id="total-capital">-</td>
                            </tr>
                            <tr>
                                <td>Total Pembayaran</td>
                                <td id="total-payment">-</td>
                            </tr>
                            <tr>
                                <td>Total Profit</td>
                                <td id="total-profit">-</td>
                            </tr>
                            <tr>
                                <td>Tanggal Transaksi</td>
                                <td id="transaction-date">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="table-roll-modal">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="/invoice-doc/invoiceid-40.pdf" type="button" class="btn btn-success" id="modal-print-preview-pdf">Preview PDF</a>
                <a href="/invoice/print/" type="button" class="btn btn-primary" id="modal-print-pdf" onclick="window.open(this.href).print(); return false">Print PDF</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-payment" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin memperbaharui status pelunasan ?
            </div>
            <div class="modal-footer">
                <form action="<?= route_to('invoice.updatePayment') ?>" method="POST">
                    <input type="hidden" id="id-invoice" name="id_invoice" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script src="/js/general-helper.js"></script>
<script type="module">
    import alert from "/js/alert.js";
    $(document).ready(function() {
        $.ajax({
            url: "/api/invoice/monthly",
            type: "GET",
        }).done((responseAjax) => {
            drawCardFinance(responseAjax.finance);
        })

        const tableInvoice = $("#tableInvoice").DataTable({
            createdRow: function(row, data, index) {
                if (data[8] === "Belum Lunas") {
                    $('td:eq(0)', row).prepend($("<i>").addClass("fa-solid fa-triangle-exclamation").attr("style", "color:red"))
                    $('td:eq(8)', row).addClass("table-danger")
                }
            }
        });




        $(document).on("click", ".open-modal-invoice", function() {
            const invoiceId = $(this).data("invoice-id");
            const invoiceCode = $(this).data("invoice-code");
            const totalProfit = $(this).data("total-profit");
            const totalPayment = $(this).data("total-payment");
            const totalCapital = $(this).data("total-capital");
            const adminName = $(this).data("admin-name");
            const customerName = $(this).data("customer-name");
            const transactionDate = $(this).data("date-invoice");



            $("#detailInvoiceLabel").text(invoiceCode);
            $("#total-profit").text(intToRupiah(totalProfit));
            $("#total-payment").text(intToRupiah(totalPayment));
            $("#total-capital").text(intToRupiah(totalCapital));
            $("#admin-name").text(adminName);
            $("#customer-name").text(customerName);
            $("#invoice-code").text(invoiceCode);
            $("#transaction-date").text(transactionDate);
            $("#modal-print-preview-pdf").attr("href", `/invoice-doc/invoiceid-${invoiceId}.pdf`)
            $("#modal-print-pdf").attr("href", `/invoice-doc/invoiceid-${invoiceId}.pdf`)


            $.ajax({
                url: "/api/roll-transactions/" + invoiceId,
                context: document.body
            }).done(function(result) {
                $(this).addClass("done");

                $("#table-roll-modal table").remove();
                let content = ` <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Roll</th>
                            <th scope="col">Jumlah Roll</th>
                            <th scope="col">Kuantitas Per Roll</th>
                            <th scope="col">Kuantitas Total</th>
                            <th scope="col">Harga Dasar</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Sub Total (Pembayaran)</th>
                        </tr>
                    </thead>
                    <tbody>`;

                result.forEach((element, index) => {
                    let no = parseInt(index) + 1;
                    content += `
                            <tr>
                                <th scope="row">${no}</th>
                                <td>${element.roll_name}</td>
                                <td>${element.transaction_quantity}</td>
                                <td>${element.transaction_quantity_total/element.transaction_quantity} ${element.unit_name}</td>
                                <td>${element.transaction_quantity_total} ${element.unit_name}</td>
                                <td>${intToRupiah(element.basic_price)}</td>
                                <td>${intToRupiah(element.sub_total/element.transaction_quantity_total)}</td>
                                <td>${intToRupiah(element.sub_total)}</td>
                            </tr>`;
                });
                content += '</tbody></table>';

                $("#table-roll-modal").append(content);
            });

        });

        $(document).on("click", ".open-modal-payment", function() {
            $("#id-invoice").val($(this).data("id"));
        });

        $("#filter").on("click", () => {
            let year = null;
            let month = null;

            if ($('#month option:selected').prop("disabled")) {
                return alert.error('Filter bulan belum dipilih !');
            } else {
                month = $("#month").val();
            }

            if ($('#year option:selected').prop("disabled")) {
                return alert.error('Filter tahun belum dipilih !');
            } else {
                year = $('#year').val();
            }
            tableInvoice.clear().draw();

            $.ajax({
                url: "/api/invoice/",
                context: document.body,
                type: "GET",
                data: {
                    "month": month,
                    "year": year
                }
            }).done((result) => {
                if (result.length == 0) {
                    return alert.error('Data tidak ditemukan !');
                } else {
                    result.forEach((element, index) => {
                        let button = `<button 
                                type="button" 
                                class="btn btn-success open-modal-invoice mt-2" 
                                data-bs-toggle="modal" 
                                data-invoice-code="${element.invoice_code}" 
                                data-invoice-id="${element.invoice_id}" 
                                data-total-capital="${element.total_capital}"
                                data-total-payment="${element.total_payment}" 
                                data-total-profit="${element.total_profit}" 
                                data-customer-name="${element.customer_name}" 
                                data-admin-name="${element.fullname}" 
                                data-date-invoice="${element.date_invoice}" 
                                data-bs-target="#detailInvoice">
                                    <i class="fas fa-info-circle"></i>
                            </button >

                            <a href="/invoice/edit/${element.invoice_id}" class="btn btn-success mt-2">Refund</a>
                            `;
                        element.is_paid == 1 ? "" : button += `
                            <button 
                                type="button" 
                                class="btn btn-primary open-modal-payment mt-2" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modal-payment" 
                                data-id="${element.invoice_id}">
                                     Pembayaran
                            </button>
                            `;

                        tableInvoice.row.add([
                            index + 1,
                            element.invoice_code,
                            intToRupiah(element.total_capital),
                            intToRupiah(element.total_payment),
                            intToRupiah(element.total_profit),
                            element.type_payment,
                            element.customer_name,
                            element.fullname,
                            element.is_paid == 1 ? "Lunas" : "Belum Lunas",
                            element.date_invoice,
                            button
                        ]).draw();
                    });
                }
            });


            $.ajax({
                url: "/api/invoice/monthly",
                type: "GET",
                data: {
                    "month": month,
                    "year": year
                }
            }).done((responseAjax) => {
                drawCardFinance(responseAjax.finance);
            })

        })
    });
</script>


<?= $this->endSection() ?>