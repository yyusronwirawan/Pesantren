<div class="table-responsive">
  <table class="table table-striped table-hover" style="vertical-align: middle">
    <tr>
      <th>No.</th>
      <th>Nama Guru</th>
      <th>Mata Pelajaran</th>

    </tr>

    @foreach($guru as $item)
    <tr>
      <td>{{ $loop->index + 1 }}</td>
      <td>{{ $item->nama_guru }}</td>
      <td>{{ $item->mata_pelajaran }}</td>
      <td>
        @foreach($guru as $str )
        {{$str}}
        {{ $str->nama_santri }},
        @endforeach
      </td>
    </tr>
    @endforeach
  </table>
</div>