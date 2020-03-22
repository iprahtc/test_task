<?php

namespace App\Http\Resources;

use App\Models\Publication;
use App\Models\Subscription;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data =  parent::toArray($request);

        $data['subscribers'] = $this->subscribers()->count();
        $data['subscriptions'] = $this->subscriptions()->count();
        $data['amount_publications'] = $this->publications()->count();

        return $data;
    }
}
