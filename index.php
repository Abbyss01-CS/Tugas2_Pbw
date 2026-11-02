<?php
function hitungNilaiAkhir($tugas, $uts, $uas)
{
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function tentukanGrade($nilaiAkhir)
{
    if ($nilaiAkhir >= 85) {
        return "A";
    } elseif ($nilaiAkhir >= 75) {
        return "B";
    } elseif ($nilaiAkhir >= 65) {
        return "C";
    } elseif ($nilaiAkhir >= 50) {
        return "D";
    } else {
        return "E";
    }
}

function tentukanStatus($nilaiAkhir)
{
    return ($nilaiAkhir >= 65) ? "Lulus" : "Tidak Lulus";
}

function validasiNilai($nilai)
{
    return is_numeric($nilai) && $nilai >= 0 && $nilai <= 100;
}

function tentukanPredikat($nilaiAkhir)
{
    if ($nilaiAkhir >= 85) {
        return "Sangat Baik";
    } elseif ($nilaiAkhir >= 75) {
        return "Baik";
    } elseif ($nilaiAkhir >= 65) {
        return "Cukup";
    } elseif ($nilaiAkhir >= 50) {
        return "Kurang";
    } else {
        return "Sangat Kurang";
    }
}

$daftarMahasiswa = [
    ["nama" => "Andi",  "nim" => "231234567", "tugas" => 80,  "uts" => 75, "uas" => 90],
    ["nama" => "Budi",  "nim" => "231234568", "tugas" => 60,  "uts" => 70, "uas" => 65],
    ["nama" => "Citra", "nim" => "231234569", "tugas" => 45,  "uts" => 50, "uas" => 40],
    ["nama" => "Dina",  "nim" => "231234570", "tugas" => 90,  "uts" => 120, "uas" => 85],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penghitung Nilai Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f4f6f8; color: #222; }
        h1 { margin-bottom: 4px; }
        .card { background: #fff; border-radius: 8px; padding: 16px 20px; margin: 14px 0; box-shadow: 0 1px 4px rgba(0,0,0,.1); max-width: 520px; }
        .card h3 { margin-top: 0; }
        table { border-collapse: collapse; }
        td { padding: 3px 14px 3px 0; }
        .lulus { color: #1a7f37; font-weight: bold; }
        .gagal { color: #cf222e; font-weight: bold; }
        .error { color: #cf222e; }
    </style>
</head>
<body>
    <h1>Penghitung Nilai Mahasiswa</h1>
    <p>Bobot: Tugas 30% &middot; UTS 30% &middot; UAS 40%</p>

    <?php foreach ($daftarMahasiswa as $mhs): ?>
        <?php
        $nama  = $mhs["nama"];
        $nim   = $mhs["nim"];
        $tugas = $mhs["tugas"];
        $uts   = $mhs["uts"];
        $uas   = $mhs["uas"];
        ?>
        <div class="card">
            <h3>Data Mahasiswa</h3>
            <table>
                <tr><td>Nama</td><td>: <?= $nama ?></td></tr>
                <tr><td>NIM</td><td>: <?= $nim ?></td></tr>
                <tr><td>Nilai Tugas</td><td>: <?= $tugas ?></td></tr>
                <tr><td>Nilai UTS</td><td>: <?= $uts ?></td></tr>
                <tr><td>Nilai UAS</td><td>: <?= $uas ?></td></tr>
            </table>

            <?php if (validasiNilai($tugas) && validasiNilai($uts) && validasiNilai($uas)): ?>
                <?php
                $nilaiAkhir = hitungNilaiAkhir($tugas, $uts, $uas);
                $grade      = tentukanGrade($nilaiAkhir);
                $status     = tentukanStatus($nilaiAkhir);
                $predikat   = tentukanPredikat($nilaiAkhir);
                ?>
                <h3>Hasil Perhitungan</h3>
                <table>
                    <tr><td>Nilai Akhir</td><td>: <?= number_format($nilaiAkhir, 2, ',', '.') ?></td></tr>
                    <tr><td>Grade</td><td>: <?= $grade ?></td></tr>
                    <tr><td>Predikat</td><td>: <?= $predikat ?></td></tr>
                    <tr>
                        <td>Status</td>
                        <td>: <span class="<?= $status === 'Lulus' ? 'lulus' : 'gagal' ?>"><?= $status ?></span></td>
                    </tr>
                </table>
            <?php else: ?>
                <p class="error">Nilai tidak valid! Semua nilai harus berada di rentang 0 sampai 100.</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</body>
</html>