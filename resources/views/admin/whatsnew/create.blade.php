@extends('layout.admin')
@section('title', 'Thêm bố cục trang Whats new')
@section('content')
    <h4 class="font-medium leading-tight text-2xl mt-0 mb-2">Thêm bố cục ảnh</h4>

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
    <form action="{{url('whatsnew/store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-submit">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Xác nhận</button>
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Vị trí</label>
            <select name="name" class="form-select" style="font-size: 18px">
                <option value="whats-new">What's new</option>
                {{-- <option value="2">What's new</option> --}}
            </select>
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Hình ảnh</label>
            <div class="list-img">
                <label for="inputImg1" class="form-label custom-label">
                    <img class="imgPreview1" src="{{asset('back-end/imgs/add-img.png')}}" alt="">
                    <span>Ảnh 1</span>
                    <input type="file" id="inputImg1" name="img_1" style="display: none">
                </label>
            </div>
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="title" value="{{old('title')}}">
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Nội dung</label>
            <textarea name="content" class="form-control" id="ckeditor" cols="30" rows="10">{{old('content')}}</textarea>
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


