@extends('front.layouts.frontend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 mt-4">
            <div>
                <img src="{{ asset('uploads/' . $artikel->gambar_artikel )}}" class="img-fluid" alt="">
            </div>
            <div class="detail-content mt-2 p-4">
                <div class="detail-badge">
                    <a href="" class="badge bg-warning">{{ $artikel->kategori->nama_kategori }}</a>
                    <a href="" class="badge bg-primary">{{ $artikel->users->name }}</a>
                </div>
                <h2>{{ $artikel->judul }}</h2>
                <div class="detail-body">
                    <p>
                        {{ $artikel->body }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="div detail-sidebar-iklan">
                <h4>{{ $iklan->judul_iklan }}</h4>
                <hr>
                <a href="">
                    <img src="{{ asset('uploads/' . $iklan->gambar_iklan)}}" width="350px" alt="">
                </a>
            </div>

            <div class="detail-sidebar-kategori">
                <h4 class="mt-4">Kategori</h4>
                <hr>
                @foreach ($kategori as $row)
                <div class="sidebar-kategori d-flex flex-wrap">
                    <a href="">
                        <p>{{ $row->nama_kategori }}</p>
                    </a>
                    <p class="ms-auto text-end"><span class="badge bg-dark">{{ $row->artikel->count() }}</span></p>
                </div>
                @endforeach
            </div>

            <div class="detail-sidebar-artikel">
                <h4 class="mt-4">Artikel Terbaru</h4>
                <hr>
                @foreach ($postinganTerbaru as $row)
                <div class="d-flex mt-3">
                    <div class="flex-shrink-0">
                      <img src="{{ asset('uploads/' . $row->gambar_artikel )}}" width="50px" alt="...">
                    </div>
                   <div class="flex-grow-1 ms-3">
                      <h6 class="mt-0">{{ $row->judul }}</h6>
                    </div> 
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection