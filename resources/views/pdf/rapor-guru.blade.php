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
		.page-break {
			page-break-after: always;
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
			<td>{{ $teacher->profile->ftitle ?? '' }} {{ ucwords(strtolower($teacher->name ?? '')) }}{{ $teacher->profile->ltitle ? ', '. $teacher->profile->ltitle : '' }}</td>
		</tr>
		<tr>
			<td>NIG</td>
			<td>:</td>
			<td>{{ $teacher->nig ? $teacher->nig->number : '' }}</td>
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
				<td>{{ $permit->signed_at ? $permit->signed_at->format('d/m/Y') : '' }}</td>
				<td>{{ $permitoptions[$permit->category] }}</td>
				<td>{{ $permit->started_at ? $permit->started_at->format('d/m/Y') : '' }}</td>
				<td>{{ $permit->ended_at ? $permit->ended_at->format('d/m/Y') : '' }}</td>
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
				<th>RT</th>
				<th style="width: 35%">Keterangan</th>
			</tr>
			@forelse ($mscores as $i => $score)
			<tr>
				<td>{{ $score->scored_at->format('d/m/Y') }}</td>
				@foreach ($moptions as $k => $opt)
				<td style="text-align: center">{{ $score->$k }}</td>
				@endforeach
				<td style="text-align: center">
					@php $rts  = round(array_sum([$score->c1, $score->c2, $score->c3, $score->c4, $score->c5, $score->c6]) / count($moptions), 1) @endphp
					{{ $rts }}
				</td>
				<td>{{ $score->description ?? '-' }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="8">Data masih kosong.</td>
			</tr>
			@endforelse
		</table>
		<table style="width: 100%;" cellpadding=0 cellspacing=0 border="0">
			<tr>
				<td style="width: 50%; vertical-align:text-top">
					<p>
						<b>Rentang Nilai</b><br>
						91 - 100 = Memuaskan<br>
						81 - 90 = Sangat baik<br>
						71 - 80 = Baik<br>
						61 - 70 = Cukup<br>
						51 - 60 = Kurang<br>
						0 - 50 = Sangat kurang<br>
					</p>
				</td>
				<td style="width: 50%; vertical-align:text-top">
					<p>
						<b>Keterangan:</b> <br>
						@foreach ($moptions as $k => $opt)
						{{ strtoupper($k) }} = {{ $opt }}<br>
						@endforeach
						RT = Rata-rata Nilai
					</p>
				</td>
				
			</tr>
		</table>
		
		
		<li>PENILAINAN FUNGSIONAL</li>
		<table class="content" cellspacing="0">
			<tr>
				<th style="width: 10%">Tanggal</th>
				@foreach ($toptions as $k => $opt)
				<th>{{ strtoupper($k) }}</th>
				@endforeach
				<th>RT</th>
				<th style="width: 35%">Keterangan</th>
			</tr>
			@forelse ($tscores as $i => $score)
			<tr>
				<td>{{ $score->scored_at->format('d/m/Y') }}</td>
				@foreach ($toptions as $k => $opt)
				<td style="text-align: center">{{ $score->$k }}</td>
				@endforeach
				<td style="text-align: center">
					@php $rtf  = round(array_sum([$score->c1, $score->c2, $score->c3, $score->c4]) / count($toptions), 1) @endphp
					{{ $rtf }}
				</td>
				<td>{{ $score->description ?? '-' }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="8">Data masih kosong.</td>
			</tr>
			@endforelse
		</table>
		<table style="width: 100%;" cellpadding=0 cellspacing=0 border="0">
			<tr>
				<td style="width: 50%; vertical-align:text-top">
					<p>
						<b>Rentang Nilai</b><br>
						91 - 100 = Memuaskan<br>
						81 - 90 = Sangat baik<br>
						71 - 80 = Baik<br>
						61 - 70 = Cukup<br>
						51 - 60 = Kurang<br>
						0 - 50 = Sangat kurang<br>
					</p>
				</td>
				<td style="width: 50%; vertical-align:text-top">
					<p>
						<b>Keterangan:</b> <br>
						@foreach ($toptions as $k => $opt)
						{{ strtoupper($k) }} = {{ $opt }}<br>
						@endforeach
						RT = Rata-rata Nilai
					</p>
				</td>
				
			</tr>
		</table>
		
		<li>PENILAIAN PENUGASAN</li>
		<table class="content" cellspacing="0">
			<tr>
				<th style="width: 10%">Tanggal</th>
				<th>Nama Kegiatan</th>
				<th style="width: 10%">Nilai</th>
				<th style="width: 35%">Keterangan</th>
			</tr>
			@forelse ($ascores as $i => $score)
			<tr>
				<td>{{ $score->scored_at->format('d/m/Y') }}</td>
				<td>{{ $score->activity ?? '' }}</td>
				<td>{{ $score->score ?? '' }}</td>
				<td>{{ $score->description ?? '-' }}</td>
			</tr>
			@empty
			<tr>
				<td colspan="4">Data masih kosong.</td>
			</tr>
			@endforelse
		</table>
		<table style="width: 100%;" cellpadding=0 cellspacing=0 border="0">
			<tr>
				<td style="width: 40%; vertical-align:text-top">
					<p>
						<b>Rentang Nilai</b><br>
						91 - 100 = Memuaskan<br>
						81 - 90 = Sangat baik<br>
						71 - 80 = Baik<br>
						61 - 70 = Cukup<br>
						51 - 60 = Kurang<br>
						0 - 50 = Sangat kurang<br>
					</p>
				</td>
				<td style="width: 60%; vertical-align:text-top">
					
				</td>
			</tr>
		</table>
		
		
		<li>ABSENSI KUMPUL</li>
		<table class="content" cellspacing="0">
			<tr>
				<th style="width: 10%">Tanggal</th>
				<th>Nama Kegiatan</th>
				<th style="width: 35%">Keterangan</th>
			</tr>
			@forelse ($gatherings as $gath)
			<tr>
				<td>{{ $gath->held_at ? $gath->held_at->format('d/m/Y') : '' }}</td>
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
				<td>{{ $asign->signed_at ? $asign->signed_at->format('d/m/Y') : '' }}</td>
				<td>{{ $asign->decree }}</td>
				<td>{{ $asignoptions[$asign->category] }}</td>
				<td>{{ $asign->started_at ? $asign->started_at->format('d/m/Y') : '' }}</td>
				<td>{{ $asign->ended_at ? $asign->ended_at->format('d/m/Y') : '' }}</td>
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