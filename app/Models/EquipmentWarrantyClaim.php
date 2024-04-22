<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentWarrantyClaim extends Model
{
    use HasFactory;

    protected $table = "equipment_warranty_claims";
    protected $primaryKey = 'equipment_claim_id';


    public function inspection()
    {
        return $this->belongsTo(EquipmentInspection::class, 'equipment_claim_inspection_id', 'inspection_id');
    }
    
    public function qrCode()
    {
        return $this->belongsTo(GeneratedQrCode::class, 'equipment_claim_qr_id', 'equipment_qr_id');
    }
}
