<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanKhau extends Model
{
    use HasFactory;
    protected $table="NhanKhau";
    public $timestamp = false;
    protected $fillable = ['firstname', 'lastname', 'identityNumber', 'ownerIndex'];
    public function ThongTinHo($value ="")
    {
        return $this->belongsTo(ThongTinHo::class, "id", "id");
    }
}
