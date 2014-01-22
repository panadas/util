<?php
namespace Panadas\Util;

class String
{

    const MASK_REVEAL_PERCENT = 25;
    const MASK_REVEAL_MAX_LENGTH = 8;

    const RANDOM_MCRYPT_IV_SIZE = 10;
    const RANDOM_MCRYPT_IV_SOURCE = MCRYPT_DEV_URANDOM;

    /**
     * Mask a string, optionally revealing some of the first and last characters.
     *
     * @param  string  $string
     * @param  boolean $reveal
     * @param  string  $character
     * @throws \InvalidArgumentException
     * @return string
     */
    public static function mask($string, $reveal = false, $character = "*")
    {
        if (mb_strlen($character) !== 1) {
            throw new \InvalidArgumentException("A single character is required");
        }

        $length = mb_strlen($string);

        if ($reveal) {

            // Calculate the number of characters to reveal up to a maximum of MASK_REVEAL_MAX_LENGTH characters
            $reveal_length = min(
                ($length * (static::MASK_REVEAL_PERCENT / 100)),
                static::MASK_REVEAL_MAX_LENGTH
            );

            // Set the number of characters to reveal each side
            $reveal_length = floor($reveal_length / 2);

        } else {
            $reveal_length = 0;
        }

        $masked = "";

        if ($reveal_length > 0) {
            $masked .= mb_substr($string, 0, $reveal_length);
        }

        $masked .= str_repeat($character, ($length - ($reveal_length * 2)));

        if ($reveal_length > 0) {
            $masked .= mb_substr($string, -$reveal_length);
        }

        return $masked;
    }

    /**
     * Multibyte-safe version of strtolower().
     *
     * @param  string $string
     * @param  string $encoding
     * @return string
     */
    public static function mb_lcfirst($string, $encoding = null)
    {
        $string[0] = mb_strtolower($string[0], (is_null($encoding) ? mb_internal_encoding() : $encoding));

        return $string;
    }

    /**
     * Multibyte-safe version of strtoupper().
     *
     * @param  string $string
     * @param  string $encoding
     * @return string
     */
    public static function mb_ucfirst($string, $encoding = null)
    {
        $string[0] = mb_strtoupper($string[0], (is_null($encoding) ? mb_internal_encoding() : $encoding));

        return $string;
    }

    /**
     * Convert a string to camel-case. All non-alphanumeric characters are considered word boundaries. The first
     * character is lowercase.
     *
     * @param  string $string
     * @param  string $encoding
     * @return string
     */
    public static function camel($string, $encoding = null)
    {
        $encoding = is_null($encoding) ? mb_internal_encoding() : $encoding;

        $callback = function($matches) use ($encoding) {

            if (empty($matches[1])) {
                return null;
            }

            return mb_strtoupper($matches[1], $encoding);

        };

        return preg_replace_callback("/[^a-z0-9](.)?/", $callback, mb_strtolower($string, $encoding));
    }

    /**
     * Check if a string starts with the provided prefix.
     *
     * @param  string $prefix
     * @param  string $string
     * @return boolean
     */
    public static function startsWith($prefix, $string)
    {
        return (mb_substr($string, 0, mb_strlen($prefix)) === $prefix);
    }

    /**
     * Check if a string ends with the provided suffix.
     *
     * @param  string $prefix
     * @param  string $string
     * @return boolean
     */
    public static function endsWith($suffix, $string)
    {
        return (mb_substr($string, -mb_strlen($suffix)) === $suffix);
    }

    /**
     * Generate a random string.
     *
     * @param  integer $length
     * @return string
     */
    public static function random($length)
    {
        $string = null;

        while (mb_strlen($string) < $length) {
            $string .= sha1(mcrypt_create_iv(static::RANDOM_MCRYPT_IV_SIZE, static::RANDOM_MCRYPT_IV_SOURCE));
        }

        if (mb_strlen($string) > $length) {
            $string = mb_substr($string, 0, $length);
        }

        return $string;
    }

}
