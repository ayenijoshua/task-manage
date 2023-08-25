<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function task(){
        return $this->hasOne(Category::class);
    }
}
