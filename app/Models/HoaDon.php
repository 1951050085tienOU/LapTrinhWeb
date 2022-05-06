<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;
    protected $table="HoaDon";
    public $timestamp = false;
    public function DoiTac($value ="")
    {
        return $this->belongsTo(DoiTac::class, "DoiTacid", "id");
    }
    public function QuyDinh($value ="")
    {
        return $this->belongsTo(QuyDinh::class, "QuyDinhid", "id");
    }
    public function ThongTinHo($value ="")
    {
        return $this->belongsTo(ThongTinHo::class, "ThongTinHoid", "id");
    }
    public function ThongTinSuCo($value ="")
    {
        return $this->hasOne(ThongTinSuCo::class, "ThongTinSuCoid", "id");
    }
}
