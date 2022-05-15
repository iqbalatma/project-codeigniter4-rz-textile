<?= $this->extend('layouts/app-layout') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />


<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- #RENDER -->
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title ?></h1>
        <?= $this->include('layouts/alert-section') ?>


        <div class="row mb-4">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-file-lines"></i>
                        <b>
                            Laporan
                        </b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Tanggal Awal</span>
                                    <input type="text" class="form-control" placeholder="Pilih batas bawah laporan" id="lower-limit" name="lower_limit" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Tanggal Akhir</span>
                                    <input type="text" class="form-control" placeholder="Pilih batas atas laporan" id="upper-limit" name="upper_limit" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-3">
                                <button class="btn btn-primary" id="show-report">
                                    <b>
                                        Tampilkan Laporan
                                    </b>
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
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
                        <form action="/invoice/printReport" method="POST" class="d-none" id="export-doc">
                            <input type="text" name="dataInvoice" id="dataInvoice" hidden>
                            <button class="btn btn-primary" type="submit" id="export-pdf">
                                <b>
                                    Export Dokumen
                                </b>
                            </button>
                        </form>
                        <div class="table-responsive">
                            <table id="table-invoice" class="display compact cell-border" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Invoice</th>
                                        <th>Nama Roll</th>
                                        <th>Jumlah Roll</th>
                                        <th>Kuantitas Isi</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Keuntungan</th>
                                    </tr>
                                </thead>
                                <tbody>

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
<!-- selectize -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script type="module">
    import alert from "/js/alert.js";
    $(document).ready(function() {

        const tableInvoice = $('#table-invoice').DataTable({
            "columns": [{
                    "data": "action"
                }, {
                    "data": "invoice"
                },
                {
                    "data": "rollName"
                },
                {
                    "data": "transactionQuantity"
                },
                {
                    "data": "transactionQuantityTotal"
                },
                {
                    "data": "capital"
                },
                {
                    "data": "sellingPrice"
                },
                {
                    "data": "customerName"
                },
                {
                    "data": "profit"
                }
            ],
            "ordering": false,
            "paging": false,
            "stripeClasses": []
        });

        $("#lower-limit").datepicker({
            dateFormat: "m/dd/yy",
            onSelect: function(date) {
                const lowerLimit = $('#lower-limit').datepicker('getDate');
                $('#upper-limit').datepicker('option', 'minDate', lowerLimit);
            }
        });

        $('#upper-limit').datepicker({
            dateFormat: "m/dd/yy",
            onClose: function() {
                const upperLimit = $('#upper-limit').datepicker('getDate');
                $('#lower-limit').datepicker('option', 'maxDate', upperLimit);
            }
        });

        $("#show-report").on("click", function() {
            let lowerLimit = $("#lower-limit").val();
            let upperLimit = $("#upper-limit").val();

            if (lowerLimit.trim() === "") {
                return Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tanggal awal belum dipilih !',
                })
            }
            if (upperLimit.trim() === "") {
                return Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tanggal akhir belum dipilih !',
                })
            }


            $.ajax({
                url: "/api/invoice/report",
                type: "POST",
                data: {
                    "lower_limit": lowerLimit,
                    "upper_limit": upperLimit
                }
            }).done((responseAjax) => {
                tableInvoice.clear().draw();

                if (responseAjax.dataInvoices.length == 0) {
                    $("#export-doc").addClass("d-none");
                    return alert.error("Data laporan tidak ditemukan !")
                } else {
                    alert.success("Pencarian berhasil", "Data laporan berhasil ditemukan !")
                    $("#export-doc").removeClass("d-none");

                    responseAjax.lowerLimit = lowerLimit;
                    responseAjax.upperLimit = upperLimit;
                    $("#dataInvoice").val(JSON.stringify(responseAjax));


                    responseAjax.dataInvoices.forEach(element => {
                        let rowNode = tableInvoice.row.add({
                                "action": `<i class="fa-solid fa-circle-plus"></i>`,
                                "invoiceId": element.invoice_id,
                                "invoice": element.invoice_code,
                                "rollName": "",
                                "transactionQuantity": "",
                                "transactionQuantityTotal": "",
                                "capital": intToRupiah(element.total_capital),
                                "sellingPrice": intToRupiah(element.total_payment),
                                "profit": intToRupiah(element.total_profit),
                                "customerName": element.customer_name,
                            }).draw()
                            .node();
                        $(rowNode).addClass('parent').attr({
                            "id": `row${element.invoice_id}`,
                        });

                        let invoiceId = element.invoice_id;
                        let dataTransaction = responseAjax.dataTransactions.reduce(function(transactions, person) {
                            if (person.invoice_id == invoiceId) {
                                return transactions.concat(person);
                            } else {
                                return transactions
                            }
                        }, []);

                        dataTransaction.forEach(elementTransaction => {
                            let rowNode = tableInvoice.row.add({
                                    "action": ``,
                                    "invoice": "",
                                    "rollName": elementTransaction.roll_name,
                                    "transactionQuantity": elementTransaction.transaction_quantity,
                                    "transactionQuantityTotal": `${elementTransaction.transaction_quantity_total*elementTransaction.transaction_quantity} ${elementTransaction.unit_name}`,
                                    "capital": intToRupiah(elementTransaction.sub_capital),
                                    "sellingPrice": intToRupiah(elementTransaction.sub_total),
                                    "customerName": "",
                                    "profit": "",
                                }).draw()
                                .node();
                            $(rowNode).addClass(`child-row${elementTransaction.invoice_id} bg-light`).attr("style", "display:none;")
                        });
                    });


                    $('tr.parent')
                        .css("cursor", "pointer")
                        .attr("title", "Click to expand/collapse")
                        .click(function() {
                            $(this).siblings('.child-' + this.id).toggle();
                        });
                }

                // $('tr[@class^=child-]').hide().children('td');
            })
        });




    })
</script>
<?= $this->endSection() ?>