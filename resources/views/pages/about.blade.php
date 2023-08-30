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
        </span> About Pesantren
      </h3>
    </div>
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h3 class="card-header text-center" style="margin-bottom: 20px;">Profil Pesantren</h3>
            <div class="row">
              <div class="col">
                <p><b>Nama Pesantren</b></p>
              </div>
              <div class="col">
                <p>{{$setting->nama_pesantren}}</p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p><b>Alamat Pesantren</b></p>
              </div>
              <div class="col">
                <p>{{$setting->alamat}}</p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p><b>Pengasuh Pesantren</b></p>
              </div>
              <div class="col">
                <p>{{$setting->pengasuh}}</p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p><b>Izin Pesantren</b></p>
              </div>
              <div class="col">
                <p>{{$setting->izin}}</p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p><b>Telp Pesantren</b></p>
              </div>
              <div class="col">
                <p>{{$setting->telp}}</p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p><b>Website Pesantren</b></p>
              </div>
              <div class="col">
                <p><a href="http://{{$setting->website}}" target="_blank">{{$setting->website}}</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h3>M U Q O D D I M A H</h3>
            <p>
              Perguruan Islam Pesantren Al-Muntadhor merupakan salah satu pesantren Islam yang memadukan kurikulum diniyyah dan umum,
              bahwa penguasaan terhadap ilmu agama dan umum yang dikemas dengan akhlaqul karimah, adalah perpaduan yang harus dimiliki
              para anak didik, dalam rangka mencetak generasi Islam yang berkualitas yang siap terhadap perubahan zaman.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h3>Dasar Pemikiran</h3>
            <p>Menjawab kebutuhan masyarakat terhadap pendidikan yang membimbing peserta didik secar autuh dari keilmuan, ketaqwaan, dan amal soleh, Perguruan Islam Pesantren Al-Muntadhor Babakan Ciwaringin Cirebon, memberikan kesempatan kepada masyarakat untuk mengikuti pendidikan pesantren secara terpadu.</p>
            <p>Proses pendidikan dilaksanakan dengan mengedepankan pengasuhan dan keteladanan, menggali semua potensi pelajar santri baik secara intelegensi, emosi dan spiritual. Pembiasaan secara ketat terhadap kehidupan beragama, serta melatih keterampilan berbahsa dan memvisualisasikan ilmu-ilmu diniyyah.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body text-center">
            <h3>Maps</h3>
            <iframe class="responsive" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.658509229347!2d108.36614261404884!3d-6.68915276725453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6edefcaad37c35%3A0x163a0af6459df031!2sPondok%20Pesantren%20Al-muntadhor!5e0!3m2!1sid!2sid!4v1643802793550!5m2!1sid!2sid" width="250" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h3>Sejarah</h3>
              <p>Alm. KH Burhanudin Halim selaku Pendiri Pesantren Al Muntadhor adalah Alumni Pondok Pesantren Babakan. Beliau mondok di Babakan selama 6 tahun lamanya. Setelah mondok di Babakan, beliau memutuskan untuk melanjutkan mondok lagi di Pacitan, lebih tepatnya di Perguruan Islam Pesantren Tremas selama 7 tahun. Di sana beliau banyak mendapatkan ilmu, teman, pengalaman dsb. Kemudian beliau mendapatkan undangan dan rekomendasi dari Kyainya sendiri KH. Dimyati atau dikenal dengan panggilan Mbah Dim untuk melanjutkan ke Perguruan Tinggi Di Timur Tengah, tepatnya di Negara Sudan.</p>
              <p>Beliau kuliah di sana selama 4 tahun (S1 & S2). Setelah itu, beliau ditugaskan dan diberangkatkan ke Arab Saudi. Setelah 2 tahun lamanya, beliau diizinkan cuti dan beliau pulang ke Indonesia pada tahun 1983. Sesampainya di Indonesia, beliau silaturahim ke Kyai Tremas. Dan sebenarnya beliau punya rencana untuk berangkat ke Timur Tengah lagi. Namun Mbah Habib Dimyati berpesan “sampean kalo mau ke luar negri lagi harus nikah dulu”.</p>
              <p>Singkat cerita, beliau silaturahim ke Babakan pada Hari Jum’at dan pada Hari itu juga beliau langsung dijodohkan oleh Nyai Hj. Rohmiyah. 3 Hari kemudian, Beliau langsung Ijab Kabul bertepatan pada Hari Senin. Setelah menikah dan akan melanjutkan pergi ke Luar Negeri, KH Burhanudin kebingungan karena keluarganya itu tidak mengizinkannya untuk pergi kesana. Lalu beliau ditugaskan untuk “ngrewangi mulang” yang artinya membantu ngaji.</p>
              <p>KH. Burhanudin disuruh pindah ke Rumah yang saat ini menjadi Pondok Al Muntadhor. Berawal dari rumah, PIP Al Muntadhor ini didirikan pada tahun 1985 Masehi. Namun untuk tanggal dan Bulan pada saat didirikannya itu masih belum di ketahui, karena Gus Nawawi sendiri belum lahir. Ujarnya pada tanggal 24 Juli 2021.</p>
              <p>Warga Babakan digiring oleh Alm. KH Burhanudin Halim untuk mengaji karena beliau sendiri tidak punya santri untuk diajari. Beliau mengajari para penduduk selama 2 tahun lamanya. Setelah itu ada beberapa Wali Santri yang menitipkan anaknya untuk mondok di Perguruan Islam Pesantren Al Muntadhor. Pertama itu hanya ada 3 santri dengen rincian 1 Santri Putra dan 2 Santri Putri. Pada masanya, Toko Al Muntadhor itu sendiri dulunya adalah sebuah kamar Santri Putra.</p>
              <p>Beberapa tahun kemudian Santri yang mondok di Al Muntadhor semakin banyak, dan fakta mengejutkannya pada saat dulu itu hanya Alm. KH Burhanudin Halim saja yang mengajarkan ngaji seperti fasolatan, bahasa arab dan tidak dibantu oleh Ustad-ustad lainnya seperti saat ini.</p>
              <p>Sedikit informasi, Nama Al Muntadhor diambil dari nama asrama yang berada di Perguruan Islam Pesantren Tremas, dan arti Al Muntadhor sendiri itu berarti yang dinanti-nanti/ditunggu-tunggu.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h3>Visi dan Misi</h3>
              <ul>
                <li><b>Visi</b></li>
                <p>Terbentuknya generasi yang berprestasi berlandaskan ilmu, iman dan berakhlak mulia</p>
                <li><b>Misi</b></li>
                <p>1. Mendidik santri agar menjadi generasi yang memiliki akidah yang kokoh, berpengetahuan luas serta berakhlak mulia</p>
                <p>2. Menjadikan santri berprestasi dalam bidang akademik dan non akademik</p>
                <p>3. Melaksanakan bimbingan terpadu antara kegiatan pesantren dan kegiatan sekolah</p>
                <p>4. Melaksanakan bimbingan intensif membaca Al-Qur'an dan membaca kitab salafiyah</p>
                <p>5. Mengadakan dan mengembangkan sarana dan prasarana pondok yang memadai</p>
                <p>6. Mampu berkiprah dalam kegiatan keagamaan dan kemasyarakatan</p>
                <p>7. Menyiapkan kader yang istiqomah dalam menjalankan kegiatan-kegiatan islami dan mampu menerapkan kepada masyarakat</p>
              </ul>
            </div>
          </div>
        </div>
      </div>
      @include('umum.footer')
    </div>
  </div>
</div>