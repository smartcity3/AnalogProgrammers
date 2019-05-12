@include('navbar')

@isset($bins)
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Status</th>
        <th scope="col">GPS</th>
      </tr>
    </thead>
    <tbody>
@foreach ($bins as $bin)
      <tr>
        <th scope="row">{{ $bin->id }}</th>
        <td>
        @if($bin->temp >= 100)
            On Fire
        @else
            Need Cleaning
        @endif
        </td>
        <td>
            {!! $bin->latitude !!}, {!! $bin->longitude !!}
        </td>
      </tr>
@endforeach
</tbody>
</table>
@endisset