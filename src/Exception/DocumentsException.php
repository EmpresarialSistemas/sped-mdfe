<?php

namespace NFePHP\MDFe\Exception;

/**
 * @author     Cleiton Perin <cperin20 at gmail dot com>
 * @package    NFePHP\MDFe\Exception
 * @copyright  Copyright (c) 2008-2019
 * @license    http://www.gnu.org/licenses/lesser.html LGPL v3
 * @category   NFePHP
 * @link       http://github.com/nfephp-org/sped-common for the canonical source repository
 */
class DocumentsException extends \InvalidArgumentException implements ExceptionInterface
{
    public static $list = [
        0 => "Este documento [{{msg}}] não recebe protocolos. Confira a ordem dos parâmetros.",
        1 => "O arquivo indicado como MDFe não está protocolado ou não é um MDFe!!",
        2 => "O arquivo indicado como B2B não contêm a tagB2B indicada!!",
        3 => "O documento de resposta não contêm o NODE {{msg}}.",
        4 => "O documento de resposta relata um erro {{msg}}.",
        5 => "Os documentos se referem a diferentes objetos. {{msg}}.",
        6 => "O argumento passado não é um XML válido.",
        7 => "Este xml não pertence ao projeto SPED-MDFe.",
        8 => "A configuração (config.json) não é válido {{msg}}.",
        9 => "Falta o CSC no config.json.",
        10 => "Falta o CSCId no config.json.",
        11 => "Falta a URL do serviço NfeConsultaQR.",
        12 => "O TXT não representa uma MDFe",
        13 => "O numero de notas indicado na primeira linha do TXT é diferente do numero total de notas do txt.",
        14 => "Falha na validação do TXT:\n {{msg}}.",
        15 => "Um TXT de MDFe deve ser passado como parâmetro, e nada foi passado.",
        16 => "O txt tem um campo não definido {{msg}}"
    ];

    public static function wrongDocument($code, $msg = '')
    {
        $msg = self::replaceMsg(self::$list[$code], $msg);
        return new static($msg);
    }
    private static function replaceMsg($input, $msg)
    {
        return str_replace('{{msg}}', $msg, $input);
    }
}
