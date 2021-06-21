<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index() {
        //get data from table articles
        $articles = Article::latest()->get();

        //make response JSON
        return response()->json([
            'success' => 'true',
            'message' => 'List Data Articles',
            'data'  => $articles
        ], 200);
    }

    public function show($id) {
        //find ID by post
        $articles = Article::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data' => $articles
        ],200);
    }

    public function store(Request $request) {
        //set validation
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $articles = Article::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        //success save to DB
        if($articles) {
            return response()->json([
                'success' => true,
                'message' => 'Article created',
                'data' => $articles
            ], 201);
        }

        //failed save to DB
        return response()->json([
            'success' => false,
            'message' => 'Article failed to save',
        ], 409);

        // $validatedData = $request->validate([
        //     'title' => 'required',
        //     'content' => 'required',
        // ]);

    }

    public function update(Request $request, Article $articles) {
        //set validation
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find article by ID
        $articles = Article::findOrFail($articles->id);

        if($articles) {
            //update 
        }

    }



}
