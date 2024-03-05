<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\State;
use App\Models\Country ;

class StateController extends BaseController
{
    public function index()
    {
           $countries = State::all();

        $this->setPageTitle('States', 'List of all States');
        return view('admin.states.index', compact('countries'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
           $countries = Country::all();
       $this->setPageTitle('State', 'Create State');
        return view('admin.states.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'name'      =>  'required|max:191',
        ]);

		$ship = $request->has('ship') ? 1 : 0;
        $shippings = New State;
		$shippings->name = $request->name ; 
		$shippings->name2 = $request->name2;
		$shippings->country_id = $request->country_id ;
		$shippings->ship_price = $request->ship_price ;
		$shippings->ship = $ship ;	
		$shippings->save();
        if (!$shippings) {
            return $this->responseRedirectBack('Error occurred while creating State.', 'error', true, true);
        }
        return $this->responseRedirect('admin.states.index', 'State added successfully' ,'success',false, false);
    }
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping = State::find($id);
		
           $countries = Country::all();
        $this->setPageTitle('State', 'Edit State : '.$shipping->name);
        return view('admin.states.edit', compact('shipping', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		//dd($request->all());
         $this->validate($request, [
            'name'      =>  'required|max:191',
        ]);

		$ship = $request->has('ship') ? 1 : 0;
        $shippings = State::find($request->id);
		$shippings->name = $request->name ;
		$shippings->name2 = $request->name2; 
		$shippings->country_id = $request->country_id ;
		$shippings->ship_price = $request->ship_price ;
		$shippings->ship = $ship ;	
		$shippings->save();
        if (!$shippings) {
            return $this->responseRedirectBack('Error occurred while updating State.', 'error', true, true);
        }
        return $this->responseRedirectBack('State updated successfully' ,'success',false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       $collection = State::find($id);
		$collection->delete();
        if (!$collection) {
            return $this->responseRedirectBack('Error occurred while deleting State.', 'error', true, true);
        }
        return $this->responseRedirect('admin.states.index', 'State deleted successfully' ,'success',false, false);
    }
}
