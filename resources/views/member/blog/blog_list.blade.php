@extends('member/layout.layout')

@section('left')
@include('member/layout.left')
@endsection

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">

                </div>
            </div>
            <div class="col-sm-9">
                <div class="blog-post-area">
                    @foreach ($blogs as $key => $value)
                        <div class="single-blog-post">
                            <h3>{{ $value->description}}</h3>
                            <div class="post-meta">
                                <ul>
                                    <li><i class="fa fa-user"></i>{{ $value->title }}</li>
                                    <li><i class="fa fa-clock-o"></i>{{ $value->updated_at->format('H:i') }}</li>
                                    <li><i class="fa fa-calendar"></i>{{ $value->updated_at->format('M d, y')}}</li>
                                </ul>
                                <span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </span>
                            </div>
                            <a href="">
                                <img src="{{ asset('/admin/blog/'.$value->id.'/'.$value->image) }}" alt="">
                            </a>
                            <p>{!! Illuminate\Support\Str::limit($value->content,100) !!}</p>
                            <a class="btn btn-primary" href="{{ url('/member/blog_detail', ['blog_id' => $value->id]) }}">Xem thêm</a>
                        </div>
                    @endforeach
                    <div class="pagination-area">
                        <ul class="pagination">
                            {{$blogs->links('pagination::bootstrap-4')}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection