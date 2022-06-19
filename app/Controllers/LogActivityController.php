<?php

namespace App\Controllers;


class LogActivityController extends BaseController
{
    public function show()
    {
        $logModel = new \App\Models\LogActivity();
        return view("log-activity/index", [
            "title" => "Log Activity",
            "dataLog" => $logModel->get100LogActivity(),
        ]);
    }
}
