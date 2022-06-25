<?php

namespace App\Services;

use App\Models\Rolls;
use App\Models\RollTransaction;
use App\Models\Units;
use Exception;

class RollService
{

  public function getSearchData(): array
  {
    return [
      "title" => "Pencarian Item",
      "dataRolls" => (new Rolls())->getAllDataRolls()
    ];
  }

  public function getAllDataRolls(): array
  {
    return (new Rolls())->getAllDataRolls();
  }

  public function getRollById($id)
  {
    return (new Rolls())->getRollById($id);
  }

  public function getIndexData(): array
  {
    return [
      "title" => "Data Roll Kain",
      "dataRolls" => (new Rolls())->getAllDataRolls(),
      "dataUnits" => (new Units())->where("is_deleted", 0)->findAll(),
      "dataFinances" => (new RollTransaction())->getSummaryFinance()
    ];
  }

  public function store(array $data): bool
  {
    try {
      $generatedBarcode = $this->getGeneratedBarcode();

      $rollName = $data["roll_name"];
      $rollCode = $data["roll_code"];
      $rollQuantity = $data["roll_quantity"];
      $allQuantity =  $data["all_quantity"];

      $idRoll =   (new Rolls())->insert([
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
      LogService::setLogSuccess("STORE", "Tambah Roll BERHASIL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName");

      (new RollTransaction())->insert([
        "roll_id" => $idRoll,
        "transaction_type" => 0,
        "transaction_quantity" => $rollQuantity,
        "transaction_quantity_total" => $allQuantity,
        "sub_total" => null,
        "invoice_id" => null,
        "is_deleted" => 0
      ]);
      LogService::setLogSuccess("STORE", "Transaksi Roll :  $rollCode BERHASIL dilakukan dengan jumlah $rollQuantity");
      $this->storeBarcode($generatedBarcode);

      return true;
    } catch (Exception $e) {
      LogService::setLogFailed("STORE", "Tambah Roll GAGAL dilakukan. Errpr: $e");
      LogService::setLogFailed("STORE", "Tambah Transaksi Roll GAGAL dilakukan. Error : $e");
      return false;
    }
  }

  public function update(array $data): bool
  {
    try {
      $rollId = $data["roll_id"];
      $rollCode = $data["roll_code"];
      $rollName = $data["roll_name"];

      (new Rolls())->update($rollId,  [
        "roll_code" => $rollCode,
        "roll_name" => $rollName,
        "basic_price" => $data["basic_price"],
        "selling_price" => $data["selling_price"],
        "unit_id" => $data["unit_id"],
        "is_deleted" => 0,
      ]);

      LogService::setLogSuccess("UPDATE", "Update Roll BERHASIL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName");
      return true;
    } catch (Exception $e) {
      LogService::setLogFailed("UPDATE", "Update Roll GAGAL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName. Error: $e");
      return false;
    }
  }

  public function destroy(array $data): bool
  {
    try {
      $rollId = $data["roll_id"];
      $rollCode = $data["roll_code"];
      $rollName = $data["roll_name"];

      (new RollTransaction())->where("roll_id", $rollId)->delete();
      (new Rolls())->delete($rollId);
      LogService::setLogSuccess("DELETE", "Hapus Roll BERHASIL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName");
      return true;
    } catch (Exception $e) {
      LogService::setLogFailed("DELETE", "Hapus Roll GAGAL dilakukan. Kode Roll : $rollCode, Nama Roll :  $rollName. Error : $e");
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
    $rollCodeFromDB = (new Rolls())->getRollById($data["roll_id"])[0]["roll_code"];
    if ($data["roll_code"] == $rollCodeFromDB) {
      return true;
    } else {
      return false;
    }
  }

  public function getGeneratedBarcode()
  {
    $isUnique = false;
    $generatedBarcode = null;
    while (!$isUnique) {
      $generatedBarcode = generateRandomString();
      if (count((new Rolls())->getRollByBarcode($generatedBarcode)) === 0) {
        $isUnique = true;
      }
    }
    return $generatedBarcode;
  }

  public function storeBarcode($generatedBarcode): void
  {
    $barcode = new \Picqer\Barcode\BarcodeGeneratorJPG();
    file_put_contents(ROOTPATH . "public/barcode/$generatedBarcode.jpg", $barcode->getBarcode($generatedBarcode, $barcode::TYPE_CODE_128, 3, 50));
  }
}
