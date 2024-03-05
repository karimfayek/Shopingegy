<?php

namespace App\Http\Controllers\Admin;

use App\Traits\UploadAble;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;

use Image;
class ProductImageController extends Controller
{
    use UploadAble;

    protected $productRepository;

    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function upload(Request $request)
    {
        $product = $this->productRepository->findProductById($request->product_id);
//dd($request->image);
        if ($request->has('image')) {
            try {
                //code...
            } catch (\Throwable $th) {
                //throw $th;
            }
            $file = request()-> file('image');
            $original_photo_storage = public_path('storage/products/original_photos/');
            $medium_photos_storage = public_path('storage/products/medium_photos/');
            $mobile_photos_storage = public_path('storage/products/mobile_photos/');
            $thumbnail_storage = public_path('storage/products/thumbnail/');
            $tiny_photos_storage = public_path('storage/products/tiny_photos/');
            $image = Image::make($file->getRealPath());
            
            $image->save($original_photo_storage.$file->hashName(),100)

                ->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                    })->save($medium_photos_storage.$file->hashName(),85)

                ->resize(420, null, function ($constraint) {
                    $constraint->aspectRatio();
                    })->save($mobile_photos_storage.$file->hashName(),85)

                    
                ->resize(120, null, function ($constraint) {
                    $constraint->aspectRatio();
                    })->save($thumbnail_storage.$file->hashName(),85)

                ->resize(10, null, function ($constraint) {
                    $constraint->aspectRatio();
                    })->blur(1)->save($tiny_photos_storage.$file->hashName(),85);

            $productImage = new ProductImage([
                'full'      =>  $file->hashName(),
            ]);

        $product->images()->save($productImage);
        }
       // dd($)

        return response()->json(['status' => 'Success']);
    }

    public function delete($id)
    {
        $image = ProductImage::findOrFail($id);

        if ($image->full != '') {
			     
            $original_photo_storage = public_path('storage\\products\\original_photos\\');
            $medium_photos_storage = public_path('storage\\products\\medium_photos\\');
            $mobile_photos_storage = public_path('storage\\products\\mobile_photos\\');
            $tiny_photos_storage = public_path('storage\\products\\tiny_photos\\');
            $thumbnail_storage = public_path('storage\\products\\thumbnail\\');
			
            @unlink($original_photo_storage .$image->full);
            @unlink($medium_photos_storage .$image->full);
            @unlink($mobile_photos_storage .$image->full);
            @unlink($tiny_photos_storage .$image->full);
            @unlink($thumbnail_storage .$image->full);
            @unlink($image->full);
        }
        $image->delete();

        return redirect()->back();
    }
}
