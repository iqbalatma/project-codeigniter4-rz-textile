<?php

namespace App\Services;

use App\Models\LogActivity;

class LogService
{
  // public static function setLog($logName, $logDesc, $trCollor)
  // {
  //   $logModel = new LogActivity();
  //   $dataLog = [
  //     "log_name" => $logName,
  //     "log_description" => $logDesc,
  //     "log_tr_collor" => $trCollor,
  //     "user_id" => session()->get("id_user")
  //   ];
  //   $logModel->insert($dataLog);
  // }

  public static function setLogSuccess(string $logName, string $logDesc): void
  {
    $logModel = new LogActivity();
    $dataLog = [
      "log_name" => $logName,
      "log_description" => $logDesc,
      "log_tr_collor" => "success",
      "user_id" => session()->get("id_user")
    ];
    $logModel->insert($dataLog);
  }

  public static function setLogFailed(string $logName, string $logDesc): void
  {
    $logModel = new LogActivity();
    $dataLog = [
      "log_name" => $logName,
      "log_description" => $logDesc,
      "log_tr_collor" => "danger",
      "user_id" => session()->get("id_user")
    ];
    $logModel->insert($dataLog);
  }
}
