<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyDetails extends Model
{
    use HasFactory;
    protected $table='property_details';
    protected $primaryKey='property_details_id';
}