<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exports\ThichTinExport;
use Maatwebsite\Excel\Facades\Excel;
class ExportController extends Controller
{
    public function export()
    {
        // return Excel::download(new ThichTinExport, 'product.xlsx');
        // return Excel::download(new ThichTinExport, 'supplier.xlsx');
        // return Excel::download(new ThichTinExport, 'phieu.xlsx');
        // return Excel::download(new ThichTinExport, 'hoadon_pros.xlsx');
        // return Excel::download(new ThichTinExport, 'hd_sanphams.xlsx');
        return Excel::download(new ThichTinExport, 'hoadon_scs.xlsx');
        // return Excel::download(new ThichTinExport, 'hd_suachuas.xlsx');
        // return Excel::download(new ThichTinExport, 'hd_kiemtras.xlsx');


    }
}
