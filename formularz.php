<?php

if ($_GET['status'] == 1) {
    $plik = "form1.json";
} else if ($_GET['status'] == 2) {
    $plik = "form2.json";
} else if ($_GET['status'] == 3) {
    $plik = "form3.json";
}
$array = json_decode(file_get_contents($plik), true);

$body = '';

$body .= '<form action="/rekrutacja' . $array['action'] . '" method="GET">';
$check = "";
foreach ($array['fields'] as $arr) {

    $required = "";
    if ($arr['required']) {
        $required = "required";
    }

    if ($arr['type'] == 'fieldset') {
        $body .= '
        <fieldset>
            <legend>' . $arr['label'] . '</legend>';
        foreach ($arr['fields'] as $input) {
            $checkFieldset = "";
            if ($checkFieldset == $input['label']) {
            } else {
                $requiredFieldset = "";
                if ($input['required'] == 1) {
                    $requiredFieldset = "required";
                }

                if ($input['type'] == "radio") {
                    foreach ($input['options'] as $radio) {
                        $body .= '<label>' . $radio['label'] . '</label><input type="' . $input['type'] . '" ' . $requiredFieldset . ' name="' . $input['name'] . '" value="' . $radio['value'] . '">';
                    }
                } else if ($input['type'] == 'text') {

                    $body .= '<label>' . $input['label'] . '</label><input type="' . $input['type'] . '" ' . $requiredFieldset . ' name="' . $input['name'] . '"minlength="2" maxlength="20"">';
                } else if ($input['type'] == 'password') {

                    $body .= '<label>' . $input['label'] . '</label><input type="' . $input['type'] . '" ' . $requiredFieldset . ' name="' . $input['name'] . '"minlength="8" maxlength="60" pattern="^(?=.*\d)(?=.*[a-zA-Z]).+$"">';
                } else {
                    $body .= '<label>' . $input['label'] . '</label><input type="' . $input['type'] . '" ' . $requiredFieldset . ' name="' . $input['name'] . '">';
                }
            }
            $checkFieldset = $input['label'];
        }
        $body .= '
        </fieldset>';
    } else if ($arr['type'] == 'text' and $check != $arr['label']) {

        $body .= '<label>' . $arr['label'] . '</label><input type="' . $arr['type'] . '" ' . $required . ' name="' . $arr['name'] . '"minlength="2" maxlength="20"">';
    } else if ($arr['type'] == 'password' and $check != $arr['label']) {

        $body .= '<label>' . $arr['label'] . '</label><input type="' . $arr['type'] . '" ' . $required . ' name="' . $arr['name'] . '"minlength="8" maxlength="60" pattern="^(?=.*\d)(?=.*[a-zA-Z]).+$"">';
    } else if ($arr['type'] == 'radio' and $check != $arr['label']) {
        foreach ($arr['options'] as $radio) {
            $body .= '<label>' . $radio['label'] . '</label><input type="' . $arr['type'] . '" ' . $required . ' name="' . $arr['name'] . '" value="' . $radio['value'] . '">';
        }
    } else if ($check != $arr['label']) {

        $body .= '<label>' . $arr['label'] . '</label><input type="' . $arr['type'] . '" ' . $required . ' name="' . $arr['name'] . '">';
    }
    $check = $arr['label'];
}
$body .= '<input type="hidden" name="status2" value="' . $_GET['status'] . '">';
$body .= '<input type="submit">';
$body .= '</form>';


echo $body;
