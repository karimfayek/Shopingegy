<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\BannerContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class BannerRepository
 *
 * @package \App\Repositories
 */
class BannerRepository extends BaseRepository implements BannerContract
{
    use UploadAble;

    /**
     * BannerRepository constructor.
     * @param Banner $model
     */
    public function __construct(Banner $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBanners(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort)->where('status', 1);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findBannerById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Banner|mixed
     */
    public function createBanner(array $params)
    {
        try {
            $collection = collect($params);

            $featured = $collection->has('featured') ? 1 : 0;
            $status = $collection->has('status') ? 1 : 0;

            $merge = $collection->merge(compact('status', 'featured'));

            $Banner = new Banner($merge->all());

            $Banner->save();

            if ($collection->has('categories')) {
                $Banner->categories()->sync($params['categories']);
            }
            return $Banner;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBanner(array $params)
    {
        $Banner = $this->findBannerById($params['Banner_id']);

        $collection = collect($params)->except('_token');

        $featured = $collection->has('featured') ? 1 : 0;
        $status = $collection->has('status') ? 1 : 0;

        $merge = $collection->merge(compact('status', 'featured'));

        $Banner->update($merge->all());

        if ($collection->has('categories')) {
            $Banner->categories()->sync($params['categories']);
        }

        return $Banner;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteBanner($id)
    {
        $Banner = $this->findBannerById($id);

        $Banner->delete();

        return $Banner;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findBannerBySlug($slug)
    {
        $Banner = Banner::where('slug', $slug)->first();

        return $Banner;
    }
}
