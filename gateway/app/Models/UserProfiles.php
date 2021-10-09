<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfiles extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = "users.profiles";

    protected $primaryKey = 'id';

    protected $fillable = [
        'description',
    ];

    public function getUsers()
    {
        return $this->hasMany(UserProfiles::class, 'profile_id', 'id');
    }
}
