<?php
session_start();

$valid_code = 'd0n7_trust_cl1ent_s1de_c0de'; 

$user_code = trim($_POST['code'] ?? '');

if (hash_equals($valid_code, $user_code)) {
    $_SESSION['premium_access'] = true;

    $secret = 'WebSec{m4k4ny@_j4ng4n_k@s!h_k0d3_jsjsjs_ny4_b4n9!!!!!}';

    echo json_encode([
        'ok' => true,
        'secret' => $secret
    ]);
} else {
    echo json_encode([
        'ok' => false,
        'msg' => 'Kode salah'
    ]);
}