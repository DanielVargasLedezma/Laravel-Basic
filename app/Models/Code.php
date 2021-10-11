<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'codes';

    protected $primaryKey = 'code_id';

    protected $fillable = ['code', 'user_id'];

    protected $hidden = ['code_id'];
}
