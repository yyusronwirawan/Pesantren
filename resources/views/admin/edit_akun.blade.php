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
              <form method="POST" action="{{route('data-akun.update', $accounts->id)}}">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{$accounts->id}}">
                <div class="mb-3">
                  <label for="" class="form-label">Nama Lengkap</label>
                  <input name="name" value="{{$accounts->name}}" type="text" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Username</label>
                  <input name="username" value="{{$accounts->username}}" type="text" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Email</label>
                  <input name="email" value="{{$accounts->email}}" type="email" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Kelas</label>
                  <input name="kelas" value="{{$accounts->kelas}}" type="text" class="form-control">
                </div>
                <!--<div class="mb-3">-->
                <!--  <label for="" class="form-label">Kelas</label>-->
                <!--  <input name="kelas" value="{{$accounts->kelas}}" type="text" class="form-control">-->
                <!--</div>-->
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