<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\NhanKhau;
use App\Models\HopDong;
use App\Models\ThongTinCanHo;
use App\Models\ThongTinSuCo;
use App\Models\HoaDon;
use App\Models\HoaDonDienNuoc;
use App\Models\HoaDonDoiTac;
use Illuminate\Support\Facades\Auth;

class layoutController extends Controller
{
    public function index()
    {
        $missedIndividualCount = 0;
        $tongCacCanHo= 0;
        $soCanHoKhongTrong= 0;
        $reportCount  = 0;
        $demNhanKhau = 0;
        $debtBill = 0;
        $CustomerBillCount = 0;
        $partnetBillCount = 0;
        $totalElectricity = 0;
        $totalWater = 0;
        // Missed Individual
        $nhankhau = NhanKhau::all();
        foreach($nhankhau as $nk)
        {
            if($nk->identityNumber == null or $nk->lastname == "" or $nk->firstname =="")
            {
                $missedIndividualCount++;
                $demNhanKhau++;
            }
        }
        //Empty
        $CanHo = ThongTinCanHo::all();
        $CanHoKhongTrong = DB::table('thongtincanho')
        ->join('hopdong', function ($join) {
            $join->on('thongtincanho.id', '=', 'hopdong.apartmentNo');
        })
        ->get();
        foreach($CanHo as $a)
        {
            $tongCacCanHo++;
        }
        foreach($CanHoKhongTrong as $b)
        {
            $soCanHoKhongTrong++;
        }
        $empty = $tongCacCanHo - $soCanHoKhongTrong;
       // Report so cac su co chua duoc xu ly
       $cacSuCo = ThongTinSuCo::all();
       foreach($cacSuCo as $csc)
       {
           if($csc->HoaDonId == null)
           {
               $reportCount++;
           }
        }

        // debt bills
        $hoaDon = HoaDon::all();
        foreach($hoaDon as $h)
        {
            if($h->paid == null)
            {
                $debtBill++;
            }
        }


        //customer bills
        $hoaDonDienNuoc = DB::table('hoadon')
        ->join('hoadondiennuoc', function ($join) {
            $join->on('hoadon.id', '=', 'hoadondiennuoc.linkId');
        })
        ->get();
        foreach($hoaDonDienNuoc as $hddn)
        {
            if($hddn->paid==null)
            {
                $CustomerBillCount++;
            }
            $totalElectricity+=$hddn->electricity;
            $totalWater+=$hddn->water;

        }
        //partner bills
        $hoaDonDoiTac = DB::table('hoadon')
        ->join('hoadondoitac', function ($join) {
            $join->on('hoadon.id', '=', 'hoadondoitac.linkId');
        })
        ->get();
        foreach($hoaDonDoiTac as $hddt)
        {
            if($hddt->paid==null)
            {
                $partnetBillCount++;
            }
        }
        return view('layout', compact('empty', 'missedIndividualCount','reportCount', 'tongCacCanHo','demNhanKhau','debtBill','CustomerBillCount','partnetBillCount'));
    }
}
