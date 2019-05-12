@include('navbar')
@isset($bins)

<div id="mapid" style="position: absolute; width: 100%; height: 90%;"></div>
<script>
    var highicon = L.icon({
        iconUrl: 'High.png',
            iconSize:     [38, 38], // size of the icon
            iconAnchor:   [22, 22], // point of the icon which will correspond to marker's location
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
    var medicon = L.icon({
            iconUrl: 'Med.png',
            iconSize:     [38, 38], // size of the icon
            iconAnchor:   [22, 22], // point of the icon which will correspond to marker's location
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
    var lowicon = L.icon({
            iconUrl: 'Low.png',
            iconSize:     [38, 38], // size of the icon
            iconAnchor:   [22, 22], // point of the icon which will correspond to marker's location
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
	var mymap = L.map('mapid').setView([37.9597152, 23.6869968], 14);

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox.streets'
    }).addTo(mymap);
    
    @foreach ($bins as $bin)
        @if($bin->volume >= 75)
        L.marker([{!! $bin->latitude !!},{!! $bin->longitude !!}],{icon: highicon}).bindPopup('<p>Volume: {{ $bin->volume }} % @auth <br>Temp: {{ $bin->temp }} &#8451<br>Battery: {{ $bin->battery }} %<br>Last clean: {{ $bin->lastclean }}<br> @isset($bin->issue) @foreach ($bin->issue as $issue) @if($issue->type==1 && $issue->hide==0) Kapaki <a href="/hide/{{ $issue->id}}" class="btnbtn-secondarybtn-info" role="button"aria-disabled="true">Fixed</a><br>  @elseif($issue->type==2 && $issue->hide==0) Roda <a href="/hide/{{ $issue->id}}" class="btnbtn-secondarybtn-info" role="button"aria-disabled="true">Fixed</a><br>  @elseif($issue->type==3 && $issue->hide==0) kamenos <a href="/hide/{{ $issue->id}}" class="btnbtn-secondarybtn-info" role="button"aria-disabled="true">Fixed</a><br>  @elseif($issue->type==4 && $issue->hide==0)spasmenos <a href="/hide/{{ $issue->id}}" class="btnbtn-secondarybtn-info" role="button"aria-disabled="true">Fixed</a><br> @endif   @endforeach @endisset @endif </p> {!! Form::open(['route' => 'issues.store']) !!}{!! Form::select('issueop', array('1' => 'Kapaki', '2' => 'Roda', '3' => 'kamenos', '4' => 'spasmenos'), null, ['placeholder' => 'Add a Issue'])!!}<input name="id" type="hidden" value="{{ $bin->id }}"> <br><br> {!! Form::submit('Submit', ['class' => 'btn btn-info btn-sm']) !!}{!! Form::close() !!}').addTo(mymap);
        @elseif ($bin->volume < 75 && $bin->volume >= 40)
        L.marker([{!! $bin->latitude !!},{!! $bin->longitude !!}],{icon: medicon}).bindPopup('<p>Volume: {{ $bin->volume }} % @auth <br>Temp: {{ $bin->temp }} &#8451<br>Battery: {{ $bin->battery }} %<br>Last clean: {{ $bin->lastclean }}<br> @isset($bin->issue) @foreach ($bin->issue as $issue) @if($issue->type==1 && $issue->hide==0) Kapaki <a href="/hide/{{ $issue->id}}" class="btnbtn-secondarybtn-info" role="button"aria-disabled="true">Fixed</a><br>  @elseif($issue->type==2 && $issue->hide==0) Roda <a href="/hide/{{ $issue->id}}" class="btnbtn-secondarybtn-info" role="button"aria-disabled="true">Fixed</a><br>  @elseif($issue->type==3 && $issue->hide==0) kamenos <a href="/hide/{{ $issue->id}}" class="btnbtn-secondarybtn-info" role="button"aria-disabled="true">Fixed</a><br>  @elseif($issue->type==4 && $issue->hide==0)spasmenos <a href="/hide/{{ $issue->id}}" class="btnbtn-secondarybtn-info" role="button"aria-disabled="true">Fixed</a><br> @endif  @endforeach @endisset @endif </p> {!! Form::open(['route' => 'issues.store']) !!}{!! Form::select('issueop', array('1' => 'Kapaki', '2' => 'Roda', '3' => 'kamenos', '4' => 'spasmenos'), null, ['placeholder' => 'Add a Issue'])!!}<input name="id" type="hidden" value="{{ $bin->id }}"> <br><br> {!! Form::submit('Submit', ['class' => 'btn btn-info btn-sm']) !!}{!! Form::close() !!}').addTo(mymap);
        @else
        L.marker([{!! $bin->latitude !!},{!! $bin->longitude !!}],{icon: lowicon}).bindPopup('<p>Volume: {{ $bin->volume }} % @auth <br>Temp: {{ $bin->temp }} &#8451<br>Battery: {{ $bin->battery }} %<br>Last clean: {{ $bin->lastclean }}<br> @isset($bin->issue) @foreach ($bin->issue as $issue) @if($issue->type==1 && $issue->hide==0) Kapaki <a href="/hide/{{ $issue->id}}" class="btnbtn-secondarybtn-info" role="button"aria-disabled="true">Fixed</a><br>  @elseif($issue->type==2 && $issue->hide==0) Roda <a href="/hide/{{ $issue->id}}" class="btnbtn-secondarybtn-info" role="button"aria-disabled="true">Fixed</a><br>  @elseif($issue->type==3 && $issue->hide==0) kamenos  <a href="/hide/{{ $issue->id}}" class="btnbtn-secondarybtn-info" role="button"aria-disabled="true">Fixed</a><br> @elseif($issue->type==4 && $issue->hid==0)spasmenos <a href="/hide/{{ $issue->id}}" class="btnbtn-secondarybtn-info" role="button"aria-disabled="true">Fixed</a><br> @endif  @endforeach @endisset  @endif </p> {!! Form::open(['route' => 'issues.store']) !!}{!! Form::select('issueop', array('1' => 'Kapaki', '2' => 'Roda', '3' => 'kamenos', '4' => 'spasmenos'), null, ['placeholder' => 'Add a Issue'])!!}<input name="id" type="hidden" value="{{ $bin->id }}"> <br><br> {!! Form::submit('Submit', ['class' => 'btn btn-info btn-sm']) !!}{!! Form::close() !!}').addTo(mymap);
        @endif
    @endforeach
	

</script>
@endisset

</body>
</html>