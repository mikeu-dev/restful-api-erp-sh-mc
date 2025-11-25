<?php

namespace App\Modules\Biodata\Repository;

use App\Base\BaseRepository;
use App\Contracts\Biodata\Repository\IBiodataRepositoryContract;
use App\Modules\Biodata\Model\Biodata;

class BiodataRepository extends BaseRepository implements IBiodataRepositoryContract
{
    protected $model;
    /**
     * Create a new class instance.
     */
    public function __construct(Biodata $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function model(): string
    {
        return Biodata::class;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $exists = $this->model->findOrFail($id);

        return $exists->update($data);
    }
}
