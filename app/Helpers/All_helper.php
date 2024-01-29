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
