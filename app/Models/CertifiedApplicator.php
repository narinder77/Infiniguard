<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CertifiedApplicator extends Model
{
    use HasFactory;

    protected $table = "certified_applicators";
    protected $primaryKey = 'applicator_id';

    protected $fillable = [
        'applicator_certification_id',
        'applicator_provider_id',
        'applicator_name',
        'applicator_email',
        'applicator_password',
        'applicator_date',
        'applicator_language',
        'applicator_status',
    ];
    public function certifiedProviders()
    {
        return $this->belongsTo(CertifiedProvider::class, 'applicator_provider_id', 'provider_id');
    }
    public function registeredCodes()
    {
        return $this->hasMany(RegisteredQrCode::class, 'applicator_id', 'applicator_id');
    }

    public function warrantyClaims()
    {
        return $this->hasManyThrough(
            EquipmentWarrantyClaim::class,
            RegisteredQrCode::class,
            'applicator_id',
            'equipment_claim_qr_id',
            'applicator_id',
            'equipment_qr_id'
        );
    }
    /*public function applicatorDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y'),
        );
    }*/
}
