<?php
namespace Panadas\Util;

class String
{

    /**
     * Mask a string, optionally revealing some of the last characters. The number of characters to reveal can be
     * provided as an argument but a maximum of 25% of the string will be revealed and this will override the number
     * requested.
     *
     * @param unknown $string
     * @param number $reveal
     * @param string $character
     * @throws \InvalidArgumentException
     * @return string
     */
    public static function mask($string, $reveal = 0, $character = "•")
    {
        if (mb_strlen($character) !== 1) {
            throw new \InvalidArgumentException("A single character is required");
        }

        $length = mb_strlen($string);
        $masked = str_repeat($character, $length);

        if ($reveal > 0) {

            // Reveal a maximum of 25% of the original string
            $max_reveal = round($length * 0.25);

            if ($reveal > $max_reveal) {
                $reveal = $max_reveal;
            }

            if ($reveal > 0) {
                $masked = mb_substr($masked, 0, ($length - $reveal));
                $masked .= mb_substr($string, -$reveal);
            }

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
            $string .= sha1(mcrypt_create_iv(10, MCRYPT_DEV_URANDOM));
        }

        if (mb_strlen($string) > $length) {
            $string = substr($string, 0, $length);
        }

        return $string;
    }

}
