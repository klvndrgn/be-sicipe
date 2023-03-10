<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>SiCipe - {{ Str::ucfirst(Request::segment(2)) }}</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id Top Up</th> 
                            <th>Id Pengguna</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->id_top_up }}</td>
                            <td>{{ $item->id_pengguna }}</td>
                            <td>Rp.{{ $item->jumlah_top_up ? number_format($item->jumlah_top_up) : 0 }}</td>
                            <td>{{ $item->tanggal_top_up ? \Carbon\Carbon::parse($item->tanggal_top_up)->format('d/m/Y H:i:s A') : '-' }}</td>
                            <td>
                                @if($item->status_top_up)
                                    <span class="badge text-bg-success">Berhasil</span>
                                @else
                                    <span class="badge text-bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if(!$item->status_top_up)
                                    <form action="{{ route('top-up.update', $item->id_top_up) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input class="btn btn-success" type="submit" value="Selesai">
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>            
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>