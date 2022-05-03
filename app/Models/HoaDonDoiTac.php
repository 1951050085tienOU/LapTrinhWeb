<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonDoiTac extends Model
{
    use HasFactory;
    protected $table="HoaDonDoiTac";
    public $timestamp = false;
    public function HoaDon($value ="")
    {
        return $this->hasOne(HoaDon::class, "LinkId", "id");
    }
    public function DoiTac($value ="")
    {
        return $this->hasOne(DoiTac::class, "doitacId", "id");
    }
}
