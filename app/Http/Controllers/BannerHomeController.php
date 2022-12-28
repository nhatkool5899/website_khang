<?php

namespace App\Http\Controllers;

use App\Models\BannerHome;
use Illuminate\Http\Request;

class BannerHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bannerHome = BannerHome::orderBy('id','DESC')->get();
        return view('admin.bannerHome.index', compact('bannerHome'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bannerHome.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'img' => 'required',
                'img_mobile' => 'required'
            ],
            [
                'img.required' => 'Hình ảnh trên pc thể trống',
                'img_mobile.required' => 'Hình ảnh trên mobile không thể trống'
            ]
        );

        $data = $request->all();

        $bannerHome = new BannerHome();
        $bannerHome->vitri = $data['vitri'];
        $bannerHome->status = 1;
        
        $get_img = $request->file('img');

        $get_name_img = $get_img->getClientOriginalName();
        $name_image = current(explode('.', $get_name_img));
        $new_image = $name_image.'-'.rand(0,99).'.'.$get_img->getClientOriginalExtension();
        $path = 'uploads/banner-home';

        $get_img->move($path, $new_image);

        $bannerHome->img = $new_image;

        // image mobile
        $get_img_2 = $request->file('img_mobile');

        $get_name_img_2 = $get_img_2->getClientOriginalName();
        $name_image_2 = current(explode('.', $get_name_img_2));
        $new_image_2 = $name_image_2.'-'.rand(0,99).'.'.$get_img_2->getClientOriginalExtension();
        $path = 'uploads/banner-home';

        $get_img_2->move($path, $new_image_2);

        $bannerHome->img_mobile = $new_image_2;

        $bannerHome->save();

        return redirect('/home-banner');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bannerHome = BannerHome::find($id);
        return view('admin.bannerHome.edit',compact('bannerHome'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();

        $bannerHome = BannerHome::find($id);

        $bannerHome->vitri = $data['vitri'];
        $bannerHome->status = $data['status'];

        
        $get_img = $request->file('img');
        $get_img_2 = $request->file('img_mobile');
        if($get_img){

            $path_file = 'uploads/banner-home/'.$bannerHome->img;
            if(file_exists($path_file)){
                unlink($path_file);
            }

            $get_name_img = $get_img->getClientOriginalName();
            $name_image = current(explode('.', $get_name_img));
            $new_image = $name_image.'-'.rand(0,99).'.'.$get_img->getClientOriginalExtension();
            $path = 'uploads/banner-home';
    
            $get_img->move($path, $new_image);
    
            $bannerHome->img = $new_image;
    
        }
        
        if($get_img_2){

            $path_file = 'uploads/banner-home/'.$bannerHome->img_mobile;
            if(file_exists($path_file)){
                unlink($path_file);
            }

            $get_name_img = $get_img_2->getClientOriginalName();
            $name_image = current(explode('.', $get_name_img));
            $new_image = $name_image.'-'.rand(0,99).'.'.$get_img_2->getClientOriginalExtension();
            $path = 'uploads/banner-home';
    
            $get_img_2->move($path, $new_image);
    
            $bannerHome->img_mobile = $new_image;
    
        }

        $bannerHome->save();


        return redirect('/home-banner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bannerHome = BannerHome::find($id);
        $path = 'uploads/banner-home/'.$bannerHome->img;
        if(file_exists($path)){
            unlink($path);
        }
        $path_2 = 'uploads/banner-home/'.$bannerHome->img_mobile;
        if(file_exists($path_2)){
            unlink($path_2);
        }
        BannerHome::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa banner thành công');
    }

    public function active($id)
    {
        $bannerHome = BannerHome::find($id);
        $bannerHome->status = 1;
        $bannerHome->save();
        return redirect()->back();
    }

    public function unactive($id)
    {
        $bannerHome = BannerHome::find($id);
        $bannerHome->status = 0;
        $bannerHome->save();
        return redirect()->back();
    }
}
