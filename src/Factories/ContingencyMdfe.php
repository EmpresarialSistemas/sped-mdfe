<?php
namespace NFePHP\NFe\Factories;

use NFePHP\Common\Strings;
use NFePHP\MDFe\Factories\Contingency;
use NFePHP\Common\Signer;
use NFePHP\Common\Keys;
use NFePHP\Common\UFList;
use DateTime;

class ContingencyMdfe
{
    /**
     * Corret MDFe fields when in contingency mode
     * @param string $xml NFe xml content
     * @return string
     */
    public static function adjust($xml, Contingency $contingency)
    {
        if ($contingency->type == '') {
            return $xml;
        }
        $xml = Signer::removeSignature($xml);
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = false;
        $dom->loadXML($xml);
        
        $ide = $dom->getElementsByTagName('ide')->item(0);
        $cUF = $ide->getElementsByTagName('cUF')->item(0)->nodeValue;
        $cNF = $ide->getElementsByTagName('cMDF')->item(0)->nodeValue;
        $nNF = $ide->getElementsByTagName('nMDF')->item(0)->nodeValue;
        $serie = $ide->getElementsByTagName('serie')->item(0)->nodeValue;
        $mod = $ide->getElementsByTagName('mod')->item(0)->nodeValue;
        $dtEmi = new DateTime($ide->getElementsByTagName('dhEmi')->item(0)->nodeValue);
        $ano = $dtEmi->format('y');
        $mes = $dtEmi->format('m');
        $tpEmis = (string) $contingency->tpEmis;
        $emit = $dom->getElementsByTagName('emit')->item(0);
        $cnpj = $emit->getElementsByTagName('CNPJ')->item(0)->nodeValue;
        
        $motivo = trim(Strings::replaceSpecialsChars($contingency->motive));
        $dt = new DateTime();
        $dt->setTimestamp($contingency->timestamp);
        $ide->getElementsByTagName('tpEmis')
            ->item(0)
            ->nodeValue = $contingency->tpEmis;

        //corrigir a chave
        $infMDFe = $dom->getElementsByTagName('infMDFe')->item(0);
        $chave = Keys::build(
            $cUF,
            $ano,
            $mes,
            $cnpj,
            $mod,
            $serie,
            $nNF,
            $tpEmis,
            $cNF
        );
        $ide->getElementsByTagName('cDV')->item(0)->nodeValue = substr($chave, -1);
        $infMDFe->setAttribute('Id', 'MDFe'.$chave);
        return Strings::clearXmlString($dom->saveXML(), true);
    }
}