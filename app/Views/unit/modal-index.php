<!-- Modal add unit -->
<div class="modal fade" id="modalAddUnit" tabindex="-1" aria-labelledby="modalAddUnitLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddUnitLabel">Tambah Satuan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="<?= route_to("unit.store") ?>">
        <div class="modal-body">
          <div class="mb-3">
            <label for="unit_name" class="form-label">Satuan</label>
            <input type="text" class="form-control" id="unit_name" name="unit_name" aria-describedby="unit_name" placeholder="Contoh : Kilogram">
          </div>
          <div class="mb-3">
            <label for="unit_code" class="form-label">Kode Satuan</label>
            <input type="text" class="form-control" id="unit_code" name="unit_code" aria-describedby="unit_code" placeholder="Contoh : kg">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal edit unit-->
<div class="modal fade" id="modal-edit" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="<?= route_to("unit.update") ?>">
        <div class="modal-body">
          <input type="hidden" name="unit_id" id="unit-id-edit">
          <div class="mb-3">
            <label for="unit-name-edit" class="form-label">Nama Satuan</label>
            <input type="text" class="form-control" id="unit-name-edit" name="unit_name" placeholder="Contoh : Kilogram">
          </div>
          <div class="mb-3">
            <label for="unit-code-edit" class="form-label">Kode Satuan</label>
            <input type="text" class="form-control" id="unit-code-edit" name="unit_code" placeholder="Contoh : kg">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>