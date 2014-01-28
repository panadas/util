<?php
namespace Panadas\Util;

class Php
{

    /**
     * Convert an arbitrary variable to a string representation.
     *
     * @param  mixed $var
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
                return "array(" . count($var) . ")";
            case "object":
                return "object(" . get_class($var) . ")";
            case "resource":
                return "resource(" . get_resource_type($var) . ")";
            case "NULL":
                return "null";
            // @codeCoverageIgnoreStart
            default:
                return "unknown";
        }
        // @codeCoverageIgnoreEnd
    }
}
