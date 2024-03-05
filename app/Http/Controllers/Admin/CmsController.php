<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

use Illuminate\Support\Str;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Models\Cms;


use Image;
class CmsController extends BaseController
{
    use UploadAble;

     public function index()
    {
        $cmss = Cms::all();

        $this->setPageTitle('Cmss', 'Pages List');
        return view('admin.cmss.index', compact('cmss'));
    }
	 public function create()
    {
		$cmss = Cms::all();

        $this->setPageTitle('Cmss', 'Create Page');
		return view('admin.cmss.create', compact('cmss'));
    }
	 public function store(Request $request)
	 {
        $published = $request->has('published') ? 1 : 0;
        $menu =      $request->has('menu') ? 1 : 0;
        $footer = $request->has('footer') ? 1 : 0;
        $mission = $request->has('mission') ? 1 : 0;
        $vision = $request->has('vision') ? 1 : 0;
        $valu = $request->has('valu') ? 1 : 0;
        $articles = $request->has('articles') ? 1 : 0;  
        $blog = $request->has('blog') ? 1 : 0;  
        $company = $request->has('company') ? 1 : 0; 
        $adv = $request->has('adv') ? 1 : 0;
        $counter = $request->has('counter') ? 1 : 0;
        $team = $request->has('team') ? 1 : 0;
        $cert = $request->has('cert') ? 1 : 0;
            $cmss = new Cms;
            $cmss->name = $request->name;
			$cmss->name2 = $request->name2;
			$cmss->content = $request->content;
			$cmss->content2 = $request->content2;
			$cmss->icon = $request->icon;
            $cmss->slug = str_slug($request->name);
            
            
            $cmss->published = $published;
			$cmss->menu =    $menu;
			$cmss->footer = $footer;
			$cmss->cert = $cert;
            $cmss->valu = $valu;
            $cmss->mission = $mission;            
            $cmss->adv = $adv;
            $cmss->vision = $vision;
            $cmss->articles = $articles;  
            $cmss->company = $company; 
            $cmss->blog = $blog; 
            $cmss->counter = $counter;
            $cmss->team = $team;
            $cmss->order_no = $request->order_no;
            

            $image = null;
            $file = null;

          
				 if ($request->has('image')) {
				$file = request()-> file('image');
				$original_photo_storage = public_path('storage/cmsimages/original_photos/');
				$large_photos_storage = public_path('storage/cmsimages/large_photos/');
				$medium_photos_storage = public_path('storage/cmsimages/medium_photos/');
				$mobile_photos_storage = public_path('storage/cmsimages/mobile_photos/');
				$tiny_photos_storage = public_path('storage/cmsimages/tiny_photos/');
				$image = \Image::make($file->getRealPath());
				//dd($image);
				$image->save($original_photo_storage.$file->hashName(),100)
		  ->resize(860, null, function ($constraint) {
				  $constraint->aspectRatio();
				  })->save($large_photos_storage.$file->hashName(),85)
		  ->resize(640, null, function ($constraint) {
				  $constraint->aspectRatio();
				  })->save($medium_photos_storage.$file->hashName(),85)
		  ->resize(420, null, function ($constraint) {
				  $constraint->aspectRatio();
				  })->save($mobile_photos_storage.$file->hashName(),85)
		  ->resize(10, null, function ($constraint) {
				  $constraint->aspectRatio();
				  })->blur(1)->save($tiny_photos_storage.$file->hashName(),85);

				
            $cmss->image =  $file->hashName();

					
			}
           
           
            $cmss->file = $file;

            $cmss->save();
		   if (!$cmss) {
            return $this->responseRedirectBack('Error occurred while Creating .', 'error', true, true);
        }
        return $this->responseRedirectBack(' updated successfully' ,'success',false, false);
	}
	 public function update(Request $request)
	 {
        $published = $request->has('published') ? 1 : 0;
        $menu =      $request->has('menu') ? 1 : 0;
        $footer = $request->has('footer') ? 1 : 0;
        $mission = $request->has('mission') ? 1 : 0;
        $vision = $request->has('vision') ? 1 : 0;
        $valu = $request->has('valu') ? 1 : 0;
        $articles = $request->has('articles') ? 1 : 0;  
        $blog = $request->has('blog') ? 1 : 0;  
        $company = $request->has('company') ? 1 : 0; 
        $adv = $request->has('adv') ? 1 : 0;
        $counter = $request->has('counter') ? 1 : 0;
        $team = $request->has('team') ? 1 : 0;
        $cert = $request->has('cert') ? 1 : 0;
            $cmss = Cms::find($request->product_id);
           $cmss->name = $request->name;
			$cmss->name2 = $request->name2;
			$cmss->content = $request->content;
			$cmss->content2 = $request->content2;
			$cmss->icon = $request->icon;
            $cmss->slug = str_slug($request->name);
            
            $cmss->published = $published;
			$cmss->menu =    $menu;
            $cmss->footer = $footer;
            $cmss->mission = $mission;
            $cmss->vision = $vision;
            $cmss->valu = $valu;        
            $cmss->adv = $adv;
            $cmss->cert = $cert;
            $cmss->blog = $blog;
            $cmss->company = $company;
            $cmss->articles = $articles;  
            $cmss->counter = $counter;
            $cmss->team = $team;
            $cmss->order_no = $request->order_no;

                
			 if ($request->has('image')) {
				$file = request()-> file('image');
				$original_photo_storage = public_path('storage/cmsimages/original_photos/');
				$large_photos_storage = public_path('storage/cmsimages/large_photos/');
				$medium_photos_storage = public_path('storage/cmsimages/medium_photos/');
				$mobile_photos_storage = public_path('storage/cmsimages/mobile_photos/');
				$tiny_photos_storage = public_path('storage/cmsimages/tiny_photos/');
				if ($cmss->image != null) {
					//dd($original_photo_storage.$cmss->image);
                   @unlink($original_photo_storage.$cmss->image);
                   @unlink($large_photos_storage.$cmss->image);
                   @unlink($medium_photos_storage.$cmss->image);
                   @unlink($mobile_photos_storage.$cmss->image);
                   @unlink($tiny_photos_storage.$cmss->image);
                }
                
				$image = Image::make($file->getRealPath());
                //dd($tiny_photos_storage);
				//dd($image);
				$image->save($original_photo_storage.$file->hashName(),100)
		  ->resize(860, null, function ($constraint) {
				  $constraint->aspectRatio();
				  })->save($large_photos_storage.$file->hashName(),85)
		  ->resize(640, null, function ($constraint) {
				  $constraint->aspectRatio();
				  })->save($medium_photos_storage.$file->hashName(),85)
		  ->resize(420, null, function ($constraint) {
				  $constraint->aspectRatio();
				  })->save($mobile_photos_storage.$file->hashName(),85)
		  ->resize(10, null, function ($constraint) {
				  $constraint->aspectRatio();
				  })->blur(1)->save($tiny_photos_storage.$file->hashName(),85);

				
            $cmss->image =  $file->hashName();

					
			}
            
            if ($request->file('file') && ($request->file('file') instanceof  UploadedFile)) {
                if ($cmss->file != null) {
                    $this->deleteOne($cmss->file);
                }
                $file = $this->uploadOne($request->file('file') , 'cmsfiles');
                
            $cmss->file = $file; 
            }
            $cmss->save();
		   if (!$cmss) {
            return $this->responseRedirectBack('Error occurred while updating .', 'error', true, true);
        }
        return $this->responseRedirectBack(' updated successfully' ,'success',false, false);
	}
	 public function edit($id)
    {
		$product = Cms::find($id);

        $this->setPageTitle('Cmss', 'Create Page');
		return view('admin.cmss.edit', compact('product'));
    }
	
	 public function delete($id)
    {

        $cmss = Cms::find($id);
        $original_photo_storage = public_path('storage/cmsimages/original_photos/');
        $large_photos_storage = public_path('storage/cmsimages/large_photos/');
        $medium_photos_storage = public_path('storage/cmsimages/medium_photos/');
        $mobile_photos_storage = public_path('storage/cmsimages/mobile_photos/');
        $tiny_photos_storage = public_path('storage/cmsimages/tiny_photos/');
        if ($cmss->image != null) {
            //dd($original_photo_storage.$cmss->image);
           @unlink($original_photo_storage.$cmss->image);
           @unlink($large_photos_storage.$cmss->image);
           @unlink($medium_photos_storage.$cmss->image);
           @unlink($mobile_photos_storage.$cmss->image);
           @unlink($tiny_photos_storage.$cmss->image);
        }
        $cmss->delete($cmss);
        return $this->responseRedirectBack(' deleted successfully' ,'success',false, false);

    }
}
