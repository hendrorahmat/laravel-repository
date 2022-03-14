<?php
namespace App\Repositories;

use Illuminate\Http\JsonResponse;

interface TopicRepositoryInterface
{
    /**
     * @return JsonResponse
     */
    public function getAll();
}