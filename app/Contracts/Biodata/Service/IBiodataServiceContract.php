<?php

namespace App\Contracts\Biodata\Service;

interface IBiodataServiceContract
{
    public function createBiodata($request);
    public function updateBiodata(int $id, $request);
}
