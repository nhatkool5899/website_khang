@extends('layout.page')
@section('breadcrumb')
<div class="clear-header"></div>
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{url('trang-chu')}}">Trang chủ</a></li>
            <li><a href="#">Hướng dẫn lấy số đo</a></li>
        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="main-body bg-details question">
    <div class="container">
        <div class="page_ft-title">{{$laysodo->title}}</div>
        <div class="box-take-number">
            {!! $laysodo->content_1 !!}
        </div>
        <div class="box-take-number">
            {!! $laysodo->content_2 !!}
        </div>
    </div>
</div>
@endsection