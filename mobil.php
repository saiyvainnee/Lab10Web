<?php
/**
 * Program sederhana pendefinisian class dan pemanggilan class.
 */

class Mobil
{
    private $warna;
    private $merk;
    private $harga;

    public function __construct()
    {
        $this->warna = "Biru";
        $this->merk  = "BMW";
        $this->harga = 10000000; // angka, bukan string
    }

    public function gantiWarna($warnaBaru)
    {
        $this->warna = $warnaBaru;
    }

    public function tampilWarna()
    {
        echo "Warna mobilnya : " . htmlspecialchars($this->warna);
    }

    public function info()
    {
        echo "Merk: " . htmlspecialchars($this->merk) . "<br>";
        echo "Harga: Rp " . number_format($this->harga, 0, ',', '.') . "<br>";
        $this->tampilWarna();
    }
}

$a = new Mobil();
$b = new Mobil();

echo "<b>Mobil pertama</b><br>";
$a->tampilWarna();
echo "<br>Mobil pertama ganti warna<br>";
$a->gantiWarna("Merah");
$a->tampilWarna();

echo "<br><br><b>Mobil kedua</b><br>";
$b->gantiWarna("Hijau");
$b->tampilWarna();
?>
