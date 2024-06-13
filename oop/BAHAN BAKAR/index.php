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
            <label for= "liter">Masukkanjumlah liter pembelian : </label>
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
class DataBahanBakar {
    private $HargaSuper;
    private $HargaSVPower;
    private $HargaSVPowerDiesel;
    private $HargaSVPowerNitro;


    public $jenisYangDipilih ;
    public $totalLiter ;

    protected $totalPembayaran ;

    public function setHarga($valsuper, $valSVPower, $valSVPowerdiesel, $valSVPowerNitro){
        $this->HargaSuper = $valsuper;
        $this->HargaSVPower = $valSVPower;
        $this->HargaSVPowerDiesel = $valSVPowerdiesel;
        $this->HargaSVPowerNitro = $valSVPowerNitro;
    }

    public function getHarga(){
        $semuaDataSolar ['Super'] = $this->HargaSuper;
        $semuaDataSolar ['SVPower'] = $this->HargaSVPower;
        $semuaDataSolar ['SVPowerDiesel'] = $this->HargaSVPowerDiesel;
        $semuaDataSolar ['SVPowerNitro'] = $this->HargaSVPowerNitro;
        return $semuaDataSolar;
    }
}

class pembelian extends DataBahanBakar {
    //data sudah disediakan, tinggal proses penghitungan jumlah pembelian
    public function totalHarga(){
        $this->totalPembayaran = $this->getHarga()[$this->jenisYangDipilih] * $this->totalLiter;
    }

    public function cetakBukti() {
        echo  "<center> ----------------------------------- </center>"; 
        echo "<center>jenis bahan bakar :". $this->jenisYangDipilih."</center";
        echo "<br>";
        echo "<center> total liter : " . $this->totalLiter . "</center";
        echo " <center> harga bayar : Rp." . number_format($this->totalPembayaran, 0, ',', '.'). "</center";
        echo "<br>";
        echo "<center>------------------------------------------------------</center";

    }
}

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

