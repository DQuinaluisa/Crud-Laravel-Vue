<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persons extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $date = ['deleted_at'];

    protected $fillable = [
        'first_name',
        'last_name',
        'description',
    ];

    public function profiles () {
        return $this->hasOne('App\Profile')->withTimestamps();
    }

}
