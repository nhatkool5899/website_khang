<?php

namespace App\Http\Controllers;

use App\Models\ChinhSach;
use App\Models\DatMay;
use App\Models\LaySoDo;
use App\Models\LienHe;
use Illuminate\Http\Request;

class PageFooterController extends Controller
{
    public function LaySoDo()
    {
        $laysodo = LaySoDo::find(1);
        return view('admin.footer.laysodo', compact('laysodo'));
    }

    public function LaySoDo_update(Request $request)
    {
        $data = $request->all();
        $laysodo = LaySoDo::find(1);
        $laysodo->title = $data['title'];
        $laysodo->content_1 = $data['content_1'];
        $laysodo->content_2 = $data['content_2'];
        $laysodo->save();
        return redirect()->back()->with('status', 'Cập nhật thành công');
    }

    public function DatMay()
    {
        $datmay = DatMay::find(1);
        return view('admin.footer.datmay', compact('datmay'));
    }

    public function DatMay_update(Request $request)
    {
        $data = $request->all();
        $datmay = DatMay::find(1);
        $datmay->title_1 = $data['title_1'];
        $datmay->title_2 = $data['title_2'];
        $datmay->title_3 = $data['title_3'];
        $datmay->content_1 = $data['content_1'];
        $datmay->content_2 = $data['content_2'];
        $datmay->content_3 = $data['content_3'];

        $datmay->save();

        return redirect()->back()->with('status', 'Cập nhật thành công');
    }

    public function ChinhSach()
    {
        $chinhsach = ChinhSach::find(1);
        return view('admin.footer.chinhsach', compact('chinhsach'));
    }

    public function ChinhSach_update(Request $request)
    {
        $data = $request->all();
        $chinhsach = ChinhSach::find(1);
        $chinhsach->title = $data['title'];
        $chinhsach->content = $data['content'];

        $chinhsach->save();

        return redirect()->back()->with('status', 'Cập nhật thành công');
    }

    public function LienHe()
    {
        $lienhe = LienHe::find(1);
        return view('admin.footer.lienhe', compact('lienhe'));
    }

    public function LienHe_update(Request $request)
    {
        $data = $request->all();
        $lienhe = LienHe::find(1);
        $lienhe->title = $data['title'];
        $lienhe->content = $data['content'];

        $lienhe->save();

        return redirect()->back()->with('status', 'Cập nhật thành công');
    }
    
}
