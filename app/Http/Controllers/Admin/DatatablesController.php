<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\User;
use App\Models\Product;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    public function user() {
        $level = Auth::user()->level;
        $item = User::where(function($query) use ($level){
            $query->where('level','>=',$level);
       })->orderBy('level','asc')->get();
        $datatables = DataTables::of($item);
        $datatables->editColumn('name', function ($item) {
            $result = $item->name;
            if ($item->id == Auth::user()->id) {
                $result = '<i class="fas fa-home"></i> ' .$result ;
            }
            return $result;
        });
        $datatables->editColumn('email', function ($item) {
            $result = '';
            if (Auth::user()->hasAnyRole(['super-admin|admin']) || $item->id == Auth::user()->id){
                $result = $item->email;
            }
            return $result;
        });
        $datatables->editColumn('level', function ($item) {
            $result = '';
            foreach (levels() as $level) {
                if ($level->id == $item->level) {
                    $result = $level->name;
                }
            }
            return $result;
        });
        $datatables->editColumn('avatar', function ($item) {
            $src = 'src="'.storage_link_show('account',$item->created_at).$item->avatar.'?v='.time().'" onerror="this.onerror=null; this.src=\'logo/none.png\'"';
            $result = '<img  data-toggle="tooltip" title="<img src='.storage_link_show('account',$item->created_at).$item->avatar.'/>" data-html="true" class="img" ' .$src. '/>';
            return $result;
        });
        $datatables->editColumn('status', function ($item) {
            $result = '';
            if ($item->level > Auth::user()->level ){
                if ($item->status == 1) {
                    $result .= '<div class="btn btn-xs btn-success btn-status" data-id='.$item->id.' data-toggle="tooltip" title="'.__('admin.update_status').'">
                        <i class="fas fa-check"></i>
                    </div>';
                }else{
                    $result .= '<div class="btn btn-xs btn-warning btn-status" data-id='.$item->id.' data-toggle="tooltip" title="'.__('admin.update_status').'">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>';
                }
            }
            return $result;
        });
        $datatables->addColumn('action', function ($item) {
            $result = '';
            $edit = '';
            $delete = '';
            if (Auth::user()->hasAnyRole(['super-admin']) || $item->id == Auth::user()->id ) {
                $edit = '<a href="account/edit/'.$item->id.'" class="btn btn-xs btn-primary" data-toggle="tooltip" title="'.__('admin.update_info').'">
                    <i class="fas fa-pen-nib"></i>
                </a> ';
            }
            if (Auth::user()->hasAnyRole(['super-admin']) ){
                $delete = '<div class="btn btn-xs btn-danger btn-destroy" data-id="'.$item->id.'" data-toggle="tooltip" title="'.__('admin.delete_info').'"  >
                <i class="fas fa-trash-alt"></i></div> ';
            }
            $result .= $edit . $delete;
            return $result;
        });
        $datatables->setRowClass(function ($item) {
			if ($item->id == Auth::user()->id) {
                return 'text-warning font-weight-bold';
            }else if ($item->level == 2) {
                return 'text-dark font-weight-bold';
            }else if ($item->level == 3){
                return 'text-dark';
            }
		});
        $datatables->rawColumns(['name','level','avatar','status','action']);
        return $datatables->make();
    }

    public function product() {
        $item = DB::table('vhn_products')
            ->leftJoin('vhn_logsps','vhn_products.id','=','vhn_logsps.id_pro')
            ->select('vhn_products.*',DB::raw("GROUP_CONCAT(DISTINCT vhn_logsps.socu,'_',vhn_logsps.somoi,'_',vhn_logsps.ngaytao ORDER BY vhn_logsps.ngaytao DESC) as totalsp"))
            ->groupBy('vhn_products.id')
            ->orderBy('vhn_products.id','desc');
        $datatables = DataTables::of($item);
        $datatables->editColumn('price_sale', function ($item) {
            return '___'; //number_format($item->price_sale);
        });
        $datatables->editColumn('price_import', function ($item) {
            return number_format($item->price_import);
        });
        $datatables->editColumn('date_import', function ($item) {
            return datevn($item->date_import);
        });
        $datatables->editColumn('image', function ($item) {
            $src = 'src="'.storage_link_show('product',$item->created_at).$item->image.'?v='.time().'" onerror="this.onerror=null; this.src=\'logo/logo.png\'"';
            $result = '<img  data-toggle="tooltip" title="<img src='.storage_link_show('product',$item->created_at).$item->image.'/>" data-html="true" class="img" ' .$src. '/>';
            return $result;
        });
        $datatables->addColumn('baohanh', function ($item) {
            $date1= date_create($item->date_import);
            $date2= date_create(date('d-m-Y'));
            $diff = date_diff($date1,$date2)->format("%y") * 12 + date_diff($date1,$date2)->format("%m");
            $bh = ($item->warranty - $diff < 0) ? 0 : $item->warranty - $diff;
            return  '<b>'. $bh . '</b> th';
        });
        $datatables->editColumn('status', function ($item) {
            $result = '';
                if ($item->status == 1) {
                    $result .= '<div class="btn btn-xs btn-success btn-status" data-id='.$item->id.' data-toggle="tooltip" title="'.__('admin.update_status').'">
                        <i class="fas fa-check"></i>
                    </div>';
                }else{
                    $result .= '<div class="btn btn-xs btn-warning btn-status" data-id='.$item->id.' data-toggle="tooltip" title="'.__('admin.update_status').'">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>';
                }
            return $result;
        });
        $datatables->addColumn('action', function ($item) {
            $result = ''; $edit = ''; $delete = ''; $viewhd = ''; $log = '';
            $viewhd = '<button class="btn btn-warning btn-xs btn-viewhd" data-id="'.$item->id.'" data-toggle="modal" data-target=".flipFlop"><i class="fas fa-eye"></i> </button>  &nbsp; ';
            $edit = '<a href="products/edit/'.$item->id.'" class="btn btn-xs btn-primary" data-toggle="tooltip" title="'.__('admin.update_info').'">
                <i class="fas fa-pen-nib"></i>
            </a> ';
            $delete = '<div class="btn btn-xs btn-danger btn-destroy" data-id="'.$item->id.'" data-toggle="tooltip" title="'.__('admin.delete_info').'"  >
            <i class="fas fa-trash-alt"></i></div> ';
            $totalsp = '';
            if ($item->totalsp) {

                foreach (explode(",",$item->totalsp) as $itemsp) {
                    $assp = explode("_", $itemsp);
                    $totalsp .= '*** số mới:'.$assp[1] . ' | số cũ:'.$assp[0] . ' | ngày:'.date_format(date_create($assp[2]),"d-m-Y") .'<br>';
                }
            }
            $log = '<div class="btn btn-xs btn-dark " data-id="'.$item->id.'" data-html="true" data-toggle="tooltip" title="'.$totalsp.'"  >
            <i class="fas fa-blog"></i></div> ';
            $result .= $viewhd . $edit . $delete . $log;
            return $result;
        });
        $datatables->rawColumns(['price_sale','price_import','date_import','image','baohanh','status','action']);
        return $datatables->make();
    }

    public function phieu() {
        $item = DB::table('vhn_phieus')->orderBy('id','desc');
        $datatables = DataTables::of($item);
        $datatables->editColumn('type', function ($item) {
            foreach (types() as $type) {
                if ($item->type == $type->id) {
                    return $type->name;
                }
            }
        });
        $datatables->editColumn('date_import', function ($item) {
            return datevn($item->date_import);
        });
        $datatables->editColumn('fee', function ($item) {
            return number_format($item->fee);
        });
        $datatables->editColumn('sort', function ($item) {
            $result = '';
            $result .= '<input class="btn-sort" style="width: 70px" data-id="'.$item->id.'" type="number" value="'.$item->sort.'">';
            return $result;
        });
        $datatables->editColumn('status', function ($item) {
            $result = '';
                if ($item->status == 1) {
                    $result .= '<div class="btn btn-xs btn-success btn-status" data-id='.$item->id.' data-toggle="tooltip" title="'.__('admin.update_status').'">
                        <i class="fas fa-check"></i>
                    </div>';
                }else{
                    $result .= '<div class="btn btn-xs btn-warning btn-status" data-id='.$item->id.' data-toggle="tooltip" title="'.__('admin.update_status').'">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>';
                }
            return $result;
        });
        $datatables->addColumn('action', function ($item) {
            $result = ''; $edit = ''; $delete = '';
            $edit = '<a href="phieus/edit/'.$item->id.'" class="btn btn-xs btn-primary" data-toggle="tooltip" title="'.__('admin.update_info').'">
                <i class="fas fa-pen-nib"></i>
            </a> ';
            $delete = '<div class="btn btn-xs btn-danger btn-destroy" data-id="'.$item->id.'" data-toggle="tooltip" title="'.__('admin.delete_info').'"  >
            <i class="fas fa-trash-alt"></i></div> ';
            $result .= $edit . $delete;
            return $result;
        });
        $datatables->setRowClass(function ($item) {
			if ($item->type == 2) {
                return 'text-dark font-weight-bold';
            }else{
                return 'text-danger font-weight-bold';
            }
		});
        $datatables->rawColumns(['type','date_import','fee','sort','status','action']);
        return $datatables->make();
    }

    public function hoadonpro() {
        $item = DB::table('vhn_hoadon_pros')
            ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
            ->leftJoin('vhn_hd_tunhaps','vhn_hd_tunhaps.id_hd','=','vhn_hoadon_pros.id')
            ->select(
                'vhn_hoadon_pros.*',
                DB::raw("GROUP_CONCAT(DISTINCT vhn_hd_sanphams.total,'-',vhn_hd_sanphams.id_type) as totalsp"),
                DB::raw("SUM( DISTINCT vhn_hd_tunhaps.price) AS totaltn"),
                DB::raw("GROUP_CONCAT(DISTINCT CASE WHEN (vhn_hoadon_pros.id_congno > 0) AND (vhn_hoadon_pros.ngay_congno IS NULL) THEN vhn_hoadon_pros.tenkh ELSE NULL END , '*' ) as congno"),
            )
            ->groupBy('vhn_hoadon_pros.id')
            ->orderBy('vhn_hoadon_pros.id','desc');
        $datatables = DataTables::of($item);
        $datatables->editColumn('mahoadon', function ($item) {
            return  sprintf("%06d", $item->mahoadon);
        });
        $datatables->editColumn('thoigian', function ($item) {
            return datevn($item->thoigian);
        });
        $datatables->editColumn('tenkh', function ($item) {
            return $item->tenkh;
        });
        $datatables->addColumn('tongtien', function ($item) {
            // return number_format($hdsanphams->sum('total')) .' + '. number_format($hdtunhaps->sum('price'));
            $totalsp = 0;
            if ($item->totalsp) {
                $arrtotal = $item->totalsp;
                foreach (explode(",",$arrtotal) as $itemsp) {
                    $assp = explode("-", $itemsp);
                    if ($assp[1] == 'pro') {
                        $totalsp += $assp[0];
                    }
                }
            }
            return number_format($totalsp) . ' + ' . number_format($item->totaltn);
        });
        $datatables->editColumn('status', function ($item) {
            $result = '';
                if ($item->status == 1) {
                    $result .= '<div class="btn btn-xs btn-success btn-status" data-id='.$item->id.' data-toggle="tooltip" title="'.__('admin.update_status').'">
                        <i class="fas fa-check"></i>
                    </div>';
                }else{
                    $result .= '<div class="btn btn-xs btn-warning btn-status" data-id='.$item->id.' data-toggle="tooltip" title="'.__('admin.update_status').'">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>';
                }
            return $result;
        });
        $datatables->editColumn('congno', function ($item) {
            if (isset($item->congno)) {
                $result = '<div class="badge badge-xs badge-danger" data-toggle="tooltip" title="'.$item->tenkh.'">
                    <i class="fas fa-comment-dots"></i> còn nợ
                </div> ';
            }else{
                $result = '<div class="badge badge-xs badge-secondary" data-toggle="tooltip" title="'.$item->tenkh.'">
                    <i class="fas fa-comment-dots"></i> không nợ
                </div> ';
            }

            return $result;
        });
        $datatables->addColumn('action', function ($item) {
            $result = ''; $edit = ''; $delete = ''; $show = '';
            $edit = '<a href="hoadonpros/edit/'.$item->id.'" class="btn btn-xs btn-primary" data-toggle="tooltip" title="'.__('admin.update_info').'">
                <i class="fas fa-pen-nib"></i>
            </a> ';
            $show = '<a href="hoadonpros/show/'.$item->id.'" class="btn btn-xs btn-info" data-toggle="tooltip" title="xem hóa đơn">
                <i class="fas fa-print"></i>
            </a> ';
            $delete = '<div class="btn btn-xs btn-danger btn-destroy" data-id="'.$item->id.'" data-toggle="tooltip" title="'.__('admin.delete_info').'"  >
            <i class="fas fa-trash-alt"></i></div> ';
            $result .= $edit . $show . $delete;
            return $result;
        });
        $datatables->rawColumns(['mahoadon','thoigian','tenkh','tongtien','status','congno','action']);
        return $datatables->make();
    }

    public function hoadonsc() {
        $sub = 'sc';
        $item = DB::table('vhn_hoadon_scs')
            ->leftJoin('vhn_hd_kiemtras','vhn_hd_kiemtras.id_hd','=','vhn_hoadon_scs.id')
            ->leftJoin('vhn_hd_suachuas','vhn_hd_suachuas.id_hd','=','vhn_hoadon_scs.id')
            ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
            ->leftjoin('vhn_giamgias','vhn_giamgias.code','=','vhn_hd_sanphams.giamgia')
            // ->leftJoin('vhn_suppliers','vhn_hd_suachuas.id_congno','=','vhn_suppliers.id')
            ->select(
                'vhn_hoadon_scs.*','vhn_hd_kiemtras.name',
                DB::raw("GROUP_CONCAT(DISTINCT vhn_hd_kiemtras.name) as arr_name"),
                DB::raw("SUM( DISTINCT vhn_hd_suachuas.price + vhn_hd_suachuas.fee) AS totalsc"),
                // DB::raw("GROUP_CONCAT(DISTINCT vhn_hd_sanphams.total,'-',vhn_hd_sanphams.id_type) as totalsp"),
                DB::raw("GROUP_CONCAT(DISTINCT vhn_hd_sanphams.stt ,'-' , vhn_hd_sanphams.total , '-', vhn_hd_sanphams.id_type) as congnosp"),
                DB::raw("GROUP_CONCAT(DISTINCT vhn_hd_suachuas.stt , '-' , vhn_hd_suachuas.price, '-' , vhn_hd_suachuas.id_hd ) as congnosc"),
                DB::raw("GROUP_CONCAT(DISTINCT CASE WHEN (vhn_hoadon_scs.id_congno > 0) AND (vhn_hoadon_scs.ngay_congno IS NULL) THEN vhn_hoadon_scs.tenkh ELSE NULL END , '*' ) as congno"),
                DB::raw("GROUP_CONCAT(vhn_giamgias.giamgia) as giamgia"),
            )
            ->groupBy('vhn_hoadon_scs.id')
            ->orderBy('vhn_hoadon_scs.id','desc')->get();
        // dd($item);
        $datatables = DataTables::of($item);
        $datatables->editColumn('mahoadon', function ($item) {
            return  sprintf("%06d", $item->mahoadon);
        });
        $datatables->editColumn('thoigian', function ($item) {
            return datevn($item->thoigian);
        });
        $datatables->editColumn('ngaytra', function ($item) {
            return datevn($item->ngaytra);
        });
        $datatables->addColumn('tentb', function ($item) {
            return $item->arr_name;
        });
        $datatables->editColumn('tenkh', function ($item) {
            return $item->tenkh;
        });
        $datatables->addColumn('tongtien', function ($item) {
            // $totalsp = 0;
            // if ($item->totalsp) {
            //     $arrtotal = $item->totalsp;
            //     foreach (explode(",",$arrtotal) as $itemsp) {
            //         $assp = explode("-", $itemsp);
            //         if ($assp[1] == 'sc') {
            //             $totalsp += $assp[0];
            //         }
            //     }
            // }
            // return number_format($item->totalsc) . ' + ' . number_format($totalsp);
            $congnosc = 0;
            $congnosp = 0;
            $giamgia = 0;
            if ($item->congnosc) {
                foreach (explode(",", $item->congnosc) as $key => $itemsc) {
                    $congnosc += explode("-", $itemsc)[1];
                }
            }
            if ($item->congnosp) {
                foreach (explode(",", $item->congnosp) as $key => $itemsp) {
                    if (explode("-", $itemsp)[2] == 'sc') {
                        $congnosp += explode("-", $itemsp)[1];
                    }
                }
            }
            if ($item->giamgia) {
                foreach (explode(",", $item->giamgia) as $key => $itemgg) {
                    $giamgia +=$itemgg;
                }
            }
            // $giamgia = $item->giamgia;
            return number_format($congnosc) .' + '. number_format($congnosp - $giamgia) . '('.  number_format($giamgia).')' ;
        });
        $datatables->editColumn('congno', function ($item) {
            if (isset($item->congno)) {
                $result = '<div class="badge badge-xs badge-danger" data-toggle="tooltip" title="'.$item->tenkh.'">
                    <i class="fas fa-comment-dots"></i> còn nợ
                </div> ';
            }else{
                $result = '<div class="badge badge-xs badge-secondary" data-toggle="tooltip" title="'.$item->tenkh.'">
                    <i class="fas fa-comment-dots"></i> không nợ
                </div> ';
            }

            return $result;
        });
        $datatables->editColumn('status', function ($item) {
            $result = '';
            $option = ''; $color = ''; $selected = '';
            foreach (tinhtrangs() as $tt) {
                $option .= '<button class="dropdown-item btn-status" data-id='.$item->id.' data-status='.$tt->id.' type="button">'.$tt->name.'</button>';
                if ($tt->id == $item->status) {
                    $color = $tt->color;
                    $selected = $tt->name;
                }
            }
            $result .= '<div class="btn-group">
                <button type="button" class="btn btn-'.$color.' btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> '.$selected.'</button>
                <div class="dropdown-menu dropdown-menu-right ">'.$option.'</div>
            </div>';
            return $result;
        });
        $datatables->addColumn('action', function ($item) {
            $result = ''; $edit = ''; $delete = ''; $show = ''; $copy = '';
            $edit = '<a href="hoadonscs/edit/'.$item->id.'" class="btn btn-xs btn-primary" data-toggle="tooltip" title="'.__('admin.update_info').'">
                <i class="fas fa-pen-nib"></i>
            </a> ';
            $show = '<a href="hoadonscs/show/'.$item->id.'" class="btn btn-xs btn-info" data-toggle="tooltip" title="xem hóa đơn">
                <i class="fas fa-print"></i>
            </a> ';
            $copy = '<span class="click">
            <a class="btn btn-xs btn-warning copy" data-toggle="tooltip" title="share link hóa đơn">
                <i class="fas fa-share"></i>
                <span link="'.url('hoadonscs/showkh/'.$item->id.'_'.$item->sdt).'">copy </span>
            </a></span> ';
            if ($item->status < 4) {
                $delete = '<div class="btn btn-xs btn-danger btn-destroy" data-id="'.$item->id.'" data-toggle="tooltip" title="'.__('admin.delete_info').'"  >
                <i class="fas fa-trash-alt"></i></div> <span class="btn-loinhuan"><span class="form-loinhuan"></span></span>';
            }else{
                $delete = '
                <div class="btn btn-xs btn-dark btn-loinhuan" data-toggle="tooltip" data-html="true" title="lợi nhuận: '.number_format($item->loinhuan).'<br> hồi vốn: '.number_format($item->hoivon).' "  >
                <i class="fas fa-dollar-sign"></i></div> ';
                // $delete .= '<form class="input-group input-group-sm form-loinhuan" style="display:none" action="hoadonscs/loinhuan/'.$item->id.'" method="POST" > '.csrf_field().'
                //     <input type="text" name="loinhuan" value="'.$item->loinhuan.'" class="form-control number">
                //     <div class="input-group-append">
                //         <button class="input-group-text">ok</button>
                //     </div>
                // </form>';
            }
            $ghichu = '
            <div class="btn btn-xs btn-dark btn-ghichu" data-toggle="tooltip" title="nhập ghi chú"  >
            <i class="far fa-comment-alt"></i></div> ';
            $ghichu .= '<form class="input-group input-group-sm form-ghichu" style="display:none" action="hoadonscs/ghichu/'.$item->id.'" method="POST" > '.csrf_field().'
            <input type="text" name="ghichu" value="'.$item->ghichu.'" class="form-control ">
            <div class="input-group-append">
                <button class="input-group-text">ok</button>
            </div>
        </form>';
            $result .= $edit . $show . $copy . $delete . $ghichu;
            return $result;
        });
        $datatables->rawColumns(['mahoadon','thoigian','ngaytra','tentb','tenkh','tongtien','congno','status','action']);
        return $datatables->make();
    }
}
