<?php
$to_root = "../";

$include_controller = $to_root . "controllers/Pesanan.php";

include_once $include_controller;

$pesanan = new PesananTiket();
$data = $pesanan->daftarPesanan();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Tiket Another Bus </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2> Data Pemesanan Bus</h2>
        <table class="table">
            <thead>
                <tr class="bg-secondary">
                    <th>No</th>
                    <th>Id</th>
                    <th>Nama Lengkap</th>
                    <th>No Id</th>
                    <th>No Hp</th>
                    <th>Kelas Penumpang</th>
                    <th>Jadwal Keberangkatan</th>
                    <th>Jumlah Penumpang</th>
                    <th>Jumlah Penumpang Lansia</th>
                    <th>Harga</th>
                    <th colspan="2">Gambar</th>
                    <th>Total Harga</th>
                    <th> Action </th>
                </tr>
            </thead>

            <tbody>
                <?php
                for ($i = 0; $i < count($data); $i++) {
                    $currentData = $data[$i];
                ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $currentData['id'] ?></td>
                        <td><?= $currentData['nama_lengkap'] ?></td>
                        <td><?= $currentData['no_id'] ?></td>
                        <td><?= $currentData['no_hp'] ?></td>
                        <td><?= $currentData['kelas_penumpang'] ?></td>
                        <td><?= $currentData['jadwal_keberangkatan'] ?></td>
                        <td><?= $currentData['jumlah_penumpang'] ?></td>
                        <td><?= $currentData['jenis'] ?></td>
                        <td><?= $currentData['harga'] ?></td>
                        <td><img src="../images/<?= $currentData['gambar_bus'] ?>" style="width: 100px; height: 100px; object-fit: cover;" alt=""></td>
                        <td><img src="../images/<?= $currentData['gambar_interior'] ?>" style="width: 100px; height: 100px; object-fit: cover;" alt=""></td>
                        <td><?= $currentData['total_harga'] ?></td>
                        <td>
                            <a href="<?= $to_root ?>/controllers/Pesanan.php?id=<?= $currentData['id'] ?>&is_deleting=true" class="btn btn-danger"> Delete</a>
                            <a href="../Views/form.php?id=<?= $currentData['id'] ?>" class="btn btn-warning"> Update</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>

            <a href=form.php> Back </a>
            <!-- <a href=../Controllers/deletePesanan.php> Delete </a> -->

        </table>
    </div>

</body>

</html>