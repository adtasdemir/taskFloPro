<?php

namespace App\Services;

use App\Contracts\Service\BaseServiceContract;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseService implements BaseServiceContract
{
    public BaseRepository $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function find(int $id): ?Model
    {
        return $this->repository->find($id);
    }

    /**
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $id): ?Model
    {
        return $this->repository->findOrFail($id);
    }

    public function create(array $attributes): Model
    {
        return $this->repository->create($attributes);
    }

    public function update(int $id, array $attributes): bool
    {
        return $this->repository->update($id, $attributes);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }

    public function paginate(int $perPage): mixed
    {
        return $this->repository->paginate($perPage);
    }
}
