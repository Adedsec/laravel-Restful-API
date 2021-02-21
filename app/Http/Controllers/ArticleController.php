<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $articles = Article::paginate();
        return response()->json(new ArticleCollection($articles), 200);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validateArticle($request);
        Article::create([
            'user_id' => auth('api')->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $this->uploadImage($request)
        ]);

        return response()->json([
            'message' => 'created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        $article = Article::FindOrFail($id);
        return response()->json([
            "data" => new ArticleResource($article)
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        return response()->json([
            'message' => 'updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Article::findOrFail($id)->delete();

        return response()->json([
            'message' => 'deleted'
        ], 200);
    }

    private function validateArticle(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'image' => ['required']
        ]);
    }

    private function uploadImage(Request $request)
    {
        return $request->hasFile('image')
            ? $request->image->store('public')
            : null;
    }
}
