@extends('admin.layout.index')
@section('content')
  <!-- Page Content -->
  <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại tin
                    <small>{{$loaitin->Ten}}</small>
                </h1>
            </div>
             <!-- /.col-lg-12 -->
             @if(count($errors) > 0)
             <div class="alert alert-danger">
                 @foreach ($errors->all() as $error)
                     {{$error}} <br>
                 @endforeach
             </div>
             @endif
 
             @if(session('thongbao'))
                 <div class="alert alert-success">{{session('thongbao')}}</div>
             @endif
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/loaitin/sua/{{$loaitin->id}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                        <label>Tên loại tin</label>
                        <input class="form-control" name="Ten" placeholder="Nhập tên loại tin" value="{{$loaitin->Ten}}" />
                    </div>
                    <div class="form-group">
                        <label>Tên thể loại</label>
                        <select class="form-control" name="TheLoai">
                            @foreach ($theloai as $item)
                            <option value="{{$item->id}}" 
                                @if($loaitin->idTheLoai == $item->id)
                                {{"selected"}}
                                @endif
                                >{{$item->Ten}}</option>
                            @endforeach
                            <option value="">Tin Tức</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-default">Sửa loại tin</button>
                    <button type="reset" class="btn btn-default">Làm trống</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection