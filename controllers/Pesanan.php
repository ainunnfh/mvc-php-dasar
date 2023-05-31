<?php

if (!isset($to_root)) {
    $to_root = '../';
}

include_once $to_root . 'Models/Database.php';

class PesananTiket extends Database
{
    public function daftarPesanan()
    {
        $query = "SELECT
        pesanan.id,
        pesanan.nama_lengkap,
        pesanan.no_id,
        pesanan.no_hp,
        pesanan.kelas_penumpang,
        pesanan.jadwal_keberangkatan,
        pesanan.jumlah_penumpang,
        pesanan.jumlah_penumpang_lansia,
        bus.harga,
        bus.jenis,
        bus.gambar_bus,
        bus.gambar_interior,
        (pesanan.jumlah_penumpang + pesanan.jumlah_penumpang_lansia) * bus.harga AS total_harga
        FROM pesanan INNER JOIN bus on pesanan.kelas_penumpang = bus.id";

        $data = $this->runSelectQuery($query);
        return $data;
    }

    public function detailPesanan($id)
    {
        $data = $this->runSelectQuery("SELECT * FROM pesanan WHERE id = $id");
        if (count($data) === 0) {
            return null;
        } else {
            return $data[0];
        }
    }

    public function createPesanan()
    {
        echo "CREATING..";
        $nama_lengkap = $_POST['nama_lengkap'] ?? '';
        $no_id = @$_POST['no_id'];
        $no_hp = @$_POST['no_hp'];
        $kelas_penumpang = @$_POST['kelas_penumpang'];
        $jadwal_keberangkatan = @$_POST['jadwal_keberangkatan'];
        $jumlah_penumpang = @$_POST['jumlah_penumpang'];
        $jumlah_penumpang_lansia = @$_POST['jumlah_penumpang_lansia'];

        $query = "INSERT INTO pesanan (nama_lengkap, no_id, no_hp, kelas_penumpang, jadwal_keberangkatan, jumlah_penumpang, jumlah_penumpang_lansia) VALUES ('$nama_lengkap', '$no_id', '$no_hp', '$kelas_penumpang', '$jadwal_keberangkatan', '$jumlah_penumpang', '$jumlah_penumpang_lansia')";

        $insert = $this->runQuery($query);
        if ($insert) {
            echo "<div>
            <script>
            alert('berhasil memesan bus');
            window.location.href = '../views/pesanan.php';
            </script>
            </div>";
        } else {
            $this->getErrors();
        }
    }

    public function deletePesanan()
    {
        $id_pemesan = @$_GET['id'];

        $query = "DELETE FROM pesanan WHERE id = $id_pemesan";

        $isSuccess = $this->runQuery($query);

        if ($isSuccess) {
            // redirect ke table
            echo "<div>
        <script>
        alert('Berhasil Menghapus Data');
        window.location.href = '../views/pesanan.php';
        </script>
        </div>";
        } else {
            // error handling
            $this->getErrors();
        }
    }

    public function updatePesanan()
    {
        echo "UPDATING..";
        $id_pemesan = @$_POST['id'];

        $nama_lengkap = @$_POST['nama_lengkap'];
        $no_hp = @$_POST['no_hp'];
        $kelas_penumpang = @$_POST['kelas_penumpang'];
        $jadwal_keberangkatan = @$_POST['jadwal_keberangkatan'];
        $jumlah_penumpang = @$_POST['jumlah_penumpang'];
        $jumlah_penumpang_lansia = @$_POST['jumlah_penumpang_lansia'];

        $query = "UPDATE pesanan SET nama_lengkap='$nama_lengkap', no_hp='$no_hp', kelas_penumpang='$kelas_penumpang', jadwal_keberangkatan='$jadwal_keberangkatan', jumlah_penumpang = '$jumlah_penumpang', jumlah_penumpang_lansia = '$jumlah_penumpang_lansia' WHERE id = $id_pemesan";

        $db = new database();

        $insert = $db->runQuery($query);
        if ($insert) {
            echo "<div>
            <script>
            alert('berhasil update data');
            window.location.href = '../views/pesanan.php';
            </script>
            </div>";
        } else {
            $this->getErrors();
        }
    }
}

$pesanan = new PesananTiket();

if (isset($_POST['is_creating']) && $_POST['is_creating'] == 'true') {
    $pesanan->createPesanan();
}

if (isset($_GET['is_deleting']) && isset($_GET['id'])) {
    $pesanan->deletePesanan();
};

if (isset($_POST['is_updating']) && isset($_POST['id'])) {
    $pesanan->updatePesanan();
}