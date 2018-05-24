<?php

namespace App\Http\Controllers;

use App\PublishPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\MailController;
use App\Http\Resources\PhotoResource;
use Auth;
use File;

class PublishPhotoController extends Controller
{
   
    public function index()
    {
       return PublishPhoto::where('admin', Auth::id())->latest()->paginate(20);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|unique:publish_photos|min:10|max:140',
            'image' => 'required'
        ]);

        $image = $request->image;
        $extension = $image->getClientOriginalExtension();

        $allowed = array('jpg', 'png', 'jpeg', 'svg');
        if(in_array(strtolower($extension), $allowed)){
            $imageid = uniqid('120asfdhgsiufdhbipo');
            $imagename = $imageid.".".$extension;
            $url = 'images/'.$imagename;
            $inputs = ['title' => $request->title, 'description' => $request->description, 'status' => $request->status, 'image' => $url, 'admin' => Auth::id()];
            $store = PublishPhoto::create($inputs);
            if($store){
                $image->move(base_path()."/public/images", $imagename);
                return response()->json(['success' => true, 'message' => 'Photo uploaded', 'lastId' => $store->id]);
            }else{
                return response()->json(['success' => false, 'message' => 'Photo uploaded failed']);
            }
        }else{
            return response()->json(['success' => false, 'message' => 'This is not allowed']);
        }

        
    }

    public function show(PublishPhoto $publishPhoto, $id)
    {
        return PublishPhoto::where('id', $id)->where('admin', Auth::id())->get();
    }

    public function update(Request $request, PublishPhoto $publishPhoto) {
        $obj = PublishPhoto::where('id', $request->id)
                            ->where('admin', Auth::id())
                            ->update([
                                'title' => $request->title,
                                'description' => $request->description,
                                'status' => $request->status
                            ]);

        if($obj){
            return response()->json(['success' => true, 'message' => 'Edited successfully']);
        }else{
            return response()->json(['success' => false, 'message' => 'Nothing to edit']);
        }

    }

    
    public function destroy($id) {
        $post = PublishPhoto::where('id', $id)->where('admin', Auth::id())->first();
        if(File::delete($post->image)){
            if($post->delete()){
                return response()->json(['success' => true, 'message' => 'Post deleted successfully']);;
            }else{
                return response()->json(['success' => false, 'message' => 'Something went wrong please try again']);
            }
        }else{
            return response()->json(['success' => false, 'message' => 'Something went wrong please try again']);
        }
    }
    function send(Request $request){
        $message = "Hey! Download my image from here $request->url";
        $data = array();
        $data["sub"] = "Download image";
        $data["email"] = $request->email;
        $data["name"] = $request->sendername;
        if(new MailController($data,$message)){
            return response()->json(["success" => true, "message" => "invitation sended successfully"]);
        }else{
            return response()->json(["success" => false, "message" => "Something went wrong please try again"]);
        }
    }
}
