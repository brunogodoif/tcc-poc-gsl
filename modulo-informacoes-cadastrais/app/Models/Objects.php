<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objects extends Model
{
    use HasFactory;

    protected $table = "objects.objects";

    protected $primaryKey = 'id';
}
