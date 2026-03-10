<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission;

class TenantPermission extends Permission
{
    use HasFactory;
     protected $connection = 'tenant';
}
