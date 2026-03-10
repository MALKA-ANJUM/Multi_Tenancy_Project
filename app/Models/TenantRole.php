<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;

class TenantRole extends Role

{
    protected $connection = 'tenant';
}
