<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'city' => $this->city,
            'state' => $this->state,
            'address' => $this->address,
            'postalCode' => $this->postal_code,
        ];
    }

    public function messages(){
        //
    }
}
