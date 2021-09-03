<table>
	<thead>
		<tr>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Kegiatan</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($data as $k => $d)
		<tr>
			<td>{{ $k + 1 }}</td>
			<td>{{ $d->held_at->format('d/m/Y') }}</td>
			<td>{{ $d->name }}</td>
			<td>{{ $d->description }}</td>
		</tr>
		@endforeach
	</tbody>
</table>