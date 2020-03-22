<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PublicationResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $comments = Comment::with([
            'answerComments',
        ])->where('user_id', auth()->user()->id)->get();

        return CommentResource::collection($comments);
    }

    /**
     * @param CommentRequest $request
     * @return CommentResource
     */
    public function store(CommentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        $comment = Comment::create($data);

        return new CommentResource($comment);
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function show(Comment $comment)
    {

        $comments = $comment->with([
            'answerComments',
        ])->where('user_id', auth()->user()->id)->get();

        return CommentResource::collection($comments);
    }

    /**
     * @param CommentRequest $request
     * @param Comment $comment
     * @return CommentResource|\Illuminate\Http\JsonResponse
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        if($comment->user_id === auth()->user()->id) {
            $comment->update($request->validated());
            return new CommentResource($comment);
        }
        else
            return $this->getModelNotFound(__('massages.model_not_found'));
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment)
    {
        if($comment->user_id === auth()->user()->id){
            $comment->delete();
            return $this->getSuccessResponse();
        }
        else
            return $this->getModelNotFound(__('massages.model_not_found'));
    }
}
