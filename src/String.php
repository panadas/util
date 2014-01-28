<?php
namespace Panadas\Util;

class String
{

    const MASK_REVEAL_PERCENT = 25;
    const MASK_REVEAL_MAX_LENGTH = 8;

    const RANDOM_MCRYPT_IV_SIZE = 10;
    const RANDOM_MCRYPT_IV_SOURCE = MCRYPT_DEV_URANDOM;

    /**
     * Mask a string optionally revealing some of the first and last characters.
     *
     * @param  string  $string
     * @param  boolean $reveal
     * @param  string  $character
     * @param  string  $encoding
     * @throws \InvalidArgumentException
     * @return string
     */
    public static function mask(
        $string,
        $reveal = false,
        $character = "*",
        $encoding = null
    ) {
        if (null === $encoding) {
            $encoding = mb_internal_encoding();
        }

        if (mb_strlen($character, $encoding) !== 1) {
            throw new \InvalidArgumentException(
                "A single character is required"
            );
        }

        $length = mb_strlen($string, $encoding);
        $revealLength = 0;

        if ($reveal) {

            // Calculate the number of characters to reveal up to a maximum of
            // MASK_REVEAL_MAX_LENGTH characters
            $revealLength = min(
                ($length * (static::MASK_REVEAL_PERCENT / 100)),
                static::MASK_REVEAL_MAX_LENGTH
            );

            // Set the number of characters to reveal each side
            $revealLength = floor($revealLength / 2);

        }

        $masked = "";

        if ($revealLength > 0) {
            $masked .= mb_substr($string, 0, $revealLength, $encoding);
        }

        $masked .= str_repeat($character, ($length - ($revealLength * 2)));

        if ($revealLength > 0) {
            $masked .= mb_substr($string, -$revealLength, null, $encoding);
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
    public static function mbLcfirst($string, $encoding = null)
    {
        if (null === $encoding) {
            $encoding = mb_internal_encoding();
        }

        if (mb_strlen($string, $encoding) === 0) {
            return $string;
        }

        return (
            mb_strtolower(mb_substr($string, 0, 1, $encoding), $encoding)
            . mb_substr($string, 1, null, $encoding)
        );
    }

    /**
     * Multibyte-safe version of strtoupper().
     *
     * @param  string $string
     * @param  string $encoding
     * @return string
     */
    public static function mbUcfirst($string, $encoding = null)
    {
        if (null === $encoding) {
            $encoding = mb_internal_encoding();
        }

        if (mb_strlen($string, $encoding) === 0) {
            return $string;
        }

        return (
            mb_strtoupper(mb_substr($string, 0, 1, $encoding), $encoding)
            . mb_substr($string, 1, null, $encoding)
        );
    }

    /**
     * Convert a string to camel-case. All non-alphabetic characters are
     * considered word boundaries. The first character is lowercase.
     *
     * @param  string $string
     * @param  string $encoding
     * @return string
     */
    public static function camel($string, $encoding = null)
    {
        if (null === $encoding) {
            $encoding = mb_internal_encoding();
        }

        return preg_replace_callback(
            "/[ _-]([a-z])/",
            function ($matches) use ($encoding) {
                return mb_strtoupper($matches[1], $encoding);
            },
            mb_strtolower($string, $encoding)
        );
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
            $string .= sha1(
                mcrypt_create_iv(
                    static::RANDOM_MCRYPT_IV_SIZE,
                    static::RANDOM_MCRYPT_IV_SOURCE
                )
            );
        }

        if (mb_strlen($string) > $length) {
            $string = mb_substr($string, 0, $length);
        }

        return $string;
    }
}
