<?php
namespace Panadas\Util;

class Http
{

    static private $status_code_map = [
        100 => "Continue",
        101 => "Switching Protocols",
        200 => "OK",
        201 => "Created",
        202 => "Accepted",
        203 => "Non-Authoritative Information",
        204 => "No Content",
        205 => "Reset Content",
        206 => "Partial Content",
        300 => "Multiple Choices",
        301 => "Moved Permanently",
        302 => "Found",
        303 => "See Other",
        304 => "Not Modified",
        305 => "Use Proxy",
        307 => "Temporary Redirect",
        400 => "Bad Request",
        401 => "Unauthorized",
        402 => "Payment Required",
        403 => "Forbidden",
        404 => "Not Found",
        405 => "Method Not Allowed",
        406 => "Not Acceptable",
        407 => "Proxy Authentication Required",
        408 => "Request Timeout",
        409 => "Conflict",
        410 => "Gone",
        411 => "Length Required",
        412 => "Precondition Failed",
        413 => "Request Entity Too Large",
        414 => "Request-URI Too Long",
        415 => "Unsupported Media Type",
        416 => "Requested Range Not Satisfiable",
        417 => "Expectation Failed",
        418 => "I\"m a Teapot",
        422 => "Unprocessable Entity",
        423 => "Locked",
        424 => "Failed Dependency",
        424 => "Method Failure",
        425 => "Unordered Collection",
        426 => "Upgrade Required",
        428 => "Precondition Required",
        429 => "Too Many Requests",
        431 => "Request Header Fields Too Large",
        449 => "Retry With",
        450 => "Blocked by Windows Parental Controls",
        451 => "Unavailable For Legal Reasons",
        500 => "Internal Server Error",
        501 => "Not Implemented",
        502 => "Bad Gateway",
        503 => "Service Unavailable",
        504 => "Gateway Timeout",
        505 => "HTTP Version Not Supported",
    ];

    /**
     * @return array
     */
    public static function getStatusCodes()
    {
        return array_keys(static::$status_code_map);
    }

    /**
     * @param  integer $code
     * @return boolean
     */
    public static function hasStatusCode($code)
    {
        return array_key_exists($code, static::$status_code_map);
    }

    /**
     * @param  integer $code
     * @return string
     */
    public static function getStatusMessageFromCode($code)
    {
        return static::hasStatusCode($code) ? static::$status_code_map[$code] : null;
    }

    /**
     * Convert a raw header name to the PHP equivalent.
     *
     * @param  string $name
     * @return string
     */
    public static function getPhpHeaderName($name)
    {
        return "HTTP_" . preg_replace("/[^0-9a-z]/i", "_", mb_strtoupper($name));
    }

}
