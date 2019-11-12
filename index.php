<?php
    $host = "localhost";
    $usuario = "aluno";
    $senha = "aluno";
    $banco = "world";

    echo "<head><meta charset=\"utf-8\"></head>";
 
    $c = mysqli_connect($host, $usuario, $senha, $banco);
 
    if(!$c)
    {
        echo "erro na conexão";
        echo mysqli_error($c);
        die();
    }
 
    if(!mysqli_select_db($c,$banco))
    {
        echo "erro no select_db";
        echo mysqli_error($c);
        mysqli_close($c);
        die();
    }
 
    $sql = "SELECT C.name FROM country as C INNER JOIN countrylanguage as B ON (B.CountryCode = C.Code) WHERE (B.Language = 'Portuguese') AND (B.IsOfficial='T')";
 
    $resp = mysqli_query($c, $sql);
 
    if(!$resp)
    {
        echo "erro na consulta $sql";
        echo mysqli_error($c);
        mysqli_close($c);
        die();
    }
 
    $linha = mysqli_fetch_assoc($resp);
    echo "<p>Países que falam português: </p>";
    echo "<table border=\"1\">";
    echo "<tr><th>Nome</th></tr>";
    if($linha)
    {
        while($linha)
        {
            echo "<tr><td>{$linha["name"]}</td></tr>";
            $linha = mysqli_fetch_assoc($resp);
        }
    }
    else
    {
        echo "tabela vazia";
    }
    echo "</table>";

    $sql = "SELECT name, population FROM city WHERE CountryCode = 'Bra' ORDER BY name";
    $resp = mysqli_query($c, $sql);
 
    if(!$resp)
    {
        echo "erro na consulta $sql";
        echo mysqli_error($c);
        mysqli_close($c);
        die();
    }
 
    $linha = mysqli_fetch_assoc($resp);
    echo "<p>Cidades do Brasil</p>";
    echo "<table border=\"1\">";
    echo "<tr><th>Nome</th><th>População</th></tr>";
    if($linha)
    {
        while($linha)
        {
            echo utf8_encode("<tr><td>{$linha["name"]}</td><td>{$linha["population"]}</td></tr>");
            $linha = mysqli_fetch_assoc($resp);
        }
    }
    else
    {
        echo "tabela vazia";
    }
    echo "</table>";

    $sql = "SELECT name, population, lifeExpectancy, gnp FROM country WHERE Continent = 'South America' ORDER BY `lifeExpectancy` DESC";
    $resp = mysqli_query($c, $sql);
 
    if(!$resp)
    {
        echo "erro na consulta $sql";
        echo mysqli_error($c);
        mysqli_close($c);
        die();
    }
 
    $linha = mysqli_fetch_assoc($resp);
    echo "<p>Países da America do Sul</p>";
    echo "<table border=\"1\">";
    echo "<tr><th>Nome</th><th>População</th><th>Expectativa de Vida</th><th>PIB</th></tr>";
    if($linha)
    {
        while($linha)
        {

            $edv = $linha["lifeExpectancy"];
            if ($edv == null)
                $edv = "SEM DADOS";
            $pib = $linha["gnp"];
            if ($pib == 0)
                $pib = "SEM DADOS";
            echo utf8_encode("<tr><td>{$linha["name"]}</td><td>{$linha["population"]}</td><td>{$edv}</td><td>$pib</td></tr>");
            $linha = mysqli_fetch_assoc($resp);
        }
    }
    else
    {
        echo "tabela vazia";
    }
    echo "</table>";

    $sql = "SELECT name, population, lifeExpectancy, gnp FROM country WHERE Continent = 'Africa' ORDER BY `gnp` DESC";
    $resp = mysqli_query($c, $sql);
 
    if(!$resp)
    {
        echo "erro na consulta $sql";
        echo mysqli_error($c);
        mysqli_close($c);
        die();
    }
 
    $linha = mysqli_fetch_assoc($resp);
    echo "<p>Países da Africa</p>";
    echo "<table border=\"1\">";
    echo "<tr><th>Nome</th><th>População</th><th>Expectativa de Vida</th><th>PIB</th></tr>";
    if($linha)
    {
        while($linha)
        {
            $edv = $linha["lifeExpectancy"];
            if ($edv == null)
                $edv = "SEM DADOS";
            $pib = $linha["gnp"];
            if ($pib == 0)
                $pib = "SEM DADOS";
            $pop = $linha["population"];
            if ($pop == 0)
                $pop = "SEM DADOS";
            echo utf8_encode("<tr><td>{$linha["name"]}</td><td>{$pop}</td><td>{$edv}</td><td>$pib</td></tr>");
            $linha = mysqli_fetch_assoc($resp);
        }
    }
    else
    {
        echo "tabela vazia";
    }
    echo "</table>";

    mysqli_free_result($resp);
    mysqli_close($c);
?>A