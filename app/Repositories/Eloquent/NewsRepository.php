<?php

namespace App\Repositories\Eloquent;

use App\Models\News;
use App\Helpers\APIResponse;
use Illuminate\Support\Facades\Redis;
use App\Repositories\NewsRepositoryInterface;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{
    /**
     * NewsRepository constructor.
     *
     * @param News $model
     */
    public function __construct(News $model)
    {
        parent::__construct($model);
    }

    public function getAll(array $filter)
    {
        $cache = Redis::get('news data : ');
        if (!isset($filter['status']) || !isset($filter['topic_id'])) {

            if (isset($cache)) {

                $news = json_decode($cache, FALSE);
                return APIResponse::success($news);
            }
        }

        $data = News::with(['topic','tags'])->orderBy('created_at', 'desc');

        $datas = $this->filter($data, $filter);

        Redis::set('news data: ', json_encode($datas));

        return APIResponse::success($datas->get());
    }

    public function store(array $request)
    {
        $data = News::create($request);

        return APIResponse::success($data);
    }

    /**
     * @param int $id
     * @param array $request
     */
    public function update(int $id, array $request)
    {
        $data = News::findOrFail($id);

        $data->update($request);

        return APIResponse::success($data);
    }

    public function delete(int $id)
    {
        $data = News::findOrFail($id);

        $data->delete();

        return APIResponse::success('Successfully deleted.');
    }

    /**
    * @return Object
    * @param array $filters
    */
    public function filter($data, $filter)
    {
        if (isset($filter['status']) != ""){
            $data->where('status', $filter['status']);
        }

        if (isset($filter['topic_id']) != ""){
            $data->where('topic_id', $filter['topic_id']);
        }

        return $data;
    }
}
