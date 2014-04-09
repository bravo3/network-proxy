<?php
namespace Bravo3\Tests\NetworkProxy;

use Bravo3\NetworkProxy\Enum\ProxyScheme;
use Bravo3\NetworkProxy\Implementation\FtpProxy;
use Bravo3\NetworkProxy\Implementation\HttpProxy;
use Bravo3\NetworkProxy\Implementation\NetworkProxyCollection;
use Bravo3\NetworkProxy\Implementation\SocksProxy;

class NetworkProxyCollectionTest extends \PHPUnit_Framework_TestCase {

    /**
     * @small
     */
    public function testCollection()
    {
        $http_proxy = new HttpProxy('http', 8080);
        $ftp_proxy = new FtpProxy('ftp', 8080);
        $socks_proxy = new SocksProxy('socks', 8080);

        $collection = new NetworkProxyCollection();
        $collection->setHttpProxy($http_proxy);
        $collection->setHttpsProxy($http_proxy);
        $collection->setFtpProxy($ftp_proxy);
        $collection->setSocksProxy($socks_proxy);

        $this->assertTrue($collection->getHttpProxy() instanceof HttpProxy);
        $this->assertTrue($collection->getHttpsProxy() instanceof HttpProxy);
        $this->assertTrue($collection->getFtpProxy() instanceof FtpProxy);
        $this->assertTrue($collection->getSocksProxy() instanceof SocksProxy);

        $this->assertEquals('http', $collection->getHttpProxy()->getHostname());
        $this->assertEquals('http', $collection->getHttpsProxy()->getHostname());
        $this->assertEquals('ftp', $collection->getFtpProxy()->getHostname());
        $this->assertEquals('socks', $collection->getSocksProxy()->getHostname());
    }

    /**
     * @small
     */
    public function testRetrieval()
    {
        $http_proxy = new HttpProxy('http', 8080);
        $https_proxy = new HttpProxy('https', 8080);
        $ftp_proxy = new FtpProxy('ftp', 8080);
        $socks_proxy = new SocksProxy('socks', 8080);

        $collection = new NetworkProxyCollection();
        $collection->setSocksProxy($socks_proxy);

        $this->assertTrue($collection->getProxy(ProxyScheme::FTP()) instanceof SocksProxy);
        $this->assertTrue($collection->getProxy(ProxyScheme::HTTP()) instanceof SocksProxy);
        $this->assertTrue($collection->getProxy(ProxyScheme::HTTPS()) instanceof SocksProxy);

        $collection->setFtpProxy($ftp_proxy);

        $this->assertTrue($collection->getProxy(ProxyScheme::FTP()) instanceof FtpProxy);
        $this->assertTrue($collection->getProxy(ProxyScheme::HTTP()) instanceof SocksProxy);
        $this->assertTrue($collection->getProxy(ProxyScheme::HTTPS()) instanceof SocksProxy);

        $collection->setHttpProxy($http_proxy);

        $this->assertTrue($collection->getProxy(ProxyScheme::FTP()) instanceof FtpProxy);
        $this->assertTrue($collection->getProxy(ProxyScheme::HTTP()) instanceof HttpProxy);
        $this->assertTrue($collection->getProxy(ProxyScheme::HTTPS()) instanceof SocksProxy);

        $collection->setHttpsProxy($https_proxy);

        $this->assertTrue($collection->getProxy(ProxyScheme::FTP()) instanceof FtpProxy);
        $this->assertTrue($collection->getProxy(ProxyScheme::HTTP()) instanceof HttpProxy);
        $this->assertTrue($collection->getProxy(ProxyScheme::HTTPS()) instanceof HttpProxy);

        $this->assertEquals('http', $collection->getProxy(ProxyScheme::HTTP())->getHostname());
        $this->assertEquals('https', $collection->getProxy(ProxyScheme::HTTPS())->getHostname());

    }

}
 