<!-- Modal -->
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
          <div class="col-md-2 mt-5">
            <input type="checkbox" class="btn-check" id="show-customer-cb" autocomplete="off">
            <label class="btn btn-outline-primary" for="show-customer-cb">Pilih Customer</label>
          </div>
          <div class="col-md-2 mt-5">
            <div class="form-check form-switch mt-2">
              <input class="form-check-input" type="checkbox" id="is-paid" checked>
              <label class="form-check-label" for="is-paid" id="label-is-paid">Lunas</label>
            </div>
          </div>
          <div class="col-md-4 mt-3">
            <label for="payment-type" class="form-label">Jenis Pembayaran</label>
            <select id="payment-type" name="payment_type" class="form-select">
              <option value="cash">Cash</option>
              <option value="transfer">Transfer</option>
            </select>
          </div>
          <div class="col-md-4 mt-3">
            <label for="total-payment" class="form-label">Total pembayaran</label>
            <input type="text" class="form-control" id="total-payment" readonly>
          </div>
        </div>

        <div class="row" id="row-customer" style="display: none;">
          <div class="col-md-6">
            <label for="customer_id" class="form-label">Customer</label>
            <select id="customer_id" class="" name="customer_id">
              <option selected disabled>-Pilih Customer-</option>
              <?php foreach ($dataCustomers as $key => $customer) {
              ?>
                <option data-data='{"dataAddress": "<?= $customer["address"] ?>" ,"dataNIK": "<?= $customer["customer_NIK"] ?>", "dataNoHp" : "<?= $customer["no_hp"] ?>" }' value="<?= $customer["customer_id"] ?>"><?= $customer["customer_name"] . " | " . $customer["customer_NIK"] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" readonly>
          </div>
          <div class="col-md-6">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" name="address" readonly>
          </div>
          <div class="col-md-6">
            <label for="no_hp" class="form-label">Nomor HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" readonly>
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


<!-- Modal Detail Invoice-->
<div class="modal fade" id="detailInvoice" tabindex="-1">
  <div class="modal-dialog modal-lg">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="/invoice/print/" type="button" class="btn btn-success" id="modal-print-preview-pdf">Preview PDF</a>
        <a href="/invoice/print/" type="button" class="btn btn-primary" id="modal-print-pdf" onclick="window.open(this.href).print(); return false">Print PDF</a>
      </div>
    </div>
  </div>
</div>