@extends('layouts.main')
@section('container')
@include('partials.navbar')
@include('partials.sidebar')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-success text-white me-2">
          <a href="{{ URL::previous() }}" style="color:white"><i class="fas fa-arrow-circle-left"></i></a>
        </span> Jadwal Kegiatan
      </h3>
    </div>

    <div class="card  ">
      <div class="card-body">
        <div class="row d-block d-sm-none">
          <div class="col-md-6 grid-margin">
            <div class="card-title mt-3">Hari Ahad</div>
            <div class="list-group">
              @if($ahad->isEmpty())
              <small>Belum ada data</small>
              @endif
              @foreach($ahad as $minggu)
              <div class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{$minggu->kegiatan}}</h5>
                </div>
                <small>{{$minggu->mulai}} - {{$minggu->selesai}} WIB</small>
                <p> <small>Tempat : {{$minggu->tempat}}</small></p>
              </div>
              @endforeach
            </div>

            <div class="card-title mt-3">Hari Senin</div>
            <div class="list-group">
              @if($senin->isEmpty())
              <small>Belum ada data</small>
              @endif
              @foreach($senin as $sen)
              <div class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{$sen->kegiatan}}</h5>
                </div>
                <small>{{$sen->mulai}} - {{$sen->selesai}} WIB</small>
                <p> <small>Tempat : {{$sen->tempat}}</small></p>
              </div>
              @endforeach
            </div>

            <div class="card-title mt-3">Hari Selasa</div>
            <div class="list-group">
              @if($selasa->isEmpty())
              <small>Belum ada data</small>
              @endif
              @foreach($selasa as $sel)
              <div class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{$sel->kegiatan}}</h5>
                </div>
                <small>{{$sel->mulai}} - {{$sel->selesai}} WIB</small>
                <p> <small>Tempat : {{$sel->tempat}}</small></p>
              </div>
              @endforeach
            </div>

            <div class="card-title mt-3">Hari Rabu</div>
            <div class="list-group">
              @if($rabu->isEmpty())
              <small>Belum ada data</small>
              @endif
              @foreach($rabu as $rab)
              <div class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{$rab->kegiatan}}</h5>
                </div>
                <small>{{$rab->mulai}} - {{$rab->selesai}} WIB</small>
                <p> <small>Tempat : {{$rab->tempat}}</small></p>
              </div>
              @endforeach
            </div>
          </div>

          <div class="col-md-6 grid-margin ">
            <div class="card-title mt-3">Hari Kamis</div>
            <div class="list-group">
              @if($kamis->isEmpty())
              <small>Belum ada data</small>
              @endif
              @foreach($kamis as $kam)
              <div class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{$kam->kegiatan}}</h5>
                </div>
                <small>{{$kam->mulai}} - {{$kam->selesai}} WIB</small>
                <p> <small>Tempat : {{$kam->tempat}}</small></p>
              </div>
              @endforeach
            </div>

            <div class="card-title mt-3">Hari Jumat</div>
            <div class="list-group">
              @if($jumat->isEmpty())
              <small>Belum ada data</small>
              @endif
              @foreach($jumat as $jum)
              <div class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{$jum->kegiatan}}</h5>
                </div>
                <small>{{$jum->mulai}} - {{$jum->selesai}} WIB</small>
                <p> <small>Tempat : {{$jum->tempat}}</small></p>
              </div>
              @endforeach
            </div>

            <div class="card-title mt-3">Hari Sabtu</div>
            <div class="list-group">
              @if($sabtu->isEmpty())
              <small>Belum ada data</small>
              @endif
              @foreach($sabtu as $sab)
              <div class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{$sab->kegiatan}}</h5>
                </div>
                <small>{{$sab->mulai}} - {{$sab->selesai}} WIB</small>
                <p> <small>Tempat : {{$sab->tempat}}</small></p>
              </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="tabel table-responsive d-none d-sm-block" style="margin-top: 20px">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Hari</th>
                <th>Kegiatan</th>
                <th>Waktu</th>
                <th>Tempat</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td rowspan="{{$ahad->count()}}">Ahad</td>
                @foreach ($ahad as $ahad)

                <td>{{$ahad->kegiatan}}</td>
                <td>{{$ahad->mulai}}-{{$ahad->selesai}}</td>
                <td>{{$ahad->tempat}}</td>
              </tr>
              @endforeach
              <tr>
                <td rowspan="{{$senin->count()}}">Senin</td>
                @foreach ($senin as $senin)
                <td>{{$senin->kegiatan}}</td>
                <td>{{$senin->mulai}}-{{$senin->selesai}}</td>
                <td>{{$senin->tempat}}</td>
              </tr>
              @endforeach
              <tr>
                <td rowspan="{{$selasa->count()}}">Selasa</td>
                @foreach ($selasa as $selasa)
                <td>{{$selasa->kegiatan}}</td>
                <td>{{$selasa->mulai}}-{{$selasa->selesai}}</td>
                <td>{{$selasa->tempat}}</td>
              </tr>
              @endforeach
              <tr>
                <td rowspan="{{$rabu->count()}}">Rabu</td>
                @foreach ($rabu as $rabu)
                <td>{{$rabu->kegiatan}}</td>
                <td>{{$rabu->mulai}}-{{$rabu->selesai}}</td>
                <td>{{$rabu->tempat}}</td>
              </tr>
              @endforeach
              <tr>
                <td rowspan="{{$kamis->count()}}">Kamis</td>
                @foreach ($kamis as $kamis)
                <td>{{$kamis->kegiatan}}</td>
                <td>{{$kamis->mulai}}-{{$kamis->selesai}}</td>
                <td>{{$kamis->tempat}}</td>
              </tr>
              @endforeach
              <tr>
                <td rowspan="{{$jumat->count()}}">Jumat</td>
                @foreach ($jumat as $jumat)
                <td>{{$jumat->kegiatan}}</td>
                <td>{{$jumat->mulai}}-{{$jumat->selesai}}</td>
                <td>{{$jumat->tempat}}</td>
              </tr>
              @endforeach
              <tr>
                <td rowspan="{{$sabtu->count()}}">Sabtu</td>
                @foreach ($sabtu as $sabtu)
                <td>{{$sabtu->kegiatan}}</td>
                <td>{{$sabtu->mulai}}-{{$sabtu->selesai}}</td>
                <td>{{$sabtu->tempat}}</td>
              </tr>
              @endforeach

            </tbody>
            {{-- @endforeach --}}
          </table>
        </div>

      </div>
    </div>

  </div>
  @include('partials.footer')
</div>