<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class IklanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iklan = Iklan::all();
        return view('back.iklan.index', compact('iklan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.iklan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_iklan' => 'required|min:3',
            'gambar_iklan' => 'mimes:png,jpg,jpeg,gif,bmp'

        ]);

        if (!empty($request->file('gambar_iklan'))) {
            $data = $request->all();
            $data['gambar_iklan'] = $request->file('gambar_iklan')->store('iklan');

            Iklan::create($data);

            Alert::success('Berhasil', 'Data Berhasil Tersimpan');
            return redirect()->route('iklan.index');

        } else {
            $data = $request->all();

            Iklan::create($data);

            Alert::success('Berhasil', 'Data Berhasil Tersimpan');
            return redirect()->route('iklan.index');
        }
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
        $iklan = Iklan::find($id);

        return view('back.iklan.edit', compact('iklan'));
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
        if(empty($request->file('gambar_iklan'))){
             
            $iklan = Iklan::find($id);
            $iklan->update([
                'judul_iklan' => $request->judul_iklan,
                'link' => $request->link,
                'status' => $request->status,
                'user_id' => Auth::id(),
            ]);

            Alert::info('Updated', 'Data Berhasil Diupdate');
            return redirect()->route('iklan.index');
            
            
        } else {
            $iklan = Iklan::find($id);
            Storage::delete($iklan->gambar_iklan);
            $iklan->update([
                'judul_iklan' => $request->judul_iklan,
                'link' => $request->link,
                'status' => $request->status,
                'user_id' => Auth::id(),
                'gambar_iklan' => $request->file('gambar_iklan')->store('iklan'),
            ]);

            Alert::info('Updated', 'Data Berhasil Diupdate');
            return redirect()->route('iklan.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $iklan = Iklan::find($id);
        if (!$iklan) {
            return redirect()->route('iklan.index')->with('success', 'Data Tidak Ada'); 
        }
        Storage::delete($iklan->gambar_iklan);
        $iklan->delete();
        return redirect()->route('iklan.index')->with('success', 'Data Berhasil Dihapus');
    }
}
