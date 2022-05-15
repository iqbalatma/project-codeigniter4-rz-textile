<?= $this->extend('layouts/app-layout') ?>


<?= $this->section('style') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title ?></h1>
        <div class="row">
            <div class="col-xl-8 mt-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-retweet me-1"></i>
                        <b>
                            Ringkasan Transaksi
                        </b>
                    </div>
                    <div class="card-body" style="overflow-x: auto;">
                        <div class="col-xl-12 col-md-12 mt-3">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Data</th>
                                            <th scope="col">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kode Invoice</td>
                                            <td id="invoice_code" data-invoice-id="<?= $dataInvoice["invoice_id"] ?>"><?= $dataInvoice["invoice_code"] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Total Pembayaran</td>
                                            <td id="total_paymen"><?= intToRupiah($dataInvoice["total_payment"]) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Customer</td>
                                            <td id="customer_name"><?= $dataInvoice["customer_name"] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table display compact" id="tableRefund">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID Transaksi</th>
                                            <th scope="col">Nama Roll</th>
                                            <th scope="col">Jumlah Roll</th>
                                            <th scope="col">Kuantitas Per Roll</th>
                                            <th scope="col">Total Kuantitas</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Sub Total</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col" class="action-col">Action</th>
                                            <th scope="col">Roll Tersedia</th>
                                            <th scope="col">Total Tersedia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($dataTransactions as $item) {
                                        ?>
                                            <tr id='row<?= $item["roll_code"] ?>' data-roll-id="<?= $item["roll_id"] ?>" data-roll-name="<?= $item["roll_name"] . " (" . $item["all_quantity"] . " " . $item["unit_name"] . ")" ?>">
                                                <td><?= $item["transaction_id"] ?></td>
                                                <td><?= $item["roll_name"] . " (" . $item["all_quantity"] . " " . $item["unit_name"] . ")" ?>
                                                </td>
                                                <td class="rollquantity"><?= $item["transaction_quantity"] ?></td>
                                                <td class="unitquantity"><?= $item["transaction_quantity_total"] / $item["transaction_quantity"] . " " . $item["unit_name"] ?></td>
                                                <td><?= $item["transaction_quantity_total"] . " " . $item["unit_name"] ?></td>
                                                <td data-roll-code="<?= $item["roll_code"] ?>"><?= intToRupiah($item["sub_total"] / $item["transaction_quantity_total"]) ?></td>
                                                <td><?= intToRupiah($item["sub_total"]) ?></td>
                                                <td><?= $item["transaction_date"] ?></td>
                                                <td class="action-col">
                                                    <button class="btn btn-danger  btn-minus-q me-2 mb-2" data-roll-name="<?= $item["roll_name"] . " (" . $item["all_quantity"] . " " . $item["unit_name"] . ")" ?>" data-roll-code="<?= $item["roll_code"] ?>">
                                                        <i class="fas fa-minus-square"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-remove-row me-2 mb-2" data-transaction-id="<?= $item["transaction_id"] ?>" data-roll-name="<?= $item["roll_name"] . " (" . $item["all_quantity"] . " " . $item["unit_name"] . ")" ?>" data-roll-code="<?= $item["roll_code"] ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                                <td><?= $item["roll_quantity"] ?></td>
                                                <td><?= $item["all_quantity"] . " " . $item["unit_name"] ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" id="btn-refund-finish" class="btn mt-2 btn-success">Refund Selesai</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 mt-4">
                <div class="card">
                    <h5 class="card-header">Pilih Item</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="roll_id" class="form-label">Roll Kain</label>
                                <select id="roll_id" class="" name="roll_id">
                                    <?php foreach ($dataRolls as $key => $roll) { ?>
                                        <option data-data='{
                                            "unitName":"<?= $roll["unit_name"] ?>",
                                            "allQuantity":"<?= $roll["all_quantity"] ?>",
                                            "rollQuantity":<?= $roll["roll_quantity"] ?>, "sellingPrice": <?= $roll['selling_price'] ?>,"rollCode": "<?= $roll['roll_code'] ?>","rollName" : " <?= $roll["roll_name"] . " (" . $roll["all_quantity"] . " " . $roll["unit_name"] . ")" ?>"}' value="<?= $roll["roll_id"] ?>">
                                            <?php  ?>
                                            <?= $roll["roll_name"] . " (" . $roll["all_quantity"] . " " . $roll["unit_name"] . ") | " . $roll["barcode_code"] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Detail Invoice-->
<div class="modal fade" id="detailInvoice" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailInvoiceLabel">Detail Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
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
                            <td id="total-payment-invoice">-</td>
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
                <div id="table-roll-modal">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="/invoice/print/" type="button" class="btn btn-success" id="modal-print-preview-pdf">Preview PDF</a>
                <a href="/invoice/print/" type="button" class="btn btn-primary" id="modal-print-pdf" onclick="window.open(this.href).print(); return false">Print PDF</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="modalConfirm" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body" style="overflow-x: auto;">
                <div class="table-responsive">
                    <div class="row" id="row-table">


                    </div>
                </div>

                <div class="row mt-4 mb-4">
                    <div class="col-md-2 mt-5 ms-3">
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="is-paid" checked>
                            <label class="form-check-label" for="is-paid" id="label-is-paid">Lunas</label>
                        </div>
                    </div>
                    <!-- <div class="col-md-5 mt-3">
                        <label for="payment-type" class="form-label">Jenis Pembayaran</label>
                        <select id="payment-type" name="payment_type" class="form-select">
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </div> -->
                    <div class="col-md-5 mt-3">
                        <label for="total-payment" class="form-label">Total pembayaran</label>
                        <input type="text" class="form-control" id="total-payment" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="button" class="btn btn-primary" id="btn-confirm-modal">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>



<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script src="/js/general-helper.js"></script>


<script type="module">
    import alert from "/js/alert.js";
    import table from "/js/table.js";
    import transaction from "/js/transaction.js";
    import keyEvent from "/js/key-event.js";

    $(document).ready(function() {
        let selectized = $('#roll_id').selectize({
            sortField: 'text',
            openOnFocus: false,
            render: {
                option: function(data, escape) {
                    return `
                        <div class="item-roll-selectized" data-unit-name="${escape(data.unitName)}" data-all-quantity="${escape(data.allQuantity)}" data-roll-name="${escape(data.rollName)}" data-roll-code="${escape(data.rollCode)}" data-roll-quantity="${escape(data.rollQuantity)}" data-selling-price="${escape(data.sellingPrice)}">
                            ${escape(data.text)}
                        </div>`
                }
            },
            onChange: function(value, isOnInitialize) {
                onChangeSelectize(value, isOnInitialize);
            },
        });


        function selectizedFocusAndClear(selectized) {
            selectized[0].selectize.focus();
            selectized[0].selectize.off();
            selectized[0].selectize.clear();
            selectized[0].selectize.on("change", function(value, isOnInitialize) {
                onChangeSelectize(value, isOnInitialize);
            });
        }


        selectizedFocusAndClear(selectized);


        function onChangeSelectize(value, isOnInitialize) {
            let rollId = value;
            let sellingPrice = $(`.item-roll-selectized[data-value=${rollId}]`).data("selling-price");
            let rollCode = $(".selectize-dropdown-content").children(`[data-value=${rollId}]`).data("roll-code");
            let rollName = $(".selectize-dropdown-content").children(`[data-value=${rollId}]`).data("roll-name").trim();
            let totalRollQuantity = parseInt($(".selectize-dropdown-content").children(`[data-value=${rollId}]`).data("roll-quantity")) - 1;
            let totalUnitQuantity = parseInt($(".selectize-dropdown-content").children(`[data-value=${rollId}]`).data("all-quantity")) - 1;
            let unitName = $(".selectize-dropdown-content").children(`[data-value=${rollId}]`).data("unit-name");

            $('#tableRefund > tbody >  tr').each(function(index) {
                if (table.getColomnText(this, 1).trim() === rollName) {
                    totalRollQuantity = parseInt(table.getColomnText(this, 9)) - 1;
                    totalUnitQuantity = parseInt(table.getColomnText(this, 10)) - 1;
                    return false;
                }
            });
            $('#tableRefund > tbody >  tr').each(function(index) {
                if (table.getColomnText(this, 1).trim() === rollName) {
                    table.setColomnText(this, 9, totalRollQuantity);
                    table.setColomnText(this, 10, `${totalUnitQuantity} ${unitName}`);
                }
            });


            let tr = $("<tr>", {
                id: `row${rollCode}`,
                attr: {
                    "data-roll-id": rollId,
                    "data-roll-name": rollName
                },
            }).appendTo($('#tableRefund > tbody '));

            $("<td>").text("-").appendTo(tr);
            $("<td>").text(rollName).appendTo(tr);
            $("<td>").addClass("rollquantity").text(1).appendTo(tr);
            $("<td>").addClass("unitquantity").text(`1 ${unitName}`).data("roll-code", rollCode).appendTo(tr);
            $("<td>").text(`1 ${unitName}`).appendTo(tr);
            $("<td>").addClass("sellingprice").text(intToRupiah(sellingPrice)).appendTo(tr);
            $("<td>").text(intToRupiah(sellingPrice)).appendTo(tr);
            $("<td>").text("-").appendTo(tr);

            let actionTd = $("<td>").addClass("action-col").appendTo(tr);
            $("<button>", {
                class: "btn btn-primary btn-plus-q me-2 mb-2",
                attr: {
                    "data-roll-code": rollCode,
                    "data-roll-name": rollName
                },
            }).append($("<i>").addClass("fas fa-plus-square")).appendTo(actionTd);
            $("<button>", {
                class: "btn btn-danger btn-minus-q me-2 mb-2",
                attr: {
                    "data-roll-code": rollCode,
                    "data-roll-name": rollName
                },
            }).append($("<i>").addClass("fas fa-minus-square")).appendTo(actionTd);
            $("<button>", {
                class: "btn btn-danger btn-remove-row me-2 mb-2",
                attr: {
                    "data-roll-code": rollCode,
                    "data-roll-name": rollName
                },
            }).append($("<i>").addClass("fas fa-trash")).appendTo(actionTd);
            $("<td>").text(totalRollQuantity).appendTo(tr);
            $("<td>").text(`${totalUnitQuantity} ${unitName}`).appendTo(tr);


            selectizedFocusAndClear(selectized);
        }


        $("#tableRefund").on({
            click: function() {
                table.toEditableColomn(this);
            },
            focus: function() {
                transaction.setRollQuantityTrans($(this).text());
            },
            blur: function() {
                const rollName = $(this).parent().data("roll-name");
                const row = $(this).parent();

                const unitName = table.getColomnText(row, 10).split(" ")[1];
                const rollQuantity = parseInt(table.getColomnText(row, 2));
                const unitQuantity = parseInt(table.getColomnText(row, 3));
                const sellingPrice = rupiahToInt(table.getColomnText(row, 5));
                const difference = parseInt(transaction.getRollQuantityTrans()) - rollQuantity;
                const totalRollQuantity = parseInt(table.getColomnText(row, 9)) + difference;
                const totalUnitQuantity = parseInt(table.getColomnText(row, 10)) + (difference * unitQuantity);
                const subTotal = sellingPrice * unitQuantity * rollQuantity;

                if ($(this).text().trim() === "") {
                    $(this).text(transaction.getRollQuantityTrans());
                    return alert.alertRequiredQuantity();
                } else if (totalRollQuantity < 0 || totalUnitQuantity < 0) {
                    $(this).text(transaction.getRollQuantityTrans());
                    return alert.alertQuantityNotEnough();
                } else {
                    table.setColomnText(row, 4, rollQuantity * unitQuantity + " " + unitName);
                    table.setColomnText(row, 6, intToRupiah(subTotal))

                    $('#tableRefund > tbody >  tr').each(function(index) {
                        if (table.getColomnText(this, 1).trim() === rollName) {
                            table.setColomnText(this, 9, totalRollQuantity);
                            table.setColomnText(this, 10, totalUnitQuantity + ` ${unitName}`);
                        }
                    });
                }
                $(this).prop("contenteditable", false);
            },
            keypress: function(event) {
                keyEvent.preventString(this, event)
            },
            keydown: function(event) {
                table.toNextColomnUnit(this, event, transaction)
            },
        }, ".rollquantity");
        $("#tableRefund").on({
            click: function() {
                table.toEditableColomn(this);
            },
            focus: function() {
                let quantity = parseInt($(this).text().split(" ")[0]);
                transaction.setUnitQuantityTrans(quantity);
                $(this).text(quantity);
            },
            blur: function() {
                const rollName = $(this).parent().data("roll-name");
                const row = $(this).parent();

                const unitName = table.getColomnText(row, 10).split(" ")[1];
                const rollQuantity = parseInt(table.getColomnText(row, 2));
                const unitQuantity = parseInt(table.getColomnText(row, 3));
                const sellingPrice = rupiahToInt(table.getColomnText(row, 5));
                const difference = transaction.getUnitQuantityTrans() - unitQuantity;
                const totalUnitQuantity = parseInt(table.getColomnText(row, 10)) + (difference * rollQuantity);
                const subTotal = sellingPrice * unitQuantity * rollQuantity;

                if ($(this).text().trim() == "") {
                    $(this).text(transaction.getUnitQuantityTrans() + ` ${unitName}`);
                    return alert.alertRequiredQuantity();
                } else if (totalUnitQuantity < 0) {
                    $(this).text(`${transaction.getUnitQuantityTrans()} ${unitName}`);
                    return alert.alertQuantityNotEnough();
                } else {
                    $(this).text(`${unitQuantity} ${unitName}`);
                    table.setColomnText($(this).parent(), 4, rollQuantity * unitQuantity + " " + unitName);
                    table.setColomnText($(this).parent(), 6, intToRupiah(subTotal));

                    $('#tableRefund > tbody >  tr').each(function(index) {
                        let rollNameFromTable = $(this).children().eq(1).text().trim();
                        if (rollNameFromTable === rollName) {
                            table.setColomnText(this, 10, `${totalUnitQuantity} ${unitName}`);
                        }
                    });

                }
                $(this).prop("contenteditable", false);
            },
            keypress: function(event) {
                keyEvent.preventString(this, event)
            }
        }, ".unitquantity");
        $("#tableRefund").on({
            click: function() {
                table.toEditableColomn(this);
            },
            focus: function() {
                const sellingPrice = rupiahToInt($(this).text());
                transaction.setSellingPrice(sellingPrice);
                $(this).text(sellingPrice);
            },
            blur: function() {
                const row = $(this).parent();
                const sellingPrice = $(this).text();
                const rollQuantity = parseInt(table.getColomnText(row, 2));
                const unitQuantity = parseInt(table.getColomnText(row, 3));
                if (sellingPrice.trim() === "") {
                    $(this).text(intToRupiah(transaction.getSellingPrice()));
                    return alert.alertSellingPriceCannotZero();
                } else {
                    $(this).text(intToRupiah(sellingPrice));
                    table.setColomnText(row, 6, intToRupiah(rollQuantity * unitQuantity * sellingPrice));
                }
            },
            keypress: function(event) {
                keyEvent.preventString(this, event)
            }
        }, ".sellingprice");
        $("#tableRefund").on("click", ".btn-minus-q", function() {
            const rollName = $(this).data("roll-name");
            const row = $(this).parent().parent();
            const unitName = table.getColomnText(row, 10).split(" ")[1];
            const rollQuantity = parseInt(table.getColomnText(row, 2));
            const unitQuantity = parseInt(table.getColomnText(row, 3));
            const totalRollQuantity = parseInt(table.getColomnText(row, 9));
            const totalUnitQuantity = parseInt(table.getColomnText(row, 10));
            const sellingPrice = rupiahToInt(table.getColomnText(row, 5));
            const subTotal = sellingPrice * unitQuantity * (rollQuantity - 1);

            if (rollQuantity === 1) {
                row.remove();
            } else {
                table.setColomnText(row, 2, rollQuantity - 1);
                table.setColomnText(row, 4, (rollQuantity - 1) * unitQuantity + ` ${unitName}`);
                table.setColomnText(row, 6, intToRupiah(subTotal));
            }
            $('#tableRefund > tbody >  tr').each(function(index) {
                if (table.getColomnText(this, 1).trim() === rollName) {
                    table.setColomnText(this, 9, totalRollQuantity + 1);
                    table.setColomnText(this, 10, totalUnitQuantity + unitQuantity + ` ${unitName}`);
                }
            });
        })
        $("#tableRefund").on("click", ".btn-plus-q", function() {
            const rollName = $(this).data("roll-name");
            const row = $(this).parent().parent();
            const unitName = table.getColomnText(row, 10).split(" ")[1];
            const rollQuantity = parseInt(table.getColomnText(row, 2));
            const unitQuantity = parseInt(table.getColomnText(row, 3));
            const totalRollQuantity = parseInt(table.getColomnText(row, 9));
            const totalUnitQuantity = parseInt(table.getColomnText(row, 10));
            const sellingPrice = rupiahToInt(table.getColomnText(row, 5));
            const subTotal = sellingPrice * unitQuantity * (rollQuantity + 1);


            if (totalRollQuantity === 0 || totalUnitQuantity - unitQuantity < 0) {
                return alert.alertQuantityNotEnough();
            } else {
                table.setColomnText(row, 2, rollQuantity + 1);
                table.setColomnText(row, 4, (rollQuantity + 1) * unitQuantity + ` ${unitName}`);
                table.setColomnText(row, 6, intToRupiah(subTotal));

                $('#tableRefund > tbody >  tr').each(function(index) {
                    if (table.getColomnText(this, 1).trim() == rollName) {
                        table.setColomnText(this, 9, totalRollQuantity - 1);
                        table.setColomnText(this, 10, totalUnitQuantity - unitQuantity + ` ${unitName}`);
                    }
                });
            }
        });
        $("#tableRefund").on("click", ".btn-remove-row", function() {
            const rollName = $(this).data("roll-name");

            alert.mySwal().fire({
                title: 'Apakah anda yakin ?',
                text: "Transaksi yang dihapus tidak akan berubah sampai refund selesai!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak, batalkan!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    alert.successDeleting();
                    $(this).parent().parent().remove();
                    const row = $(this).parent().parent();
                    const unitName = table.getColomnText(row, 10).split(" ")[1];
                    const rollQuantity = parseInt(table.getColomnText(row, 2));
                    const unitQuantity = parseInt(table.getColomnText(row, 3));
                    const totalRollQuantity = parseInt(table.getColomnText(row, 9));
                    const totalUnitQuantity = parseInt(table.getColomnText(row, 10));
                    const sellingPrice = rupiahToInt(table.getColomnText(row, 5));
                    const subTotal = sellingPrice * unitQuantity * (rollQuantity - 1);

                    $('#tableRefund > tbody >  tr').each(function(index) {
                        if (table.getColomnText(this, 1).trim() === rollName) {
                            table.setColomnText(this, 9, totalRollQuantity + rollQuantity);
                            table.setColomnText(this, 10, totalUnitQuantity + (unitQuantity * rollQuantity) + ` ${unitName}`);
                        }
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    alert.cancelDeleting();
                }
            })
        });
        $("#btn-refund-finish").on("click", function() {
            let invoiceId = $("#invoice_code").data("invoice-id");
            $.ajax({
                url: `/api/roll-transactions/${invoiceId}`,
                type: "GET",
            }).done(function(result) {
                let totalPaymentBefore = 0;

                result.forEach(element => {
                    totalPaymentBefore += parseInt(element.sub_total);
                });

                let isZero = false;
                let total = 0;
                $('#tableRefund > tbody >  tr ').each(function(index) {
                    let rollQuantity = table.getColomnText(this, 2);
                    let unitQuantity = parseInt(table.getColomnText(this, 2));
                    let subTotal = rupiahToInt(table.getColomnText(this, 6));
                    if (rollQuantity < 1 || unitQuantity < 1) {
                        isZero = true;
                    }
                    total += subTotal;
                });

                if (isZero) {
                    return alert.alertQtyCannotZero();
                } else {
                    $("#total-payment").val(intToRupiah(total - totalPaymentBefore));
                    $("#modalConfirm").modal("toggle");
                    $("#row-table").children().remove();
                    $("#tableRefund").clone().appendTo($("#row-table")).attr("id", "tableRefundModal").find(".btn, .action-col").remove();
                }
            });


            $("#is-paid").on("change", function() {
                $("#label-is-paid").text(this.checked ? "Lunas" : "Belum Lunas");
            })

            $("#btn-confirm-modal").on("click", function() {
                alert.mySwal().fire({
                    title: 'Apakah anda yakin melakukan refund ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya!',
                    cancelButtonText: 'Tidak, batalkan!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const invoiceId = $("#invoice_code").data("invoice-id");
                        // const typePayment = $("#payment-type").val();
                        const isPaid = $("#is-paid").is(":checked") ? 1 : 0;

                        let arrData = [];
                        $("#tableRefund tr").each(function(index) {
                            const row = $(this);
                            const obj = {};
                            obj.rollId = row.data("roll-id");;
                            obj.transactionQuantity = table.getColomnText(row, 2);
                            obj.transactionQuantityTotal = table.getColomnText(row, 3);
                            obj.sellingPrice = table.getColomnText(row, 5);
                            obj.subTotal = table.getColomnText(row, 6);

                            // untuk ngeskip index 0 yaitu table row kosong
                            if (index !== 0) {
                                arrData.push(obj);
                            }
                        });

                        const data = {
                            dataTable: arrData,
                            // typePayment: typePayment,
                            invoiceId: invoiceId,
                            isPaid: isPaid,
                        }

                        $.ajax({
                            url: "/api/refund/update",
                            type: "POST",
                            data: data
                        }).done(function(result) {
                            if (result.message === "success") {
                                let modalConfirm = $("#modalConfirm");
                                modalConfirm.modal("hide");
                                $.ajax({
                                    url: `/api/invoice/${invoiceId}`,
                                    type: "GET",
                                }).done(function(resultInvoice) {
                                    let modalDetail = $("#detailInvoice");
                                    modalDetail.modal("show");
                                    modalDetail.on("hide.bs.modal", function() {
                                        window.location = "/invoice";
                                    })

                                    $("#invoice-code").text(resultInvoice.invoice[0].invoice_code);
                                    $("#customer-name").text(resultInvoice.invoice[0].customer_name);
                                    $("#admin-name").text(resultInvoice.invoice[0].fullname);
                                    $("#total-capital").text(intToRupiah(resultInvoice.invoice[0].total_capital));
                                    $("#total-payment-invoice").text(intToRupiah(resultInvoice.invoice[0].total_payment));
                                    $("#total-profit").text(intToRupiah(resultInvoice.invoice[0].total_profit));
                                    $("#transaction-date").text(intToRupiah(resultInvoice.invoice[0].date_invoice));
                                    $("#modal-print-preview-pdf").attr("href", "/invoice/print/" + resultInvoice.invoice[0].invoice_id)
                                    $("#modal-print-pdf").attr("href", "/invoice/print/" + resultInvoice.invoice[0].invoice_id)

                                    $("#table-roll-modal table").remove();
                                    let content = ` <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Kode Roll</th>
                                                                <th scope="col">Jumlah Roll</th>
                                                                <th scope="col">Kuantitas Per Roll</th>
                                                                <th scope="col">Total Kuantitas</th>
                                                                <th scope="col">Sub Total (Pembayaran)</th>
                                                            </tr>
                                                        </thead>
                                                    <tbody>`;

                                    resultInvoice.transaction_by_invoice_id.forEach((element, index) => {
                                        let no = parseInt(index) + 1;
                                        content += `<tr>
                                                        <th scope="row">` + no + `</th>
                                                        <td>` + element.roll_name + `</td>
                                                        <td>` + element.transaction_quantity + `</td>
                                                        <td>` + element.transaction_quantity_total / element.transaction_quantity + " " + element.unit_name + `</td>
                                                        <td>` + element.transaction_quantity_total + " " + element.unit_name + `</td>
                                                        <td>` + intToRupiah(element.sub_total) + `</td>
                                                    </tr>`;
                                    });

                                    content += `    </tbody>
                                                </table>`;

                                    $("#table-roll-modal").append(content);
                                }).fail(function() {
                                    window.location = "/invoice";
                                });
                            }
                        })


                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        aler.mySwal().fire(
                            'Dibatalkan',
                            'Refund dibatalkan !',
                            'error'
                        )
                    }
                });
            })
        })
    })
</script>
<?= $this->endSection() ?>