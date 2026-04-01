<?php

namespace Modules\Frontend\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request)
    {
        $content = $this->movie ?? $this->episode ?? $this->video;
        
        return [
            'date' => $this->created_at->format('Y-m-d H:i:s'),
            'name' => $content ? $content->name : 'N/A',
            'type' => $this->movie ? 'Movie' : ($this->episode ? 'Episode' : 'Video'),
            'expire_date' => $this->view_expiry_date ? $this->view_expiry_date : 'N/A',
            'amount' => (float)$this->content_price,
            'discount' => (float)$this->discount_percentage ?? 0,
            'total' => (float)$this->price 
        ];
    }
} 