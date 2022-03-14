<?php
namespace App\Repositories;

use Illuminate\Http\JsonResponse;

interface TagRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function getAll();

    /**
     * @param array $request
     * @return JsonResponse
     */
    public function store(array $request);

    /**
     * @param int $id
     * @param array $request
     * @return JsonResponse
     */
    public function update(int $id, array $request);

    /**
     * @param int $id
     */
    public function delete(int $id);
}