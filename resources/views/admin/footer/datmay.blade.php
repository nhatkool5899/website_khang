@extends('layout.admin')
@section('title', 'Quản lý đặt may')
@section('content')
    <h4 class="font-medium leading-tight text-2xl mt-0 mb-2">Quản lý đặt may</h4>

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
    <form action="{{url('dat-may/update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-submit">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Xác nhận</button>
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Tiêu đề 1</label>
            <input type="text" class="form-control" name="title_1" value="{{$datmay->title_1}}">
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Nội dung 1</label>
            <textarea name="content_1" id="ckeditor" class="form-control" rows="10">{{$datmay->content_1}}</textarea>
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Tiêu đề 2</label>
            <input type="text" class="form-control" name="title_2" value="{{$datmay->title_2}}">
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Nội dung 2</label>
            <textarea name="content_2" id="ckeditor2" class="form-control" rows="10">{{$datmay->content_2}}</textarea>
        </div>

        <div class="mb-3 form-group">
            <label class="form-label">Tiêu đề 3</label>
            <input type="text" class="form-control" name="title_3" value="{{$datmay->title_3}}">
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Nội dung 3</label>
            <textarea name="content_3" id="ckeditor3" class="form-control" rows="10">{{$datmay->content_3}}</textarea>
        </div>
       
    </form>

@endsection


