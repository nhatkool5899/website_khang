@extends('layout.admin')
@section('title', 'Lấy số đo')
@section('content')
    <h4 class="font-medium leading-tight text-2xl mt-0 mb-2">Lấy số đo</h4>

    <div class="clearfix"></div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success" style="margin-left: 0">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{url('lay-sodo/update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-submit">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Xác nhận</button>
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="title" value="{{$laysodo->title}}">
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Nội dung 1</label>
            <textarea name="content_1" id="ckeditor" class="form-control" rows="10">{{$laysodo->content_1}}</textarea>
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Nội dung 2</label>
            <textarea name="content_2" id="ckeditor2" class="form-control" rows="10">{{$laysodo->content_2}}</textarea>
        </div>
       
    </form>

@endsection


