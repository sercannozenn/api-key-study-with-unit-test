<?php

namespace App\Services;

use App\Models\Integration;
use \Illuminate\Database\Eloquent\Collection;
use \Illuminate\Database\Eloquent\Builder;

class IntegrationService
{
    public Integration $integration;

    public function __construct(Integration $integration)
    {
        $this->integration = $integration;
    }

    public function create(array $data): Integration
    {
        return $this->integration::create($data);
    }

    public function getAll(): Collection|array
    {
        return $this->integration::all();
    }

    public function updateById(int $id, array $data): Integration
    {
        $integration = $this->getById($id);
        $this->setter($integration);
        $this->update($data);

        return $this->integration;
    }

    public function setter(Integration $integration)
    {
        $this->integration = $integration;
    }

    public function getById(int $id): Integration|Builder
    {
        return $this->integration::query()
            ->where('id', $id)
            ->firstOrFail();
    }

    public function update(array $data): IntegrationService
    {
        $this->integration->update($data);
        $this->integration->fresh();

        return $this;
    }

    public function deleteById(int $id): IntegrationService
    {
        $integration = $this->getById($id);
        $this->setter($integration);
        $this->delete();

        return $this;
    }

    public function delete()
    {
        $this->integration->delete();
    }
}
