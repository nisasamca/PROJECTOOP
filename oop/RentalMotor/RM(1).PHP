<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <body><center>

        <form action="" method="POST">
            <div class="form-group">
                <label for="nama" class="form-label">Masukan nama :</label>
                <input type="text" name="member" id="nama" class="form-control" placeholder="Masukan nama" required>
            </div>
            <div class="form-group">
                <label for="jenis" class="form-label">Pilih Jenis Motor : </label>
                <select name="jenis" id="jenis" class="form-select" required>
                    <option value="default" selected disabled>Pilih jenis Motor:</option>
                    <option value="Scooter">Scooter</option>
                    <option value="Sport">Sport</option>
                    <option value="SportTouring">Sport Touring</option>
                    <option value="Cross">Cross</option>
                </select>
            </div>
            <div class="form-group">
                <label for="waktu" class="form-label">Masukan waktu sewa : </label>
                <input type="number" name="waktu" id="waktu" class="form-control" min="1" placeholder="Minimal 1 hari" required>
            </div>
            <center>
                <button type="submit" name="submit" class="btn btn-primary">Sewa</button>
            </center>
        </form>
    </center>
    <?php
    include 'RM.php';

$logic = new Rental();
$logic->getHarga(100000, 150000, 200000, 250000);

if (isset($_POST['submit'])) {
    $logic->member = $_POST['member'];
    $logic->jenis = $_POST['jenis'];
    $logic->Waktu = $_POST['waktu'];

    $logic->Pembayaran();
}
    ?>
    </body>
    </html>



