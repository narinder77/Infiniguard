<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * Get the certified provider associated with the client.
     */
    public function certifiedProvider()
    {
        return $this->belongsTo(CertifiedProvider::class, 'client_provider_id', 'provider_id');
    }
}
