<?php
namespace Idsy\Tools;

class Create {
    public static function sql(string $manager, $fields, $from, $where, $orderBy, $lines): string
    {
        $sql = '';
        $resultLines = '';

        if ($where != '') {
            $where = ' where ' . $where;
        }

        if ($manager == 'mysql') {
            if (($lines <> '') and ($lines <> '0')) {
                $resultLines = ' limit ' . $lines;
            }

            $sql =
                ' select ' . $fields .
                ' from ' . $from .
                $where .
                $orderBy .
                $resultLines;
        } else
            if ($manager == 'firebird') {
            if (($lines <> '') and ($lines <> '0')) {
                $resultLines = ' first ' . $lines;
            }

            $sql =
                ' select ' . $resultLines . $fields .
                ' from ' . $from .
                $where .
                $orderBy;
        } else
            if ($manager == 'sqlserver') {
            if (($lines <> '') and ($lines <> '0')) {
                $resultLines = ' top ' . $lines;
            }

            $sql =
                ' select ' . $resultLines . $fields .
                ' from ' . $from .
                $where .
                $orderBy;
        } else
            if ($manager == 'oracle') {
            if (($lines <> '') and ($lines <> '0')) {
                $resultLines = ' rowcount ' . $lines;
            }

            $sql =
                ' select ' . $fields .
                ' from ' . $from .
                $where .
                $orderBy .
                $resultLines;
        } else {
            throw new \Exception('Tools::createSQL(Banco de dados não suportado)');
        }
        return $sql;
    }   

    /**
     * Gerar o txid.     * 
     *
     * @param string $value
     * @return string
     */
    public static function txid(string $sigla, int $sequencia): string
    {
        $tamanho = 33;
        $tamanho = $tamanho - strlen($sigla);
        return $sigla . str_pad($sequencia, $tamanho, '0', STR_PAD_LEFT);
    }    

    public static function log($path, $name, $message)
    {
        $fp = fopen($path . $name . '.log', "a+");
        fwrite($fp, date('d/m/Y H:i:s'));
        fwrite($fp, 'Result: ' . $message);
        fwrite($fp, "\n");
        fwrite($fp, '-----------------------------------');
        fwrite($fp, "\n");
        fclose($fp);
    }    
}