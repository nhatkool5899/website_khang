<?php

namespace App\Http\Controllers;

use App\Models\PhotoLayout;
use App\Models\Tulieu;
use Illuminate\Http\Request;

class TulieuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tulieu = Tulieu::orderBy('id','desc')->get();
        return view('admin.tulieu.index',compact('tulieu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tulieu.create');
        
    }

    public function gallery($id)
    {
        $value = Tulieu::find($id);
        return view('admin.tulieu.gallery', compact('value'));
    }

    public function add_gallery(Request $request, $id)
    {
        $data = $request->all();
        $tulieu = Tulieu::find($id);

        // Thêm ảnh
        $images = array();
        if($files = $request->file('add_img'))
        {
            $path = 'uploads/tu-lieu/'.$tulieu->id.'/';
            foreach($files as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move($path, $name);  
                $images[] = $name;  
            }
        }

        $tulieu->imgs = json_encode($data['list_img']);

        $tulieu->save();

        return redirect('/tulieu');
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
                'name' => 'required|unique:tbl_tu_lieu',
                'description' => 'required',
                'img_1' => 'required',
            ],
            [
                'name.required' => 'Tên không thể trống',
                'name.unique' => 'Tên đã tồn tại',
                'description.required' => 'Mô tả không thể trống',
                'img_1.required' => 'Ảnh 1 không được trống',
            ]
        );

        $data = $request->all();
        $layout = new PhotoLayout();
        $layout->name = 'tu-lieu';
        $layout->status = 1;

        $get_img_1 = $request->file('img_1');

        // Img-1
        $get_name_img_1 = $get_img_1->getClientOriginalName();
        $name_image_1 = current(explode('.', $get_name_img_1));
        $new_image_1 = $name_image_1.'-'.rand(0,99).'.'.$get_img_1->getClientOriginalExtension();
        $path = 'uploads/tu-lieu';
        $get_img_1->move($path, $new_image_1);
        $layout->img_1 = $new_image_1;
        
    
        $layout->save();


        $tulieu = new Tulieu();
        $tulieu->photo_layout_id = $layout->id;
        $tulieu->name = $data['name'];
        $tulieu->description = $data['description'];

        $tulieu->save();

        return redirect('/tulieu');
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
        $tulieu = Tulieu::with('layout')->find($id);
        return view('admin.tulieu.edit',compact('tulieu'));
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
                'name' => 'required',
                'description' => 'required',
            ],
            [
                'name.required' => 'Tên không thể trống',
                'description.required' => 'Mô tả không thể trống',
            ]
        );

        $data = $request->all();

        $tulieu = Tulieu::find($id);

        $layout = PhotoLayout::find($tulieu->photo_layout_id);
        $layout->name = 'tu-lieu';

        $get_img_1 = $request->file('img_1');

        // Img-1
        if($get_img_1){
            $path_file = 'uploads/tu-lieu/'.$layout->img_1;
            if(file_exists($path_file)){
                unlink($path_file);
            }

            $get_name_img_1 = $get_img_1->getClientOriginalName();
            $name_image_1 = current(explode('.', $get_name_img_1));
            $new_image_1 = $name_image_1.'-'.rand(0,99).'.'.$get_img_1->getClientOriginalExtension();
            $path = 'uploads/tu-lieu';
            $get_img_1->move($path, $new_image_1);
            $layout->img_1 = $new_image_1;
        }

        $layout->save();

        $tulieu->name = $data['name'];
        $tulieu->description = $data['description'];

        $tulieu->save();

        return redirect('/tulieu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tulieu = Tulieu::find($id);
        $photo_layout = PhotoLayout::find($tulieu->photo_layout_id);
        for ($i=1; $i <= 4; $i++) { 
            $img = 'img_'.$i;
            $path = 'uploads/tu-lieu/'.$photo_layout->$img;
            if(file_exists($path)){
                unlink($path);
            }
        }
        PhotoLayout::find($photo_layout->id)->delete();
        return redirect()->back()->with('status', 'Xóa ảnh thành công');
    }

    public function active($id)
    {
        $tulieu = Tulieu::find($id);
        $tulieu->status = 1;
        $tulieu->save();
        return redirect()->back();
    }

    public function unactive($id)
    {
        $tulieu = Tulieu::find($id);
        $tulieu->status = 0;
        $tulieu->save();
        return redirect()->back();
    }
}
