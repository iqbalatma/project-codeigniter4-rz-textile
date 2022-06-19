<?= $this->extend('layouts/app-layout') ?>


<?= $this->section('content') ?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4 mb-4"><?= $title ?></h1>

    <?= $this->include('layouts/alert-section') ?>

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item "><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manajemen User</li>
      </ol>
    </nav>




    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add_user">
      <i class="fa-solid fa-square-plus"></i> <b>Tambah User</b>
    </button>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-edit-my-profile">
      <i class="fa-solid fa-pen-to-square"></i> <b>Edit Profil Saya</b>
    </button>

    <div class="row mt-4">
      <div class="col-xl-12 col-md-12">
        <div class="card mb-4">
          <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <b>
              Tabel User
            </b>
          </div>
          <div class="card-body" style="overflow-x: auto;">
            <div class="col-xl-12 col-md-12 mt-3">
              <div class="table-responsive">
                <table class="table table-bordered cell-border" id="table-user">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama Lengkap</th>
                      <th scope="col">Username</th>
                      <th scope="col">Password</th>
                      <th scope="col">Role</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($dataUsers as $user) {
                      // to skip current user added into table 
                      if ($user["is_deleted"] == 1) {
                        $status = "Nonaktif";
                        $btnClass = "primary";
                        $btnText = "Aktifkan";
                        $dataStatus = 0;
                      } else {
                        $status = "Aktif";
                        $btnClass = "danger";
                        $btnText = "Nonaktifkan";
                        $dataStatus = 1;
                      }
                      if ($user["username"] !== session()->username) {
                        echo "<tr>
                                <td scope='col'>$i</td>
                                <td scope='col'>{$user['fullname']}</td>
                                <td scope='col'>{$user['username']}</td>
                                <td scope='col'>{$user['password']}</td>
                                <td scope='col'>{$user['role']}</td>
                                <td scope='col'>{$status}</td>
                                <td scope='col'>
                                  <button type='button' data-status='$dataStatus' data-user-id='{$user['user_id']}' class='btn btn-$btnClass btn-change-status'>$btnText</button>

                                  <button type='button' data-user-id='{$user['user_id']}' data-fullname='{$user['fullname']}' data-username='{$user['username']}' data-password='{$user['password']}' data-role='{$user['role']}'  class='btn btn-success btn-edit-user'>Edit</button>
                                </td>
                              </tr>";
                        $i++;
                      }
                    }
                    ?>
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
<?= $this->include('user-management/modal-index') ?>
<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    $("#table-user").DataTable();

    $("#table-user").on("click", ".btn-change-status", function() {
      const modal = $("#modal-change-status");
      const userId = $(this).data("user-id");
      const status = $(this).data("status");

      modal.find("#user_id").val(userId);
      modal.find("#status").val(status);
      modal.modal("show");
    });

    $("#table-user").on("click", ".btn-edit-user", function() {
      const btn = $(this);
      const modal = $("#modal-edit-user");
      const userId = btn.data("user-id");
      const fullname = btn.data("fullname");
      const username = btn.data("username");
      const password = btn.data("password");
      const role = btn.data("role");

      modal.find("#user-id").val(userId);
      modal.find("#fullname").val(fullname);
      modal.find("#username").val(username);
      modal.find("#password").val(password);
      modal.find("#role").val(role);
      modal.modal("show");
    });
  })
</script>
<?= $this->endSection(); ?>