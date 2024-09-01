<?php

namespace App\Contracts\Service;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseServiceContract
{
    public function all(): Collection;

    public function find(int $id): ?Model;

    public function findOrFail(int $id): ?Model;

    public function create(array $attributes): Model;

    public function update(int $id, array $attributes): bool;

    public function delete(int $id): void;

    public function paginate(int $perPage): mixed;
}
