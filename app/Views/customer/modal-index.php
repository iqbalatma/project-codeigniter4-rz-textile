<!-- Modal Tambah Konsumen -->
<div class="modal fade" id="modal_tambah_konsumen" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_tambah_konsumenLabel">Modal Tambah Konsumen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/customer/store" method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label for="customer_NIK" class="form-label">NIK</label>
            <input type="text" class="form-control" id="customer_NIK" name="customer_NIK" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="customer_name" class="form-label">Nama Konsumen</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal edit-->
<div class="modal fade" id="modal-edit" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Konsumen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= route_to('customer.update') ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" name="customer_id" id="customer_id">
          <div class="mb-3">
            <label for="customer_NIK" class="form-label">NIK</label>
            <input type="number" class="form-control" id="customer_NIK" name="customer_NIK">
          </div>
          <div class="mb-3">
            <label for="customer_name" class="form-label">Nama Konsumen</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name">
          </div>
          <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP</label>
            <input type="number" class="form-control" id="no_hp" name="no_hp" maxlength="15">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" name="address">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    </form>
  </div>
</div>

<!-- Modal delete-->
<div class="modal fade" id="modal-delete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Konsumen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= route_to('customer.destroy') ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" name="customer_id" id="customer-id-delete">
          <input type="hidden" name="customer_name" id="customer-name-delete">
          Apakah anda yakin ingin menghapus data konsumen ini ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
    </div>
    </form>
  </div>
</div>