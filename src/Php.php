<?php
namespace Panadas\Util;

class Php
{

    /**
     * @param  mixed   $var
     * @return boolean
     */
    public static function isIterable($var)
    {
        return (is_array($var) || ($var instanceof \Traversable));
    }

    /**
     * @param  mixed   $var
     * @return boolean
     */
    public static function makeIterable($var)
    {
        if (static::isIterable($var)) {
            return $var;
        }

        if (null === $var) {
            return [];
        }

        return [$var];
    }

    /**
     * Convert an arbitrary variable to a string representation.
     *
     * @param  mixed  $var
     * @return string
     */
    public static function toString($var)
    {
        switch (gettype($var)) {
            case "boolean":
                return $var ? "true" : "false";
            case "integer":
            case "double":
                return $var;
            case "string":
                return "\"{$var}\"";
            case "array":
                return "array[" . count($var) . "]";
            case "object":
                return get_class($var);
            case "resource":
                return "resource[" . get_resource_type($var) . "]";
            case "NULL":
                return "null";
            // @codeCoverageIgnoreStart
            default:
                return "unknown";
        }
        // @codeCoverageIgnoreEnd
    }
}
