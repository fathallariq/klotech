<div class="container">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          @foreach ($slide as $key => $row)
          <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img src="{{ asset('uploads/' . $row->gambar_slide )}}" class="d-block w-100" style="height: 700; width: 1080;" alt="...">
          </div>
          @endforeach
    </div>
</div>