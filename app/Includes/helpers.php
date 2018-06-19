<?php

function myFormatDate($time = null) {
    return date('d.m.Y H:i', $time);
}

if (!function_exists('getRusDate')) {
    function getRusDate($dateTime, $format = '%DAYWEEK%, d %MONTH% Y H:i', $offset = 0)
    {
        $monthArray = array('������', '�������', '�����', '������', '���', '����', '����', '�������', '��������', '�������', '������', '�������');
        $daysArray = array('�����������', '�������', '�����', '�������', '�������', '�������', '�����������');

        $timestamp = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dateTime)->timestamp;
        $timestamp += 3600 * $offset;

        $findArray = array('/%MONTH%/i', '/%DAYWEEK%/i');
        $replaceArray = array($monthArray[date("m", $timestamp) - 1], $daysArray[date("N", $timestamp) - 1]);
        $format = preg_replace($findArray, $replaceArray, $format);

        return date($format, $timestamp);
    }
}

if (!function_exists('uploads_path')) {
    function uploads_path()
    {
        return storage_path('app.uploads');
    }
}