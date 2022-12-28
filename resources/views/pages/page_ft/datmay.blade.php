@extends('layout.page')
@section('breadcrumb')
<div class="clear-header"></div>
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{url('trang-chu')}}">Trang chủ</a></li>
            <li><a href="#">Hướng dẫn đặt may</a></li>
        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="main-body bg-details question">
    <div class="container">
        <div class="page_ft-title">Hướng dẫn đặt may</div>
        <div class="box-order">
            <div class="item-order">
                <div class="title">{{$datmay->title_1}}</div>
                <div>
                    {!! $datmay->content_1 !!}
                </div>
            </div>

            <div class="item-order">
                <div class="title">{{$datmay->title_2}}</div>
                <div>
                    {!! $datmay->content_2 !!}
                </div>
            </div>

            <div class="item-order">
                <div class="title">{{$datmay->title_3}}</div>
                <div>
                    {!! $datmay->content_3 !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection