<?php

if (!function_exists('encryptCCavenue')) {

    function encryptCCavenue($data)
    {
        $workingKey = config('ccavenue.working_key');

        $merchantData = http_build_query($data);

        $key = hextobin(md5($workingKey));

        $initVector = pack("C*", 
            0x00,0x01,0x02,0x03,0x04,0x05,0x06,0x07,
            0x08,0x09,0x0a,0x0b,0x0c,0x0d,0x0e,0x0f
        );

        $encrypted = openssl_encrypt(
            $merchantData,
            'AES-128-CBC',
            $key,
            OPENSSL_RAW_DATA,
            $initVector
        );

        return bin2hex($encrypted);
    }
}

if (!function_exists('decryptCCavenue')) {

    function decryptCCavenue($encrypted)
    {
        $workingKey = config('ccavenue.working_key');

        $key = hextobin(md5($workingKey));

        $initVector = pack("C*", 
            0x00,0x01,0x02,0x03,0x04,0x05,0x06,0x07,
            0x08,0x09,0x0a,0x0b,0x0c,0x0d,0x0e,0x0f
        );

        $encrypted = hextobin($encrypted);

        $decrypted = openssl_decrypt(
            $encrypted,
            'AES-128-CBC',
            $key,
            OPENSSL_RAW_DATA,
            $initVector
        );

        parse_str($decrypted, $output);

        return $output;
    }
}

function hextobin($hexString)
{
    $length = strlen($hexString);
    $binString = "";

    for ($i = 0; $i < $length; $i += 2) {
        $binString .= pack("H*", substr($hexString, $i, 2));
    }

    return $binString;
}