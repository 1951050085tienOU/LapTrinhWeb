<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuyDinh extends Model
{
    use HasFactory;
    protected $table="QuyDinh";
    public $timestamp = false;
    public function HoaDon($value ="")
    {
        return $this->hasMany(HoaDon::class, "QuyDinhid", "id");
    }
}
