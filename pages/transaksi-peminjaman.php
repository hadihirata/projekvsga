<div id="label-page">
    <h3>Tampil Data Peminjam</h3>
</div>
<div id="content">

    <p id="tombol-tambah-container"><a href="index.php?p=pinjam-input" class="tombol">Tambah Data Peminjam</a>
        <a target="_blank" href="pages/cetakpinjam.php"><img src="print.png" height="50px" height="50px"></a>
    <FORM CLASS="form-inline" METHOD="POST">
        <div align="right">
            <form method=post><input type="text" name="pencarian"><input type="submit" name="search" value="search" class="tombol"></form>
    </FORM>
    </p>
    <table id="tabel-tampil">
        <tr>
            <th id="label-tampil-no">No</td>
            <th>Nama Peminjam</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>

            <th id="label-opsi">Opsi</th>
        </tr>



        <?php
        $batas = 5;
        extract($_GET);
        if (empty($hal)) {
            $posisi = 0;
            $hal = 1;
            $nomor = 1;
        } else {
            $posisi = ($hal - 1) * $batas;
            $nomor = $posisi + 1;
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian']));
            if ($pencarian != "") {
                $sql = "select * from tbtransaksi 
                inner JOIN tbanggota 
                on tbtransaksi.idanggota=tbanggota.idanggota
                INNER join tbbuku
                on tbtransaksi.idbuku = tbbuku.idbuku
                 WHERE nama LIKE '%$pencarian%'
						OR idanggota LIKE '%$pencarian%'
						OR jeniskelamin LIKE '%$pencarian%'
						OR alamat LIKE '%$pencarian%'";

                $query = $sql;
                $queryJml = $sql;
            } else {
                $query = "select * from tbtransaksi 
                inner JOIN tbanggota 
                on tbtransaksi.idanggota=tbanggota.idanggota
                INNER join tbbuku
                on tbtransaksi.idbuku = tbbuku.idbuku LIMIT $posisi, $batas";
                $queryJml = "select * from tbtransaksi 
                inner JOIN tbanggota 
                on tbtransaksi.idanggota=tbanggota.idanggota
                INNER join tbbuku
                on tbtransaksi.idbuku = tbbuku.idbuku";
                $no = $posisi * 1;
            }
        } else {
            $query = "select * from tbtransaksi 
            inner JOIN tbanggota 
            on tbtransaksi.idanggota=tbanggota.idanggota
            INNER join tbbuku
            on tbtransaksi.idbuku = tbbuku.idbuku
             LIMIT $posisi, $batas";
            $queryJml = "select * from tbtransaksi 
            inner JOIN tbanggota 
            on tbtransaksi.idanggota=tbanggota.idanggota
            INNER join tbbuku
            on tbtransaksi.idbuku = tbbuku.idbuku";
            $no = $posisi * 1;
        }

        //$sql="SELECT * FROM tbanggota ORDER BY idanggota DESC";
        $q_tampil_anggota = mysqli_query($db, $query);
        if (mysqli_num_rows($q_tampil_anggota) > 0) {
            while ($r_tampil_anggota = mysqli_fetch_array($q_tampil_anggota)) {

        ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $r_tampil_anggota['nama']; ?></td>
                    <td><?php echo $r_tampil_anggota['judulbuku']; ?></td>
                    <td><?php echo $r_tampil_anggota['tglpinjam']; ?></td>
                    <td><?php echo $r_tampil_anggota['tglkembali']; ?></td>

                    <td>

                        <div class="tombol-opsi-container"><a href="index.php?p=pinjam-edit&id=<?php echo $r_tampil_anggota['idanggota']; ?>" class="tombol">Edit</a></div>
                        <div class="tombol-opsi-container"><a href="proses/pinjam-hapus.php?id=<?php echo $r_tampil_anggota['idanggota']; ?>" onclick="return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="tombol">Hapus</a></div>
                    </td>
                </tr>
        <?php $nomor++;
            }
        } else {
            echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>";
        } ?>
    </table>
    <?php
    if (isset($_POST['pencarian'])) {
        if ($_POST['pencarian'] != '') {
            echo "<div style=\"float:left;\">";
            $jml = mysqli_num_rows(mysqli_query($db, $queryJml));
            echo "Data Hasil Pencarian: <b>$jml</b>";
            echo "</div>";
        }
    } else { ?>
        <div style="float: left;">
            <?php
            $jml = mysqli_num_rows(mysqli_query($db, $queryJml));
            echo "Jumlah Data : <b>$jml</b>";
            ?>
        </div>
        <div class="pagination">
            <?php
            $jml_hal = ceil($jml / $batas);
            for ($i = 1; $i <= $jml_hal; $i++) {
                if ($i != $hal) {
                    echo "<a href=\"?p=transaksi-peminjaman&hal=$i\">$i</a>";
                } else {
                    echo "<a class=\"active\">$i</a>";
                }
            }
            ?>
        </div>
    <?php
    }
    ?>
</div>