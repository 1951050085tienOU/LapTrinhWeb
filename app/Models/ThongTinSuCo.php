<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinSuCo extends Model
{
    use HasFactory;
    protected $table="ThongTinSuCo";
    protected $fillable = ['description', 'date', 'apartmentNo', 'createdBy', 'ThongTinCanHoid'];
    public $timestamp = false;
    public function HoaDon($value ="")
    {
        return $this->belongsTo(HoaDon::class, "id", "id");
    }
    public function ThongTinCanHo($value ="")
    {
        return $this->belongsTo(ThongTinCanHo::class, "ThongTinCanHoid", "id");
    }
    
}
