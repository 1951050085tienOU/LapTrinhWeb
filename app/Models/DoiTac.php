<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoiTac extends Model
{
    use HasFactory;
    protected $table="DoiTac";
    public $timestamp = false;
    public function HoaDon($value ="")
    {
        return $this->hasMany(HoaDon::class, "DoiTacid", "id");
    }
}
