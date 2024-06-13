<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BahanBakwan</title>
</head>
<body>
    <form action="" method="post">
        <div style= "display: flex;">
            <labe for= "liter">Masukkanjumlah liter pembelian : </label>
            <input type="number" name="liter" id="liter" required>
        </div>
        <div style = "display : flex;" >
            <label for="jenis" require>Pilih Jenis Bahan Bakar : </label>
            <select name="jenis" require>
                <option value="Super">Shell Super</option>
                <option value="SVPower">Shell V-Power</option>
                <option value="SVPowerDiesel">Shell V-Power Diesel</option>
                <option value="SVPowerNitro">Shell V-Power Nitro</option>
            </select>

        </div>
        <button type="submit" name="beli">buy</button>
    </form>
    <?php
        require 'satu.php' ;
        $logic = new pembelian();
        $logic->setHarga(10000, 15000, 18000, 20000);

        if (isset($_POST['beli'])){
            $logic->jenisYangDipilih = $_POST['jenis'];
            $logic->totalLiter = $_POST['liter'];
            $logic->totalHarga();
            $logic->cetakBukti();
        }
    ?>
    
</body>
</html>