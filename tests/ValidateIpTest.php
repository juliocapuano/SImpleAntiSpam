<?php

namespace juliocapuano\SimpleAntiSpam;

use Exception;

class ValidateIpTest extends \PHPUnit\Framework\TestCase
{

    private $valid_ip    = '107.180.104.65';
    private $no_valid_ip = '400.88.200.8';
    private $spam_ip_list
                         = [
            '217.197.244.134',
            '213.5.20.132',
            '45.64.122.210',
            '91.233.239.127'
        ];

    private $no_spam_email = 'example@mail.com';

    /**
     * @test
     * @throws Exception
     */
    public function checkValidIp()
    {

        $result = SimpleAntiSpam::isSpamIp($this->valid_ip);
        $this->assertFalse($result);

        $result = SimpleAntiSpam::isSpamIp($this->no_valid_ip);
        $this->assertTrue($result);
    }

    /**
     * @test
     * @throws Exception
     */
    public function checkIpInBlackList()
    {
        //        $result = SimpleAntiSpam::isSpamIp('noreply@heamyk.com');
        //        $this->assertTrue($result);

        foreach ($this->spam_ip_list as $spam_ip) {
            $result = SimpleAntiSpam::isSpamIp($spam_ip);
            $this->assertTrue($result);
        }
    }
}
