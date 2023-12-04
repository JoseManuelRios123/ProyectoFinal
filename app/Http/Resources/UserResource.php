<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                "id"=> $this->id,
                "Name"=> $this->name,
                "email"=> $this->email,
                "status"=> $this->status,
                "email_verified_at"=> $this->email_verified_at,
                "two_factor_confirmed_at"=> $this->two_factor_confirmed_at,
                "current_team_id"=> $this->current_team_id,
                "profile_photo_path"=> $this->profile_photo_path,
                "created_at"=> $this->created_at,
                "updated_at"=> $this->updated_at,
                "profile_photo_url"=> $this->profile_photo_url,
        ];
    }
}
