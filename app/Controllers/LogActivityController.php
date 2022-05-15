<?php

namespace App\Controllers;


class LogActivityController extends BaseController
{
    public function show()
    {
        $modelLog = new \App\Models\LogActivity();
        return view("log-activity/index", [
            "title" => "Log Activity",
            "dataLog" => $modelLog->get100LogActivity(),
        ]);
    }
}
