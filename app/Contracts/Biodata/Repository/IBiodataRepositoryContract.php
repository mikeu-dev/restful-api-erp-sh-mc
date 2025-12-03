<?php

namespace App\Contracts\Biodata\Repository;

interface IBiodataRepositoryContract
{
    public function create(array $data);
    public function update(int $id, array $data);
}
