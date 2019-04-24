<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SchoolModel extends Model
{
     protected $table = "perlengkapan_sekolah";
    protected $guarded = [];
    public $timestamps = false;
}
