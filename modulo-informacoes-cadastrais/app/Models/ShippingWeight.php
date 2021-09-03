<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingWeight extends Model
{
    use HasFactory;

    protected $table = "freight.shipping_weight";

    protected $primaryKey = 'id';
}
