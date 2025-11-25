<?php

namespace App\Contracts\Repositories;

interface BaseRepositoryContract
{
    public function paginate(
        int $perPage,
        array $columns = ['*'],
        array $filters = [],
        array $sorts = [],
        array $relations = [],
        ?\Closure $callback = null
    );
    public function all(array $columns = ['*']);
    public function find(int $id, array $columns = ['*']);
    public function delete(int $id);
}
