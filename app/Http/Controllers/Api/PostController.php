<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Post;
use Validator;
class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();
        return $this->sendResponse($post->toArray(), 'post retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $post = Post::create($input);
        return $this->sendResponse($post->toArray(), 'Product created successfully.');
    }

    public function show($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return $this->sendError('post not found.');
        }
        return $this->sendResponse($post->toArray(), 'post retrieved successfully.');
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $post = Post::find($id);
        $post->title = $input['title'];
        $post->description = $input['description'];
        $post->save();
        return $this->sendResponse($post->toArray(), 'post updated successfully.');
    }

    public function destroy($id)
    {        
        $post = Post::find($id);
        $post->delete();
        return $this->sendResponse($post->toArray(), 'post deleted successfully.');
    }
}
