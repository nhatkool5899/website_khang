@extends('layout.admin')
@section('title', 'Quản lý About Khang')
@section('content')
<div class="table-responsive">
    @if (session('status'))
        <div class="alert alert-success" style="margin-left: 0">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('about.update', ['about' => $about->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="box-submit p-4">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Xác nhận</button>
        </div>
        <div class="about-body">
            <div class="container">
                <div class="intro_about">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="about-title">
                               <input type="text" class="form-control" name="title_1" value="{{$about->title_1}}">
                            </div>
                            <div class="about-text">
                                <textarea name="text_4" id="ckeditor" class="form-control" rows="6">{{$about->text_4}}</textarea>
                            </div>
                            <div class="about-img">
                                <label for="inputImg3">
                                    <img id="preImg3" src="{{asset('uploads/about/'.$about->img_3)}}" alt="">
                                    <input type="file" name="img_3" id="inputImg3" accept="image/*">
                                </label>
                            </div>
                            <div class="about-text">
                                <textarea name="text_5" id="ckeditor2" class="form-control" rows="6">{{$about->text_5}}</textarea>
                            </div>
                        </div>
                        <div class="clearfix-2"></div>
                        
                    </div>
                </div>
            </div>
            <div class="clearfix" id="lienhe" style="height: 200px"></div>
        </div>
    </form>
</div>

<script>

    var input1 = document.getElementById('inputImg1');
    var input2 = document.getElementById('inputImg2');
    var input3 = document.getElementById('inputImg3');

    input1.addEventListener('change', (e) => {
        if (e.target.files.length) {
            let src = URL.createObjectURL(e.target.files[0]);
            $('#preImg1').attr('src',src);
        }
    });
    input2.addEventListener('change', (e) => {
        if (e.target.files.length) {
            let src = URL.createObjectURL(e.target.files[0]);
            $('#preImg2').attr('src',src);
        }
    });
    input3.addEventListener('change', (e) => {
        if (e.target.files.length) {
            let src = URL.createObjectURL(e.target.files[0]);
            $('#preImg3').attr('src',src);
        }
    });
    

</script>
@endsection