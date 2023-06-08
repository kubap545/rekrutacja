<?php
$conn = mysqli_connect('localhost', 'root', '', 'form_data');

if ($_GET['status2'] == 1) {
    $plik = "form1.json";
} else if ($_GET['status2'] == 2) {
    $plik = "form2.json";
} else if ($_GET['status2'] == 3) {
    $plik = "form3.json";
}
$array = json_decode(file_get_contents($plik), true);
print_r($array);
$data = '';
foreach ($array['fields'] as $arr) {


    if ($arr['type'] == 'fieldset') {

        foreach ($arr['fields'] as $input) {
            $checkFieldset = "";
            if ($checkFieldset == $input['label']) {
            } else {
                $requiredFieldset = "";


                if ($input['type'] == "radio") {
                    $data .= $_GET[$input['name']] . ';;;';
                } else if ($input['type'] == 'text') {
                    $data .= $_GET[$input['name']] . ';;;';
                } else if ($input['type'] == 'password') {
                    $data .= $_GET[$input['name']] . ';;;';
                } else {
                    $data .= $_GET[$input['name']] . ';;;';
                }
            }
            $checkFieldset = $input['label'];
        }
    } else if ($arr['type'] == 'text' and $check != $arr['label']) {
        $data .= $_GET[$arr['name']] . ';;;';
    } else if ($arr['type'] == 'password' and $check != $arr['label']) {
        $data .= $_GET[$arr['name']] . ';;;';
    } else if ($arr['type'] == 'radio' and $check != $arr['label']) {
        $data .= $_GET[$arr['name']] . ';;;';
    } else if ($check != $arr['label']) {
        $data .= $_GET[$arr['name']] . ';;;';
    }
    $check = $arr['label'];
}

$zapytanie = "INSERT INTO data_from_form(data_from_form) values ('$data')";

$zapyt = mysqli_query($conn, $zapytanie);

mysqli_close($conn);

header("Location:index.php");
