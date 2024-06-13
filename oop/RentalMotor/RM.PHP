<?php
class Data {
    public $member;
    public $jenis;
    public $Waktu;
    public $Diskon;
    protected $Pajak;
    private $Scooter, $Sport, $SportTouring, $Cross;
    private $ListMember = ['ana', 'sam', 'alex','ara'];

    function __construct(){
        $this->Pajak = 10000;   
    }
 public function getMember() {
    if (in_array($this->member, $this->ListMember)){
        return "member";
    } else {
        return "non member";
 }
        
    
}

public function setHarga($jenis1, $jenis2, $jenis3, $jenis4){
    $this->Scooter = $jenis1;
    $this->Sport = $jenis2;
    $this->SportTouring = $jenis3;
    $this->Cross = $jenis4;

}
public function getHarga(){
   $data['Scooter'] = $this->Scooter;
   $data['Sport'] = $this->Sport;
   $data['SportTouring'] = $this->SportTouring;
   $data['Cross'] = $this->Cross;
   return $data;
}

}

class Rental extends Data {
    public function hargaRental(){
    $dataHarga = $this->getHarga()[$this->jenis];
    $Diskon = $this->getMember() == "member" ? 5 : 0;
    if ($this->Waktu === 1){
        $bayar = ($dataHarga -($dataHarga * $Diskon/100)) + $this->Pajak;

    }else{
        $bayar = (($dataHarga * $this->Waktu)-($dataHarga * $Diskon / 100)) + $this->Pajak;
    }
    return [$bayar, $Diskon];
}
public function pembayaran(){
    echo "<center>";
    echo $this->member . "berstatus sebgai " . $this->getMember() . " mendapatkan diskon sebesar " . $this->hargaRental()[1] . "%";
    echo "<br>";
    echo "Jenis motor yang dirental adalah " . $this->jenis . " selama " . $this->Waktu . " hari";
    echo "<br>";
    echo "Harga rental per-harinya : Rp. " . number_format($this->getHarga()[$this->jenis]);
    echo "<br>";
    echo "<b>Besar yang harus dibayarkan adalah: Rp. ". number_format($this->hargaRental()[0]). " (<i>Termasuk Pajak)</i></b>";
    echo "</center>";
}
}
?>