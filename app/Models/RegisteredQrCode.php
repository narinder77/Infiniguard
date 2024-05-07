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
    public function createdAt(): string
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }
    public function time(): string
    {
        return Carbon::parse($this->created_at)->format('H:i');
    }
    public function registeredEquipments()
    {
        return $this->belongsTo(GeneratedQrCode::class, 'equipment_qr_id');
    }

    public function certifiedApplicators()
    {
        return $this->belongsTo(CertifiedApplicator::class, 'applicator_id');
    }
    public function equipmentInspection()
    {
        return $this->hasMany(EquipmentInspection::class, 'inspection_equipment_qr_id','equipment_qr_id');
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
