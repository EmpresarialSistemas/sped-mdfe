<?php

namespace Tests\NFePHP\MDFe\Auxiliar;

/**
 * @author Roberto L. Machado <linux.rlm at gmail dot com>
 */
use PHPUnit\Framework\TestCase;
use NFePHP\MDFe\Auxiliar\Response;

class ResponseTest extends TestCase
{
    public $mdfe;

    public function testInstanciar()
    {
        $this->mdfe = new Response();
    }
}
