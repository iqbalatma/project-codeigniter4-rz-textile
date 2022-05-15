export default alert = {
  mySwal() {
    return Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger me-3",
      },
      buttonsStyling: false,
    });
  },

  error(message) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: message,
    });
  },
  success(title, message) {
    Swal.fire({
      icon: "success",
      title: title,
      text: message,
    });
  },

  cancelDeleting() {
    this.mySwal().fire("Dibatalkan", "Penghapusan data dibatalkan", "error");
  },

  successDeleting() {
    this.mySwal().fire(
      "Data Dihapus",
      "Data berhasil di hapus dari table",
      "success"
    );
  },

  alertRequiredQuantity() {
    this.mySwal().fire(
      "Penambahan kuantitas gagal",
      "Kuantitas harus di isi !",
      "error"
    );
  },

  alertQuantityNotEnough() {
    this.mySwal().fire(
      "Penambahan kuantitas gagal",
      "Jumlah kuantitas di gudang tidak cukup !",
      "error"
    );
  },

  alertQtyCannotZero() {
    this.mySwal().fire(
      "Transaksi tidak dapat dilakukan",
      "Terdapat kuantitas yang kurang dari 1 !",
      "error"
    );
  },

  alertSellingPriceCannotZero() {
    this.mySwal().fire(
      "Perubahan harga jual gagal",
      "Harga jual harus di isi !",
      "error"
    );
  },
};
