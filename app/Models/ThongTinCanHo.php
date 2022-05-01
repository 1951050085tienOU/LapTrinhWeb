<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinCanHo extends Model
{
    use HasFactory;
    protected $table="ThongTinCanHo";
    public $timestamp = false;
    public function ThongTinSuCo($value ="")
    {
        return $this->hasMany(ThongTinSuCo::class, "ThongTinCanHoid", "id");
    }
    public function HopDong($value ="")
    {
        return $this->hasOne(HopDong::class, "id", "id");
    }
    public function ThongTinHo($value ="")
    {
        return $this->belongsTo(ThongTinHo::class, "id", "id");
    }
}
