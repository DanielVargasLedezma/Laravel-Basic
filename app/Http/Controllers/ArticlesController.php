<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $id)
    {
        // if (!isset($id) || !is_numeric($id)) {
        //     return response(500)->json([]);
        // }

        // $article = Article::find($id);

        // return response()->json([
        //     'id' => $article->id,
        //     'type' => 'Articles',
        //     'attributes' => [
        //         'title' => $article->title,
        //         'content' => $article->content,
        //         'user_id' => $article->user_id,
        //         'image' => $article->image,
        //         'created_at' => $article->created_at,
        //     ],
        // ]);

        return new ArticleResource($id);
    }


    /**
     * Display the specified resource.
     *
     * @param  anything, if NULL then does not return it capped
     * @return \Illuminate\Http\Response
     */
    public function showMultiple($last = null)
    {
        // if (!$last) {
        //     // $articles = DB::select('select * from articles order by created_at desc');
        //     $articles = DB::table('articles')
        //         ->latest()
        //         ->get();

        //     dd($articles);
        // } else {
        //     $articles = DB::table('articles')
        //         ->latest()
        //         ->limit(5)
        //         ->get();

        //     dd($articles);
        // }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
