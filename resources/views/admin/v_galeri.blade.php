@include('admin.layouts.head')
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('admin.layouts.sidebar')
        <div class="layout-page">
            @include('admin.layouts.navbar')
            <div class="content-wrapper">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Galeri</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{-- Form tambah konten  --}}
                                <form action="{{route('data-galeri.store')}}" method="POST" enctype="multipart/form-data">
                                    {{-- CSRF merupakan keamanan yang disediakan laravel  --}}
                                    @method('POST')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="" class="form-label">Judul Gambar</label>
                                        <input required name="judul" type="text" class="form-control" placeholder="Masukkan judul gambar">
                                    </div>
                                    <input type="text" name="kategori" value="galeri" hidden>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Gambar/File</label>
                                        <input name="gambar" id="gambar" type="file" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Deskripsi</label>
                                        <textarea required name="deskripsi" class="form-control" placeholder="Tambahkan deskripsi"></textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-plus-circle"></i> Tambah Galeri</button>
                            <div class="table-responsive">
                                <table class="table table-stiped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Judul Gambar</th>
                                            <th class="text-center">Gambar</th>
                                            <th class="text-center">Deskripsi</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($galeri as $g)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td>{{ $g->judul }}</td>
                                            <td> <img src="{{ asset('/content/'. $g->gambar) }}" alt="" width="20%"> {{ $g->gambar }}</td>
                                            <td>{{ $g->deskripsi }}</td>
                                            <td class="text-center">
                                                <a href="{{ asset('/content/'. $g->gambar) }}" class="btn btn-warning"><i class="fas fa-download"></i></a>
                                                <a href="{{route('data-galeri.edit', $g->id)}}" class="btn btn-primary fas fa-edit"></a>
                                                <form action="{{route('data-galeri.destroy', $g->id)}}" method="POST">

                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger fas fa-trash-alt"></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="page-bottom" style="margin: 20px">
                            <br />
                            <!-- pagination -->
                            Current Page: {{ $galeri->currentPage() }}<br>
                            Jumlah Data: {{ $galeri->total() }}<br>
                            Data perhalaman: {{ $galeri->perPage() }}<br>
                            <br>
                            {{ $galeri->links() }}
                        </div>
                    </div>
                </div>
                @include('admin.layouts.foot')
            </div>
        </div>
    </div>
</div>