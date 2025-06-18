<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Surat Keputusan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        .title {
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }

        .underline {
            text-decoration: underline;
        }

        .content {
            margin: 30px 0;
            text-align: justify;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .signature {
            float: right;
            text-align: center;
            margin-top: 50px;
            width: 300px;
        }

        .footer {
            margin-top: 50px;
            font-size: 10pt;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/logo_sekolah.png') }}" class="logo">
        <h3>{{ $nama_sekolah }}</h3>
        <p>{{ $alamat_sekolah }} - Telp. (021) 123456</p>
        <p>Email: sman1@contoh.sch.id - Website: www.sman1contoh.sch.id</p>
    </div>

    <div class="title">
        <span class="underline">SURAT KEPUTUSAN</span><br>
        <span>Nomor: {{ $nomor_surat }}</span>
    </div>

    <div class="content">
        <p>Menimbang : Bahwa perlu menetapkan siswa eligible berdasarkan hasil seleksi</p>
        <p>Memperhatikan : Hasil rapat dewan guru tanggal {{ $tanggal }}</p>

        <p style="margin-top: 20px;"><strong>MEMUTUSKAN</strong></p>
        <p><strong>Menetapkan :</strong></p>

        <p><strong>Pertama :</strong> Nama-nama siswa jurusan {{ $jurusan }} yang dinyatakan eligible:</p>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NISN</th>
                    <th>Total Nilai</th>
                    <th>Peringkat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa_eligible as $siswa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $siswa->namasiswa }}</td>
                        <td>{{ $siswa->nisn }}</td>
                        <td>{{ $siswa->total_keseluruhan }}</td>
                        <td>{{ $siswa->peringkat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Kedua :</strong> Surat keputusan ini berlaku sejak tanggal ditetapkan.</p>
    </div>

    <div class="signature">
        <p>Ditetapkan di: Kota ...</p>
        <p>Pada tanggal: {{ $tanggal }}</p>
        <br><br>
        <p>Kepala Sekolah,</p>
        <br><br><br>
        <p><u>{{ $nama_kepala }}</u></p>
        <p>NIP. ........................</p>
    </div>

    <div class="footer">
        <p><em>Tembusan:</em></p>
        <ol>
            <li>Yayasan Pendidikan Contoh</li>
            <li>Dinas Pendidikan Kota Contoh</li>
            <li>Arsip</li>
        </ol>
    </div>
</body>

</html>
