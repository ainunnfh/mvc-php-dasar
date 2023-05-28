<?php
$to_root = "../";

include_once $to_root . "controllers/Pesanan.php";

$pesanan = new PesananTiket();

$defaultValue = [
    "id" => "",
    "nama_lengkap" => "",
    "no_id" => "",
    "no_hp" => "",
    "kelas_penumpang" => "",
    "jadwal_keberangkatan" => "",
    "jumlah_penumpang" => "",
    "jumlah_penumpang_lansia" => "",

];

if (isset($_GET['id'])) {
    // dapetin data dengan id
    $existing = $pesanan->detailPesanan($_GET['id']);
    if ($existing !== null) {
        $defaultValue['id'] = $existing['id'];
        $defaultValue['nama_lengkap'] = $existing['nama_lengkap'];
        $defaultValue['no_id'] = $existing['no_id'];
        $defaultValue['no_hp'] = $existing['no_hp'];
        $defaultValue['kelas_penumpang'] = $existing['kelas_penumpang'];
        $defaultValue['jadwal_keberangkatan'] = str_replace('T', ' ', substr($existing['jadwal_keberangkatan'], 0, 16));
        $defaultValue['jumlah_penumpang'] = $existing['jumlah_penumpang'];
        $defaultValue['jumlah_penumpang_lansia'] = $existing['jumlah_penumpang_lansia'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Tiket Bus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
</head>

<body>
    <div class='container'>
        <form class='mt-4' action="<?= $to_root ?>/controllers/Pesanan.php?" method='post'>
            <?php
            if ($defaultValue['id'] == '') {
                echo "<input type='hidden' name='is_creating' value='true' />";
            } else {
                echo "<input type='hidden' name='is_updating' value='true' />";
                echo "<input type='hidden' name='id' value='$defaultValue[id]' />";
            }
            ?>
            <input type="hidden" name="is_creating" value="true" />
            <h1 class='mb-3'> Form Pemesanan Tiket Bus</h1>
            <div class="mb-3 row">
                <label for="nama_lengkap" class="col-sm-2 col-form-label"> Nama Lengkap </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_lengkap" value="<?= $defaultValue['nama_lengkap'] ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="no_id" class="col-sm-2 col-form-label"> No Identitas </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_id" value="<?= $defaultValue['no_id'] ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="no_hp" class="col-sm-2 col-form-label"> Nomor Hp </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_hp" value="<?= $defaultValue['no_hp'] ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="kelas_penumpang" class="col-sm-2 col-form-label"> Kelas Penumpang </label>
                <div class="col-sm-10">
                    <select id="kelas_penumpang" name="kelas_penumpang" class="form-select" value="<?= $defaultValue['kelas_penumpang'] ?>">
                        <option> Pilih Kelas Bus </option>
                        <?php
                        $result = $pesanan->runSelectQuery('SELECT * FROM bus');
                        $i = 0;
                        while ($i < count($result)) {
                            $row = $result[$i];
                            $selected = $row['id'] == $defaultValue['kelas_penumpang'] ? 'selected' : '';
                            echo "<option $selected  value='$row[id]'>$row[jenis]</option>";
                            $i++;
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jadwal_keberangkatan" class="col-sm-2 col-form-label"> Jadwal Keberangkatan </label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" name="jadwal_keberangkatan" value="<?= $defaultValue['jadwal_keberangkatan'] ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="jumlah_penumpang" class="col-sm-2 col-form-label"> Jumlah Penumpang </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="jumlah_penumpang" value="<?= $defaultValue['jumlah_penumpang'] ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="jumlah_penumpang_lansia" class="col-sm-2 col-form-label"> Jumlah Penumpang Lansia</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="jumlah_penumpang_lansia" value="<?= $defaultValue["jumlah_penumpang_lansia"] ?>">
                </div>
            </div>

            <button typr="submit" class="btn btn-primary"> Submit </button>

        </form>
    </div>
</body>

</html>