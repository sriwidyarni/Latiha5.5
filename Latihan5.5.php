<?php

class Pembeli {
    var $nomor;
    var $kartumember;
    var $totalbelanja;
    var $diskon;
    var $biaya;
    
    function setNomor($x) {
        $this->nomor = $x;
    }

    function getNomor() {
        return $this->nomor;
    }

    function setKartuMember($x) {
        $this->kartumember = $x;
    }

    function getKartuMember() {
        return $this->kartumember;
    }

    function setTotalBelanja($x) {
        $this->totalbelanja = $x;
    }

    function getTotalBelanja() {
        return $this->totalbelanja;
    }

    function hitungDiskon() {
        $diskon = 0;
        switch ($this->kartumember) {
            case 'Memiliki':
                switch (true) {
                    case ($this->totalbelanja > 500000):
                        $diskon = 50000;
                        break;
                    case ($this->totalbelanja > 100000):
                        $diskon = 15000;
                        break;
                }
                break;
            case 'Tidak Memiliki':
                if ($this->totalbelanja > 100000) {
                    $diskon = 5000;
                }
                break;
        }
        return $diskon;
    }

    function hitungBiaya() {
        return $this->totalbelanja - $this->hitungDiskon();
    }
}

$pembeliData = [
    ['Memiliki', 200000],
    ['Memiliki', 570000],
    ['Tidak Memiliki', 120000],
    ['Tidak Memiliki', 90000],
];

$pembeliList = [];
for ($i = 0; $i < count($pembeliData); $i++) {
    $pembeli = new Pembeli;
    $pembeli->setNomor($i + 1);
    $pembeli->setKartuMember($pembeliData[$i][0]);
    $pembeli->setTotalBelanja($pembeliData[$i][1]);
    $pembeliList[] = $pembeli;
}

$isi = "";
foreach ($pembeliList as $pembeli) {
    $diskon = $pembeli->hitungDiskon();
    $biaya = $pembeli->hitungBiaya();

    $isi .= "<tr>";
    $isi .= "<td>" . $pembeli->getNomor() . "</td>";
    $isi .= "<td>Pembeli</td>";
    $isi .= "<td>" . $pembeli->getKartuMember() . "</td>";
    $isi .= "<td>" . $pembeli->getTotalBelanja() . "</td>";
    $isi .= "<td>" . $diskon . "</td>";
    $isi .= "<td>" . $biaya . "</td>";
    $isi .= "</tr>";
}

echo "<table border='1' rules='all' width='600'>
        <tr align='center' height='30' bgcolor='#BFFFF'>
        <td>Nomor</td>
        <td>Pembeli</td>
        <td>Kartu Member</td>
        <td>Total Belanja</td>
        <td>Diskon</td>
        <td>Biaya</td></tr>";

echo $isi;

echo "</table>";
