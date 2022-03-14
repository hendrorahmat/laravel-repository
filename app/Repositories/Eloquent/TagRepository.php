<?php

namespace App\Repositories\Eloquent;

use App\Models\Tag;
use App\Helpers\APIResponse;
use Illuminate\Support\Facades\Redis;
use App\Repositories\TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    /**
     * TagRepository constructor.
     *
     * @param Tag $model
     */
    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        $cache = Redis::get('tags : ');

        if (isset($cache)) {
            $tags = json_decode($cache, FALSE);

            return APIResponse::success($tags);
        }

        $data = Tag::all();

        Redis::set('tags : ', json_encode($data));

        return APIResponse::success($data);
    }

    public function store(array $request)
    {
        $data = Tag::create($request);

        return APIResponse::success($data);
    }

    /**
     * @param int $id
     * @param array $request
     */
    public function update(int $id, array $request)
    {
        $data = Tag::findOrFail($id);

        $data->update($request);

        return APIResponse::success($data);
    }

    public function delete(int $id)
    {
        $data = Tag::findOrFail($id);

        $data->delete();

        return APIResponse::success('Successfully deleted.');
    }
}
