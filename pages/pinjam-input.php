<div id="label-page">
    <h3>Input Data Peminjam</h3>
</div>
<div id="content">
    <form action="proses/anggota-input-proses.php" method="post" enctype="multipart/form-data">

        <table id="tabel-input">
            <tr>
                <td class="label-formulir">ID Transaksi</td>
                <td class="isian-formulir"><input type="text" name="idtransaksi" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir">ID Anggota</td>
                <td class="isian-formulir">
                    <select name="idanggota" class="isian-formulir isian-formulir-border">
                        <?php
                        $sql = "SELECT * FROM tbanggota ORDER BY idanggota DESC";
                        $q_tampil_anggota = mysqli_query($db, $sql);
                        while ($r_tampil_anggota = mysqli_fetch_array($q_tampil_anggota)) {
                        ?>
                            <option value="<?php echo $r_tampil_anggota['idanggota']; ?>" selected><?php echo $r_tampil_anggota['idanggota']; ?>-<?php echo $r_tampil_anggota['nama']; ?></option>

                        <?php } ?>
                    </select>

                </td>
            </tr>
            <tr>
                <td class="label-formulir">Id Buku</td>
                <td class="isian-formulir">
                    <select name="idbuku" class="isian-formulir isian-formulir-border">
                        <?php
                        $sqlbuku = "SELECT * FROM tbbuku ORDER BY idbuku DESC";
                        $q_tampil_buku = mysqli_query($db, $sqlbuku);
                        while ($r_tampil_buku = mysqli_fetch_array($q_tampil_buku)) {
                        ?>
                            <option value="<?php echo $r_tampil_buku['idbuku']; ?>" selected><?php echo $r_tampil_buku['idbuku']; ?>-<?php echo $r_tampil_buku['judulbuku']; ?></option>

                        <?php } ?>
                    </select>

                </td>
            </tr>

            <tr>
                <td class="label-formulir">Tanggl Pinjam</td>
                <td class="isian-formulir"><input type="date" name="tglpinjam" class="isian-formulir isian-formulir-border"></td>
            </tr>

            <tr>
                <td class="label-formulir">Tanggal Kembali</td>
                <td class="isian-formulir"><input type="date" name="tglkembali" class="isian-formulir isian-formulir-border"></td>
            </tr>

            <tr>
                <td class="label-formulir"></td>
                <td class="isian-formulir"><input type="submit" name="simpan" value="Simpan" class="tombol"></td>
            </tr>
        </table>
    </form>
</div>