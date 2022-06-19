<?php

namespace App\Services;

use App\Models\Rolls;
use App\Models\RollTransaction;
use Exception;

class RollService
{
  public function store($data)
  {
    $rollName = $data["roll_name"];
    $rollCode = $data["roll_code"];
    $rollQuantity = $data["roll_quantity"];
    $allQuantity =  $data["all_quantity"];

    $generatedBarcode = $this->getGeneratedBarcode();
    $rollModel = new Rolls();
    $rollTransactionModel = new RollTransaction();

    try {
      $idRoll =   $rollModel->insert([
        "roll_code" => $rollCode,
        "barcode_code" => $generatedBarcode,
        "roll_name" => $rollName,
        "roll_quantity" => $rollQuantity,
        "all_quantity" => $allQuantity,
        "unit_id" => $data["unit_id"],
        "basic_price" => $data["basic_price"],
        "selling_price" => $data["selling_price"],
        "is_deleted" => 0,
        "barcode_image" => "barcode/" .  $generatedBarcode . ".jpg",
      ]);
      LogService::setLog("Aktifitas Tambah Roll BERHASIL", "Tambah Roll BERHASIL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName", "success");

      $rollTransactionModel->insert([
        "roll_id" => $idRoll,
        "transaction_type" => 0,
        "transaction_quantity" => $rollQuantity,
        "transaction_quantity_total" => $allQuantity,
        "sub_total" => null,
        "invoice_id" => null,
        "is_deleted" => 0
      ]);
      LogService::setLog("Aktifitas Tambah Transaksi Roll BERHASIL", "Transaksi Roll :  $rollCode BERHASIL dilakukan dengan jumlah $rollQuantity", "success");
      $this->addBarcode($generatedBarcode);

      return true;
    } catch (Exception $e) {
      LogService::setLog("Aktifitas Tambah Roll GAGAL", "Tambah Roll GAGAL dilakukan.", "success");
      LogService::setLog("Aktifitas Tambah Transaksi Roll GAGAL", "Tambah Transaksi Roll GAGAL dilakukan. Error : $e", "success");
      return false;
    }
  }

  public function update($data)
  {
    $rollId = $data["roll_id"];
    $rollCode = $data["roll_code"];
    $rollName = $data["roll_name"];
    $basicPrice = $data["basic_price"];
    $sellingPrice =  $data["selling_price"];
    $unitId =  $data["unit_id"];

    $rollModel = new Rolls();

    try {
      $rollModel->update($rollId,  [
        "roll_code" => $rollCode,
        "roll_name" => $rollName,
        "basic_price" => $basicPrice,
        "selling_price" => $sellingPrice,
        "unit_id" => $unitId,
        "is_deleted" => 0,
      ]);

      LogService::setLog("Aktifitas Update Roll", "Update Roll BERHASIL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName", "success");
      return true;
    } catch (Exception $e) {
      LogService::setLog("Aktifitas Update Roll", "Update Roll BERHASIL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName", "danger");
      return false;
    }
  }

  public function destroy($data)
  {
    $rollTransactionModel = new RollTransaction();
    $rollModel = new Rolls();

    $rollId = $data["roll_id"];
    $rollCode = $data["roll_code"];
    $rollName = $data["roll_name"];

    try {
      $rollTransactionModel->where("roll_id", $rollId)->delete();
      $rollModel->delete($rollId);
      LogService::setLog("Aktifitas Hapus Roll", "Hapus Roll BERHASIL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName", "success");
      return true;
    } catch (Exception $e) {
      LogService::setLog("Aktifitas Hapus Roll", "Hapus Roll GAGAL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName. Error : $e", "danger");
      return false;
    }
  }

  public function printBarcode($imgSrc, $rollCode, $rollName, $quantity, $isDownload = false)
  {
    $mpdf = new \Mpdf\Mpdf([
      'margin_top' => 5,
      'margin_bottom' => 5,
      'format' => [108, 35]
    ]);

    $mpdf->showImageErrors = true;
    $mpdf->curlAllowUnsafeSslRequests = true;
    $mpdf->SetProtection(array('print'));
    $mpdf->SetTitle("Barcode $rollName");
    $mpdf->SetAuthor("RZ TEXTILE");
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->debug = true;
    for ($i = 0; $i < $quantity; $i++) {
      $mpdf->WriteHTML("<img  src='barcode/$imgSrc'>");
      $mpdf->WriteHTML("Kode Roll : $rollCode");
      $mpdf->WriteHTML("Nama Roll : $rollName");
      if ($i !== $quantity - 1) {
        $mpdf->AddPage();
      }
    }
    if ($isDownload) {
      return  $mpdf->Output("barcode.pdf", "D");
    } else {
      return $mpdf->Output();
    }
  }

  public function isCodeSame(array $data): bool
  {
    $rollModel = new Rolls();
    $rollId = $data["roll_id"];
    $rollCode = $data["roll_code"];
    $rollCodeFromDB = $rollModel->getRollById($rollId)[0]["roll_code"];
    if ($rollCode == $rollCodeFromDB) {
      return true;
    } else {
      return false;
    }
  }

  public function getGeneratedBarcode()
  {
    $rollModel = new Rolls();
    $isUnique = false;
    $generatedBarcode = null;
    while (!$isUnique) {
      $generatedBarcode = generateRandomString();
      if (count($rollModel->getRollByBarcode($generatedBarcode)) === 0) {
        $isUnique = true;
      }
    }
    return $generatedBarcode;
  }

  public function addBarcode($generatedBarcode)
  {
    $barcode = new \Picqer\Barcode\BarcodeGeneratorJPG();
    file_put_contents(ROOTPATH . "public/barcode/$generatedBarcode.jpg", $barcode->getBarcode($generatedBarcode, $barcode::TYPE_CODE_128, 3, 50));
  }
}
