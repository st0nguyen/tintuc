<?php

namespace App\Http\Controllers;

use App\TheLoai;
use App\TinTuc;
use App\LoaiTin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Comment;

class TinTucController extends Controller
{
    public function getDanhSach(){
        $tintuc = TinTuc::all();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }
    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=>$theloai, 'loaitin'=>$loaitin]);
    }
    public function postThem(Request $request) {
        $this->validate($request,
            [
                'idLoaiTin' => 'required',
                // Yêu cầu phải có, min = 3, không trùng trong bảng TinTuc->cột tiêu để
                'TieuDe' => 'required|min:3|unique:tbl_TinTuc,TieuDe',
                'TomTat' => 'required',
                'NoiDung' => 'required',
                'NoiBat' => 'required',
            ],
            [
                'idLoaiTin.required' => 'Bạn chưa chọn loại tin',
                'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
                'TieuDe.min' => 'Độ dài tiêu đề >= 3 kí tự',
                'TieuDe.unique' => 'Tiêu đề này bị trùng. Vui lòng nhập tiêu đề khác',
                'TomTat.required' => 'Yêu cầu nhập tóm tắt',
                'NoiDung.required' => 'Yêu cầu nhập nội dung',
                'NoiBat.required' => 'Yêu cầu chọn nổi bật',

            ]);
        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = str::slug($request->TieuDe,'-');
        $tintuc->TomTat = $request->TomTat;
        $tintuc->idLoaiTin = $request->idLoaiTin;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;

        // Kiểm tra xem có upload hình lên không
        if($request->hasFile('fileAnh')){
            $file = $request->file('fileAnh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != "jpg" && $duoi != "png" && $duoi != "jpeg")
            {
                // return redirect('admin/tintuc/them')->with('loi', 'Chỉ được chọn file jpg, png, jpeg');
                return redirect()->back()->with('loi', 'Chỉ được chọn file jpg, png, jpeg');
            }

            $name = $file->getClientOriginalName();
            $tenhinh = str::random()."_".$name;
            while(file_exists("upload/tintuc/".$tenhinh)) {
                $tenhinh = str::random()."_".$name;
            }
            $file->move("upload/tintuc",$tenhinh);
            $tintuc->Hinh = $tenhinh;
        } else {
            $tintuc->Hinh = "";
        }
//        print_r($tintuc);
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao', 'Thêm tin tức thành công');
    }
    public function getSua($id){
        $tintuc = TinTuc::Find($id);
        $theloai = TheLoai::All();
        $loaitin = LoaiTin::All();
        return view('admin.tintuc.sua', ['tintuc' => $tintuc, 'theloai' => $theloai, 'loaitin' => $loaitin]);
    }
    public function postSua(Request $request, $id)
    {
        $tintuc = TinTuc::Find($id);

        $this->validate($request,
            [
                'idLoaiTin' => 'required',
                // Yêu cầu phải có, min = 3, không trùng trong bảng TinTuc->cột tiêu để
                'TieuDe' => 'required|min:3',
                'TomTat' => 'required',
                'NoiDung' => 'required',
                'NoiBat' => 'required',
            ],
            [
                'idLoaiTin.required' => 'Bạn chưa chọn loại tin',
                'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
                'TieuDe.min' => 'Độ dài tiêu đề >= 3 kí tự',
                'TomTat.required' => 'Yêu cầu nhập tóm tắt',
                'NoiDung.required' => 'Yêu cầu nhập nội dung',
                'NoiBat.required' => 'Yêu cầu chọn nổi bật',

            ]);
        $tintuc = TinTuc::Find($id);
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = str::slug($request->TieuDe,'-');
        $tintuc->TomTat = $request->TomTat;
        $tintuc->idLoaiTin = $request->idLoaiTin;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;

        // Kiểm tra xem có upload hình lên không
        if($request->hasFile('fileAnh')){
            $file = $request->file('fileAnh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != "jpg" && $duoi != "png" && $duoi != "jpeg")
            {
                // return redirect('admin/tintuc/them')->with('loi', 'Chỉ được chọn file jpg, png, jpeg');
                return redirect()->back()->with('loi', 'Chỉ được chọn file jpg, png, jpeg');
            }

            $name = $file->getClientOriginalName();
            $tenhinh = str::random()."_".$name;
            while(file_exists("upload/tintuc/".$tenhinh)) {
                $tenhinh = str::random()."_".$name;
            }
            $file->move("upload/tintuc",$tenhinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $tenhinh;
        } else {
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao', 'Sửa thành công');

    }

    // Xóa
    public function getXoa($id) {
        $tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Bạn đã xóa thành công');
    }

}
