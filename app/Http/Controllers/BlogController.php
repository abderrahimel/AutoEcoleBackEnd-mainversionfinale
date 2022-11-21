<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{   
    public function getBlog(){
        $blogs = Blog::all();
       foreach($blogs as $key => $blog) {
        if($blog->image){
            $blog->image = 'http://' . request()->getHttpHost() . '/' . 'blog/' .  $blog->image; 
        }
        }

         return response()->json($blogs, 200);
    }

    public function getBlogById($id){
        $blog = Blog::find($id);
        // here we convert the image to base 64 
        if($blog->image){
            $blog->image = 'http://' . request()->getHttpHost() . '/' . 'blog/' .  $blog->image;  
        }
        if(is_null($blog)){
            return response()->json(['message'=>'blog dos not exist'], 404);
        }
        
        return response()->json($blog, 200);
    }
        
    public function newBlog(request $request){
        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('blog/').$name_image);
        }
         $blog = Blog::create([
            'titre'=>$request->titre,
            'description'=>$request->description,
            'image'=>$name_image,
         ]);
         $blog->save();
         return response()->json($blog, 200);
    }
    public function updateBlogAdmin(request $request, $id){
        $blog = Blog::find($id);
        if(is_null($blog)){
            return reponse()->json(['message'=>'blog does not exist in db'], 404);
        }
        if($request->image != ''){
            $name_image = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('blog/').$name_image);
        }
         $blog->titre = $request->titre;
         $blog->description = $request->description;
         $blog->image = $name_image;
         $blog->save();
        return  response()->json($blog, 200);        
    }
    public function deletBlog($id){
        $blog = Blog::find($id);
        if(is_null($blog)){
            return response()->json(['message'=>'blog does not exist in db'], 404);
        }
        $blog->delete();
        return response()->json(['message'=>'blog deleted from db'], 200);
    }
}
