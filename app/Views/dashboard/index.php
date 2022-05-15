<?= $this->extend('layouts/app-layout') ?>


<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4"><?= $title ?></h1>
        <!-- ROW 1 -->
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body" id="card-payment">

                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/invoice">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body" id="card-capital">

                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/invoice">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body" id="card-profit">
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="/invoice">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 2 -->
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-money-bill-wave me-1"></i>
                        <b>
                            Invoice Hari Ini
                        </b>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered cell-border" id="table-transaction-today">
                            <thead>
                                <tr>
                                    <th scope="col">Kode Invoice</th>
                                    <th scope="col">Nama Pembeli</th>
                                    <th scope="col">Pembayaran</th>
                                    <th scope="col">Keuntungan</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($invoicesToday as $item) { ?>
                                    <tr>
                                        <td><?= $item["invoice_code"] ?></td>
                                        <td><?= $item["customer_name"] ?></td>
                                        <td><?= intToRupiah($item["total_payment"]) ?></td>
                                        <td><?= intToRupiah($item["total_profit"]) ?></td>
                                        <td><?= $item["date_invoice"] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer small text-muted">Data Invoice Terakhir | <a href="/invoice">Selengkapnya</a></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        <b>
                            Grafik Keuntungan
                        </b>
                    </div>
                    <div class="card-body"><canvas id="chart-profit" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">Selengkapnya pada menu invoice</div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        $("#table-transaction-today").DataTable({
            responsive: true,
            autoWidth: true,
            scrollX: true,
            sScrollXInner: "100%",
        });

        const myLineChart = new Chart($("#chart-profit"), {
            type: "line",
            options: {
                responsive: true,
                interaction: {
                    mode: "index",
                    intersect: false,
                },
                stacked: true,
                scales: {
                    x: {
                        time: {
                            unit: "month",
                        },
                        gridLines: {
                            display: true,
                        },
                        ticks: {
                            maxTicksLimit: 12,
                        },
                        title: {
                            display: true,
                            text: "Bulan",
                            color: "#2e2936",
                            font: {
                                // family: 'Comic Sans MS',
                                size: 20,
                                weight: "bold",
                                lineHeight: 1.2,
                            },
                            padding: {
                                top: 20,
                                left: 0,
                                right: 0,
                                bottom: 0,
                            },
                        },
                    },
                    y: {
                        ticks: {
                            min: 0,
                            max: 15000,
                            maxTicksLimit: 12,
                        },
                        gridLines: {
                            display: true,
                        },
                        title: {
                            display: true,
                            text: "Nilai",
                            color: "#2e2936",
                            font: {
                                // family: 'Comic Sans MS',
                                size: 20,
                                weight: "bold",
                                lineHeight: 1.2,
                            },
                            padding: {
                                top: 20,
                                left: 0,
                                right: 0,
                                bottom: 0,
                            },
                        },
                    },
                },
                plugins: {
                    legend: {
                        position: "top",
                        display: true,
                    },
                    title: {
                        display: true,
                        text: "Penghasilan Selama Setahun",
                    },
                },
            },
        });

        $.ajax({
            url: "/api/invoice/yearly",
            type: "GET",
        }).done(function(responseAjax) {
            // get last index
            const numberLastMonth = responseAjax.finance.at(-1).month;

            let dataForLabels = [];
            for (let index = 0; index < numberLastMonth; index++) {
                dataForLabels.push(getListMonth()[index]);
            }
            myLineChart.data.labels = dataForLabels;

            let dataProfit = [];
            responseAjax.finance.forEach((element) => {
                dataProfit[element.month - 1] = element.total_profit;
            });
            for (let index = 0; index < numberLastMonth; index++) {
                if (typeof dataProfit[index] == "undefined") {
                    dataProfit[index] = 0;
                }
            }

            myLineChart.data.datasets = [{
                label: "Profit",
                backgroundColor: "rgb(0, 102, 0)",
                borderColor: "rgb(0, 102, 0)",
                data: dataProfit,
                pointRadius: 5,
            }];

            myLineChart.update();
        });


        $.ajax({
            url: "/api/invoice/monthly",
            type: "GET",
        }).done((responseAjax) => {
            drawCardFinance(responseAjax.finance)
        })
    });
</script>
<?= $this->endSection() ?>