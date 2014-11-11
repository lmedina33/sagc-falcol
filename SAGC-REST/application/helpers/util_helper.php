<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function sprintfn ($format, array $args = array()) {
    // map of argument names to their corresponding sprintf numeric argument value
    $arg_nums = array_slice(array_flip(array_keys(array(0 => 0) + $args)), 1);

    // find the next named argument. each search starts at the end of the previous replacement.
    for ($pos = 0; preg_match('/(?<=%)([a-zA-Z_]\w*)(?=\$)/', $format, $match, PREG_OFFSET_CAPTURE, $pos);) {
        $arg_pos = $match[0][1];
        $arg_len = strlen($match[0][0]);
        $arg_key = $match[1][0];

        // programmer did not supply a value for the named argument found in the format string
        if (! array_key_exists($arg_key, $arg_nums)) {
            user_error("sprintfn(): Missing argument '${arg_key}'", E_USER_WARNING);
            return false;
        }

        // replace the named argument with the corresponding numeric one
        $format = substr_replace($format, $replace = $arg_nums[$arg_key], $arg_pos, $arg_len);
        $pos = $arg_pos + strlen($replace); // skip to end of replacement for next iteration
    }

    return vsprintf($format, array_values($args));
}

function arquivosNomesIguais($fileName, $index) {
    $uploadDir = getcwd() . '\uploads\licencas';
    $name = strstr($fileName, '.', true);
    $extension = substr($fileName, -3);
    $modifiedFileName = $name . ' (' . $index . ').' . $extension;
    $targetFile = rtrim($uploadDir) . "\\" . $modifiedFileName;
    if (file_exists($targetFile)) {
        $index++;
        return arquivosNomesIguais($fileName, $index);
    } else {
        return $modifiedFileName;
    }
}

function dadosContrutivosETE() {
    $dadosContrutivos = array("estacaoElevatoriaEfluentes" => array(), "tanqueEqualizacao" => array(),
        "aeracao" => array(), "bombas" => array(),
        "decantadorSecundario" => array());

    $dadosContrutivos["estacaoElevatoriaEfluentes"]["ladoUtil"] = 3.6;
    $dadosContrutivos["estacaoElevatoriaEfluentes"]["comprimentoUtil"] = 6;
    $dadosContrutivos["estacaoElevatoriaEfluentes"]["alturaUtil"] = 3;
    $dadosContrutivos["estacaoElevatoriaEfluentes"]["alturaTotal"] = 6.9;
    $dadosContrutivos["estacaoElevatoriaEfluentes"]["volumeUtil"] = 64.8;

    $dadosContrutivos["tanqueEqualizacao"]["larguraUtil"] = 7.65;
    $dadosContrutivos["tanqueEqualizacao"]["comprimentoUtil"] = 15.3;
    $dadosContrutivos["tanqueEqualizacao"]["alturaUtil"] = 5.7;
    $dadosContrutivos["tanqueEqualizacao"]["alturaMorta"] = 0.3;
    $dadosContrutivos["tanqueEqualizacao"]["bordaLivre"] = 0.5;
    $dadosContrutivos["tanqueEqualizacao"]["alturaTotal"] = 6.5;
    $dadosContrutivos["tanqueEqualizacao"]["volumeUtilEqualizacao"] = 667.16;
    $dadosContrutivos["tanqueEqualizacao"]["volumeMorto"] = 35.11;
    $dadosContrutivos["tanqueEqualizacao"]["volumeHomogeneizacao"] = 35.11;
    $dadosContrutivos["tanqueEqualizacao"]["tempoResidencia"] = 11.12;

    $dadosContrutivos["aeracao"]["larguraUtil"] = 13.85;
    $dadosContrutivos["aeracao"]["comprimentoUtil"] = 27.7;
    $dadosContrutivos["aeracao"]["alturaUtil"] = 6;
    $dadosContrutivos["aeracao"]["bordaLivre"] = 0.5;
    $dadosContrutivos["aeracao"]["alturaTotal"] = 6.5;
    $dadosContrutivos["aeracao"]["volumeUtil"] = 2301.87;
    $dadosContrutivos["aeracao"]["numeroCelulas"] = 2;
    $dadosContrutivos["aeracao"]["volumeUtilTotal"] = 4603.74;
    $dadosContrutivos["aeracao"]["volumeCelula"] = 2301.87;
    $dadosContrutivos["aeracao"]["coeficienteGeracaoLodo"] = 0.65;

    $dadosContrutivos["bombas"]["tipo"] = "Centrígura de rotor aberto";
    $dadosContrutivos["bombas"]["identificacao"] = "BEL-001 A/B/C";
    $dadosContrutivos["bombas"]["vazao"] = "155,52 m3/h";
    $dadosContrutivos["bombas"]["alturaManometrica"] = "15 mca";
    $dadosContrutivos["bombas"]["unidades"] = "3 Unidades";

    $dadosContrutivos["decantadorSecundario"]["vazaoProjeto"] = 60;
    $dadosContrutivos["decantadorSecundario"]["diametro"] = 9.5;
    $dadosContrutivos["decantadorSecundario"]["alturaReta"] = 3;
    $dadosContrutivos["decantadorSecundario"]["areaUtil"] = 70.88;
    $dadosContrutivos["decantadorSecundario"]["volumeUtil"] = 212.65;

    return $dadosContrutivos;
}

function sanitizeString($string) {
    // matriz de entrada
    $what = array('ä', 'ã', 'à', 'á', 'â', 'ê', 'ë', 'è', 'é', 'ï', 'ì', 'í', 'ö', 'õ', 'ò', 'ó', 'ô', 'ü', 'ù', 'ú', 'û', 'À', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ', 'ç', 'Ç', ' ', '-', '(', ')', ',', ';', ':', '|', '!', '"', '#', '$', '%', '&', '/', '=', '?', '~', '^', '>', '<', 'ª', 'º');

    // matriz de saída
    $by = array('a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'A', 'A', 'E', 'I', 'O', 'U', 'n', 'n', 'c', 'C', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_');

    // devolver a string
    return str_replace($what, $by, $string);
}

function startsWith($haystack, $needle) {
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

function dataStrToObject($dataHora) {
    $dataHora = \trim($dataHora);

    if (empty($dataHora)) {
        return "";
    } else {
        list($dia, $mes, $ano) = explode("/", $dataHora);
        $dataFormatada = $ano . '-' . $mes . '-' . $dia;

        if (strlen($dataHora) > 10) { //Data com hora
            list($ano, $hora) = explode(" ", $ano);
            $dataFormatada = $ano . '-' . $mes . '-' . $dia . ' ' . $hora;
        }

        try {
            return new \DateTime($dataFormatada);
        } catch (\Exception $ex) {
            throw new \Exception("A data \"$dataHora\" é inválida.");
        }
    }
}

function dataStrToBanco($dataHora) {
    $dataHora = \trim($dataHora);

    if (empty($dataHora)) {
        return "";
    } else {
        list($dia, $mes, $ano) = explode("/", $dataHora);
        $dataFormatada = $ano . '-' . $mes . '-' . $dia;

        if (strlen($dataHora) > 10) { //Data com hora
            list($ano, $hora) = explode(" ", $ano);
            $dataFormatada = $ano . '-' . $mes . '-' . $dia . ' ' . $hora;
        }

        return $dataFormatada;
    }
}

function dataBancoToStr($dataHora) {
    $dataHora = \trim($dataHora);

    if (empty($dataHora)) {
        return "";
    } else {
        list($ano, $mes, $dia) = explode("-", $dataHora);
        $dataFormatada = $dia . '/' . $mes . '/' . $ano;

        if (strlen($dataHora) > 10) { //Data com hora
            list($dia, $hora) = explode(" ", $dia);
            $dataFormatada = $dia . '/' . $mes . '/' . $ano . ' ' . $hora;
        }

        return $dataFormatada;
    }
}

function dataObjectToStr(DateTime $dateTime, $comHora = false) {
    $strDate = $dateTime->format("d/m/Y");
    if ($comHora) {
        $strDate .= $dateTime->format(" H:i:s");
    }

    return $strDate;
}

function array_orderby() {
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = strtoupper($row[$field]);
            $args[$n] = $tmp;
        }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

function mesNumeroParaNome($numero, $curto = false) {
    switch ($numero) {
        case "01": case "1": return $curto ? "Jan" : "Janeiro";
        case "02": case "2": return $curto ? "Fev" : "Fevereiro";
        case "03": case "3": return $curto ? "Mar" : "Março";
        case "04": case "4": return $curto ? "Abr" : "Abril";
        case "05": case "5": return $curto ? "Mai" : "Maio";
        case "06": case "6": return $curto ? "Jun" : "Junho";
        case "07": case "7": return $curto ? "Jul" : "Julho";
        case "08": case "8": return $curto ? "Ago" : "Agosto";
        case "09": case "9": return $curto ? "Set" : "Setembro";
        case "10": return $curto ? "Out" : "Outubro";
        case "11": return $curto ? "Nov" : "Novembro";
        case "12": return $curto ? "Dez" : "Dezembro";
    }
}

function buscaQuantText($lista) {
    $quant = count($lista);
    if ($quant == 0) {
        return "Não foi encontrado nenhum resultado para esta consulta.";
    } elseif ($quant == 1) {
        return "Foi encontrado um resultado para esta consulta.";
    } else {
        return "Foram encontrados " . $quant . " resultados para esta consulta.";
    }
}

function validaCPF($cpf = null) {

    // Verifica se um número foi informado
    if (empty($cpf)) {
        return false;
    }

    // Elimina possivel mascara
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    // Verifica se o numero de digitos informados é igual a 11 
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se nenhuma das sequências invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
        return false;
        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
    } else {
        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }

        return true;
    }
}

function dataStrObject($dataHora) {
    $dataHora = trim($dataHora);

    if (empty($dataHora)) {
        return "";
    } else {
        list($dia, $mes, $ano) = explode("/", $dataHora);
        $dataFormatada = $ano . '-' . $mes . '-' . $dia;

        if (strlen($dataHora) > 10) { //Data com hora
            list($ano, $hora) = explode(" ", $ano);
            $dataFormatada = $ano . '-' . $mes . '-' . $dia . ' ' . $hora;
        }

        try {
            return new DateTime($dataFormatada);
        } catch (Exception $ex) {
            throw new Exception("A data \"$dataHora\" é inválida.");
        }
    }
}

?>
