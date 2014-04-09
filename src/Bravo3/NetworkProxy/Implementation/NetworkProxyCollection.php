<?php
namespace Bravo3\NetworkProxy\Implementation;

use Bravo3\NetworkProxy\AbstractNetworkProxyCollection;
use Bravo3\NetworkProxy\Enum\ProxyScheme;
use Bravo3\NetworkProxy\NetworkProxyInterface;

/**
 * A collection of proxies suitable for using in multi-protocol configuration
 */
class NetworkProxyCollection extends AbstractNetworkProxyCollection
{

    /**
     * Get the most appropriate proxy for the protocol
     *
     * @param ProxyScheme $protocol
     * @return NetworkProxyInterface|null
     */
    public function getProxy(ProxyScheme $protocol)
    {
        $proxy = $this->socks_proxy;
        if ($protocol == ProxyScheme::HTTP() && $this->http_proxy) {
            $proxy = $this->http_proxy;
        } elseif ($protocol == ProxyScheme::HTTPS() && $this->https_proxy) {
            $proxy = $this->https_proxy;
        } elseif ($protocol == ProxyScheme::FTP() && $this->ftp_proxy) {
            $proxy = $this->ftp_proxy;
        }
        return $proxy;
    }

}
 