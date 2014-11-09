<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function ValidaNis($nis) {
    $multiplicador = Array(3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
    $soma;
    $resto;
    if (strlen(trim($nis)) == 0)
        return false;
    $nis = trim($nis);
    $nis = str_pad(str_replace(Array('-', '.'), Array('', ''), $nis), 11, "0", STR_PAD_LEFT);
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += intval(strval($nis[$i])) * $multiplicador[$i];
    }
    $resto = $soma % 11;
    if ($resto < 2) {
        $resto = 0;
    } else {
        $resto = 11 - $resto;
    }
    return endsWith($nis, strval($resto));
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

function replaceFormatJsonValue($array, $replace) {
    $self = Array();
    $obj = false;
    foreach ($array as $key => $element) {
        if (is_array($element)) {
            if (isset($replace[isset($element['cod']) ? $element['cod'] : 'unknown'])) {
                $element['cod'] = $replace[$element['cod']];
            }
            if (isset($replace[isset($element[0]) ? $element[0] : 'unknown'])) {
                $element[0] = $replace[$element[0]];
            }
            $self[] = $element;
        } else {
            $obj = true;
            if (isset($replace[$key])) {
                $self[$replace[$key]] = $element;
            } else {
                $self[$key] = $element;
            }
        }
    }
    if ($obj) {
        return (object) $self;
    } else {
        return $self;
    }
}

function formatJsonGrafico($array, $replace = null) {
    if (!is_null($replace)) {
        $array = replaceFormatJsonValue($array, $replace);
    }
    if (is_array($array) && isset($array[0]) && is_array($array[0])) {
        return strtoupper(preg_replace(Array("/\"[A-Za-z0-9\ ]+\":/", "/\"([0-9]+)\"}/", '/\{/'), Array('', '\1]', '['), json_encode($array))); // [{"bairro":"bairro","quant":"1"},{"bairro":"CENTRO","quant":"1"},{"bairro":"MATRIZ","quant":"2"}]
    }
    foreach ($array as $teste) {
        if (isset($teste[0]['quant'])) {
            return strtoupper(preg_replace(Array('/:\[\{\"quant\":\"([0-9]+)\"\}/', '/\{/', '/\}/', '/,\"/', '/([a-z])([A-Z])/'), Array(', \1', '[[', ']', ', ["', '\1 \2'), json_encode($array))); // {"bolsaFamilia":[{"quant":"2"}],"bpc":[{"quant":"2"}],"peti":[{"quant":"2"}]}
        }
        break;
    }
    $self = '[';
    foreach ($array as $key => $elemento) {
        $self.='["' . $key . '", ' . $elemento . '], ';
    }
    $self = substr($self, 0, strlen($self) - 2) . ']';
    return strtoupper($self); // {"TRABALHO INFANTIL":1,"TESTE":1}
    //Return [["NOME",10],["NOME2",20],["<Nome>",<Quantidade>]]
}

//function startsWith($haystack, $needle) {
//    $length = strlen($needle);
//    return (substr($haystack, 0, $length) === $needle);
//}
//
function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

function valorStrBanco($valor) {
    return doubleval(str_replace(array('.', ','), array('', '.'), $valor));
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

function diaSemanaNumeroParaNome($numero) {
    switch ($numero) {
        case "0": return "Domingo";
        case "1": return "Segunda-Feira";
        case "2": return "Terça-Feira";
        case "3": return "Quarta-Feira";
        case "4": return "Quinta-Feira";
        case "5": return "Sexta-Feira";
        case "6": return "Sábado";
    }
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

function dataObjectToStr(DateTime $dateTime, $comHora = false) {
    $strDate = $dateTime->format("d/m/Y");
    if ($comHora) {
        $strDate .= $dateTime->format(" H:i:s");
    }

    return $strDate;
}

function isCnpjValid($cnpj) {
    //Etapa 1: Cria um array com apenas os digitos numéricos, isso permite receber o cnpj em diferentes formatos como "00.000.000/0000-00", "00000000000000", "00 000 000 0000 00" etc...
    $j = 0;
    for ($i = 0; $i < (strlen($cnpj)); $i++) {
        if (is_numeric($cnpj[$i])) {
            $num[$j] = $cnpj[$i];
            $j++;
        }
    }
    //Etapa 2: Conta os dígitos, um Cnpj válido possui 14 dígitos numéricos.
    if (count($num) != 14) {
        $isCnpjValid = false;
    }
    //Etapa 3: O número 00000000000 embora não seja um cnpj real resultaria um cnpj válido após o calculo dos dígitos verificares e por isso precisa ser filtradas nesta etapa.
    if ($num[0] == 0 && $num[1] == 0 && $num[2] == 0 && $num[3] == 0 && $num[4] == 0 && $num[5] == 0 && $num[6] == 0 && $num[7] == 0 && $num[8] == 0 && $num[9] == 0 && $num[10] == 0 && $num[11] == 0) {
        $isCnpjValid = false;
    }
    //Etapa 4: Calcula e compara o primeiro dígito verificador.
    else {
        $j = 5;
        for ($i = 0; $i < 4; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $j = 9;
        for ($i = 4; $i < 12; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        if ($resto < 2) {
            $dg = 0;
        } else {
            $dg = 11 - $resto;
        }
        if ($dg != $num[12]) {
            $isCnpjValid = false;
        }
    }
    //Etapa 5: Calcula e compara o segundo dígito verificador.
    if (!isset($isCnpjValid)) {
        $j = 6;
        for ($i = 0; $i < 5; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $j = 9;
        for ($i = 5; $i < 13; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        if ($resto < 2) {
            $dg = 0;
        } else {
            $dg = 11 - $resto;
        }
        if ($dg != $num[13]) {
            $isCnpjValid = false;
        } else {
            $isCnpjValid = true;
        }
    }
    //Trecho usado para depurar erros.
    /*
      if($isCnpjValid==true)
      {
      echo "<p><font color=\"GREEN\">Cnpj é Válido</font></p>";
      }
      if($isCnpjValid==false)
      {
      echo "<p><font color=\"RED\">Cnpj Inválido</font></p>";
      }
     */
    //Etapa 6: Retorna o Resultado em um valor booleano.
    return $isCnpjValid;
}

function formaAcessoPrimeiroAtendimento($codigo) {
    $formaAcessoPrimeiroAtendimento = array(1 => 'Por demanda espontânea',
        2 => 'Em decorrência de Busca Ativa realizada pela equipe da unidade',
        3 => 'Em decorrência de encaminhamento realizado por outros serviços/unidades da Proteção Social Básica',
        4 => 'Em decorrência de encaminhamento realizado por outros serviços/unidades da Proteção Social Especial',
        5 => 'Em decorrência de encaminhamento realizado pela área de Saúde',
        6 => 'Em decorrência de encaminhamento realizado pela área de Educação',
        7 => 'Em decorrência de encaminhamento realizado outras políticas setoriais',
        8 => 'Em decorrência de encaminhamento realizado pelo Conselho Tutelar',
        9 => 'Em decorrência de encaminhamento realizado pelo Poder Judiciário',
        10 => 'Em decorrência de encaminhamento realizado pelo Sistema de Garantia de Direitos(Defensoria Pública, Ministério Público, Delegacias)',
        99 => 'Outros encaminhamentos');

    return array_key_exists($codigo, $formaAcessoPrimeiroAtendimento) ? $formaAcessoPrimeiroAtendimento[$codigo] : '';
}

function escolaridade($codigoEscolaridade) {
    $escolaridades = array("00" => "Nunca frequentou escola",
        "01" => "Creche", "02" => "Educação Infantil", "11" => "1º ano E. Fundamental",
        "12" => "2º ano E. Fundamental", "13" => "3º ano E. Fundamental", "14" => "4º ano E. Fundamental",
        "15" => "5º ano E. Fundamental", "16" => "6º ano E. Fundamental", "17" => "7º ano E. Fundamental",
        "18" => "8º ano E. Fundamental", "19" => "9º ano E. Fundamental", "21" => "1º ano E.Médio",
        "22" => "2º ano E.Médio", "23" => "3º ano E.Médio", "30" => "Superior Incompleto", "31" => "Superior Completo",
        "40" => "EJA - Ensino Fundamental", "41" => "EJA - Ensino Médio", "99" => "Outros");

    return array_key_exists($codigoEscolaridade, $escolaridades) ? $escolaridades[$codigoEscolaridade] : '';
}

function listaEfeitoDescumprimentoBolsaFamilia() {
    return array(0 => "Advertência",
        1 => "Bloqueio",
        2 => "Suspensão",
        3 => "Cancelamento");
}

function efeitoDescumprimentoBolsaFamilia($codigoEfeito) {
    if (is_null($codigoEfeito)) {
        return "";
    } else {
        $arrayDescumprimentoBolsaFamilia = listaEfeitoDescumprimentoBolsaFamilia();
        return $arrayDescumprimentoBolsaFamilia[$codigoEfeito];
    }
}

function listaTipoMedidasSocioeducativas() {
    return array(
        1 => "Liberdade Assistida (LA)",
        2 => "Prestação de Serviços à Comunidade (PSC)",
        3 => "Advertência",
        4 => "Obrigação de Reparar o Dano",
        5 => "Semi-Liberdade",
        6 => "Internação");
}

function tipoMedidasSocioeducativas($codigoMedida) {
    if (empty($codigoMedida)) {
        return "";
    } else {
        $arrayTipoMedidasSocioeducativas = listaTipoMedidasSocioeducativas();
        return $arrayTipoMedidasSocioeducativas[$codigoMedida];
    }
}

function servicoProgramaProjeto($codigo) {
    $servicoProgramaProjeto = array(1 => 'Serviço de Convivência e Fortalecimento de Vínculos para Crianças e/ou Adolescentes',
        2 => 'Serviço de Convivência e Fortalecimento de Vínculos para Idosos',
        3 => 'Grupo específico desenvovido pelo PAIF',
        4 => 'Grupo específico desenvovido pelo PAIFI',
        5 => 'Programas ou projetos específicos da Assistência Social que não configurem serviços continuados',
        6 => 'Programas ou projetos de outras políticas setoriais(Educação,Esporte,Cultura, etc)',
        99 => 'Outros');

    return array_key_exists($codigo, $servicoProgramaProjeto) ? $servicoProgramaProjeto[$codigo] : '';
}

function codigoDescricaoSumariaAtendimento($codigo) {
    $descricaoSumariaAtendimento = array(1 => 'Atendimento socioassistencial individualizado',
        2 => 'Atendimento em atividade coletiva de caráter continuado',
        3 => 'Participação em atividade coletiva de caráter não continuado',
        4 => 'Cadastramento/Atualização Cadastral',
        5 => 'Acompanhamento de MSE',
        6 => 'Solicitação/Concessão de Benefício Eventual',
        7 => 'Visita Domiciliar',
        99 => 'Outros');

    return array_key_exists($codigo, $descricaoSumariaAtendimento) ? $descricaoSumariaAtendimento[$codigo] : '';
}

function unidadeRealizacaoServicoProgramaProjeto($codigo) {
    $unidadeRealizacaoServicoProgramaProjeto = array(1 => 'Nesta própia unidade',
        2 => 'Em outra unidade pública da rede socioassistencial',
        3 => 'Em unidade/entidade privada da rede socioassitencial',
        4 => 'Em unidade de rede de educação',
        9 => 'Outra unidade vinculada a outras políticas');

    return array_key_exists($codigo, $unidadeRealizacaoServicoProgramaProjeto) ? $unidadeRealizacaoServicoProgramaProjeto[$codigo] : '';
}

function parentescoPessoaReferencia($codigo) {
    $parentescoPessoaReferencia = array(
        1 => 'Pessoa de Referência',
        2 => 'Cônjuge/companheiro(a)',
        3 => 'Filho(a)',
        4 => 'Enteado(a)',
        5 => 'Neto(a), Bisneto(a)',
        6 => 'Pai/Mãe',
        7 => 'Sogro(a)',
        8 => 'Irmão/Irmã',
        9 => 'Genro/Nora',
        10 => 'Outro parente',
        11 => 'Não parente'
    );

    return (isset($parentescoPessoaReferencia[$codigo])) ? $parentescoPessoaReferencia[$codigo] : 'Parentesco Invalido';
}

function especificidadesSociaisEtnicasCulturais($codigo) {
    $especificidadesSociaisEtnicasCulturais = array(1 => 'Família/pessoa em situação de rua',
        2 => 'Família quilombola',
        3 => 'Família ribeirinha',
        4 => 'Família cigana',
        5 => 'Família indigéna residente em aldeia/reserva',
        6 => 'Família indígena não residente em aldeia/reserva',
        99 => 'Outras');

    return array_key_exists($codigo, $especificidadesSociaisEtnicasCulturais) ? $especificidadesSociaisEtnicasCulturais[$codigo] : '';
}

function condicaoOcupacao($valor) {
    $arrayCondicaoOcupacao = array(0 => "Não Trabalha",
        1 => "Trabalha por conta própria(bico, autônomo)",
        2 => "Trabalhor temporário em área rural",
        3 => "Empregado sem carteira de trabalho assinada",
        4 => "Empregado com carteira de trabalho assinada",
        5 => "Trabalhador doméstico sem carteira de trabalho assinada",
        6 => "Trabalhador doméstico com carteira de trabalho assinada",
        7 => "Trabalhador não-remunerado",
        8 => "Militar ou servidor público",
        9 => "Empregador",
        10 => "Estagiário",
        11 => "Aprendiz(em condição legal)");
    return array_key_exists($valor, $arrayCondicaoOcupacao) ? $arrayCondicaoOcupacao[$valor] : '';
}

function listaEncaminhamentos() {
    return array(
        5 => "Para Serviços de Convivência e Fortalecimento de Vínculos voltados a crianças e adolescentes (inclusive PETI e Projovem)",
        6 => "Para Serviços de Convivência e Fortalecimento de Vínculos voltados para idosos",
        7 => "Para atualização cadastral no CADÚNICO (inclusive quando realizada no próprio CRAS)",
        8 => "Para inclusão no CADÚNICO (inclusive quando realizada no próprio CRAS)",
        9 => "Para o INSS, visando acesso ao BPC",
        10 => "Para o INSS visando acesso a outros direitos, que não o BPC",
        11 => "Para acesso a Benefícios Eventuais",
        12 => "Para acesso a Documentação Civil (Certidão de Nascimento, RG, Carteira de Trabalho etc)",
        13 => "Encaminhamento do CRAS para o CREAS (marcação exclusiva para CRAS)",
        14 => "Encaminhamento do CREAS para o CRAS (marcação exclusiva para CREAS)",
        15 => "Encaminhamento para outras unidades/serviços de Proteção Social Especial",
        30 => "Para Serviços de Saúde Bucal (por exemplo: Brasil Sorridente)",
        31 => "Para Serviços de Saúde Mental",
        32 => "Para Serviços de Saúde voltados ao acesso de órteses e próteses para pessoas com deficiência",
        33 => "Para Unidades de Saúde da Família",
        34 => "Para outros serviços ou unidades do Sistema de Único de Saúde",
        40 => "Para Educação - Creche e Pré-escola (ensino infantil)",
        41 => "Para Educação - Rede regular de ensino (ensino fundamental e ensino médio)",
        42 => "Para Educação de Jovens de Adultos (por exemplo: Brasil Alfabetizado)",
        50 => "Para Serviços, Programas ou Projetos voltados à capacitação profissional",
        51 => "Para Serviços, Programas ou Projetos voltados à geração de trabalho e renda",
        52 => "Para Serviços, Programas ou Projetos voltados à intermediação de mão-de-obra",
        53 => "Para acesso a microcrédito",
        60 => "Para Programas da área de Habitação",
        61 => "Para acesso à Tarifa Social de Energia Elétrica",
        70 => "Para Conselho Tutelar",
        71 => "Para Poder Judiciário",
        72 => "Para Ministério Público",
        73 => "Para Defensoria Pública",
        74 => "Para Delegacias (especializadas, ou não).",
        85 => "Outras ações/encaminhamentos (código livre, a ser utilizado conforme interesse específico de cada município)",
        86 => "Outras ações/encaminhamentos (código livre, a ser utilizado conforme interesse específico de cada município)",
        87 => "Outras ações/encaminhamentos (código livre, a ser utilizado conforme interesse específico de cada município)",
        88 => "Outras ações/encaminhamentos (código livre, a ser utilizado conforme interesse específico de cada município)",
        89 => "Outras ações/encaminhamentos (código livre, a ser utilizado conforme interesse específico de cada município)");
}

function encaminhamento($codigo) {

    if (empty($codigo)) {
        return '';
    } else {
        $arrayEncaminhamentos = listaEncaminhamentos();

        return $arrayEncaminhamentos[$codigo];
    }
}

function tempoDecorido($dataini, $datafim) {

    # Split para dia, mes, ano, hora, minuto e segundo da data inicial
    $_split_datehour = explode(' ', $dataini);
    $_split_data = explode("/", $_split_datehour[0]);
    $_split_hour = explode(":", $_split_datehour[1]);
    # Coloquei o parse (integer) caso o timestamp nao tenha os segundos, dai ele fica como 0
    $dtini = mktime($_split_hour[0], $_split_hour[1], (integer) $_split_hour[2], $_split_data[1], $_split_data[0], $_split_data[2]);

    # Split para dia, mes, ano, hora, minuto e segundo da data final
    $_split_datehour = explode(' ', $datafim);
    $_split_data = explode("/", $_split_datehour[0]);
    $_split_hour = explode(":", $_split_datehour[1]);
    $dtfim = mktime($_split_hour[0], $_split_hour[1], (integer) $_split_hour[2], $_split_data[1], $_split_data[0], $_split_data[2]);

    # Diminui a datafim que é a maior com a dataini
    $time = ($dtfim - $dtini);

    # Recupera os dias
    $days = floor($time / 86400);
    # Recupera as horas
    $hours = floor(($time - ($days * 86400)) / 3600);
    # Recupera os minutos
    $mins = floor(($time - ($days * 86400) - ($hours * 3600)) / 60);
    # Recupera os segundos
    $secs = floor($time - ($days * 86400) - ($hours * 3600) - ($mins * 60));

    # Monta o retorno no formato
    # 5d 10h 15m 20s
    # somente se os itens forem maior que zero
    $retorno = "";
    if ($days > 0) {
        $retorno .= ($days > 0) ? $days . ' dias atrás' : "";
        return $retorno;
    } elseif ($hours > 0) {
        $retorno .= ($hours > 0) ? $hours . ' horas atrás' : "";
        return $retorno;
    } elseif ($mins > 0) {
        $retorno .= ($mins > 0) ? $mins . ' minutos atrás' : "";
        return $retorno;
    } elseif ($secs > 0) {
        $retorno .= ($secs > 0) ? $secs . ' segundos atrás' : "";
        return $retorno;
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

?>