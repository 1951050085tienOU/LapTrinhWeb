<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinHo extends Model
{
    use HasFactory;
    protected $table="ThongTinHo";
    public $timestamp = false;
    public function HoaDon($value ="")
    {
        return $this->hasMany(HoaDon::class, "ThongTinHoid", "id");
    }
    public function NhanKhau($value ="")
    {
        return $this->hasOne(NhanKhau::class, "id", "id");
    }
    public function ThongTinCanHo($value ="")
    {
        return $this->hasOne(ThongTinCanHo::class, "id", "id");
    }
}
