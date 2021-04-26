<?php

ini_set('display_errors', '1');


echo 'Tableau à trier : <pre>' . print_r($tab, 1) . '</pre><hr>';



function reverse(array &$tab, $k1, $k2)
{
    $t = $tab[$k1];
    $tab[$k1] = $tab[$k2];
    $tab[$k2] = $t;
}


$tab = [0, 1024, 28, -3.14, 128, 256, 13, 56, 4096, -279];


/**
 * Cette fonction est un tri a bulle.
 *
 */
function triabulles(array &$tab)
{
    $mssg = "Tri à bulles.\n";

    $nt = 0;
    $no = 0;
    $loop = 0;
    do {
        $chg = false;
        for ($i = 0; $i < count($tab); $i++) {
            $n = $i + 1;
            if (isset($tab[$n])) {
                ++$nt;
                if ($tab[$i] > $tab[$n]) {
                    $t = $tab[$i];
                    $tab[$i] = $tab[$n];
                    $tab[$n] = $t;
                    ++$no;
                    $chg = true;
                }
            }
        }
        ++$loop;
    } while ($chg);

    $mssg .= 'Tri en ' . $no . ' opérations sur ' . $nt . ' tests en ' . $loop . ' boucles.';

    return $mssg;
}






/**
 *
 */
function tridouble(array $tab, bool $stat = false)
{
    $mssg = "Tri double.\n";

    $nt = 0;
    $no = 0;
    $loop = 0;
    $size = count($tab);
    // var_dump($size); // 10
    do {
        $chg = 0;
        for ($i = 0; $i < $size; $i++) {
            $in = $i + 1;
            $l = ($size - 1) - $i;
            $lp = $l - 1;
            if (isset($tab[$in]) && isset($tab[$lp])) {
                if ($tab[$i] > $tab[$in]) {
                    reverse($tab, $i, $in);
                    ++$nt;
                    ++$no;
                    ++$chg;
                }
                if ($tab[$lp] > $tab[$l]) {
                    reverse($tab, $lp, $l);
                    ++$nt;
                    ++$no;
                    ++$chg;
                }
            }
        }
        ++$loop;
    } while ($chg > 0);

    $mssg .= 'Fin de tri en ' . $no . ' opérations sur ' . $nt . ' tests en ' . $loop . ' boucles.';

    if ($stat) return [$mssg, $tab];
    else return $tab;
}
echo '<pre>' . print_r(tridouble($tab, true)[0], 1) . '</pre></br>';





// /**
//  *
//  */
// function tridoublevariente($tab, bool $stat = false)
// {
//     $mssg = "Tri double varient.\n";

//     $nt = 0;
//     $no = 0;
//     $loop = 0;
//     $size = count($tab);
//     do {
//         $chg = false;
//         for ($i = 0; $i < $size; $i++) {
//             $in = $i + 1;
//             $l = ($size - 1) - $i;
//             $lp = $l - 1; // var_dump('test ' . $i . ' < ' . $in . ' <==' . $lp . ' < ' . $l . ' <br>');

//             if (isset($tab[$in]) && isset($tab[$lp])) {
//                 if ($tab[$i] > $tab[$lp] && $in != $lp) {
//                     // var_dump('test ' . $tab[$i] . ' > ' . $tab[$lp] . '<br>');
//                     reverse($tab, $i, $lp);
//                     ++$nt;
//                     ++$no;
//                     $chg = true;
//                     continue;
//                 }
//                 if ($tab[$l] < $tab[$in]) {
//                     reverse($tab, $l, $in);
//                     ++$nt;
//                     ++$no;
//                     $chg = true;
//                     continue;
//                 }
//                 if ($tab[$i] > $tab[$in]) {
//                     reverse($tab, $i, $in);
//                     ++$nt;
//                     ++$no;
//                     $chg = true;
//                 }
//                 if ($tab[$lp] > $tab[$l]) {
//                     reverse($tab, $lp, $l);
//                     ++$nt;
//                     ++$no;
//                     $chg = true;
//                 }
//             }
//         }
//         ++$loop;
//     } while ($chg);

//     $mssg .= 'Fin de tri en ' . $no . ' opérations sur ' . $nt . ' tests en ' . $loop . ' boucles.';

//     if ($stat) return [$mssg, $tab];
//     else return $tab;
// }
                // echo '<pre>' . print_r(tridoublevariente($tab, true)[0], 1) . '</pre></br>';