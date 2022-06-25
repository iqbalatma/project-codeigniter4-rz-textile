<?php

namespace App\Controllers\RESTAPI;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Services\RollService;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class RollAPI extends BaseController
{
    use ResponseTrait;
    private RollService $rollService;
    public function __construct()
    {
        $this->rollService = new RollService();
    }

    public function index()
    {
        return $this->respond($this->rollService->getAllDataRolls(), 200);
    }
    public function show($id)
    {
        return $this->respond($this->rollService->getRollById($id), 200);
    }
}
