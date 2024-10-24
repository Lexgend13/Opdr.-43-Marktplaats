<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Bidding;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


// TODO :: Return types aangeven bij methods, zodat voor iedereen duidelijk is wat er moet worden terug gestuurd en er errors komen als je iets anders terug stuurt.

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Article $article, Request $request)
    {
        $articlesQuery = Article::with(['categories', 'users']);
        $articles = $articlesQuery->orderByDesc('is_promoted')->orderByDesc('updated_at')->simplePaginate(10);
        //$articles = $article->with(['categories', 'users'])->get()->sortByDesc('is_promoted');
        //dd($articles);
        if ($request->has('category')) {
            $categoryId = $request->input('category');
            $articles = $articles->filter(fn($article) => $article->categories->contains('id', $categoryId));
        }
        
        if ($request->has('userId')) {
            $userId = $request->input('userId');
            $articles = $articles->filter(fn($article) => $article->user_id == $userId);
        }
        return view('marktplaats.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        $categories = $category->all();
        return view('marktplaats.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $validatedData = $request->validated();
        $categories = $validatedData['categories'];
        unset($validatedData['categories']);
        if ($request->file('image_path')) {
            $validatedData["image_path"] = $request->file('image_path')->store();
        };
        $article = Article::create($validatedData);
        $article->categories()->attach($categories);
                
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $article->load(['categories', 'users']);
        $biddings = $article->biddings()->with('user')->orderByDesc('amount')->get();

        return view('marktplaats.article', ['article' => $article, 'biddings' => $biddings, 'img_path' => Storage::url($article->image_path)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article, Category $category)
    {
        $article->with(['categories', 'users'])->get();
        $categories = $category->all();
        return view('marktplaats.edit', ['article' => $article, 'categories' => $categories, 'img_path' => Storage::url($article->image_path)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $validatedData = $request->validated();
        if ($validatedData['image_path'] == null) {
            unset($validatedData['image_path']);
        }
        //dd($validatedData);
        $article->categories()->sync($validatedData['categories'] ?? []);
        unset($validatedData['categories'], $validatedData['fileToUpload']);
        
        
        $article->update($validatedData);
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.show');
    }

    public function search(Request $request)
    {
        // TODO: aparte form reuqest validation class voor maken
        $request->validate([
            'query' => 'required|min:3'
        ]);
    $query = $request->input('query');
    $articles = Article::with(['categories', 'users'])->where('title', 'like', "%$query%")->paginate(10);
    //dd($articles);

    return view('marktplaats.index', ['articles' => $articles]);
    }
}
