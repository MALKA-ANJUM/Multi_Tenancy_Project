<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $connection = 'tenant';

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}