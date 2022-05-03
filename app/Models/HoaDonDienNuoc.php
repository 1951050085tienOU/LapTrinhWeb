<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonDienNuoc extends Model
{
    use HasFactory;
    protected $table="HoaDonDienNuoc";
    public $timestamp = false;
    public function HoaDon($value ="")
    {
        return $this->hasOne(HoaDon::class, "LinkId", "id");
    }
}
