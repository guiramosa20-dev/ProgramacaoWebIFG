<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estruturas condicionais</title>
</head>
<body>
    <?php
    ##### Estrutura condicional IF ##########
        $x = 5;
        if ($x >5){
            echo "É maior";
        }
        elseif ($x < 5){
            echo "É menor";
        }
        else{
            echo "Igual";
        } 
        echo "<hr>";
    ##### Estrutura condicional switch ######
        $favcolor = "red";
        
        switch ($favcolor) {
        case "red":
            echo "Your favorite color is red!";
            break;
        case "blue":
            echo "Your favorite color is blue!";
            break;
        case "green":
            echo "Your favorite color is green!";
            break;
        default:
            echo "Your favorite color is neither red, blue, nor green!";
        }
    ########################################
    while ($x < 10){
        echo "While: $x <br>";
        $x++;
    }

    do{
        echo "While: $x <br>";
        $x++;
    } while ($x < 15);

    for ($i=1; $i<=10; $i++){
        echo "for: $i <br>";
    }

    for ($j=10; $j >= 1; $j--){
        echo "for: $j <br>";
    }

    $vet = array ("Jax", "Kung", "Shaukan", "saybot");

    $v[0] = "Jhony";
    $v[1] = "Sindel";
    $v[2] = "Kenow";

    foreach($vet as $v){
        echo "Nome: $v <br>";
    }
    ?>
</body>
</html>