<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectsTracking extends Model
{
    use HasFactory;

    protected $table = "objects.objects_tracking";

    protected $primaryKey = 'id';


    public function getObject()
    {
        return $this->belongsTo(Objects::class, 'tracking_code', 'tracking_code');
    }
}
