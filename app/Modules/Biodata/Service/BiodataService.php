<?php

namespace App\Modules\Biodata\Service;

use App\Base\BaseService;
use App\Contracts\Biodata\Service\IBiodataServiceContract;
use App\Modules\Biodata\Repository\BiodataRepository;

class BiodataService extends BaseService implements IBiodataServiceContract
{
    protected $biodataRepository;
    public function __construct(BiodataRepository $repository)
    {
        parent::__construct($repository);
        $this->biodataRepository = $repository;
    }

    public function createBiodata($request)
    {
        return $this->biodataRepository->create($request);
    }

    public function updateBiodata($id, $request)
    {
        return $this->biodataRepository->update($id, $request);
    }
}
