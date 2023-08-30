@include('admin.layouts.head')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('admin.layouts.sidebar')
        <div class="layout-page">
            @include('admin.layouts.navbar')
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4>Detail Pengumuman</h4>
                    <div class="card">
                        <div class="card-body">
                            <h5>{{ $pengumuman->judul }}</h5>
                            <p>{{ $pengumuman->deskripsi }}</p>
                            @if (substr($pengumuman->gambar, -3) == "jpg" or substr($pengumuman->gambar, -3) == "png" or substr($pengumuman->gambar, -3) == "jpeg")
                            <img src="{{ asset('/content/'. $pengumuman->gambar) }}" alt="">
                            @else
                            <a href="{{ asset('/content/'. $pengumuman->gambar) }}" class="btn btn-info"><i class="fas fa-download"></i> Download file pdf</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layouts.foot')
        </div>
    </div>
</div>