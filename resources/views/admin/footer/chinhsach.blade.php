@extends('layout.admin')
@section('title', 'Chính sách')
@section('content')
    <h4 class="font-medium leading-tight text-2xl mt-0 mb-2">Chính sách</h4>

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
    <form action="{{url('chinh-sach/update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-submit">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Xác nhận</button>
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="title" value="{{$chinhsach->title}}">
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Nội dung</label>
            <textarea name="content" id="ckeditor" class="form-control" rows="10">{{$chinhsach->content}}</textarea>
        </div>
       
    </form>

@endsection


