<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::query()->get();

        return new JsonResponse([
            'data' => $comments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $created = Comment::query()->create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'user_id' => $request->user_id
        ]);

        return new JsonResponse([
            'data' => $created
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return new JsonResponse([
            'data' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $updated = $comment->update($request->only(['body']));

        if(!$updated){
            return new JsonResponse([
                'errors' => ['failed to update']
            ], 400);
        }

        return new JsonResponse([
            'data' => $updated
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $deleted = $comment->forceDelete();

        if(!$deleted){
            return new JsonResponse([
                'errors' => [
                    'Could not delete resource'
                    ]
            ], 400);
        }

        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
