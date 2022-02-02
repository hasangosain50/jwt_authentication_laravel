<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyList extends Model
{
    use HasFactory;
    protected $table='property_lists';
    protected $primaryKey='property_list_id';
    public function PropertyDetailsinfo(){
        return $this->hasMany('App\Models\PropertyDetails');
        
    }
}
