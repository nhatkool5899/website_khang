<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\BannerHome;
use App\Models\Cauhoi;
use App\Models\ChinhSach;
use App\Models\Collected;
use App\Models\DatMay;
use App\Models\LaySoDo;
use App\Models\LienHe;
use App\Models\PhotoLayout;
use App\Models\Sanpham;
use App\Models\Service;
use App\Models\TitleHome;
use App\Models\Tulieu;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {

        $user_ip  = request()->ip();

        $visitor_onl = Visitor::where('ip_address', $user_ip)->get();
        if (count($visitor_onl) < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip;
            $visitor->data_visitor = Carbon::today();
            $visitor->save();
        }

        $banner = BannerHome::where('status', 1)->orderBy('vitri', 'asc')->get();

        $title = TitleHome::find(1);

        $sanpham = Sanpham::where('danhmuc_id', 1)->orderBy('id', 'desc')->take(5)->get();
        $phukien = Sanpham::where('danhmuc_id', 2)->orderBy('id', 'desc')->take(5)->get();
        $chatlieu = Sanpham::where('danhmuc_id', 3)->orderBy('id', 'desc')->take(5)->get();

        $photo_1 = PhotoLayout::where('name', 'trang-chu')->where('status', 1)->first();
        $photo_2 = PhotoLayout::where('name', 'trang-chu')->where('id', '>', $photo_1->id)->where('status', 1)->first();

        $stories = PhotoLayout::where('name', 'stories')->where('status', 1)->take(3)->get();

        return view('pages.trangchu', compact('banner', 'title', 'photo_1', 'photo_2', 'sanpham', 'phukien', 'chatlieu', 'photo_1', 'photo_2', 'stories'));
    }

    public function whatsnew()
    {
        $user_ip  = request()->ip();

        $visitor_onl = Visitor::where('ip_address', $user_ip)->get();
        if (count($visitor_onl) < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip;
            $visitor->data_visitor = Carbon::today();
            $visitor->save();
        }

        $banner = Banner::find(1);
        // $whatsnew = PhotoLayout::where('name', 'whats-new')->where('status', 1)->take(3)->get();
        return view('pages.whatsnew', compact('banner'));
    }

    public function bosuutap(Request $request)
    {

        $user_ip  = request()->ip();

        $visitor_onl = Visitor::where('ip_address', $user_ip)->get();
        if (count($visitor_onl) < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip;
            $visitor->data_visitor = Carbon::today();
            $visitor->save();
        }

        $banner = Banner::find(2);

        // $sanpham = Sanpham::where('danhmuc_id', 1)->orderBy('id','desc')->take(6)->get();

        return view('pages.trangphuc', compact('banner'));
    }

    public function phukien()
    {

        $user_ip  = request()->ip();

        $visitor_onl = Visitor::where('ip_address', $user_ip)->get();
        if (count($visitor_onl) < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip;
            $visitor->data_visitor = Carbon::today();
            $visitor->save();
        }

        $banner = Banner::find(3);
        $sanpham = Sanpham::with('danhmuc')->where('danhmuc_id', 2)->orderBy('id', 'desc')->take(6)->get();
        return view('pages.phukien', compact('banner', 'sanpham'));
    }

    public function chatlieu()
    {

        $user_ip  = request()->ip();

        $visitor_onl = Visitor::where('ip_address', $user_ip)->get();
        if (count($visitor_onl) < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip;
            $visitor->data_visitor = Carbon::today();
            $visitor->save();
        }

        $banner = Banner::find(4);
        $sanpham = Sanpham::where('danhmuc_id', 3)->orderBy('id', 'desc')->take(6)->get();
        return view('pages.chatlieu', compact('banner', 'sanpham'));
    }

    public function khachhang()
    {

        $user_ip  = request()->ip();

        $visitor_onl = Visitor::where('ip_address', $user_ip)->get();
        if (count($visitor_onl) < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip;
            $visitor->data_visitor = Carbon::today();
            $visitor->save();
        }

        $banner = Banner::find(5);
        $collected = Collected::with('layout')->where('status', 1)->orderBy('id', 'asc')->take(3)->get();
        return view('pages.khachhang', compact('banner', 'collected'));
    }

    public function dichvu()
    {

        $user_ip  = request()->ip();

        $visitor_onl = Visitor::where('ip_address', $user_ip)->get();
        if (count($visitor_onl) < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip;
            $visitor->data_visitor = Carbon::today();
            $visitor->save();
        }

        $banner = Banner::find(6);
        $dichvu = Service::orderBy('id', 'ASC')->get();
        return view('pages.dichvu', compact('dichvu',  'banner'));
    }

    public function tulieu()
    {

        $user_ip  = request()->ip();

        $visitor_onl = Visitor::where('ip_address', $user_ip)->get();
        if (count($visitor_onl) < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip;
            $visitor->data_visitor = Carbon::today();
            $visitor->save();
        }

        $banner = Banner::find(7);
        $tulieu = Tulieu::with('layout')->where('status', 1)->orderBy('id', 'asc')->take(4)->get();
        return view('pages.tulieu', compact('banner', 'tulieu'));
    }

    public function about()
    {

        $user_ip  = request()->ip();

        $visitor_onl = Visitor::where('ip_address', $user_ip)->get();
        if (count($visitor_onl) < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip;
            $visitor->data_visitor = Carbon::today();
            $visitor->save();
        }

        $banner = Banner::find(8);
        $about = About::find(1);
        return view('pages.about-us', compact('banner', 'about'));
    }

    public function chitiet_sanpham($slug)
    {
        $sanpham = Sanpham::with('danhmuc')->where('slug', $slug)->first();
        // print_r (json_decode($sanpham->list_img));
        return view('pages.chitiet', compact('sanpham'));
    }

    public function chitiet_whatsnew($id)
    {
        $layout = PhotoLayout::find($id);
        return view('pages.chitiet_whatsnew', compact('layout'));
    }

    public function chitiet_khachhang($id)
    {
        $collected = Collected::find($id);
        return view('pages.chitiet_khachhang', compact('collected'));
    }

    public function chitiet_tulieu($id)
    {
        $tulieu = Tulieu::find($id);
        return view('pages.chitiet_tulieu', compact('tulieu'));
    }

    public function chitiet_dichvu($id)
    {
        $dichvu = Service::find($id);
        return view('pages.chitiet_dichvu', compact('dichvu'));
    }

    public function cau_hoi()
    {
        $cauhoi = Cauhoi::orderBy('id', 'desc')->get();
        return view('pages.page_ft.cauhoi', compact('cauhoi'));
    }

    public function lay_so_do()
    {
        $laysodo = LaySoDo::find(1);
        return view('pages.page_ft.laysodo', compact('laysodo'));
    }
    public function dat_may()
    {
        $datmay = DatMay::find(1);
        return view('pages.page_ft.datmay', compact('datmay'));
    }
    public function chinh_sach()
    {
        $chinhsach = ChinhSach::find(1);
        return view('pages.page_ft.chinhsach', compact('chinhsach'));
    }
    public function lien_he()
    {
        $lienhe = LienHe::find(1);
        return view('pages.page_ft.lienhe', compact('lienhe'));
    }

    public function stories($id)
    {
        $stories = PhotoLayout::find($id);
        return view('pages.stories', compact('stories'));
    }


    public function search(Request $request)
    {
        $data = $request->all();
        $keyword = $data['keywords'];

        $sanpham = Sanpham::where('name', 'LIKE', '%' . $keyword . '%')->get();
        $whatsnew = PhotoLayout::where('name', 'whats-new')->where('title', 'LIKE', '%' . $keyword . '%')->get();
        $khachhang = Collected::with('layout')->where('name', 'LIKE', '%' . $keyword . '%')->orWhere('description', 'LIKE', '%' . $keyword . '%')->get();
        $tulieu = Tulieu::with('layout')->where('name', 'LIKE', '%' . $keyword . '%')->orWhere('description', 'LIKE', '%' . $keyword . '%')->get();

        // print_r($khachhang);
        return view('pages.search', compact('sanpham', 'keyword', 'whatsnew', 'khachhang', 'tulieu'));
    }
}
