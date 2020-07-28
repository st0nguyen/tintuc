<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use Illuminate\Support\Str;

class LoaiTinController extends Controller
{
    public function getDanhSach()
    {
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach', ['loaitin' => $loaitin]);
    }
    public function getThem()
    {
        $theloai = TheLoai::all();

        return view('admin.loaitin.them', ['theloai' => $theloai]);

    }
    public function postThem(Request $request) {
        $this->validate($request,
            [
                'Ten' => 'required|unique:tbl_LoaiTin|max:100',
                'TheLoai' => 'required'
            ],
            [
                'Ten.required' => 'Không được để trống tên loại tin',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 3 tới 100 kí tự',
                'Ten.unique' => 'Tên loại tin đã bị trùng, vui lòng nhập lại tên',
                'Ten.max' => 'Tên thể loại phải có độ dài từ 3 tới 100 kí tự',
                'TheLoai.required' => 'Vui lòng chọn thể loại tin',
            ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = str::slug($request->Ten,'-');
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao', 'Thêm loại tin thành công');
    }
    public function getSua($id)
    {
        $loaitin = LoaiTin::Find($id);
        $theloai = TheLoai::All();
        return view('admin.loaitin.sua', ['loaitin' => $loaitin, 'theloai' => $theloai]);

    }
    public function postSua(Request $request, $id)
    {
        $loaitin = LoaiTin::Find($id);
        $this->validate($request,
            [
                'Ten' => 'required|unique:TBL_LoaiTin|max:100',
                'TheLoai' => 'required'
            ],
            [
                'Ten.required' => 'Không được để trống tên loại tin',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 3 tới 100 kí tự',
                'Ten.unique' => 'Tên loại tin đã bị trùng, vui lòng nhập lại tên',
                'Ten.max' => 'Tên thể loại phải có độ dài từ 3 tới 100 kí tự',
                'TheLoai.required' => 'Vui lòng chọn thể loại tin',
            ]);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = str::slug($request->Ten,'-');
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao', 'Sửa thành công');

    }



    public function getXoa($id) {
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao', 'Bạn đã xóa thành công');
    }
}
