<?php

namespace juliocapuano\SimpleAntiSpam;

use Exception;

class ValidateTextTest extends \PHPUnit\Framework\TestCase
{

    private $valid_text    = 'Hi, I wanted to inquire about getting a residentia';
    private $no_valid_text = 'url in text http://google.com';
    private $spam_text_list
                           = [
            'url in text http://google.com',
        ];


    /**
     * @test
     */
    public function checkValidText()
    {
        $result = SimpleAntiSpam::isUrlInText($this->valid_text);
        $this->assertFalse($result);

        $result = SimpleAntiSpam::isUrlInText($this->no_valid_text);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function checkTextInBlackList()
    {

        foreach ($this->spam_text_list as $spam_text) {
            $result = SimpleAntiSpam::isUrlInText($spam_text);
            $this->assertTrue($result);
        }
    }
}
