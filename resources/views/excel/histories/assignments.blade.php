<table>
	<thead>
		<tr>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Nomor SK</th>
			<th>Penugasan</th>
			<th>Dari Tanggal</th>
			<th>Sampai Tanggal</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($data as $k => $d)
		<tr>
			<td>{{ $k + 1 }}</td>
			<td>{{ $d->signed_at->format('d/m/Y') }}</td>
			<td>{{ $d->decree }}</td>
			<td>{{ $categories[$d->category] }}</td>
			<td>{{ $d->started_at->format('d/m/Y') }}</td>
			<td>{{ $d->ended_at->format('d/m/Y') }}</td>
			<td>{{ $d->description }}</td>
		</tr>
		@endforeach
	</tbody>
</table>