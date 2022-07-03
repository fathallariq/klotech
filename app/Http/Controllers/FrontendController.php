<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Slide;
use App\Models\Iklan;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
   public function index(){

      $artikel = Artikel::all();
      $kategori = Kategori::all();
      $slide = Slide::all();
        return view('front.home', [
            'artikel' => $artikel,
            'kategori' => $kategori,
            'slide' => $slide,
        ]);
   }

   public function detail($slug)
   {
      $artikel = Artikel::where('slug', $slug)->first();
      
      $kategori = Kategori::all();
      
      $iklan = Iklan::where('id', '1')->first();


      $postinganTerbaru = Artikel::orderBy('created_at', 'DESC')->limit(4)->get();


      return view('front.artikel.detail-artikel', [
         'artikel' => $artikel,
         'kategori' => $kategori,
         'iklan' => $iklan,
         'postinganTerbaru' => $postinganTerbaru,
      ]);

   }
}
