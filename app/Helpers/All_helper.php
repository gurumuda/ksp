<?php

function jk($jk)
{
    switch ($jk) {
        case '1':
            echo 'Laki-laki';
            break;
        case '2':
            echo 'Perempuan';
            break;
        default:
            echo 'Tidak diketahui';
            break;
    }
}

function jenistrx($jns)
{
    switch ($jns) {
        case '1':
            echo 'Debet';
            break;
        case '2':
            echo 'Kredit';
            break;
        default:
            echo 'Tidak diketahui';
            break;
    }
}

function periodetrx($per)
{
    switch ($per) {
        case '1':
            echo 'Satu Kali';
            break;
        case '2':
            echo 'Bulanan';
            break;
        case '3':
            echo 'Insiden';
            break;
        default:
            echo 'Tidak diketahui';
            break;
    }
}

function tglIndo($tgl)
{
    $tg = substr($tgl, 8, 2);
    $bl = substr($tgl, 5, 2);
    $th = substr($tgl, 0, 4);

    return $tg . ' - ' . $bl . ' - ' . $th;
}
