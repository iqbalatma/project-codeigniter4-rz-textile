<!-- Modal Edit Profile Saya -->
<div class="modal fade" id="modal-edit-my-profile" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_add_userLabel">Tambah User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= route_to("usermanagement.update") ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" name="user_id" value="<?= $myDataUser['user_id'] ?>">
          <div class="mb-3">
            <label for="fullname" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $myDataUser['fullname'] ?>">
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $myDataUser['username'] ?>">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" id="password" name="password" value="<?= $myDataUser['password'] ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary" id="submit-user">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="modal_add_user" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_add_userLabel">Tambah User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= route_to("usermanagement.store") ?>" method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label for="fullname" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="fullname" name="fullname">
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" id="password" name="password">
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select id="role" class="form-select" name="role">
              <option selected value="admin">Admin</option>
              <option value="owner">Owner</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary" id="submit-user">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Edit User -->
<div class="modal fade" id="modal-edit-user" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_add_userLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= route_to("usermanagement.update") ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" name="user_id" id="user-id">
          <div class="mb-3">
            <label for="fullname" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="fullname" name="fullname">
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" id="password" name="password">
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select id="role" class="form-select" name="role">
              <option selected value="admin">Admin</option>
              <option value="owner">Owner</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary" id="submit-user">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Delete User -->
<div class="modal fade" id="modal-change-status" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Status Aktif User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class="row g-3" method="POST" action="<?= route_to('usermanagement.destroy') ?>">
        <div class="modal-body">
          <input type="hidden" name="user_id" id="user_id">
          <input type="hidden" name="status" id="status">
          <p>Apakah anda yakin ingin mengubah status user ini ? </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary" id="confirm-deactivate">Konfirmasi</button>
        </div>
      </form>
    </div>
  </div>
</div>