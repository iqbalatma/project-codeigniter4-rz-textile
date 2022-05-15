<?= $this->extend('layouts/app-layout') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title ?></h1>
        <?= $this->include('layouts/alert-section') ?>


        <div class="row">
            <div class="col-xl-8 col-md-8">
                <div class="card">
                    <div class="card-header"><i class="fas fa-cash-register me-1"></i> <b>Ringkasan Pembelian</b></div>
                    <div class="card-body" style="overflow-x: auto;">
                        <div class="table-responsive">
                            <table class="table table-hover" id="tableProduct">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Roll</th>
                                        <th scope="col">Nama Roll</th>
                                        <th scope="col">Jumlah Roll</th>
                                        <th scope="col">Kuantitas Per Rol</th>
                                        <th scope="col">Total Kuantitas</th>
                                        <th scope="col">Harga Satuan</th>
                                        <th scope="col">Sub Total</th>
                                        <th scope="col" class="action-col">Action</th>
                                        <th scope="col">Barang Tersedia</th>
                                        <th scope="col">Total Satuan</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-product">
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-success" style="display:none" id="btnPayment">Bayar Barang</button>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-4">
                <div class="card">
                    <div class="card-header"><b>Pilih Item</b></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="roll_id" class="form-label">Roll Kain</label>
                                <select id="roll_id" class="" name="roll_id">
                                    <?php foreach ($dataRolls as $key => $roll) {
                                    ?>
                                        <option data-data='{"rollQuantity":<?= $roll["roll_quantity"] ?>,"unitName":"<?= $roll["unit_name"] ?>","allQuantity":"<?= $roll["all_quantity"] ?>", "sellingPrice": "<?= $roll["selling_price"] ?>","rollCode": "<?= $roll["roll_code"] ?>", "rollName" : "<?= $roll["roll_name"] . " (" . $roll["all_quantity"] . " " . $roll["unit_name"] . ")" ?>"}' value="<?= $roll['roll_id'] ?>">
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

        <div class="row mt-4">
        </div>
    </div>
</main>

<?= $this->include('shopping/modal-index') ?>
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
        const selectized = $('#roll_id').selectize({
            sortField: 'text',
            openOnFocus: false,
            render: {
                option: function(data, escape) {
                    return `<div class="item-roll-selectized"
                                data-all-quantity="${escape(data.allQuantity)}"
                                data-unit-name="${escape(data.unitName)}" 
                                data-roll-name="${escape(data.rollName)}" 
                                data-roll-code="${escape(data.rollCode)}" 
                                data-selling-price="${escape(data.sellingPrice)}" 
                                data-roll-quantity="${escape(data.rollQuantity)}">
                                ${escape(data.text)}
                            </div>`
                }
            },
            onChange: function(value, isOnInitialize) {
                onChangeSelectize(value, isOnInitialize, this);
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
            let rollName = $(".selectize-dropdown-content").children(`[data-value=${rollId}]`).data("roll-name");
            let totalRollQuantity = parseInt($(".selectize-dropdown-content").children(`[data-value=${rollId}]`).data("roll-quantity")) - 1;
            let totalUnitQuantity = parseInt($(".selectize-dropdown-content").children(`[data-value=${rollId}]`).data("all-quantity")) - 1;
            let unitName = $(".selectize-dropdown-content").children(`[data-value=${rollId}]`).data("unit-name");

            $('#tableProduct > tbody >  tr').each(function(index) {
                if (table.getColomnText(this, 1).trim() === rollName) {
                    totalRollQuantity = parseInt(table.getColomnText(this, 8)) - 1;
                    totalUnitQuantity = parseInt(table.getColomnText(this, 9)) - 1;
                    return false;
                }
            });
            $('#tableProduct > tbody >  tr').each(function(index) {
                if (table.getColomnText(this, 1).trim() === rollName) {
                    table.setColomnText(this, 8, totalRollQuantity);
                    table.setColomnText(this, 9, `${totalUnitQuantity} ${unitName}`);
                }
            });


            let tr = $("<tr>").attr("id", `row${rollCode}`).appendTo($('#tbody-product'));;

            $("<td>").text(rollId).appendTo(tr);
            $("<td>").text(rollName).appendTo(tr);
            $("<td>", {
                text: 1,
                click: function() {
                    table.toEditableColomn(this);
                },
                focus: function() {
                    transaction.setRollQuantityTrans($(this).text());
                },
                keydown: function(event) {
                    table.toNextColomnUnit(this, event, transaction)
                },
                blur: function() {
                    // check is the field empty
                    const row = $(this).parent();
                    const rollQuantity = parseInt(table.getColomnText(row, 2))
                    const unitQuantity = parseInt(table.getColomnText(row, 3))
                    const sellingPrice = rupiahToInt(table.getColomnText(row, 5));
                    const unitName = table.getColomnText(row, 9).split(" ")[1];
                    // set difference between roll that we have with roll in field
                    const difference = parseInt(transaction.getRollQuantityTrans()) - rollQuantity;

                    // set final roll in storage after operation with roll in field
                    const totalRollQuantity = parseInt(table.getColomnText(row, 8)) + difference;
                    const totalUnitQuantity = parseInt(table.getColomnText(row, 9).split(" ")[0]) + (difference * unitQuantity);
                    const subTotal = sellingPrice * unitQuantity * rollQuantity;
                    if ($(this).text().trim() === "") {
                        $(this).text(transaction.getRollQuantityTrans());
                        return alert.alertRequiredQuantity();
                    } else if (totalRollQuantity < 0 || totalUnitQuantity < 0) {
                        $(this).text(transaction.getRollQuantityTrans());
                        return alert.alertQuantityNotEnough();
                    } else {
                        table.setColomnText(row, 4, rollQuantity * unitQuantity + " " + unitName);
                        table.setColomnText(row, 6, intToRupiah(subTotal));
                        // if the roll in storage is enough, change all roll available on table client
                        $('#tableProduct > tbody >  tr').each(function(index) {
                            if (table.getColomnText(this, 1).trim() === rollName) {
                                table.setColomnText(this, 8, totalRollQuantity);
                                table.setColomnText(this, 9, totalUnitQuantity + ` ${unitName}`);
                            }
                        });
                    }
                    $(this).prop("contenteditable", false);
                },
                keypress: function(event) {
                    keyEvent.preventString(this, event)
                }
            }).appendTo(tr);
            $("<td>", {
                text: `1 ${unitName}`,
                click: function() {
                    table.toEditableColomn(this);
                    const quantity = parseInt($(this).text());
                    transaction.setUnitQuantityTrans(quantity)
                    $(this).text(quantity);
                },
                blur: function() {
                    const row = $(this).parent();
                    const rollQuantity = parseInt(table.getColomnText(row, 2))
                    const unitQuantity = parseInt(table.getColomnText(row, 3))
                    const sellingPrice = rupiahToInt(table.getColomnText(row, 5));
                    const unitName = table.getColomnText(row, 9).split(" ")[1];
                    // set difference between roll that we have with roll in field
                    const difference = parseInt(transaction.getUnitQuantityTrans()) - unitQuantity;

                    // set final roll in storage after operation with roll in field
                    const totalRollQuantity = parseInt(table.getColomnText(row, 8)) + difference;
                    const totalUnitQuantity = parseInt(table.getColomnText(row, 9)) + (difference * rollQuantity);
                    const subTotal = sellingPrice * unitQuantity * rollQuantity;

                    if ($(this).text().trim() === "") {
                        $(this).text(`${transaction.getUnitQuantityTrans()} ${unitName}`);
                        alert.alertRequiredQuantity();
                    } else if (totalUnitQuantity < 0) {
                        $(this).text(`${transaction.getUnitQuantityTrans()} ${unitName}`);
                        alert.alertQuantityNotEnough();
                    } else {
                        $(this).text(`${unitQuantity} ${unitName}`);
                        table.setColomnText($(this).parent(), 4, rollQuantity * unitQuantity + " " + unitName);
                        table.setColomnText($(this).parent(), 6, intToRupiah(subTotal));

                        $('#tableProduct > tbody >  tr').each(function(index) {
                            table.getColomnText(this, 1).trim() === rollName ?
                                table.setColomnText(this, 9, `${totalUnitQuantity} ${unitName}`) : "";
                        });
                    }
                    $(this).prop("contenteditable", false);
                },
                keypress: function(event) {
                    keyEvent.preventString(this, event)
                },
                keydown: function(event) {
                    if (event.keyCode == 9) {
                        event.preventDefault();
                        $(this).next().focus();
                    }
                },
            }).appendTo(tr);
            $("<td>", {
                text: `1 ${unitName}`,
            }).appendTo(tr);
            $("<td>", {
                text: intToRupiah(sellingPrice),
                attr: {
                    "contenteditable": true,
                },
                class: "sellingprice",
                focus: function() {
                    let sellingPrice = rupiahToInt($(this).text());
                    transaction.setSellingPrice(sellingPrice);
                    $(this).text(sellingPrice);
                },
                blur: function() {
                    const sellingPrice = $(this).text();
                    if (sellingPrice.trim() === "") {
                        $(this).text(intToRupiah(transaction.getSellingPrice()));
                        return alert.alertSellingPriceCannotZero();
                    }
                    const rollQuantityTrans = parseInt(table.getColomnText($(this).parent(), 2));
                    const unitQuantityTrans = parseInt(table.getColomnText($(this).parent(), 3));
                    const subTotal = intToRupiah(rollQuantityTrans * unitQuantityTrans * sellingPrice);

                    $(this).text(intToRupiah(sellingPrice));
                    table.setColomnText($(this).parent(), 6, subTotal);
                },
                keypress: function(event) {
                    keyEvent.preventString(this, event)
                }
            }).appendTo(tr);
            $("<td>").text(intToRupiah(sellingPrice)).appendTo(tr);

            let actionTd = $("<td>").addClass("action-col").appendTo(tr);
            $("<button>", {
                class: "btn btn-primary btn-plus-q me-2",
                click: function() {
                    const row = $(this).parent().parent();
                    const unitName = table.getColomnText(row, 9).split(" ")[1];
                    const rollQuantity = parseInt(table.getColomnText(row, 2));
                    const unitQuantity = parseInt(table.getColomnText(row, 3));
                    const totalRollQuantity = parseInt(table.getColomnText(row, 8));
                    const totalUnitQuantity = parseInt(table.getColomnText(row, 9));
                    const sellingPrice = rupiahToInt(table.getColomnText(row, 5));
                    const subTotal = sellingPrice * unitQuantity * (rollQuantity + 1);

                    if (totalRollQuantity === 0 || totalUnitQuantity - unitQuantity < 0) {
                        alert.alertQuantityNotEnough();
                    } else {
                        table.setColomnText(row, 2, rollQuantity + 1);
                        table.setColomnText(row, 4, (rollQuantity + 1) * unitQuantity + ` ${unitName}`);
                        table.setColomnText(row, 6, intToRupiah(subTotal));
                        $('#tableProduct > tbody >  tr').each(function(index) {
                            if (table.getColomnText(this, 1).trim() === rollName) {
                                table.setColomnText(this, 8, totalRollQuantity - 1);
                                table.setColomnText(this, 9, totalUnitQuantity - unitQuantity + ` ${unitName}`);
                            }
                        });
                    }
                }
            }).append($("<i>").addClass("fas fa-plus-square")).appendTo(actionTd);
            $("<button>", {
                class: "btn btn-danger btn-minus-q me-2",
                click: function() {
                    const row = $(this).parent().parent();
                    const unitName = table.getColomnText(row, 9).split(" ")[1];
                    const rollQuantity = parseInt(table.getColomnText(row, 2));
                    const unitQuantity = parseInt(table.getColomnText(row, 3));
                    const totalRollQuantity = parseInt(table.getColomnText(row, 8));
                    const totalUnitQuantity = parseInt(table.getColomnText(row, 9));
                    const sellingPrice = rupiahToInt(table.getColomnText(row, 5));
                    const subTotal = sellingPrice * unitQuantity * (rollQuantity - 1);


                    if (rollQuantity === 1) {
                        row.remove();
                        if ($("#tableProduct tbody tr").length === 0)
                            $("#btnPayment").hide();
                    } else {
                        table.setColomnText(row, 2, rollQuantity - 1);
                        table.setColomnText(row, 4, (rollQuantity - 1) * unitQuantity + ` ${unitName}`);
                        table.setColomnText(row, 6, intToRupiah(subTotal));
                    }
                    $('#tableProduct > tbody >  tr').each(function(index) {
                        if (table.getColomnText(this, 1).trim() === rollName) {
                            table.setColomnText(this, 8, totalRollQuantity + 1);
                            table.setColomnText(this, 9, totalUnitQuantity + unitQuantity + ` ${unitName}`);
                        }
                    });

                }
            }).append($("<i>").addClass("fas fa-minus-square")).appendTo(actionTd);
            $("<button>", {
                class: "btn btn-danger btn-remove-row me-2",
                click: function() {
                    alert.mySwal().fire({
                        title: 'Apakah anda yakin ?',
                        text: "",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Tidak, batalkan!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            alert.successDeleting();
                            if ($("#tableProduct tbody tr").length === 0) {
                                $("#btnPayment").hide();
                            };
                            $(this).parent().parent().remove();
                            const row = $(this).parent().parent();
                            const unitName = table.getColomnText(row, 9).split(" ")[1];
                            const rollQuantity = parseInt(table.getColomnText(row, 2));
                            const unitQuantity = parseInt(table.getColomnText(row, 3));
                            const totalRollQuantity = parseInt(table.getColomnText(row, 8));
                            const totalUnitQuantity = parseInt(table.getColomnText(row, 9));
                            const sellingPrice = rupiahToInt(table.getColomnText(row, 5));
                            const subTotal = sellingPrice * unitQuantity * (rollQuantity - 1);
                            $('#tableProduct > tbody >  tr').each(function(index) {
                                if (table.getColomnText(this, 1).trim() === rollName) {
                                    table.setColomnText(this, 8, totalRollQuantity + rollQuantity);
                                    table.setColomnText(this, 9, totalUnitQuantity + (unitQuantity * rollQuantity) + ` ${unitName}`);
                                }
                            });
                        } else if (
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            alert.cancelDeleting();
                        }
                    })
                }
            }).append($("<i>").addClass("fas fa-trash")).appendTo(actionTd);

            $("<td>").text(totalRollQuantity).appendTo(tr);
            $("<td>").text(`${totalUnitQuantity} ${unitName}`).appendTo(tr)

            selectizedFocusAndClear(selectized);
            $("#btnPayment").show();
        }

        $("#btnPayment").on("click", () => {
            let total = 0;
            let isZero = false;
            $('#tableProduct > tbody >  tr ').each(function(index) {
                let rollQuantity = table.getColomnText(this, 2);
                let unitQuantity = table.getColomnText(this, 3).split(" ")[0];
                rollQuantity < 1 || unitQuantity < 1 ?
                    isZero = true : "";

                let subTotal = rupiahToInt(table.getColomnText(this, 6));
                total += subTotal;
            });

            if (isZero) {
                return table.alertQtyCannotZero();
            } else {
                $("#modalConfirm").modal("toggle");
                $("#row-table").children().remove();
                $("#tableProduct").clone().appendTo($("#row-table")).attr("id", "tableProductModal").find(".btn, .action-col").remove();
                $("#total-payment").val(intToRupiah(total));
            }


            $("#is-paid").on("change", function() {
                $("#label-is-paid").text(this.checked ? "Lunas" : "Belum Lunas");
            })

            $("#show-customer-cb").on("click", function() {
                $(this).is(':checked') ? $("#row-customer").show() : $("#row-customer").hide();
            })

            $("#customer_id").selectize({
                sortField: 'text',
                openOnFocus: true,
                render: {
                    option: function(data, escape) {
                        return "<div class='item-customer-selectized' data-nik='" + escape(data.dataNIK) + "' data-address='" + escape(data.dataAddress) + "' data-no-hp='" + escape(data.dataNoHp) + "' >" + escape(data.text) + "</div>"
                    }
                },
                onChange: function(value, isOnInitialize) {
                    const address = $(`.item-customer-selectized[data-value=${value}]`).data('address');
                    const noHp = $(`.item-customer-selectized[data-value=${value}]`).data('no-hp');
                    const nik = $(`.item-customer-selectized[data-value=${value}]`).data('nik');
                    $("#no_hp").val(noHp);
                    $("#address").val(address);
                    $("#nik").val(nik);
                },
            });


            $("#btn-confirm-modal").on("click", function() {
                let isPaid = $("#is-paid").is(":checked") ? 1 : 0;
                let typePayment = $("#payment-type").val();
                let dataCustomer = "";

                $("#show-customer-cb").is(':checked') ? dataCustomer = {
                    'customerId': $("#customer_id").val()
                } : dataCustomer = {
                    'customerId': null
                };

                let arrData = [];
                $("#tableProductModal tr").each(function(index) {
                    const row = $(this);


                    var obj = {};
                    obj.rollId = table.getColomnText(row, 0);
                    obj.rollCode = table.getColomnText(row, 1);;
                    obj.transactionRollQuantity = table.getColomnText(row, 2);;
                    obj.transactionAllQuantity = table.getColomnText(row, 3);;
                    obj.sellingPrice = table.getColomnText(row, 5);;
                    obj.subTotal = table.getColomnText(row, 6);

                    if (index !== 0) {
                        arrData.push(obj);
                    }
                });
                const data = {
                    dataTable: arrData,
                    typePayment: typePayment,
                    dataCustomer: dataCustomer,
                    isPaid: isPaid
                }



                alert.mySwal().fire({
                    title: 'Apakah anda yakin ?',
                    text: "Transaksi tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Konfirmasi',
                    cancelButtonText: 'Keluar !',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/api/shopping/store",
                            type: "POST",
                            data: data
                        }).done(function(result) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Transaksi Berhasil!",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            $.ajax({
                                url: "/api/invoice/last",
                                type: "GET",
                            }).done(function(resultInvoice) {
                                let modalDetail = $("#detailInvoice");
                                modalDetail.modal("show");
                                modalDetail.on("hide.bs.modal", function() {
                                    window.location = "/shopping";
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
                                                        <th scope="col">Nama Roll</th>
                                                        <th scope="col">Jumlah Roll</th>
                                                        <th scope="col">Kuantitas Per Roll</th>
                                                        <th scope="col">Total Kuantitas</th>
                                                        <th scope="col">Sub Total (Pembayaran)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>`;

                                resultInvoice.transaction_by_invoice_id.forEach((element, index) => {
                                    const {
                                        transaction_quantity,
                                        transaction_quantity_total,
                                        unit_name,
                                        sub_total,
                                        roll_name
                                    } = element;
                                    content += `
                                        <tr>
                                            <th scope="row">${parseInt(index) + 1}</th>
                                            <td>${roll_name}</td>
                                            <td>${transaction_quantity}</td>
                                            <td>${transaction_quantity_total/transaction_quantity} ${unit_name}</td>
                                            <td>${transaction_quantity_total} ${unit_name}</td>
                                            <td>${intToRupiah(element.sub_total)}</td>
                                        </tr>`;
                                });

                                content += `
                                    </tbody>
                                </table>`;

                                $("#table-roll-modal").append(content);

                            })
                        });
                        $('#modalConfirm').modal('hide');
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        return false;
                    }
                });
            })

        })
    })
</script>
<?= $this->endSection(); ?>