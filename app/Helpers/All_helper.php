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
