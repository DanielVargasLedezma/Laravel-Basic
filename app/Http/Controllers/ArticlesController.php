<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
use App\Http\Requests\ArticlesRequest;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($last = null)
    {
        if(isset($last))
        {   
            return ArticleResource::collection(
                Article::latest()->limit(5)
                    ->get()
            );
        }
        else{
            return ArticleResource::collection(
                Article::latest()
                    ->get()
            );
        }
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlesRequest $request)
    {
        $article = Article::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => $request->input('user_id'),
        ]);

        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        if (!isset($article)) {
            return response(null, 400);
        }

        return new ArticleResource($article);
    }


    /**
     * Display the specified resource.
     *
     * @param int $user_id
     * @return \Illuminate\Http\Response
     */
    public function articlesPerUser($user_id)
    {
        if (!isset($user_id) || !is_numeric($user_id)) 
        {
            return response(null, 400);
        }

        return ArticleResource::collection(
            Article::all()->where('user_id', $user_id)
                
        );
    }

    
    /**
     * Display the specified resource.
     *
     * @param mixed $search
     * @return \Illuminate\Http\Response
     */
    public function search($search)
    {
        if (!isset($search)) 
        {
            return response(null, 400);
        }

        return ArticleResource::collection(
            Article::where('title', 'like', '%'.$search.'%')
                ->orWhere('content', 'like', '%'.$search.'%')
                ->get()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function storeImage(ImageRequest $request, Article $article)
    {
        if (!isset($article)) {
            return response([
                'status' => 'error',
                'errorMessage' => 'There was no id specified' 
            ], 400);
        }

        $request->validated();

        $newImageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        if($article->image)
        {
            $path = 'images/' . $article->image;
            File::delete($path);
        }

        $article->update([
            'image' => $newImageName
        ]);

        return new ArticleResource($article);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response image
     */
    public function getImage(Article $article)
    {
        if (!isset($article)) {
            return response([
                'status' => 'error',
                'errorMessage' => 'The article does not exist'
            ], 404);
        }

        $pathToFile = 'images/' . $article->image;

        if(!isset($pathToFile))
        {
            return response([
                'status' => 'error',
                'errorMessage' => 'The image does not exist'
            ], 404);
        }

        return response()->download($pathToFile);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticlesRequest $request, Article $article)
    {
        $article->update([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
     
        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if($article->image)
        {
            $path = 'images/' . $article->image;
            File::delete($path);
        }

        $article->delete();

        return response(null, 204);
    }
}
