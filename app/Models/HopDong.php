<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HopDong extends Model
{
    use HasFactory;
    protected $table="HopDong";
    public $timestamp = false;
    public function ThongTinCanHo($value ="")
    {
        return $this->belongsTo(ThongTinCanHo::class, "id", "id");
    }
}
