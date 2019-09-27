<?php

namespace Tests\NFePHP\MDFe;

/**
 * @author Roberto L. Machado <linux.rlm at gmail dot com>
 */
use NFePHP\MDFe\Tools;
use NFePHP\Common\Certificate;
use PHPUnit\Framework\TestCase;
use NFePHP\Common\Exception\InvalidArgumentException;

class ToolsTest extends TestCase
{

    protected $fixturesPath;


    protected function setUp()
    {
        $this->fixturesPath = __DIR__ . "/fixtures/";
    }

    public function testInstanciar()
    {
        $configJson = $this->fixturesPath . 'config/fakeconfig.json';
        $certPath = $this->fixturesPath . 'certs/expired_certificate.pfx';

        $cert = Certificate::readPfx(
            file_get_contents($certPath),
            'associacao'
        );

        $mdfe = new Tools(
            file_get_contents($configJson), 
            $cert
        );
    }
}
