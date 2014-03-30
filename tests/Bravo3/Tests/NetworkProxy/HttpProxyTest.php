<?php
namespace Bravo3\Tests\NetworkProxy;

use Bravo3\NetworkProxy\Implementation\HttpProxy;

class HttpProxyTest extends \PHPUnit_Framework_TestCase {

    /**
     * @small
     */
    public function testProperties()
    {
        $http = new HttpProxy('localhost', '8080');
        $this->assertEquals($http->getHostname(), 'localhost');
        $this->assertSame($http->getPort(), 8080);  // should have converted port to int

        $http->setHostname('127.0.0.1');
        $http->setPort(8010);
        $http->setUsername('username');
        $http->setPassword('password');

        $this->assertEquals($http->getHostname(), '127.0.0.1');
        $this->assertSame($http->getPort(), 8010);
        $this->assertEquals($http->getUsername(), 'username');
        $this->assertEquals($http->getPassword(), 'password');

    }

}
 