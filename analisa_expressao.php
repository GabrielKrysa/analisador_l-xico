<?php
#by: Krysa
#09/03/2020

error_reporting(E_ERROR | E_WARNING | E_PARSE);

function procura_simbolos($srt)
{
    str_replace(" ", "", $srt);
    $str_to_array = str_split($srt);
    foreach ($str_to_array as $letra) {
        if ($letra == "+") {
            $tokens["operadores"][] = $letra;
        } else if ($letra == "*") {
            $tokens["operadores"][] = $letra;
        } else if ($letra == "-") {
            $tokens["operadores"][] = $letra;
        } else if ($letra == "/") {
            $tokens["operadores"][] = $letra;
        } else if ($letra == "(" || $letra == ")") {
            $tokens["parenteses"][] = $letra;
        }
    }
    return $tokens;
}

function procura_numero($str)
{
    $str = str_replace(" ", "", $str);
    $str_to_array = str_split($str);
    for ($i = 1; $i < count($str_to_array); $i++) {
        if (filter_var($str_to_array[$i], FILTER_SANITIZE_NUMBER_INT) != "") {
            if ((int) is_numeric($str_to_array[$i])) {
                $num = $str_to_array[$i];
                $flag = 0;
                while (true) {
                    $i++;
                    try {
                        if (filter_var($str_to_array[$i], FILTER_SANITIZE_NUMBER_INT) != "" && filter_var($str_to_array[$i], FILTER_SANITIZE_NUMBER_INT) != "+") {
                            $num .= $str_to_array[$i];
                        } else if ($str_to_array[$i] == '.') {
                            $num .= $str_to_array[$i];
                            $flag = 1;
                        } else {
                            break;
                        }
                    } catch (Exception $e) {
                    }
                }
                if ($flag == 1) {
                    $tokens["reais"][] = $num;
                } else {
                    $tokens["inteiro"][] = $num;
                }
            }
        }
    }

    return $tokens;
}

function procura_erro($tokens, $str)
{
    foreach ($tokens as $categories) {
        foreach ($categories as $row) {
            foreach ($row as $element) {
                $all[] = $element;
            }
        }
    }

    foreach ($all as $x) {
        $string .= $x . " ";
    }

    foreach (str_split($str) as $compare) {
        if (!in_array($compare, str_split($string))) {
            $errors["erros"][] = $compare;
        }
    }

    return $errors;
}

$str = "(15 * 54.9) + 890 9 + 45 / 12.56";
$tokens["numeros"] = procura_numero($str);
$tokens["simbolos"] = procura_simbolos($str);
$errors = procura_erro($tokens, $str);

echo json_encode([$tokens, $errors == null ? ["erros" => null] : $errors]);
