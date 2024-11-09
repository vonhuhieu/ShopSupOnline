@extends('admin/layout.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('success')}}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Tiêu đề</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Nội dung</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $key => $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td><img style="width:350px;height:250px" src="{{ asset('/admin/blog/'.$value->id.'/'.$value->image) }}"></td>
                                        <td>{{ $value->description}}</td>
                                        <td>{!! $value->content !!}</td>
                                        <td><a href="{{ url('/admin/blog_update', ['blog_id' => $value->id]) }}">Cập nhật</a></td>
                                        <td><a href="{{ url('/admin/blog_delete', ['blog_id' => $value->id]) }}">Xóa</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr style="text-align:right;">
                                    <td colspan="5"><a href="{{ url('/admin/blog_add') }}">Thêm</a></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection