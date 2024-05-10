<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratedQrCode extends Model
{
    use HasFactory;

    protected $table = "generated_qr_codes";
    protected $primaryKey = 'equipment_qr_id';

    protected $fillable = [
        'equipment_qr_id',
    ];

    public function registeredCodes()
    {
        return $this->hasMany(RegisteredQrCode::class, 'equipment_qr_id','equipment_qr_id');
    }
    public function warrantyClaims()
    {
        return $this->hasMany(EquipmentWarrantyClaim::class, 'equipment_claim_qr_id', 'equipment_qr_id');
    }

    public function equipmentInspection()
    {
        return $this->hasMany(EquipmentInspection::class, 'inspection_equipment_qr_id','equipment_qr_id');
    }
    public function clientEquipment()
    {
        return $this->hasMany(ClientEquipment::class,'equipment_qr_id');        
    }
}
