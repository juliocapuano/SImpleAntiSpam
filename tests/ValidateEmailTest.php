<?php

namespace juliocapuano\SimpleAntiSpam;

use Exception;

class ValidateEmailTest extends \PHPUnit\Framework\TestCase
{

    private $valid_email    = 'example@mail.com';
    private $no_valid_email = 'example.mail.com';
    private $spam_email_list
                            = [
            'gedgskt@4serial.com',
            'baluchor744@gmail.com',
            'yourmail@mail.com',
            'fgdghhgh@pop.com'
        ];

    private $no_spam_email = 'example@mail.com';

    /**
     * @test
     * @throws Exception
     */
    public function checkValidEmail()
    {
        $result = SimpleAntiSpam::isSpamEmail($this->valid_email);
        $this->assertFalse($result);

        $result = SimpleAntiSpam::isSpamEmail($this->no_valid_email);
        $this->assertTrue($result);
    }

    /**
     * @test
     * @throws Exception
     */
    public function checkEmailInBlackList()
    {
        //        $result = SimpleAntiSpam::isSpamEmail('noreply@heamyk.com');
        //        $this->assertTrue($result);

        foreach ($this->spam_email_list as $spam_mail) {
            $result = SimpleAntiSpam::isSpamEmail($spam_mail);
            $this->assertTrue($result);
        }
    }
}
