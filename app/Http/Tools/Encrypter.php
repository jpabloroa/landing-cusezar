<?php

namespace App\Http\Tools;

class Encrypter
{
    /**
     * @var mixed|string
     */
    private $cipher;
    private $tag_length;

    /**
     * @var mixed
     */
    public $public_key;
    public $private_key;

    /**
     * @param $chiper
     * @param $tag_length
     */
    function __construct($chiper = 'aes-256-gcm', $passphrase = null, $tag_length = 16)
    {
        $this->cipher = $chiper;
        $this->tag_length = $tag_length;
        switch ($this->cipher) {
            case 'aes-256-gcm':
                break;
            case 'public-key-crypt':
                $configs['config'] = __DIR__ . '/../../../storage/app/ssl/openssl.cnf';
                $config = array(
                    "digest_alg" => "sha512",
                    "private_key_bits" => 4096,
                    "private_key_type" => OPENSSL_KEYTYPE_RSA,
                );
                $res = openssl_pkey_new($config + $configs);
                openssl_pkey_export($res, $this->private_key);
                $public_key = openssl_pkey_get_details($res);
                $this->public_key = $public_key["key"];
                break;
        }
    }

    /**
     * @param $textToEncrypt
     * @param $password
     * @return string
     */
    function encrypt($textToEncrypt, $password): string
    {
        switch ($this->cipher) {
            case 'aes-256-gcm':
                $iv_len = openssl_cipher_iv_length($this->cipher);
                $iv = openssl_random_pseudo_bytes($iv_len);

                $tag = ""; // will be filled by openssl_encrypt

                $key = substr(hash('sha256', $password, true), 0, 32);
                $ciphertext = openssl_encrypt($textToEncrypt, $this->cipher, $key, OPENSSL_RAW_DATA, $iv, $tag, "", $this->tag_length);

                return base64_encode($iv . $ciphertext . $tag);
            case 'public-key-crypt':
                openssl_private_encrypt($textToEncrypt, $encrypted, $this->private_key);
                return bin2hex($encrypted);
        }
        return '';
    }

    /**
     * @param $textToDecrypt
     * @param $password
     * @return false|string
     */
    function decrypt($textToDecrypt, $password): string
    {
        switch ($this->cipher) {
            case 'aes-256-gcm':
                $encrypted = base64_decode($textToDecrypt);

                $iv_len = openssl_cipher_iv_length($this->cipher);
                $iv = substr($encrypted, 0, $iv_len);
                $ciphertext = substr($encrypted, $iv_len, -$this->tag_length);
                $tag = substr($encrypted, -$this->tag_length);

                $key = substr(hash('sha256', $password, true), 0, 32);
                return openssl_decrypt($ciphertext, $this->cipher, $key, OPENSSL_RAW_DATA, $iv, $tag);
            case 'public-key-crypt':
                openssl_public_decrypt($textToDecrypt, $decrypted, $this->public_key);
                return $decrypted;
        }
        return '';
    }
}
