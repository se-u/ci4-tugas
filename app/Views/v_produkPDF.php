<h1>Data Produk</h1>

<table border="1" width="100%" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Foto</th>
    </tr>

    <?php
    $no = 1;
    foreach ($product as $index => $produk) :
        // Use FCPATH to get the correct path to public directory
        $path = FCPATH . "img/" . $produk['foto'];
        
        // Check if file exists before trying to read it
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        } else {
            // Fallback: use a placeholder or just show filename
            $base64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg=='; // 1x1 transparent pixel
        }
    ?>
        <tr>
            <td align="center"><?= $index + 1 ?></td>
            <td><?= $produk['nama'] ?></td>
            <td align="right"><?= "Rp " . number_format($produk['harga'], 2, ",", ".") ?></td>
            <td align="center"><?= $produk['jumlah'] ?></td>
            <td align="center">
                <?php if (file_exists(FCPATH . "img/" . $produk['foto'])): ?>
                    <img src="<?= $base64 ?>" width="50px">
                <?php else: ?>
                    <span>Image not found</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
Downloaded on <?= date("Y-m-d H:i:s") ?>