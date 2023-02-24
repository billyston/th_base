<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method relationLoaded(string $string)
 */
class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return
        [
            'type'                          => 'Project',

            'attributes'                    =>
            [
                'id'                        => $this -> resource -> id,
                'resource_id'               => $this -> resource -> resource_id,

                'name'                      => $this -> resource -> name,
                'description'               => $this -> resource -> description,

                'created_at'                => $this -> resource -> created_at -> toDateTimeString(),
                'updated_at'                => $this -> resource -> updated_at -> toDateTimeString(),
            ],

            'include'                       => $this -> when( $this -> relationLoaded( 'statuses' ) || $this -> relationLoaded( 'address' ) || $this -> relationLoaded( 'kyc' ) || $this -> relationLoaded( 'merchants' ) || $this -> relationLoaded( 'wallets' ),
            [
                'statuses'                  => StatusResource::collection( $this -> whenLoaded( 'statuses' ) ),
            ])
        ];
    }
}
