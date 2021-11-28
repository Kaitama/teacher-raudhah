<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<style>
		.content {
			border: 1px solid #000;
			width: 100%;
			font-size: 10pt;
		}
		.content tr td, .content tr th {
			border: 1px solid #000;
		}
		.content td, .content td * {
			vertical-align: top;
		}
		table th {
			background-color: rgb(119, 119, 119);
			color: #fff;
			/* border: 1px solid #fff; */
		}
		ol li {
			margin-top: 20px;
		}
	</style>
</head>
<body>
	<h4 style="text-align: center">
		LAPORAN KEGIATAN GURU
		<br>
		PESANTREN AR-RAUDLATUL HASANAH
	</h4>
	<br>
	<table cellpadding="0" cellspacing="0" style="width: 100%">
		<tr>
			<td style="width: 20%">Nama</td>
			<td style="width: 2%">:</td>
			<td>{{ $teacher->profile->ftitle ?? '' }} {{ ucwords(strtolower($teacher->name)) }}{{ $teacher->profile->ltitle ? ', '. $teacher->profile->ltitle : '' }}</td>
		</tr>
		<tr>
			<td>NIG</td>
			<td>:</td>
			<td>{{ $teacher->nig->number }}</td>
		</tr>
		<tr>
			<td>HP</td>
			<td>:</td>
			<td>{{ $teacher->profile->phone ?? '-' }}</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td>{{ $teacher->profile->address ?? '' }}</td>
		</tr>
		<tr>
			<td>Mulai Tanggal</td>
			<td>:</td>
			<td>{{ $from }} S/D {{ $to }}</td>
		</tr>
	</table>
	
	<ol type="A">
		<li>PERIZINAN</li>
		<table class="content" cellspacing="0">
			<tr>
				<th style="width: 10%">Tanggal</th>
				<th>Alasan</th>
				<th style="width: 10%">Mulai Tanggal</th>
				<th style="width: 10%">Sampai Tanggal</th>
				<th style="width: 35%">Keterangan</th>
			</tr>
			@forelse ($permits as $permit)
			<tr>
				<td>{{ $permit->signed_at->format('d/m/Y') }}</td>
				<td>{{ $permitoptions[$permit->category] }}</td>
				<td>{{ $permit->started_at->format('d/m/Y') }}</td>
				<td>{{ $permit->ended_at->format('d/m/Y') }}</td>
				<td>{{ $permit->description ?? '-' }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="5">Data masih kosong.</td>
			</tr>
			@endforelse
		</table>
		
		<li>PENILAINAN STRUKTURAL</li>
		<table class="content" cellspacing="0">
			<tr>
				<th style="width: 10%">Tanggal</th>
				@foreach ($moptions as $k => $opt)
				<th>{{ strtoupper($k) }}</th>
				@endforeach
				<th style="width: 35%">Keterangan</th>
			</tr>
			@forelse ($mscores as $i => $score)
			<tr>
				<td>{{ $score->scored_at->format('d/m/Y') }}</td>
				@foreach ($moptions as $k => $opt)
				<td style="text-align: center">{{ $score->$k }}</td>
				@endforeach
				<td>{{ $score->description ?? '-' }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="8">Data masih kosong.</td>
			</tr>
			@endforelse
		</table>
		<p>
			<b>Catatan:</b> <br>
			@foreach ($moptions as $k => $opt)
			{{ strtoupper($k) }} = {{ $opt }}<br>
			@endforeach
		</p>
		
		<li>PENILAINAN FUNGSIONAL</li>
		<table class="content" cellspacing="0">
			<tr>
				<th style="width: 10%">Tanggal</th>
				@foreach ($toptions as $k => $opt)
				<th>{{ strtoupper($k) }}</th>
				@endforeach
				<th style="width: 35%">Keterangan</th>
			</tr>
			@forelse ($tscores as $i => $score)
			<tr>
				<td>{{ $score->scored_at->format('d/m/Y') }}</td>
				@foreach ($toptions as $k => $opt)
				<td style="text-align: center">{{ $score->$k }}</td>
				@endforeach
				<td>{{ $score->description ?? '-' }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="8">Data masih kosong.</td>
			</tr>
			@endforelse
		</table>
		<p>
			<b>Catatan:</b> <br>
			@foreach ($toptions as $k => $opt)
			{{ strtoupper($k) }} = {{ $opt }} <br>
			@endforeach
		</p>
		
		<li>ABSENSI PERKUMPULAN</li>
		<table class="content" cellspacing="0">
			<tr>
				<th style="width: 10%">Tanggal</th>
				<th>Nama Kegiatan</th>
				<th style="width: 35%">Keterangan</th>
			</tr>
			@forelse ($gatherings as $gath)
			<tr>
				<td>{{ $gath->held_at->format('d/m/Y') }}</td>
				<td>{{ $gath->name }}</td>
				<td>{{ $gath->description ?? '-' }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="3">Data masih kosong.</td>
			</tr>
			@endforelse
		</table>
		
		<li>PENUGASAN</li>
		<table class="content" cellspacing="0">
			<tr>
				<th style="width: 10%">Tanggal</th>
				<th>Nomor SK</th>
				<th>Jenis Penugasan</th>
				<th style="width: 10%">Mulai Tanggal</th>
				<th style="width: 10%">Sampai Tanggal</th>
				<th style="width: 35%">Keterangan</th>
			</tr>
			@forelse ($assignments as $asign)
			<tr>
				<td>{{ $asign->signed_at->format('d/m/Y') }}</td>
				<td>{{ $asign->decree }}</td>
				<td>{{ $asignoptions[$asign->category] }}</td>
				<td>{{ $asign->started_at->format('d/m/Y') }}</td>
				<td>{{ $asign->ended_at->format('d/m/Y') }}</td>
				<td>{{ $asign->description ?? '-' }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="6">Data masih kosong.</td>
			</tr>
			@endforelse
		</table>
		
		<li>KEGIATAN BELAJAR MENGAJAR</li>
		<table class="content" cellspacing="0">
			<tr>
				<th style="width: 10%">Tanggal</th>
				<th>Alasan</th>
				<th style="width: 35%">Keterangan</th>
			</tr>
			@forelse ($teachings as $teach)
			<tr>
				<td>{{ $teach->signed_at->format('d/m/Y') }}</td>
				<td>{{ $teachoptions[$teach->category] }}</td>
				<td>{{ $teach->description ?? '-' }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="3">Data masih kosong.</td>
			</tr>
			@endforelse
		</table>
		
		<li>EVALUASI</li>
		<table class="content" cellspacing="0">
			<tr>
				<th style="width: 10%">Tanggal</th>
				<th>Nomor SK</th>
				<th>Alasan</th>
				<th style="width: 35%">Keterangan</th>
			</tr>
			@forelse ($evaluations as $eval)
			<tr>
				<td>{{ $eval->signed_at->format('d/m/Y') }}</td>
				<td>{{ $eval->decree ?? '-' }}</td>
				<td>{{ $evaloptions[$eval->category] }}</td>
				<td>{{ $eval->description ?? '-' }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="4">Data masih kosong.</td>
			</tr>
			@endforelse
		</table>
	</ol>
<br>
<br>
	<table style="width: 100%">
		<tr>
			<td style="width: 70%"></td>
			<td style="text-align: center">
				Medan, {{ \Carbon\Carbon::now()->isoFormat('LL') }}
				<br>
				Direktur Pesantren
				<br><br><br><br><br>
				(<b>{{ $appdata->director }}</b>)
			</td>
		</tr>
	</table>
</body>
</html>