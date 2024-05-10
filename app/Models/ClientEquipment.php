<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientEquipment extends Model
{
    use HasFactory;

    protected $table = "client_equipments";
    protected $primaryKey = 'client_equipment_id';

    protected $fillable = [
        'equipment_qr_id',
        'client_id',
        'client_maintenance_reminder',
        'client_reminder_days',
        'client_reminder_language',
        'client_additional_info',       
        
    ];

}
