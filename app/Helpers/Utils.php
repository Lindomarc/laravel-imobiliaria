<?php
    if (!function_exists('mask')) {
        function mask($value, $mask)
        {
            $result = '';
            $k = 0;
            if ($value) {
                for ($i = 0; $i <= strlen($mask) - 1; $i++) {
                    if ($mask[$i] == '#') {
                        $result .= isset($value[$k]) ? ($value[$k++]) : '';
                    } else {
                        $result .= isset($mask[$i]) ? ($mask[$i]) : '';
                    }
                }
            }
            return $result;
        }
    }

    if (!function_exists('fixDouble')) {
        function fixDouble($value, $type = 'us', $decimal = 2)
        {

            if (!!$value) {
                if ($type == 'us') {
                    $valueReplace = str_replace('.', '', $value);
                    $value = str_replace(',', '.', $valueReplace);
                } else {
                    $value = number_format((float)$value, $decimal, ',', '.');
                }
            }
            return $value;
        }
    }

    if (!function_exists('onlyNumber')) {
        function onlyNumber(?string $value)
        {
            return (!!$value) ? (preg_replace('/[^0-9]/', '', $value)) : '';
        }
    }

    if (!function_exists('fixStringDate')) {
        function fixStringDate(?string $value, $type = 'us')
        {
            if (!!$value) {
                if ($type == 'us') {
                    $value = date('Y-m-d', strtotime($value));
                } else {
                    $value = date('d/m/Y', strtotime($value));
                }
            }
            return $value;
        }
    }

    if (!function_exists('fixStringToDouble')) {
        function fixStringToDouble(?string $value, $type = 'us')
        {
            if ($value) {
                if ($type == 'us') {
                    $value = str_replace('.', '', $value);
                    $value = floatval(str_replace(',', '.', $value));
                } else {
                    $value = number_format($value, 2, ',', '.');
                }
            }
            return $value;
        }
    }
