@extends('admin.layout.index')
@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
                    <small>Danh sách</small>
                </h1>
            </div>
            @if(session('thongbao'))
                <div class="alert alert-success">{{session('thongbao')}}</div>
        @endif
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Tiêu đề không dấu</th>
                        <th>Tóm tắt</th>
                        <th>Nội dung</th>
                        <th>Nổi bật</th>

                        <th>Loại tin</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tintuc as $item)
                    <tr class="odd gradeX" align="center">
                        <td>{{$item->id}}</td>
                        <td>
                            {{$item->TieuDe}}<br>
                            <img width="100px" src="upload/tintuc/{{$item->Hinh}}" alt="{{$item->TieuDe}}">
                        </td>
                        <td>{{$item->TieuDeKhongDau}}</td>
                        <td>{{$item->TomTat}}</td>
                        <td>{{$item->NoiDung}}</td>
                        <td>
                            @if ($item->NoiBat == 0)
                            {{'Không'}}
                            @else
                            {{'Có'}}
                            @endif
                        </td>

                        <td>{{$item->loaitin->Ten}}</td>
                        <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="admin/tintuc/xoa/{{$item->id}}"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$item->id}}">Edit</a></td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
