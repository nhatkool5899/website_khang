@extends('layout.admin')
@section('title', 'Cập nhật hình ảnh')
@section('content')
    <h4 class="font-medium leading-tight text-2xl mt-0 mb-2">Cập nhật ảnh</h4>

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
    <form action="{{url('whatsnew/update/'.$photo->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-submit">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Xác nhận</button>
        </div>

        <div class="mb-3 form-group">
            <label class="form-label">Hình ảnh</label>
            <div class="list-img">
                <label for="inputImg1" class="form-label custom-label">
                    <img class="imgPreview1" src="{{asset('uploads/'.$photo->name.'/'.$photo->img_1)}}" alt="">
                    <span>Ảnh 1</span>
                    <input type="file" id="inputImg1" name="img_1" style="display: none">
                </label>
    
            </div>
        </div>

        <div class="mb-3 form-group">
            <label class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="title" value="{{$photo->title}}">
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Mô tả</label>
            <textarea name="content" class="form-control" id="ckeditor" rows="10">{{$photo->content}}</textarea>
        </div>
       
    </form>

    <script>

        var input1 = document.getElementById('inputImg1');

        input1.addEventListener('change', (e) => {
            if (e.target.files.length) {
                let src = URL.createObjectURL(e.target.files[0]);
                $('.imgPreview1').attr('src',src);
            }
        });


    </script>
@endsection


