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
                    <small>Thêm</small>
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
                <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                    {{-- Thêm token để gửi tới server --}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                    {{-- Lựa chọn thể loại tin --}}
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="idTheLoai" id="TheLoai">
                            @foreach ($theloai as $item)
                            <option value="{{$item->id}}">{{$item->Ten}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Lựa chọn loại tin --}}
                    <div class="form-group">
                        <label>Loại tin</label>
                        <select class="form-control" name="idLoaiTin" id="LoaiTin">
                            @foreach ($loaitin as $item)
                            <option value="{{$item->id}}">{{$item->Ten}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nhập tiêu đề --}}
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" />
                    </div>
                   
                    {{-- Nhập tóm tắt --}}
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea id="editorShortDescription" name="TomTat" value="something" placeholder="something"></textarea>
                    </div>
                   
                    {{-- Nhập nội dung --}}
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea id="editorContent" name="NoiDung"></textarea>
                    </div>

                    {{-- Lựa chọn nổi bật Có/Không --}}
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0" checked="" type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="1" type="radio">Có
                        </label>
                    </div>

                    {{-- Chọn file ảnh gửi lên --}}
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Chọn file ảnh tải lên</label>
                        <input type="file" name="fileAnh" id="exampleFormControlFile1">
                    </div>

                    {{-- Thêm mới tin tức --}}
                    <button type="submit" class="btn btn-default">Thêm tin tức</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
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
        }
        );
        var editor2 = new FroalaEditor('#editorShortDescription',
        {
            heightMin: 200,
            imageStyles: {
                class1: 'Class 1',
                class2: 'Class 2'
            },
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