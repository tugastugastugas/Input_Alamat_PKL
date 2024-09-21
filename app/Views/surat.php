<?php


$imagePath = FCPATH . 'images/kop.jpeg';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        p {
            font-family: 'Times New Roman', Times, serif;
            font-size: 15px;
        }

        table {
            font-family: 'Times New Roman', Times, serif;
            width: 100%;

        }

        table,
        th,
        td {

            padding: 5px 5px;
            text-align: center;

        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 65%;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        hr {
            height: 1px;
            background-color: black;
        }

        .atas {
            margin-top: 5px;
        }

        .kanan {
            margin-left: 1400px;
            margin-top: -75px;
        }
    </style>
</head>

<body>
    <img src="<?= $imagePath; ?>" alt="" style="margin-top: -5px;" width="1550" height="270">
    <table style="font-size: 15px;">
        <tr>
            <td style="text-align: left;">
                <p>Nomor : 79/442.211.7/S.Hum/SMK-PH/IX/2023</p>
                <p>Lampiran : -</p>
                <p>Perihal : Permohonan PRAKERIND</p>
                <p></p>
                <p>Kepada Yth</p>
                <p>Bapak/Ibu, Di Tempat</p>
            </td>

            <td style="text-align: right;">
                <p style="margin-bottom: 10px;">Batam, <?php echo date("D-d-M-Y"); ?></p>
                <p></p>
                <p></p>
                <p></p>
            </td>
        </tr>
    </table>

    <p>Dengan Hormat,</p>
    <p>Dalam rangka pelaksanaan program akademik SMK Permata Harapan
        tahun ajaran 2023/2024 dimana kami mewajibkan kepada setiap
        siswa/siswi untuk melaksanakan kegiatan praktek kerja industri
        (PRAKERIND) sebagai salah satu syarat untuk menempuh ujian akhir
        di kelas XII. Kami bermaksud menyampaikan permohonan serta kesediaan
        Instansi/Perusahaan yang Bapak/Ibu pimpin untuk dapat menerima
        siswa/siswi kami dalam pelaksanaan kegiatan PRAKERIND tersebut diatas.</p>
    <p>Adapun jadwal program tersebut akan berlangsung selama 4 (Empat) bulan dimulai
        dari tanggal 10 Januari 24 Mei 2024, siswa/siswi kami yang akan melaksanakan
        PRAKERIND adalah :</p>
    <table class="table align-items-center mb-0" style="font-size: 11px; border: 0.1px solid;">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data as $key) {
            ?>
                <tr>
                    <td><?= $key->username ?></td>
                    <td><?= $key->nis ?></td>
                    <td><?= $key->kelas ?></td>
                    <td><?= $key->jurusan ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>

    <p>Demikian permohonan ini kami sampaikan dengan harapan bapak/ibu dapat mengabulkannya.
        Atas perhatian dan kerjasamanya, kami ucapkan terimakasih.</p>

    <table style="width: 100%; margin-top:30;">
        <tr>
            <td style="text-align: left;">
                <p>Kepala Sekolah</p>
                <p></p>
                <p></p>
                <p></p>
                <p>Srima Deliana Damanik, S.Pd.</p>
            </td>

            <td style="text-align: right;">
                <p>Kepala Program Studi</p>
                <p></p>
                <p></p>
                <p></p>
                <p>Miftahul Ilmi, S.Pd.</p>
            </td>
        </tr>
    </table>
</body>

</html>