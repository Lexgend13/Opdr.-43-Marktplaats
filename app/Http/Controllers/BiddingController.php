<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Bidding;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\StoreBiddingRequest;

use Illuminate\Http\Request;

class BiddingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBiddingRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['article_id'] = $request->article_id;
        $validatedData['user_id'] = auth()->id();
        Bidding::create($validatedData);
        return redirect()->route('articles.show', ['article' => $request->article_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bidding $bidding, Request $request)
    {
        $bidding->delete();
        //return redirect('http://localhost:8000/articles/' . $article);
        return redirect()->route('articles.show', ['article' => $request->get("article")]);

    }
}
