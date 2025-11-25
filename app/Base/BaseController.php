<?php

namespace App\Base;

use App\Services\ApiResponse;

abstract class BaseController
{
    protected $service;
    protected ApiResponse $apiResponse;

    public function __construct($service, ApiResponse $apiResponse)
    {
        $this->service = $service;
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        $data = $this->service->getAll();
        return $this->apiResponse->success($data);
    }

    public function show(int $id)
    {
        $data = $this->service->getById($id);
        if (!$data) {
            return $this->apiResponse->notFound('Not Found');
        }
        return $this->apiResponse->success($data);
    }

    public function destroy(int $id)
    {
        $deleted = $this->service->delete($id);
        if (!$deleted) {
            return $this->apiResponse->notFound('Not Found');
        }
        return $this->apiResponse->success(null, 'Deleted Successfully');
    }
}
