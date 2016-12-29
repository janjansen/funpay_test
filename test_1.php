<?php
/**
 * Для поиска нужных значений в тесте sms
 * были наложены следующие ограничения:
 * 1)pass - от 3 до 6 цифр
 * 2)sum - oт 1 до 10  цифр после которых всегда идут копейки (2 цифры) отделенные , или .
 * 3)wallet - всегда 15 цифр
 */

/**
 * @param string $sms
 * @return array
 */
function parse($sms) {
    preg_match('/([^0-9]|^)([0-9]{3,6})(?!\,[0-9]{2}|\.[0-9]{2}|[0-9])/', $sms, $matches);
    $pass = $matches[2] ?? null;

    preg_match('/([^0-9]|^)([0-9]{1,10}[\,\.][0-9]{2})/', $sms, $matches);
    $sum = $matches[2] ?? null;

    preg_match('/([^0-9]|^)([0-9]{15})([^0-9]|$)/', $sms, $matches);
    $wallet = $matches[2] ?? null;

    return [
        'pass' => $pass,
        'sum' => $sum,
        'wallet' => $wallet
    ];
}


$sms = <<<RAW_TEXT
Пароль: 1660
Спишется 1232,51р.
Перевод на счет 410018789456321
RAW_TEXT;

print_r(parse($sms));
