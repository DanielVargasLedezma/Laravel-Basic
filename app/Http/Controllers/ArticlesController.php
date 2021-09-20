<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    /*
    Returns all the articles, if the parameter last is received then return last 5 articles;
    It return all of them by the newest to the oldest
    */
    public function getArticles($last = null)
    {
        if (!$last) {
            // $articles = DB::select('select * from articles order by created_at desc');
            $articles = DB::table('articles')
                ->latest()
                ->get();

            dd($articles);
        } else {
            $articles = DB::table('articles')
                ->latest()
                ->limit(5)
                ->get();

            dd($articles);
        }
    }

    /*
    Returns the article that has the same id that is received by parameters
    */
    public function getArticle($id)
    {
        // $article = DB::select('select * from articles where id = :id', ['id' => $id]);

        $article = DB::table('articles')
            ->find($id)
            ->get();

        dd($article);
    }

    public function createArticle()
    {
        
    }

    public function deleteArticle($id)
    {
        $article = DB::table('articles')
            ->where('id', $id)
            ->delete();

        dd($article);
    }
}
