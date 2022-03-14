<?php

namespace App\Repositories\Eloquent;

use App\Models\Topic;
use App\Helpers\APIResponse;
use App\Repositories\TopicRepositoryInterface;

class TopicRepository extends BaseRepository implements TopicRepositoryInterface
{
    /**
     * TopicRepository constructor.
     *
     * @param Topic $model
     */
    public function __construct(Topic $model)
    {
        parent::__construct($model);
    }

    /**
     * TopicRepository getAll.
     */
    public function getAll()
    {
        $data = Topic::all();

        return APIResponse::success($data);
    }
}
