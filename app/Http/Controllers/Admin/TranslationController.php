<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

use Illuminate\Support\Str;
use App\Models\Translation;

class TranslationController extends BaseController
{
   

     public function index()
    {
        $cmss = Translation::all();

        $this->setPageTitle('translations', 'translations List');
        return view('admin.translations.index', compact('cmss'));
    }
	 public function create()
    {
		$cmss = Translation::all();

        $this->setPageTitle('Cmss', 'Create Page');
		return view('admin.translations.create', compact('cmss'));
    }
	 public function store(Request $request)
	 {
		$cmss = new Translation;
		$cmss->header = $request->header;
		$cmss->ar = $request->ar;
		$cmss->en = $request->en;

		$cmss->save();
		if (!$cmss) {
		return $this->responseRedirectBack('Error occurred while Creating .', 'error', true, true);
		}
		 return $this->responseRedirect('admin.translation.create', 'added successfully' ,'success',false, false);
	}
	
	 public function update(Request $request)
	 {
		$cmss = Translation::find($request->product_id);
		$cmss->header = $request->header;
		$cmss->ar = $request->ar;
		$cmss->en = $request->en;
		$cmss->save();
	   if (!$cmss) {
		return $this->responseRedirectBack('Error occurred while updating .', 'error', true, true);
		}
		
		 return $this->responseRedirect('admin.translation.index', 'Updated successfully' ,'success',false, false);
	}
	 public function edit($id)
    {
		$product = Translation::find($id);

        $this->setPageTitle('Translation', 'Create Translation');
		return view('admin.translations.edit', compact('product'));
    }
	
	 public function delete($id)
    {

        $cmss = Translation::find($id);
       
        $cmss->delete($cmss);
        return $this->responseRedirectBack(' deleted successfully' ,'success',false, false);

    }
}
