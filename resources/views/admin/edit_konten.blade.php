@include('admin.layouts.head')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('admin.layouts.sidebar')
        <div class="layout-page">
            @include('admin.layouts.navbar')
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{route('data-konten.update', $uploads->id)}}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="old_image" value="{{$uploads->gambar}}">
                                <div class="mb-3">
                                    <label for="" class="form-label">Judul Content</label>
                                    <input name="judul" value="{{$uploads->judul}}" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Kategori</label>
                                    <input name="kategori" value="{{$uploads->kategori}}" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input name="gambar" id="gambar" type="file" class="form-control mt-3">
                                    <img src="{{ URL::to('/')}}/content/{{ $uploads->gambar }}" class="img-thumbnail" height="10%" width="50%"></img>
                                    <input type="hidden" class="form-control-file mt-3" name="old_image" value="{{ $uploads->gambar }}">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Deskripsi</label>
                                    <input name="deskripsi" value="{{$uploads->deskripsi}}" type="text" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layouts.foot')
        </div>
    </div>
</div>