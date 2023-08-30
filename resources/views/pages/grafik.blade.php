@extends('layouts.main')
@section('container')
@include('umum.navbar')
@include('umum.sidebar')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-success text-white me-2">
          <a href="{{ URL::previous() }}" style="color:white"><i class="fas fa-arrow-circle-left"></i></a>
        </span> Grafik Perkembangan Santri
      </h3>
    </div>
    <div class="card">
      <div class="card-body">
        <div id="grafik" class="responsive"></div>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script type="text/javascript">
          var optionsTahunPeserta = {
            chart: {
              type: 'bar',
              // height: 390,
              width: 700,
              toolbar: {
                show: false,
              }
            },
            series: [{
              data: [
                // 1, 2, 3, 4
                {
                  {
                    $tahun5
                  }
                }, {
                  {
                    $tahun4
                  }
                }, {
                  {
                    $tahun3
                  }
                }, {
                  {
                    $tahun2
                  }
                }, {
                  {
                    $tahun
                  }
                }
              ]
            }],
            xaxis: {
              categories: [{
                {
                  \
                  Carbon\ Carbon::now() - > subYear(4) - > format('Y')
                }
              }, {
                {
                  \
                  Carbon\ Carbon::now() - > subYear(3) - > format('Y')
                }
              }, {
                {
                  \
                  Carbon\ Carbon::now() - > subYear(2) - > format('Y')
                }
              }, {
                {
                  \
                  Carbon\ Carbon::now() - > subYear(1) - > format('Y')
                }
              }, {
                {
                  \
                  Carbon\ Carbon::now() - > format('Y')
                }
              }]
            }
          }
          var chart = new ApexCharts(
            document.querySelector('#grafik'),
            optionsTahunPeserta
          )
          chart.render()
        </script>
      </div>
    </div>

  </div>

  @include('umum.footer')
</div>