<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegisteredQrCode extends Model
{
    use HasFactory;
    protected $table = "registered_qr_codes";
    protected $primaryKey = 'id';

    protected $fillable = [
        'equipment_qr_id',
        'applicator_id',
        'condenser',
        'cabinet',
        'evaporator',
        'model_number_image',
        'serial_number_image',
        'distant_image',
        'additional_image',
        'equipment_type',
        'notes',
        'address',
        'latitude',
        'longitude',
    ];
    protected $casts = [
        'additional_image' => 'json',
    ];
    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y'),
        );
    }
    public function registeredEquipments()
    {
        return $this->belongsTo(GeneratedQrCode::class, 'equipment_qr_id');
    }

    public function certifiedApplicators()
    {
        return $this->belongsTo(CertifiedApplicator::class, 'applicator_id');
    }
    public function EquipmentInspection()
    {
        return $this->belongsTo(EquipmentInspection::class, 'equipment_qr_id');
    }

    public function certifiedProviders()
    {
        return $this->hasOneThrough(
            CertifiedProvider::class,
            CertifiedApplicator::class,
            'applicator_id',
            'provider_id',
            'applicator_id',
            'applicator_provider_id'
        );
    }
}
