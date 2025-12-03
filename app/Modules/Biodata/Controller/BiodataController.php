<?php

namespace App\Modules\Biodata\Controller;

use App\Base\BaseController;
use App\Modules\Biodata\DTOs\BiodataRequestDto;
use App\Modules\Biodata\Requests\BiodataRequest;
use App\Modules\Biodata\Service\BiodataService;
use App\Services\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class BiodataController extends BaseController
{
    protected $biodataService;
    public function __construct(BiodataService $service, ApiResponse $apiResponse)
    {
        parent::__construct($service, $apiResponse);
        $this->biodataService = $service;
    }

    public function index()
    {
        return parent::index();
    }

    public function store(BiodataRequest $request)
    {
        $data = $request->validated();

        $dto = new BiodataRequestDto($data);

        try {
            $result = $this->biodataService->createBiodata($dto->toArray());
            return $this->apiResponse->created($result);
        } catch (\Exception $e) {
            Log::error('Gagal membuat user: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString()
            ]);
            return $this->apiResponse->serverError();
        }
    }

    public function show(int $id)
    {
        return parent::show($id);
    }

    public function update(BiodataRequest $request, int $id)
    {
        $dto = new BiodataRequestDto($request->validated());

        try {
            $result = $this->biodataService->updateBiodata($id, $dto->toArray());
            return $this->apiResponse->success($result);
        } catch (ModelNotFoundException $e) {
            return $this->apiResponse->notFound("Biodata dengan ID {$id} tidak ditemukan");
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['stack' => $e->getTraceAsString()]);
            return $this->apiResponse->serverError();
        }
    }

    public function destroy(int $id)
    {
        return parent::destroy($id);
    }
}
