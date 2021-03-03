<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profiles extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $date = ['deleted_at'];
    public $timetamps = false;
    public $fillable = ['ima_profile', 'persons_id'];

    public function persons () {
        return $this->belongsToMany('App\Persons')->withTimestamps();
    }

}
