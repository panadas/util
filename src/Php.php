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
                return $var ? "TRUE" : "FALSE";
            case "integer":
            case "double":
                return $var;
            case "string":
                return "\"{$var}\"";
            case "array":
                return "Array(" . count($var) . ")";
            case "object":
                return "Object(" . get_class($var) . ")";
            case "resource":
                return "Resource(" . get_resource_type($var) . ")";
            case "NULL":
                return "NULL";
            default:
                return "Unknown Type";
        }
    }

}
