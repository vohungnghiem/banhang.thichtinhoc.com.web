<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Imports\ThichTinImport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
class ImportController extends Controller
{
    public function getImport() {
        return view('admincp.import');
    }
    public function postImport(Request $request)
    {
        $rows = Excel::toCollection(new ThichTinImport,$request->file('file'));
        $resdata = $this->insertImport($rows[0]);
        // return  redirect()->back()->with('resdata',$resdata);

    }
    public function insertImport($rows)
    {
        // if (strlen($row[21]) == 5) {
        //     $ngay_xuatcanh = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[21]))->format('Y-m-d');
        // }else{
        //     $ngay_xuatcanh = date('Y-m-d',strtotime($row[21]));
        // }
        // $created_at = Carbon::now('Asia/Ho_Chi_Minh');
        foreach ($rows as $key => $row) {
            if ($key >= 2) {

                $id = $row[0];
                $status = $row[11];

                // // # insert or update
                DB::table('vhn_hoadon_scs')->updateOrInsert(
                    ['id' => $id],
                    [
                        'status' => $status,

                    ]
                );
            }
        }
    }
}

