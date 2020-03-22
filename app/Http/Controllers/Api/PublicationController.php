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
     * @param $id
     * @return PublicationResource|\Illuminate\Http\JsonResponse
     */
    public function show(Publication $publication, $id)
    {
        $new = $publication->find($id);

        if($new)
            return new PublicationResource($new);
        else
            return $this->getModelNotFound(__('massages.model_not_found'));
    }

    /**
     * @param PublicationRequest $request
     * @param Publication $publication
     * @param $id
     * @return PublicationResource|\Illuminate\Http\JsonResponse
     */
    public function update(PublicationRequest $request, Publication $publication, $id)
    {
        $new = auth()->user()->publications()->find($id);

        if($new){
            $new->update($request->validated());
            return new PublicationResource($new);
        }
        else
            return $this->getModelNotFound(__('massages.model_not_found'));
    }

    /**
     * @param Publication $publication
     * @param $id
     * @return PublicationResource|\Illuminate\Http\JsonResponse
     */
    public function destroy(Publication $publication, $id)
    {
        $new = auth()->user()->publications()->find($id);

        if($new){
            $new->delete();
            return $this->getSuccessResponse();
        }
        else
            return $this->getModelNotFound(__('massages.model_not_found'));
    }

    public function getUserPublications(){
        return new PublicationResource(auth()->user()->publications()->paginate(10));
    }
}
