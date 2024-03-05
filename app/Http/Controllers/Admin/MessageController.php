<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\BaseController;

use App\Models\Message;

class MessageController  extends BaseController
{
   

     public function contacts()
    {
        $contacts = Message::where('type' , 'contact')->get();
       
        return view('admin.messages.contacts', compact('contacts'));
    }
	    public function careers()
    {
        $careers = Message::where('type' , 'careers')->get();
       
        return view('admin.messages.careers', compact('careers'));
    }
	    public function newsletters()
    {
        $newsletters = Message::where('type' , 'newsletter')->get();
       
        return view('admin.messages.newsletters', compact('newsletters'));
    }
        public function catalogs()
    {
        $catalogs = Message::where('type' , 'catalog')->get();
       
        return view('admin.messages.catalog', compact('catalogs'));
    }
    
    	 public function delete($id)
    {

        $message = Message::find($id);
        $message->delete($message);
        return back();

    }
	
}
