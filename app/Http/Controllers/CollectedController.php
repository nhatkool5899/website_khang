<?php

namespace App\Http\Controllers;

use App\Models\Collected;
use App\Models\PhotoLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CollectedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collected = Collected::with('layout')->orderBy('id','desc')->get();
        return view('admin.collected.index', compact('collected'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.collected.create');
    }

    public function gallery($id)
    {
        $value = Collected::find($id);
        return view('admin.collected.gallery', compact('value'));
    }

    public function add_gallery(Request $request, $id)
    {
        $data = $request->all();
        $collected = Collected::find($id);

        // Thêm ảnh
        $images = array();
        if($files = $request->file('add_img'))
        {
            $path = 'uploads/bo-suu-tap/'.$collected->id.'/';
            foreach($files as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move($path, $name);  
                $images[] = $name;  
            }
        }

        $collected->imgs = json_encode($data['list_img']);

        $collected->save();

        return redirect('/collected');
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
                'name' => 'required|unique:tbl_sanpham',
                'description' => 'required',
                'img_1' => 'required',
            ],
            [
                'name.required' => 'Tên không thể trống',
                'description.required' => 'Mô tả không thể trống',
                'img_1.required' => 'Ảnh 1 không được trống',
            ]
        );

        $data = $request->all();
        $layout = new PhotoLayout();
        $layout->name = 'khach-hang';
        $layout->status = 1;

        $get_img_1 = $request->file('img_1');

        // Img-1
        $get_name_img_1 = $get_img_1->getClientOriginalName();
        $name_image_1 = current(explode('.', $get_name_img_1));
        $new_image_1 = $name_image_1.'-'.rand(0,99).'.'.$get_img_1->getClientOriginalExtension();
        $path = 'uploads/bo-suu-tap';
        $get_img_1->move($path, $new_image_1);


        $layout->img_1 = $new_image_1;

        $layout->save();


        $collected = new Collected();
        $collected->photo_layout_id = $layout->id;
        $collected->name = $data['name'];
        $collected->description = $data['description'];

        // Thư viện ảnh
        $images = array();
        if($files = $request->file('imgs'))
		{
            $path_img = 'uploads/bo-suu-tap/'.$collected->name.'/';
            foreach($files as $file)
			{
                $get_name = $file->getClientOriginalName();
                $name_image = current(explode('.', $get_name));
                $new_image = $name_image.'-'.rand(0,99).'.'.$file->getClientOriginalExtension();
			    $file->move($path_img, $new_image);  
			    $images[] = $new_image;  
			}
		}

        $collected->imgs = json_encode($images);

        $collected->save();

        return redirect('/collected');
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
        $collected = Collected::with('layout')->find($id);
        return view('admin.collected.edit', compact('collected'));
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
        $data = $request->validate(
            [
                'name' => 'required|unique:tbl_sanpham',
                'description' => 'required',
            ],
            [
                'name.required' => 'Tên không thể trống',
                'description.required' => 'Mô tả không thể trống',
            ]
        );

        $data = $request->all();
        $collected = Collected::find($id);
        $layout = PhotoLayout::where('id', $collected->photo_layout_id)->first();

        $get_img_1 = $request->file('img_1');

        // Img-1
        if($get_img_1){

            $path_file = 'uploads/bo-suu-tap/'.$layout->img_1;
            if(file_exists($path_file)){
                unlink($path_file);
            }

            $get_name_img_1 = $get_img_1->getClientOriginalName();
            $name_image_1 = current(explode('.', $get_name_img_1));
            $new_image_1 = $name_image_1.'-'.rand(0,99).'.'.$get_img_1->getClientOriginalExtension();
            $path = 'uploads/bo-suu-tap';
            $get_img_1->move($path, $new_image_1);
    
    
            $layout->img_1 = $new_image_1;
    
            $layout->save();
        }else{
            $layout->save();
        }


       
        $collected->photo_layout_id = $layout->id;
        $collected->name = $data['name'];
        $collected->description = $data['description'];

        // Thư viện ảnh
        $images = array();
        if($files = $request->file('imgs'))
		{
            $path_img = 'uploads/bo-suu-tap/'.$collected->name.'/';
            foreach($files as $file)
			{
                $get_name = $file->getClientOriginalName();
                $name_image = current(explode('.', $get_name));
                $new_image = $name_image.'-'.rand(0,99).'.'.$file->getClientOriginalExtension();
			    $file->move($path_img, $new_image);  
			    $images[] = $new_image;  
			}
		}

        $collected->imgs = json_encode($images);

        $collected->save();

        return redirect('/collected');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collected = Collected::where('photo_layout_id',$id)->first();
        $photo_layout = PhotoLayout::find($id);
        for ($i=1; $i <= 4; $i++) { 
            $img = 'img_'.$i;
            $path = 'uploads/bo-suu-tap/'.$photo_layout->$img;
            if(file_exists($path)){
                unlink($path);
            }
        }

        $directory = 'uploads/bo-suu-tap/'.$collected->id;
        if($directory) File::deleteDirectory($directory);

        PhotoLayout::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa ảnh thành công');
    }

    public function active($id)
    {
        $collected = Collected::find($id);
        $collected->status = 1;
        $collected->save();
        return redirect()->back();
    }

    public function unactive($id)
    {
        $collected = Collected::find($id);
        $collected->status = 0;
        $collected->save();
        return redirect()->back();
    }
}
