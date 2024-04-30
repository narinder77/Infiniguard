<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientEquipment extends Model
{
    use HasFactory;

    protected $table = "client_equipments";
    protected $primaryKey = 'client_equipment_id';

}
