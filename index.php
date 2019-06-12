<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Kalkulator lokat - Marta Kaszuba</title>
</head>

<body>
    <h4>Kalkulator lokat bankowych</h4>
    <div id="main">
    <form method="POST">
        <p>Kwota depozytu (zł): <input type="text" id="sum" size="5" name="capital"></p>
        <p>Okres: <input type="number" id="years" name="years"> lat</p>
        <p>Oprocentowanie (%): <input type="text" id="procent" size="5" name="procent"></p>
        <p>Kapitalizacja odsetek: 
        <select name="capitalisation">
        <option value="annually">rocznie</option>
        <option value="half">co pół roku</option>
        <option value="quarter">kwartalnie</option>
        <option value="monthly">miesięcznie</option>
        </select>
    </p>
    <button id="btn" class="btn btn-info" name="submit">Oblicz</button>
    <p id="result">
<?php


if (isset($_POST["submit"]) && isset($_POST["capital"]) && isset($_POST["years"]) 
&& isset($_POST["procent"]) && isset($_POST["capitalisation"])){

    $capital = htmlentities(trim($_POST["capital"]));
    $capital = str_replace(",", ".", $capital);
    $years = htmlentities(trim($_POST["years"]));
    $procent = htmlentities(trim($_POST["procent"]));
    $procent = str_replace(",", ".", $procent);
    $capitalisation = htmlentities(trim($_POST["capitalisation"]));

    if (!is_numeric($capital) || !is_numeric($years) || !is_numeric($procent) || $years<0 || $capital<0 || $procent<0){
        echo "<span id='err'>Wpisz prawidłowe liczby!</span>";
    }
    else {
       if ($capitalisation === "annually"){
       $pp = 1 + $procent/100;
       $final = pow($pp,$years) * $capital;
       echo "Wynik w przybliżeniu to: ".round($final,2). " zł";
       }

       else if ($capitalisation === "half"){
        $pp = 1 + $procent/2/100;
        $final = pow($pp,$years*2) * $capital;
        echo "Wynik w przybliżeniu to: ".round($final,2). " zł";
       }

       else if ($capitalisation === "quarter"){
        $pp = 1 + $procent/4/100;
        $final = pow($pp,$years*4) * $capital;
        echo "Wynik w przybliżeniu to: ".round($final,2). " zł";        
    }

    else if ($capitalisation === "monthly"){
        $pp = 1 + $procent/12/100;
        $final = pow($pp,$years*12) * $capital;
        echo "Wynik w przybliżeniu to: ".round($final,2). " zł";
    }
    }
}    
?>

    </p>
    </form>
</div>

</body>
</html>
