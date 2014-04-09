<?php
namespace Bravo3\NetworkProxy\Enum;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Schemes suitable for use with a proxy
 *
 * @method static ProxyScheme FTP()
 * @method static ProxyScheme HTTP()
 * @method static ProxyScheme HTTPS()
 */
final class ProxyScheme extends AbstractEnumeration
{
    const HTTP  = 'http';
    const HTTPS = 'https';
    const FTP   = 'ftp';
}