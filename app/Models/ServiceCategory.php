<?php

namespace App\Models;
use App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

     public function services()
    {
        return $this->hasMany(Service::class);
    }
}
