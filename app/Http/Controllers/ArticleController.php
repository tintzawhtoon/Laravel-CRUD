<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function index()
    {
        $article = Article::latest()->paginate(5);
        return view('articles.index', [
            'articles' => $article
        ]);
    }

    public function detail($id)
    {
        $article = Article::find($id);
        return view('articles.detail', [
            'article' => $article
        ]);
    }

    public function add()
    {
        $category = Category::all();
        return view('articles.add', [
            'categories' => $category
        ]);
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();
        return redirect('/articles');
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if(Gate::allows('article-delete', $article)) {
            $article->delete();
            return redirect('/articles')->with("info", "An article was deleted");
        }


        return back()->with("info", "Unauthorize to delete this article.");
    }



    public function edit($id)
    {
        $article = Article::find($id);
        $category = Category::all();
        if(Gate::allows('article-delete', $article)) {
            return view('articles.edit', [
                'article' => $article,
                'categories' => $category
            ]);
        }

        return back()->with("info", "Unauthorize to edit this article.");

    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $article = Article::find($id);
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->save();
        return redirect('/articles')->with("update", "An article was updated successfully.");
    }
}
