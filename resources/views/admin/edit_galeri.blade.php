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
                            <form method="POST" action="{{route('data-galeri.update', $galeri->id)}}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="old_image" value="{{$galeri->gambar}}">
                                <div class="mb-3">
                                    <label for="" class="form-label">Judul Gambar</label>
                                    <input name="judul" value="{{$galeri->judul}}" type="text" class="form-control">
                                </div>

                                <input name="kategori" value="{{$galeri->kategori}}" type="text" class="form-control" hidden>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <div class="row">
                                        <div class="col">
                                            <input readonly type="text" class="form-control mt-3" name="old_image" value="{{ $galeri->gambar }}">
                                        </div>
                                        <div class="col">
                                            <input name="gambar" id="new_gambar" type="file" class="form-control-file" style="z-index: 1; margin-right:-75px ; margin-top:20px;">
                                            <label for="new_gambar" class="btn btn-info mt-3" style="z-index: 2; margin-left:-315px ;margin-bottom:20px;"><i class="fas fa-upload"></i> Ganti gambar</label>
                                        </div>
                                    </div>


                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" value="" class="form-control">{{$galeri->deskripsi}}</textarea>
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