<?php

namespace Tests\NFePHP\MDFe\Auxiliar;

/**
 * @author Roberto L. Machado <linux.rlm at gmail dot com>
 */


use PHPUnit\Framework\TestCase;
use NFePHP\MDFe\Auxiliar\Identify;

class IdentifyTest extends TestCase
{
    public function testIdentificaMdfe()
    {
        $aResp = array();
        $filePath = $this->xml . 'MDFe41140581452880000139580010000000281611743166.xml';
        $schem = Identify::identificar($filePath, $aResp);
        $this->assertEquals($schem, 'mdfe');
    }
}
