@extends('admin.layout.index')
@section('content')
{{-- Style --}}
<style>
    .class1 {
        padding: 0px 15px;
    }

    .class2 {
        margin: 0px 30px;
    }
</style>


<!-- Page Content -->
 <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
                    <small>{{$tintuc->TieuDe}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12" style="padding-bottom:120px">
                {{-- Hiện thông báo lỗi --}}
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{$error}} <br>
                    @endforeach
                </div>
                @endif

                {{-- Hiện thông báo thành công --}}
                @if(session('thongbao'))
                    <div class="alert alert-success">{{session('thongbao')}}</div>
                @endif
                @if(session('loi'))
                    <div class="alert alert-danger">{{session('loi')}}</div>
                @endif
                {{-- Thêm encript để gửi file --}}
                <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                    {{-- Thêm token để gửi tới server --}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                    {{-- Lựa chọn thể loại tin --}}
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="idTheLoai" id="TheLoai">
                            @foreach ($theloai as $item)
                            <option
                                @if ($tintuc->loaitin->theloai->id == $item->id)
                                    {{"selected"}}
                                @endif
                                value="{{$item->id}}">
                                {{$item->Ten}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Lựa chọn loại tin --}}
                    <div class="form-group">
                        <label>Loại tin</label>
                        <select class="form-control" name="idLoaiTin" id="LoaiTin">
                            @foreach ($loaitin as $item)
                            <option
                                @if ($tintuc->loaitin->id == $item->id)
                                    {{"selected"}}
                                @endif
                                value="{{$item->id}}">
                                {{$item->Ten}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nhập tiêu đề --}}
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" value="{{$tintuc->TieuDe}}"/>
                    </div>

                    {{-- Nhập tóm tắt --}}
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea id="editorShortDescription" name="TomTat" placeholder="something">{{$tintuc->TomTat}}</textarea>
                    </div>

                    {{-- Nhập nội dung --}}
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea id="editorContent" name="NoiDung">{{$tintuc->NoiDung}}</textarea>
                    </div>

                    {{-- Lựa chọn nổi bật Có/Không --}}
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input
                            @if ($tintuc->NoiBat == 0)
                                {{"checked"}}
                            @endif
                            name="NoiBat"
                            value="0"
                            type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input
                                @if ($tintuc->NoiBat == 1)
                                    {{"checked"}}
                                @endif
                                name="NoiBat"
                                value="1"
                                type="radio">Có
                        </label>
                    </div>

                    {{-- Chọn file ảnh gửi lên --}}
                    <div class="form-group">
                        <label for="uploadImage">Chọn file ảnh tải lên</label>
                        <img width="400px" src="upload/tintuc/{{$tintuc->Hinh}}"/> <br>
                        <input type="file" name="fileAnh" id="uploadImage">
                    </div>

                    {{-- Thêm mới tin tức --}}
                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                </form>
                <hr>
                <div class="row pt-3">
                    <!-- /.col-lg-12 -->
                    <h2>Comment</h2>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr align="center">
                            <th class="text-center">ID</th>
                            <th class="text-center">Tên Người Bình Luận</th>
                            <th class="text-center">Nội Dung</th>
                            <th class="text-center">Ngày Đăng</th>
                            <th class="text-center">Xóa</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tintuc->comments as $binhluan)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $binhluan->id }}</td>
                                <td>{{ $binhluan->users->name }}</td>
                                <td>{{ $binhluan->NoiDung }}</td>
                                <td>{{$binhluan->created_at }}</td>
                                <td class="center">
                                    <i class="fa fa-trash-o  fa-fw"></i>
                                    <input type="hidden" value="{{$binhluan->id}}">

                                    <a href="#" class="btnDel" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModal{{$binhluan->id}}">Xóa</a>

                                    <div style="text-align: left;" id="myModal{{$binhluan->id}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Xác Nhận</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Bạn muốn xóa Bình luận có nội dung: "{{$binhluan->NoiDung}}"?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-casetype="binhluan" class="btn btn-default btnConf">Có</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
@section('script')
<script src="admin_assets/froalaEditor/js/froala_editor.pkgd.min.js"></script>
<link href="admin_assets/froalaEditor/css/froala_editor.pkgd.min.css" rel="stylesheet">
<script>

    $(document).ready(function() {
        // Generate FroalaEditor
        var editor1 = new FroalaEditor('#editorContent',
        {
            heightMin: 200,
            imageStyles: {
                style1: 'Class 1',
                style2: 'Class 2'
            },
            lineHeights: {
                Default: '',
                Single: '1',
                '1.15': '1.15',
                '1.5': '1.5',
                '1.75': '1.75',
                Double: '2'
            }
        }
        );
        var editor2 = new FroalaEditor('#editorShortDescription',
        {
            heightMin: 200,
            imageStyles: {
                style1: 'Class 1',
                style2: 'Class 2'
            },
            lineHeights: {
                Default: '',
                Single: '1',
                '1.15': '1.15',
                '1.5': '1.5',
                '1.75': '1.75',
                Double: '2'
            }
        }
        );
        // Call Ajax when choosing TheLoai
        $("#TheLoai").change(function() {
            var idTheLoai =$(this).val();
            console.log('Select theloai id =', idTheLoai);
            $.get("admin/ajax/loaitin/"+idTheLoai, function(data) {
                console.log(data);
                $("#LoaiTin").html(data);
            })
        })
    })
</script>
@endsection
