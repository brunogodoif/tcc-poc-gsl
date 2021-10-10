<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objects extends Model
{
    use HasFactory;

    protected $table = "objects.objects";

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'description',
    ];


    public function tracking()
    {
        return $this->hasMany(ObjectsTracking::class, 'tracking_code', 'tracking_code')->orderBy('id', 'ASC');
    }
}
