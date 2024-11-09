@extends('member/layout.layout')

@section('left')
<div class="panel-group category-products" id="accordian"><!--category-productsr-->


    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="{{ url('/member/account/account_update') }}">Tài khoản</a></h4>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Lịch sử mua hàng</a></h4>
        </div>
    </div>

</div><!--/category-products-->
@endsection