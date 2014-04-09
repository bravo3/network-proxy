<?php
namespace Bravo3\NetworkProxy\Enum;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * @method static ProxyType SOCKS()
 * @method static ProxyType HTTP()
 * @method static ProxyType HTTPS()
 * @method static ProxyType FTP()
 */
final class ProxyType extends AbstractEnumeration
{
    const SOCKS = 'SOCKS';
    const HTTP  = 'HTTP';
    const HTTPS = 'HTTPS';
    const FTP   = 'FTP';
} 