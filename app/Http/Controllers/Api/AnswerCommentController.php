<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerCommentRequest;
use App\Http\Resources\AnswerCommentResource;
use App\Models\AnswerComment;
use Illuminate\Http\Request;

class AnswerCommentController extends Controller
{
    /**
     * @return AnswerCommentResource
     */
    public function index()
    {
        $answerComment = auth()->user()->answerComments()->get();

        return new AnswerCommentResource($answerComment);
    }

    /**
     * @param AnswerCommentRequest $request
     * @return AnswerCommentResource
     */
    public function store(AnswerCommentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        $answerComment = AnswerComment::create($data);

        return new AnswerCommentResource($answerComment);
    }

    /**
     * @param AnswerComment $answerComment
     * @return AnswerCommentResource
     */
    public function show(AnswerComment $answerComment)
    {
        return new AnswerCommentResource($answerComment);
    }

    /**
     * @param AnswerCommentRequest $request
     * @param AnswerComment $answerComment
     * @return AnswerCommentResource|\Illuminate\Http\JsonResponse
     */
    public function update(AnswerCommentRequest $request, AnswerComment $answerComment)
    {
        if($answerComment->user_id === auth()->user()->id) {
            $answerComment->update($request->validated());
            return new AnswerCommentResource($answerComment);
        }
        else
            return $this->getModelNotFound(__('massages.model_not_found'));
    }

    /**
     * @param AnswerComment $answerComment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(AnswerComment $answerComment)
    {
        if($answerComment->user_id === auth()->user()->id){
            $answerComment->delete();
            return $this->getSuccessResponse();
        }
        else
            return $this->getModelNotFound(__('massages.model_not_found'));
    }
}
