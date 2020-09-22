<?php

function dd($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

function cryptoRandSecure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) {
        return $min;
    }
    // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function genUnique($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[cryptoRandSecure(0, $max - 1)];
    }

    return $token;
}

function inputPost($forms)
{
    $thiss = &get_instance();
    $data = [];
    foreach ($forms as $form) {
        $data[$form] = $thiss->input->post($form);
    }
    return $data;
}

function cleanRp($value)
{
    $value = str_replace("Rp. ", "", $value);
    return str_replace(".", "", $value);
}

function toRp($amount)
{

    $rupiah = "Rp " . number_format($amount, 2, ',', '.');
    return $rupiah;
}

function toDateTime($date)
{
    return date_format($date, "d-m-Y H:i:s");
}

function isUnique($value, $params)
{
    $ci = &get_instance();

    $params = explode(".", $params);

    $table = $params[0];
    $field = $params[1];

    $ci->db->where($field, $value);

    if (count($params) === 3) {
        $id = $params[2];
        $ci->db->where_not_in('id', $id);
    }

    $data = $ci->db->limit(1)->get($table)->result();
    return $data ? false : true;
}

function array_delete_by_value($array, $value) {
    $newArray = [];
    foreach($array as $arr){
        if($arr !== $value) {
            $newArray[] = $arr;
        }
    }
    return $newArray;
}
