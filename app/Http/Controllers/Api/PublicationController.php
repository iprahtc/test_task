<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publication\PublicationRequest;
use App\Http\Requests\Publication\UpdatePublicationRequest;
use App\Http\Resources\PublicationResource;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PublicationResource::collection(Publication::paginate(10));
    }

    /**
     * @param PublicationRequest $request
     * @return PublicationResource
     */
    public function store(PublicationRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $publication = Publication::create($data);

        return new PublicationResource($publication);
    }

    /**
     * @param Publication $publication
     * @return PublicationResource|\Illuminate\Http\JsonResponse
     */
    public function show(Publication $publication)
    {
        return new PublicationResource($publication);
    }

    /**
     * @param PublicationRequest $request
     * @param Publication $publication
     * @return PublicationResource|\Illuminate\Http\JsonResponse
     */
    public function update(PublicationRequest $request, Publication $publication)
    {
        if($publication->user_id === auth()->user()->id){
            $publication->update($request->validated());
            return new PublicationResource($publication);
        }
        else
            return $this->getModelNotFound(__('massages.model_not_found'));
    }

    /**
     * @param Publication $publication
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Publication $publication)
    {
        if($publication->user_id === auth()->user()->id){
            $publication->delete();
            return $this->getSuccessResponse();
        }
        else
            return $this->getModelNotFound(__('massages.model_not_found'));
    }

    public function getUserPublications(){
        return new PublicationResource(auth()->user()->publications()->paginate(10));
    }
}
