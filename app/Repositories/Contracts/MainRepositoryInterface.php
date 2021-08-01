<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

interface MainRepositoryInterface
{
    /**
     * Returns paged list of companies
     */
    public function paginate(): LengthAwarePaginator;

    /**
     * Returns a register according to the id provided
     *
     * @param int $id Company id
     * @throws NotFoundHttpException
     */
    public function getById(?int $id = null): array;

    /**
     * Deletes a certain register according to the past id and returns if the register was deleted
     *
     * @param int $id Company id
     * @throws NotFoundHttpException
     */
    public function deleteById(int $id): bool;

    /**
     * Register a new register with the data provided
     *
     * @param array $data Company data to be registered
     */
    public function create(array $data): array;

    /**
     * Update an existing register with the new data provided
     *
     * @param int $id Company id
     * @param array $data Company data to be registered
     */
    public function update(int $id, array $data): bool;
}
