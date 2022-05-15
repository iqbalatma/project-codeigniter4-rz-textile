<?php

function check_login()
{
    if (session()->get("isLoggedIn") !== true) {
        return false;
    } else {
        return true;
    }
}

function intToRupiah($value)
{
    $rupiahResult = "Rp " . number_format($value, 0, ',', '.');
    return $rupiahResult;
}

function rupiahToInt($value)
{
    $valueResult = explode(" ", $value);
    $valueResult = str_replace(".", "", $valueResult[1]);
    return  intval($valueResult);
}

function getMonthByNumber($monthNumber)
{
    $monthData = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];
    return $monthData[$monthNumber - 1];
}

function getListMonth()
{
    $monthData = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];
    return $monthData;
}


function getMonthNow()
{
    date_default_timezone_set('Asia/Jakarta');
    return  date('m', time());
}
function getYearNow()
{
    date_default_timezone_set('Asia/Jakarta');
    return  date('Y', time());
}
function getDayNow()
{
    date_default_timezone_set('Asia/Jakarta');
    return  date('d', time());
}
function getDateNow()
{
    date_default_timezone_set('Asia/Jakarta');
    return date('Y-m-d', time());
}
function getDateTimeNow()
{
    date_default_timezone_set('Asia/Jakarta');
    return date('Y-m-d H:i:s', time());
}

function generateRandomString($length = 8)
{
    $characters = '0123456789abcdefghijklmnopqrs092u3tuvwxyzaskdhfhf9882323ABCDEFGHIJKLMNksadf9044OPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function removeElementWithValue($array, $key, $value)
{
    foreach ($array as $subKey => $subArray) {
        if ($subArray[$key] == $value) {
            unset($array[$subKey]);
        }
    }
    return $array;
}
