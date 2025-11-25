<?php

namespace App\Contracts\Services;

interface BaseServiceContract
{
    public function getAll();
    public function getById(int $id);
    public function delete(int $id);
}
