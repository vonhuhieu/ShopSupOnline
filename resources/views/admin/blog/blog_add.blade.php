@extends('admin/layout.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
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
                <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal m-t-30">
                    @csrf
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" name="title" placeholder="Mời nhập tiêu đề">
                        <br />
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input type="file" name="image">
                        <br />
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <input type="text" name="description" placeholder="Mời nhập mô tả">
                        <br />
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea type="text" name="content" id="demo" placeholder="Mời nhập nội dung"></textarea>
                        <br />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Xác nhận">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection