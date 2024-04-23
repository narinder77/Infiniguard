<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    protected $table = "clients";
    protected $primaryKey = 'client_id';

    protected $fillable = [
        'client_provider_id',
        'client_company_name',
        'client_firstname',
        'client_lastname',
        'client_email',
        'client_phone',
        'client_password',
        'client_status',
        'client_otp',
    ];
    public function certifiedProviders()
    {
        return $this->belongsTo(CertifiedProvider::class, 'client_provider_id');
    }
 
}
