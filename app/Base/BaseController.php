<?php

namespace App\Base;

use App\Http\Controllers\Controller;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
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

    public function store(Request $request)
    {
        $data = $this->service->create($request->all());
        return $this->apiResponse->success($data, 'Created Successfully');
    }

    public function update(Request $request, int $id)
    {
        $data = $this->service->update($id, $request->all());
        if (!$data) {
            return $this->apiResponse->notFound('Not Found');
        }
        return $this->apiResponse->success($data, 'Updated Successfully');
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
