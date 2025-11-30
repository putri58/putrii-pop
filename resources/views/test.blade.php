<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>
</head>
<body>
    <h1>Data Pegawai</h1>

    <p>Nama: {{ $name }}</p>
    <p>Umur: {{ $my_age }} tahun</p>

    <h3>Hobi:</h3>
    <ul>
        @foreach($hobbies as $hobby)
            <li>{{ $hobby }}</li>
        @endforeach
    </ul>

    <p>Tanggal Harus Wisuda: {{ $tgl_harus_wisuda }}</p>
    <p>Jarak Hari ke Wisuda: {{ $time_to_study_left }} hari lagi</p>

    <p>Semester Saat Ini: {{ $current_semester }}</p>
    <p>Pesan: {{ $semester_message }}</p>

    <p>Cita-cita: {{ $future_goal }}</p>

</body>
</html>
