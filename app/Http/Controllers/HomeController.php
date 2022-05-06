<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;
use App\Exceptions\Handler;

use App\Models\HopDong;
use App\Models\ThongTinCanHo;
use App\Models\NhanKhau;
use App\Models\ThongTinHo;
use App\Models\ThongTinSuCo;
use App\Models\HoaDon;
use DateTime;
use Exception;
use PhpParser\NodeVisitor\FirstFindingVisitor;

use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $url = action('HomeController@index');
        $param = $request->query('tab-selection');
        $tabSelection = $param ? $param : 1;
        $table_results = [];
        $contentSearch = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tableName = $request->get('table-name');
            $contentSearch = $request->get('search-bar');
            $tabSelection = $request->get('tab-selection');

            if ($contentSearch != "") {
                switch ($tableName) {
                    case "hopdong":
                        $table_results = HopDong::where('id', $contentSearch)->get();
                        break;
                    case "thongtincanho":
                        $table_results = ThongTinCanHo::where('id', $contentSearch)->get();
                        break;
                    case "nhankhau":
                        $table_results = NhanKhau::where('id', $contentSearch)->orWhere('identityNumber', $contentSearch)
                            ->orWhere('lastname', $contentSearch)->get();
                        break;
                    case "thongtinsuco":
                        $table_results = ThongTinSuCo::where('id', $contentSearch)->get();
                        break;
                    case "hoadon_kh":
                        $table_results = HoaDon::where('moneyIn', '1')->where('id', $contentSearch)->get();
                        break;
                    case "hoadon_dt":
                        $table_results = HoaDon::where('moneyIn', '0')->where('id', $contentSearch)->get();
                        break;
                }
            }
        }
        else {
            if (empty($param)) {
                return redirect() -> action(
                    [HomeController::class, 'index'], ['tab-selection' => 1]
                );
            }
            if (auth()->user()->Role == 'Manager') {
                if ($tabSelection == 2) {
                    $table_results = HopDong::all();
                }
                else if ($tabSelection == 3) {
                    $table_results = ThongTinCanHo::all();
                }
                else if ($tabSelection == 4) {
                    $table_results = NhanKhau::all();
                }
                else if ($tabSelection == 5) {
                    $table_results = ThongTinSuCo::all();
                }
            }
            else {
                if ($tabSelection == 3) {
                    $table_results = HoaDon::where('moneyIn', '1')->get();
                }
                else if ($tabSelection == 4) {
                    $table_results = HoaDon::where('moneyIn', '0')->get();
                }
            }
        }

        return view('home', compact('table_results', 'tabSelection', 'contentSearch'));
    }

    public function update(Request $request) {
        $tableName =  $request->json('table');
        $value = array();
        $count = 0;
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        while (true) {
            $val = $request->json('val' . str($count));
            if ($val == "") {
                break;
            }
            $count += 1;
            if ($val == 'null') {
                array_push($value, '');
                continue;
            }
            array_push($value, $val);
        }
        $out->writeln($tableName);
        foreach ($value as $vl) {
            $out->writeln($vl);
        }

        switch ($tableName) {
            case "hopdong":
                $hopdong = HopDong::where('id', $value[0])->first();
                $out->writeln($hopdong);
                try {
                    $hopdong->timestamps = false;
                    $hopdong->save();
                    $hopdong->update(array(
                        "path" => $value[1],
                        "date" => $value[2],
                        "apartmentNo" => $value[3],
                        "createdBy" => $value[4]
                    ));
                } catch (\Exception $ex) {
                    $out->writeln($ex->getMessage());
                }
                $out->writeln($hopdong);
                
                return response()->json([
                    'status' => 'success'
                ], 200);
                break;
            case "thongtincanho":
                break;
            case "nhankhau":
                $nhankhau =NhanKhau::where('id', $value[0])->first();
                $out->writeln($nhankhau);
                try {
                    $nhankhau->timestamps = false;
                    $nhankhau->save();
                    $name = [];
                    $this->FirstAndLastName($value[1], $name);
                    $nhankhau->update(array(
                        "firstname" => $name['firstname'],
                        "lastname" => $name['lastname'],
                        "identityNumber" => $value[2],
                        "ownerIndex" => $value[3]
                    ));
                } catch (\Exception $ex) {
                    $out->writeln($ex->getMessage());
                }
                $out->writeln($nhankhau);
                return response()->json([
                    'status' => 'success'
                ], 200);
                break;
            case 'thongtinsuco':
                break;
            case 'hoadon_kh': case 'hoadon_dt':
                $hoadon = HoaDon::where('id', $value[0])->first();
                $out->writeln($hoadon);
                try {
                    $hoadon->timestamps = false;
                    $hoadon->save();
                    $hoadon->update(array(
                        "description" => $value[1],
                        "createdDate" => $value[2],
                        "path" => $value[3],
                        "whoPay" => $value[4],
                        "createdBy" => auth()->user()->id
                    ));
                } catch (\Exception $ex) {
                    $out->writeln($ex->getMessage());
                }
                $out->writeln($hoadon);
                return response()->json([
                    'status' => 'success'
                ], 200);
                break;
        }

        return response()->json([
            'status' => 'failed'
        ], 500);
    }

    public function delete(Request $request) {
        $tableName =  $request->json('table');
        $value = array();
        $count = 0;
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        while (true) {
            $val = $request->json('val' . str($count));
            if ($val == "") {
                break;
            }
            $count += 1;
            if ($val == 'null') {
                array_push($value, '');
                continue;
            }
            array_push($value, $val);
        }
        $out->writeln($tableName);
        foreach ($value as $vl) {
            $out->writeln($vl);
        }
        switch ($tableName) {
            case 'hopdong':
                $hopdong = HopDong::where('id', $value[0])->first();
                try {
                    $hopdong->delete();
                } catch (\Exception $ex) {
                    $out->writeln($ex->getMessage());
                }
                return response()->json([
                    'status' => 'success'
                ], 200);
                break;
            case 'thongtincanho':
                break;
            case 'nhankhau':
                $nhankhau = NhanKhau::where('id', $value[0])->first();
                try {
                    $nhankhau->delete();
                } catch (\Exception $ex) {
                    $out->writeln($ex->getMessage());
                }
                return response()->json([
                    'status' => 'success'
                ], 200);
                break;
            case 'thongtinsuco':
                break;
            case 'hoadon_kh': case "hoadon_dt":
                $hoadon = HoaDon::where('id', $value[0])->first();
                try {
                    $hoadon->delete();
                } catch (\Exception $ex) {
                    $out->writeln($ex->getMessage());
                }
                return response()->json([
                    'status' => 'success'
                ], 200);
                break;
        }
        return response()->json([
            'status' => 'failed'
        ], 500);
    }

    public function add(Request $request) {
        $tableName =  $request->json('table');
        $value = array();
        $count = 0;
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        while (true) {
            $val = $request->json('val' . str($count));
            if ($val == "") {
                break;
            }
            $count += 1;
            if ($val == 'null') {
                array_push($value, '');
                continue;
            }
            array_push($value, $val);
        }
        $out->writeln($tableName);
        foreach ($value as $vl) {
            $out->writeln($vl);
        }
        switch ($tableName) {
            case 'hopdong':
                try {
                    $hopdong = new HopDong();
                    $hopdong->timestamps = false;
                    $hopdong->path = $value[1];
                    $hopdong->date = $value[2] == "" ? date_create()->format('Y-m-d H:i:s') : $value[2];
                    $hopdong->apartmentNo = $value[3];
                    $hopdong->createdBy = auth()->user()->id;
                    $hopdong->save();
                } catch (\Exception $ex) {
                    $out->writeln($ex->getMessage());
                }
                return response()->json([
                    'status' => 'success'
                ], 200);
                break;
            case 'thongtincanho':
                try {
                    $canho = new ThongTinCanHo();
                    $canho->timestamps = false;
                    $canho->description = $value[1];
                    $canho->rooms = $value[2];
                    $canho->upstairs = $value[3];
                    $canho->restroom = $value[4];
                    $canho->inArea = $value[5];
                    $canho->createdBy = auth()->user()->id;
                    $canho->save();
                } catch (\Exception $ex) {
                    $out->writeln($ex->getMessage());
                }
                return response()->json([
                    'status' => 'success'
                ], 200);
                break;
            case 'nhankhau':
                $name = [];
                $this->FirstAndLastName($value[1], $name);
                try {
                    $nhankhau = new NhanKhau();
                    $nhankhau->timestamps = false;
                    $nhankhau->firstname = $name['firstname'];
                    $nhankhau->lastname = $name['lastname'];
                    $nhankhau->identityNumber = $value[2] ? $value[2] : null;
                    $nhankhau->ownerIndex = $value[3];
                    $nhankhau->save();
                } catch (\Exception $ex) {
                    $out->writeln($ex->getMessage());
                }
                return response()->json([
                    'status' => 'success'
                ], 200);
                break;
            case 'thongtinsuco':
                try {
                    $suco = new ThongTinSuCo();
                    $suco->timestamps = false;
                    $suco->description = $value[1];
                    $out->writeln('so1');
                    $suco->date = $value[2] == "" ? date_create()->format('Y-m-d H:i:s') : $value[2];
                    $out->writeln('so2');
                    $suco->apartmentNo = $value[3];
                    $suco->createdBy = auth()->user()->id;
                    $suco->save();  
                } catch (\Exception $ex) {
                    $out->writeln($ex->getMessage());
                }
                return response()->json([
                    'status' => 'success'
                ], 200);
                break;
            case 'hoadon_kh':
                try {
                    $hoadon = new HoaDon();
                    $hoadon->timestamps = false;
                    $hoadon->description = $value[1];
                    $hoadon->createdDate = null;
                    $hoadon->path = $value[3];
                    $hoadon->moneyIn = '1';
                    $hoadon->whoPay = $value[4];
                    $hoadon->createdBy = auth()->user()->id;
                    $hoadon->save();
                } catch (\Exception $ex) {
                    $out->writeln($ex->getMessage());
                }
                return response()->json([
                    'status' => 'success'
                ], 200);
                break;
            case 'hoadon_dt':
                try {
                    $hoadon = new HoaDon();
                    $hoadon->timestamps = false;
                    $hoadon->description = $value[1];
                    $hoadon->createdDate = null;
                    $hoadon->path = $value[3];
                    $hoadon->moneyIn = '0';
                    $hoadon->whoPay = $value[4];
                    $hoadon->createdBy = auth()->user()->id;
                    $hoadon->save();
                } catch (\Exception $ex) {
                    $out->writeln($ex->getMessage());
                }
                return response()->json([
                    'status' => 'success'
                ], 200);
                break;
        }
        return response()->json([
            'status' => 'failed'
        ], 500);
    }

    function FirstAndLastName(string $str, &$array) {   //Nguyen Van An
        trim($str, " ");
        $processed_list = explode(" ", $str);
        $firstname = $processed_list[count($processed_list) - 1];
        $lastname = "";
        for ($count = 0; $count < count($processed_list) - 1; $count++) {
            $lastname .= $processed_list[$count];
            if ($count != count($processed_list) - 2) {
                $lastname .= " ";
            }
        }
        $array = array(
            'firstname'=> $firstname,
            'lastname' => $lastname
        );

    }
}
