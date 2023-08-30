@extends('layouts.main')
<!-- container -->
@section('container')
<!-- Navbar -->
@include('partials.navbar')
<!-- Sidebar -->
@include('partials.sidebar')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-success text-white me-2">
          <a href="{{ URL::previous() }}" style="color:white"><i class="fas fa-arrow-circle-left"></i></a>
        </span> Akun Saya
      </h3>
    </div>
    <section class="section profile">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Detail</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Password</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">

              <div class="card-body d-flex flex-column align-items-center">
                <img src="{{ URL::to('/')}}/profil/{{ $accounts->foto }}" alt="Profile" class="rounded" width="200px">
                <h4>{{ auth()->user()->name }}</h4>
                <h5>{{ auth()->user()->username }}</h5>
              </div>

              <h5 class="card-title">Profile</h5>

              <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Nomor Induk Santri</b> <br />{{ auth()->user()->username }}</li>
                <li class="list-group-item"><b>Nama Lengkap</b> <br />{{ auth()->user()->name }}</li>
                <li class="list-group-item"><b>Tanggal Lahir</b> <br />{{auth()->user()->tgl_lahir}}</li>
                <li class="list-group-item"><b>Alamat</b> <br />{{ auth()->user()->alamat }}</li>
                <li class="list-group-item"><b>Angkatan</b> <br />{{ auth()->user()->angkatan }}</li>
                <li class="list-group-item"><b>Kelas</b> <br />{{ auth()->user()->kelas }}</li>
              </ul>
              <div class="mt-4">
                <div class="card-title"> Wali/Orangtua</div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><b>Nama Ayah</b> <br />{{ auth()->user()->nama_ayah }}</li>
                  <li class="list-group-item"><b>Nama Ibu</b> <br />{{ auth()->user()->nama_ibu }}</li>
                  <li class="list-group-item"><b>No Handphone </b> <br />{{ auth()->user()->no_hp }}</li>
                </ul>
              </div>

            </div>
            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->

              <form action="{{ route('profil-user.update', $accounts->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Photo Profil</label>
                  <input type="hidden" name="old_image" value="{{$accounts->foto}}">
                  <div class="col-md-8 col-lg-9">
                    <img src="{{ URL::to('/')}}/profil/{{ $accounts->foto }}" alt="Profile" width="100px">
                    <div class="pt-2">
                      <input type="hidden" class="form-control-file mt-3" name="old_image" value="{{auth()->user()->foto}}">
                      <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                  <div class="col-md-8 col-lg-9">
                    <input class="form-control" type="text" id="name" name="name" value="{{auth()->user()->name}}" autofocus />
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="company" class="col-md-4 col-lg-3 col-form-label">NIS</label>
                  <div class="col-md-8 col-lg-9">
                    <input class="form-control" type="text" name="username" id="username" value="{{auth()->user()->username}}" readonly />
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Job" class="col-md-4 col-lg-3 col-form-label">Level</label>
                  <div class="col-md-8 col-lg-9">
                    <input class="form-control" name="level" type="text" id="level" value="{{auth()->user()->level}}" readonly />
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input class="form-control" type="text" id="email" name="email" value="{{auth()->user()->email}}" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Tanggal Lahir</label>
                  <div class="col-md-8 col-lg-9">
                    <input class="form-control" name="tgl_lahir" type="date" id="tgl_lahir" value="{{auth()->user()->tgl_lahir}}" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea class="form-control" name="alamat" type="text" id="alamat">{{auth()->user()->alamat}}</textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Angkatan</label>
                  <div class="col-md-8 col-lg-9">
                    <input class="form-control" name="angkatan" type="text" id="angkatan" value="{{auth()->user()->angkatan}}" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Kelas</label>
                  <div class="col-md-8 col-lg-9">
                    <input class="form-control" name="kelas" type="text" id="kelas" value="{{auth()->user()->kelas}}" readonly />
                  </div>
                </div>
                <div class="card-title">Data Orangtua/wali</div>
                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Nama Ayah</label>
                  <div class="col-md-8 col-lg-9">
                    <input class="form-control" name="nama_ayah" type="text" id="nama_ayah" value="{{auth()->user()->nama_ayah}}" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Nama Ibu</label>
                  <div class="col-md-8 col-lg-9">
                    <input class="form-control" name="nama_ibu" type="text" id="nama_ibu" value="{{auth()->user()->nama_ibu}}" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">No Telp</label>
                  <div class="col-md-8 col-lg-9">
                    <input class="form-control" name="no_hp" type="text" id="no_hp" value="{{auth()->user()->no_hp}}" />
                  </div>
                </div>
                <div class="mt-2">
                  <button type="submit" class="btn btn-primary me-2">Update</button>
                  <button type="reset" class="btn btn-outline-secondary">Batal</button>
                </div>
              </form><!-- End Profile Edit Form -->
              @if(Session::get('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif

              @if(Session::get('failed'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('failed') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
            </div>


            <div class="tab-pane fade pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <form action="{{ route('password-user', $accounts->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Lama</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Masukan Password Lama">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukan Password Baru">
                    @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Masukan Lagi Password Baru</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Masukan Password Baru">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Ubah Password</button>
                </div>
              </form><!-- End Change Password Form -->



            </div><!-- End Bordered Tabs -->

          </div>
        </div>
      </div>
  </div>
</div>
</section>

</div>
@include('partials.footer')
</div>


<!-- selesai content -->
<!-- Footer -->