function getListMonth() {
  return (dataMonth = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember",
  ]);
}

function getListMonthIDN() {
  return (dataMonth = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember",
  ]);
}

function intToRupiah(number) {
  let rupiah = "Rp " + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  return rupiah;
}

function rupiahToInt(rupiah) {
  let rupiahInt = rupiah.split(" ");
  rupiahInt = rupiahInt[1];
  rupiahInt = rupiahInt.replaceAll(".", "");
  rupiahInt = parseInt(rupiahInt);
  return rupiahInt;
}

function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp " + rupiah : "";
}

function replaceCons(characterToReplace) {
  return characterToReplace
    .replace(/a/g, "")
    .replace(/e/g, "")
    .replace(/i/g, "")
    .replace(/o/g, "")
    .replace(/u/g, "")
    .replace(/A/g, "")
    .replace(/E/g, "")
    .replace(/I/g, "")
    .replace(/O/g, "")
    .replace(/U/g, "")
    .replace(/ /g, "")
    .toLowerCase();
}

function drawCardFinance(data) {
  const date = new Date();
  let total_payment = 0;
  let total_capital = 0;
  let total_profit = 0;
  if (data.length > 0) {
    total_capital = data[0].total_capital;
    total_payment = data[0].total_payment;
    total_profit = data[0].total_profit;
  }
  $(".card-finance").empty();
  $("#card-payment").append(
    `Transaksi Bulan ${getListMonthIDN()[date.getMonth()]} <br> ${intToRupiah(
      total_payment
    )}`
  );
  $("#card-capital").append(
    `Modal Bulan ${getListMonthIDN()[date.getMonth()]} <br> ${intToRupiah(
      total_capital
    )}`
  );
  $("#card-profit").append(
    `Profit Bulan ${getListMonthIDN()[date.getMonth()]} <br> ${intToRupiah(
      total_profit
    )}`
  );
}
