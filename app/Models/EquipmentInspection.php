<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentInspection extends Model
{
    use HasFactory;
    protected $table = "equipment_inspections";
    protected $primaryKey = 'inspection_id';

    protected $fillable = [
        'inspection_equipment_qr_id',
        'inspection_condenser_image',
        'inspection_cabinet_image',
        'inspection_evaporator_image',
        'inspection_additional_image',
        'inspection_address',
        'inspection_notes',
        'inspection_latitude',
        'inspection_longitude',
        'inspection_reminder_date',
    ];

    public function InspectionCondenserImage(): Attribute
    { 
        return Attribute::make(
            set: fn ($value) => json_encode(["condenser_image" => $value]),
        );
    } 
    public function InspectionCabinetImage(): Attribute
    { 
        return Attribute::make(
            set: fn ($value) => json_encode(["cabinet_image" => $value]),
        );
    } 
    public function InspectionEvaporatorImage(): Attribute
    { 
        return Attribute::make(
            set: fn ($value) => json_encode(["evaporator_image" => $value]),
        );
    } 
    public function InspectionAdditionalImage(): Attribute
    { 
        return Attribute::make(
            set: fn ($value) => json_encode(["additional_image" => $value]),
        );
    } 
    
    /*public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-m-Y'),
        );
    }*/
    public function warrantyClaims()
    {
        return $this->hasMany(EquipmentWarrantyClaim::class, 'equipment_claim_inspection_id', 'inspection_id');
    }    
}
