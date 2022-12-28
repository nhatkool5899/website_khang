@extends('layout.page')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="{{url('trang-chu')}}">Trang chủ</a></li>
            <li><a href="#">What's new</a></li>
        </ul>
    </div>
</div>
@endsection

@section('banner')
<section class="box-banner style-banner">
    <div class="banner banner-page">
        <img src="{{asset('uploads/banner/'.$banner->img)}}" alt="{{$banner->img}}">
    </div>
</section>
@endsection

@section('content')
<div class="main-body">
    <!-- Main-content -->
    <div class="main-content">
        <div id="loader-seemore" class="loader-seemore">

        </div>
    </div>
</div>

<script>
    loader_more();

    function loader_more(id = '') { 
        $.ajax({
            url: '/loader-more',
            method: 'POST',
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {id:id},
            success: function(data){
                $('.btn-view-more').remove();
                $('#loader-seemore').append(data);
            }
        });
    }

    $(document).on('click','.btn-view-more', function(){
        var last_id = $(this).data('id');
        loader_more(last_id);
    })
</script>
@endsection