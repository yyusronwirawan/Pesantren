@extends('pengurus.main')
<!-- container -->
@section('pengurus')
<!-- Navbar -->
@include('pengurus.navbar')
<!-- Sidebar -->
@include('pengurus.sidebar')
<!-- Content Wrapper. Contains page content -->
<main id="main" class="main">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

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

            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="{{ URL::to('/')}}/profil/{{ $akun->foto }}" alt="Profile" class="rounded">
              <h2>{{ auth()->user()->name }}</h2>
              <h3>{{ auth()->user()->username }}</h3>
            </div>

            <h5 class="card-title">Profile</h5>

            <div class="row">

              <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
              <div class="col-lg-9 col-md-8">{{ auth()->user()->name }}</div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">Username</div>
              <div class="col-lg-9 col-md-8">{{ auth()->user()->username }}</div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">Level</div>
              <div class="col-lg-9 col-md-8">{{ auth()->user()->level }}</div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">Email</div>
              <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
            </div>

          </div>

          <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

            <!-- Profile Edit Form -->
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
            <form action="{{ route('akun-saya.update', $akun->id) }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <div class="row mb-3">
                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Photo Profil</label>
                <input type="hidden" name="old_image" value="{{$akun->foto}}">
                <div class="col-md-8 col-lg-9">
                  <img src="{{ URL::to('/')}}/profil/{{ $akun->foto }}" alt="Profile">
                  <div class="pt-2">
                    <input type="hidden" class="form-control-file mt-3" name="old_image" value="{{auth()->user()->foto}}">
                    <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" required>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                <div class="col-md-8 col-lg-9">
                  <input class="form-control" type="text" id="name" name="name" value="{{auth()->user()->name}}" autofocus>
                </div>
              </div>

              <div class="row mb-3">
                <label for="company" class="col-md-4 col-lg-3 col-form-label">Username</label>
                <div class="col-md-8 col-lg-9">
                  <input class="form-control" type="text" name="username" id="username" value="{{auth()->user()->username}}" />
                </div>
              </div>

              <div class="row mb-3">
                <label for="Job" class="col-md-4 col-lg-3 col-form-label">Level</label>
                <div class="col-md-8 col-lg-9">
                  <input class="form-control" type="text" name="level" id="level" value="{{auth()->user()->level}}" readonly />
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
                  <input class="form-control" name="alamat" type="text" id="alamat" value="{{auth()->user()->alamat}}" />
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

          </div>


          <div class="tab-pane fade pt-3" id="profile-change-password">
            <!-- Change Password Form -->
            <form action="{{ route('password-pengurus', $akun->id)}}" method="POST">
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
  </section>