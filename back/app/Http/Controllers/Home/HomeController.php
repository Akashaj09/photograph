<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\MailController;
use App\PublishPhoto;
use Auth;
use DB;

class HomeController extends Controller
{
    public function index() {
    	return $data = PublishPhoto::where('status', '1')->latest()->paginate(24);
    }

    public function photo($id) {
    	return PublishPhoto::where('id', $id)->where('status', '1')->get();
    }

    public function confirmed(Request $req) {
    	$user = Auth::user();
    	$uploader = DB::table("users")
    					->select('name', 'email', 'publish_photos.title')
    					->join('publish_photos', 'publish_photos.admin', '=', 'users.id')
    					->where('publish_photos.id', '=', $req->id)
    					->get();
    	if(count($uploader) > 0){
    		$title = $uploader[0]->title;
    		$message = "Mr. $user->name accepted your invitation to download '$title' this image";
	        $data = array();
	        $data["sub"] = "Invitation accepted";
	        $data["email"] = $uploader[0]->email;
	        $data["name"] = $uploader[0]->name;
	        if(new MailController($data,$message)){
	            return response()->json(["success" => true, "message" => "invitation sended successfully"]);
	        }else{
	            return response()->json(["success" => false, "message" => "Something went wrong please try again"]);
	        }
    	}
    }
}
