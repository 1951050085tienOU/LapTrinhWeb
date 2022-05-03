<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinSuCo extends Model
{
    use HasFactory;
    protected $table="ThongTinSuCo";
    public $timestamp = false;
    public function HoaDonSuCo($value ="")
    {
        return $this->belongsTo(HoaDonSuCo::class, "id", "id");
    }
    public function ThongTinCanHo($value ="")
    {
        return $this->belongsTo(ThongTinCanHo::class, "ThongTinCanHoid", "id");
    }
    
}
