<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
      
    /**
     * index
     *
     * @return void
     */
    public function index($offset = null, $limit = null)
    {
        //get data from table posts
        $posts = Post::select('title', 'content', 'category', 'status')->orderBy('created_at', 'DESC')->offset($offset)->limit($limit)->get();
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Post',
            'data'    => $posts  
        ], 200);

    }
    
     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $post = Post::select('title', 'content', 'category', 'status')->where('id', $id)->get();

        if($post){
            //make response JSON
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Post',
                'data'    => $post 
            ], 200);
        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Post Not Found',
        ], 404);

    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
         //set message validation
         $messages = [
            'min' => ':attribute minimal :min karakter.',
            'required' => ':attribute tidak boleh kosong.',
            'in' => 'data yang harus di input: publish, draft, trash.'
        ];

        //set rules
        $rules = [
            'title'    => 'required|min:20',
            'category' => 'required|min:3',
            'content'  => 'required|min:200',
            'status'   => 'required|in:publish,draft,trash',
        ];

        //set validation
        $validator = Validator::make($request->all(), $rules, $messages);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $post = Post::create([
            'title'     => $request->title,
            'category'  => $request->category,
            'content'   => $request->content,
            'status'    => $request->status,
        ]);

        //success save to database
        if($post) {

            return response()->json([
                'success' => true,
                'message' => 'Post Created'
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Post Failed to Save',
        ], 409);

    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, $id)
    {
        //set message validation
        $messages = [
            'min' => ':attribute minimal :min karakter.',
            'required' => ':attribute tidak boleh kosong.',
            'in' => 'data yang harus di input: publish, draft, trash.'
        ];

        //set rules
        $rules = [
            'title'    => 'required|min:20',
            'category' => 'required|min:3',
            'content'  => 'required|min:200',
            'status'   => 'required|in:publish,draft,trash',
        ];

        //set validation
        $validator = Validator::make($request->all(), $rules, $messages);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find post by ID
        $post = Post::findOrFail($id);

        if($post) {

            //update post
            $post->update([
                'title'     => $request->title,
                'category'  => $request->category,
                'content'   => $request->content,
                'status'    => $request->status,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post Updated'
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Post Not Found',
        ], 404);

    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find post by ID
        $post = Post::findOrfail($id);

        if($post) {

            //delete post
            $post->delete();

            return response()->json([
                'success' => true,
                'message' => 'Post Deleted',
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Post Not Found',
        ], 404);
    }
}
