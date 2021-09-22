<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
use App\Http\Requests\ArticlesRequest;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\File;

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
                Article::all()->limit(5)
            );
        }
        else{
            return ArticleResource::collection(
                Article::all()
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
            return response(500)->json(null);
        }

        return new ArticleResource($article);
    }


    /**
     * Display the specified resource.
     *
     * @param  User::class->id
     * @return \Illuminate\Http\Response
     */
    public function articlesPerUser($user_id)
    {
        if (!isset($user_id) || !is_numeric($user_id)) 
        {
            return response(500)->json([]);
        }

        return ArticleResource::collection(
            Article::all()->where('user_id', $user_id)
                
        );
    }


    public function storeImage(ImageRequest $request, Article $article)
    {
        if (!isset($article)) {
            return response(500)->json(null);
        }

        $request->validated();

        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();

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


    public function getImage(Article $article)
    {
        if (!isset($article)) {
            return response(500)->json(null);
        }

        $pathToFile = $article->image;

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
        $article->delete();

        return response(null, 204);
    }
}
