<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="/assets/admin-template/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.png">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <?= $this->renderSection('style') ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">TX TEXTILE</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="<?= route_to("dashboard.show") ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDataItem" aria-expanded="false" aria-controls="collapseDataItem">
                            <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                            Data Barang
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseDataItem" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= route_to("roll.search") ?>">Cari Roll Kain</a>
                                <a class="nav-link" href="<?= route_to("roll.show") ?>">Roll Kain</a>
                                <a class="nav-link" href="<?= route_to("rolltransaction.edit") ?>">Restok Roll</a>
                                <a class="nav-link" href="<?= route_to("rolltransaction.show") ?>">Data Transaksi Roll</a>
                                <a class="nav-link" href="<?= route_to("unit.show") ?>">Satuan</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="<?= route_to("invoice.show") ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                            Invoice
                        </a>
                        <a class="nav-link" href="<?= route_to("shopping.show") ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>Penjualan
                        </a>
                        <a class="nav-link" href="<?= route_to("customer.show") ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-tag"></i></div>
                            Data Konsumen
                        </a>
                        <?php if (session()->role === "owner") { ?>
                            <a class="nav-link" href="<?= route_to("usermanagement.show") ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-tag"></i></div>
                                Manajemen User
                            </a>
                            <a class="nav-link" href="<?= route_to("invoice.report") ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-file-pdf"></i></div>Laporan
                            </a>
                            <a class="nav-link" href="<?= route_to("log.show") ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                                Log Aktifitas
                            </a>
                        <?php } ?>
                        <a class="nav-link" href="<?= route_to("logout") ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?= session()->get("fullname") ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">


            <?= $this->renderSection('content') ?>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; RZ TEXTILE 2022</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/assets/admin-template/js/scripts.js"></script>
    <script src="https://kit.fontawesome.com/c395dfb97d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="/assets/admin-template/js/datatables-simple-demo.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script src="/js/general-helper.js"></script>
    <script src="/js/app.js"></script>

    <?= $this->renderSection('script') ?>


</body>

</html>