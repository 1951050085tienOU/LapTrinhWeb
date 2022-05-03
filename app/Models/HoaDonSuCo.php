<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonSuCo extends Model
{
    use HasFactory;
    protected $table="HoaDonSuCo";
    public $timestamp = false;
    public function HoaDon($value ="")
    {
        return $this->hasOne(HoaDon::class, "LinkId", "id");
    }
    public function ThongTinSuCo($value ="")
    {
        return $this->hasOne(ThongTinSuCo::class, "thongtinsucoId", "id");
    }
}
