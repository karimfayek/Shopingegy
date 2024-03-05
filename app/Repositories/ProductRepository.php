<?php

namespace App\Repositories;

use App\Models\Product;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ProductContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class ProductRepository
 *
 * @package \App\Repositories
 */
class ProductRepository extends BaseRepository implements ProductContract
{
    use UploadAble;

    /**
     * ProductRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
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
    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort)->where('status', 1);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findProductById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Product|mixed
     */
    public function createProduct(array $params)
    {
        try {
            $collection = collect($params);

            $featured = $collection->has('featured') ? 1 : 0;
            $status = $collection->has('status') ? 1 : 0;
            $seller_id = \Auth::User()->getTable()=="admins" ? 0 : \Auth::user()->id ;
           // dd(\Auth::User()->getTable() );

            $merge = $collection->merge(compact('status', 'featured', 'seller_id'));

            $product = new Product($merge->all());

            $product->save();

            if ($collection->has('categories')) {
                $product->categories()->sync($params['categories']);
            }
            return $product;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateProduct(array $params)
    {
        $product = $this->findProductById($params['product_id']);

        $collection = collect($params)->except('_token');

        $featured = $collection->has('featured') ? 1 : 0;
        $status = $collection->has('status') ? 1 : 0;

        $merge = $collection->merge(compact('status', 'featured'));

        $product->update($merge->all());

        if ($collection->has('categories')) {
            $product->categories()->sync($params['categories']);
        }

        return $product;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteProduct($id)
    {
        $product = $this->findProductById($id);
        $product->categories()->sync([]);
        foreach($product->attributes as $prattrib){
            $prattrib->delete();
        }
        $original_photo_storage = public_path('storage\\products\\original_photos\\');
            $large_photos_storage = public_path('storage\\products\\large_photos\\');
            $medium_photos_storage = public_path('storage\\products\\medium_photos\\');
            $mobile_photos_storage = public_path('storage\\products\\mobile_photos\\');
            $tiny_photos_storage = public_path('storage\\products\\tiny_photos\\');
            $thumbnail_storage = public_path('storage\\products\\thumbnail\\');
			foreach($product->images as $image){

                @unlink($original_photo_storage .$image->full);
                @unlink($large_photos_storage .$image->full);
                @unlink($medium_photos_storage .$image->full);
                @unlink($mobile_photos_storage .$image->full);
                @unlink($tiny_photos_storage .$image->full);
                @unlink($thumbnail_storage .$image->full);
                @unlink($image->full);
                $image->delete();
            }
        $product->delete();

        return $product;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findProductBySlug($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return $product;
    }
}
