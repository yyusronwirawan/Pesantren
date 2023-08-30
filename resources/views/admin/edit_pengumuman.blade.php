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
                            <form method="POST" action="{{route('data-pengumuman.update', $pengumuman->id)}}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="old_image" value="{{$pengumuman->gambar}}">
                                <div class="mb-3">
                                    <label for="" class="form-label">Judul Pengumuman</label>
                                    <input name="judul" value="{{$pengumuman->judul}}" type="text" class="form-control">
                                </div>

                                <input name="kategori" value="{{$pengumuman->kategori}}" type="text" class="form-control" hidden>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar/File</label>
                                    <div class="row">
                                        <div class="col">
                                            <input readonly type="text" class="form-control mt-3" name="old_image" value="{{ $pengumuman->gambar }}">
                                        </div>
                                        <div class="col">
                                            <input name="gambar" id="new_gambar" type="file" class="form-control-file" style="z-index: 1; margin-right:-105px ; margin-top:20px;">
                                            <label for="new_gambar" class="btn btn-info mt-3" style="z-index: 2; margin-left:-315px ;margin-bottom:20px;"><i class="fas fa-upload"></i> Ganti gambar/file</label>
                                        </div>
                                    </div>


                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" value="" class="form-control" rows="10">{{$pengumuman->deskripsi}}</textarea>
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