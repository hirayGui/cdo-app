<?php

/**
 * Metodologia de sort por nome
 */
function nameSort($a, $b) {
    // Se ambos forem null, considerar iguais
    if ($a === null && $b === null) {
        return 0;
    }
    // Se $a for null, colocar no final
    elseif ($a === null) {
        return 1;
    }
    // Se $b for null, colocar no final
    elseif ($b === null) {
        return -1;
    }
    // Ordenar normalmente
    else {
        if(isset($_GET['ordem']) && !empty($_GET['ordem'])){
            if($_GET['ordem'] === "ASC" ){
                return ($a <=> $b);
            }else{
                return ($b <=> $a);
            }
        }else{
            return ($b <=> $a);
        }
    }
}

/**
 * Metodologia de sort pelo tempo de espera
 */
function timeSort($keys) {
    return function($a, $b) use ($keys) {
        $valueA = $a;
        $valueB = $b;
        foreach ($keys as $key) {
            if (is_array($valueA) && isset($valueA[$key])) {
                $valueA = $valueA[$key];
            } else {
                $valueA = null;
            }

            if (is_array($valueB) && isset($valueB[$key])) {
                $valueB = $valueB[$key];
            } else {
                $valueB = null;
            }
        }

        // Se ambos forem null ou não definidos, considerar iguais
        if ($valueA === null && $valueB === null) {
            return 0;
        }
        // Se $a for null ou não definido, colocar no final
        elseif ($valueA === null) {
            return 1;
        }
        // Se $b for null ou não definido, colocar no final
        elseif ($valueB === null) {
            return -1;
        }
        // Ordenar normalmente
        else {
            if(isset($_GET['ordem']) && !empty($_GET['ordem'])){
                if( $_GET['ordem'] === "ASC" ){
                    return ($valueA <=> $valueB);
                }else{
                    return ($valueB <=> $valueA);
                }
            }else{
                return ($valueB <=> $valueA);
            }
            
        }
    };
}

//buscando id do parque pelo GET para poder realizar requisição
if(isset($_GET['parque_id']) && !empty($_GET['parque_id'])){
    $url = 'https://api.themeparks.wiki/v1/entity/'.$_GET['parque_id'].'/live';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


    $response = curl_exec($ch);


    if (curl_errno($ch)) {
        echo 'Erro ao fazer a requisição: ' . curl_error($ch);
        curl_close($ch);
        exit;
    }


    curl_close($ch);

    $response = json_decode($response, true);
    $attractions = $response['liveData'];

    if(isset($_GET['item']) && !empty($_GET['item'])){
        if($_GET['item'] == 'nome'){
            usort($attractions, function($a, $b) {
                return nameSort($a['name'], $b['name']);
            });
        }else{
            usort($attractions, timeSort(array('queue', 'STANDBY', 'waitTime')));
        }
    }else{
        usort($attractions, timeSort(array('queue', 'STANDBY', 'waitTime')));
    }


}else{
    $url = 'https://api.themeparks.wiki/v1/entity/75ea578a-adc8-4116-a54d-dccb60765ef9/live';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


    $response = curl_exec($ch);


    if (curl_errno($ch)) {
        echo 'Erro ao fazer a requisição: ' . curl_error($ch);
        curl_close($ch);
        exit;
    }


    curl_close($ch);

    $response = json_decode($response, true);
    $attractions = $response['liveData'];

    if(isset($_GET['item']) && !empty($_GET['item'])){
        if($_GET['item'] == 'nome'){
            usort($attractions, function($a, $b) {
                return nameSort($a['name'], $b['name']);
            });
        }else{
            usort($attractions, timeSort(array('queue', 'STANDBY', 'waitTime')));
        }
    }else{
        usort($attractions, timeSort(array('queue', 'STANDBY', 'waitTime')));
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CDO App</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css" type="text/css">
    <script src="https://kit.fontawesome.com/5be2a27f58.js" crossorigin="anonymous"></script>
</head>

<body>
    <!--Navbar-->
    <nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary" style="background-color: #683bcd !important;" data-bs-theme="dark">
    <div class="container-md">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $response['name']; ?>
                        </a>
                        <ul class="dropdown-menu position-absolute">
                            <li><a class="dropdown-item" href="./index.php?parque_id=75ea578a-adc8-4116-a54d-dccb60765ef9">Magic Kingdom</a></li>
                            <li><a class="dropdown-item" href="./index.php?parque_id=288747d1-8b4f-4a64-867e-ea7c9b27bad8">⁠Hollywood Studios</a></li>
                            <li><a class="dropdown-item" href="./index.php?parque_id=47f90d2c-e191-4239-a466-5892ef59a88b">⁠Epcot</a></li>
                            <li><a class="dropdown-item" href="./index.php?parque_id=1c84a229-8862-4648-9c71-378ddd2c7693">⁠Animal Kingdom</a></li>
                            <li><a class="dropdown-item" href="./index.php?parque_id=ead53ea5-22e5-4095-9a83-8c29300d7c63">Blizzard Beach</a></li>
                            <li><a class="dropdown-item" href="./index.php?parque_id=b070cbc5-feaa-4b87-a8c1-f94cca037a18">Typhoon Lagoon</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="./index.php?parque_id=eb3f4560-2383-4a36-9152-6b3e5ed6bc57">Universal Orlando</a></li>
                            <li><a class="dropdown-item" href="./index.php?parque_id=267615cc-8943-4c2a-ae2c-5da728ca591f">⁠Islands of Adventure</a></li>
                            <li><a class="dropdown-item" href="./index.php?parque_id=fe78a026-b91b-470c-b906-9d2266b692da">⁠Volcano Bay</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="./index.php?parque_id=27d64dee-d85e-48dc-ad6d-8077445cd946">Seaworld</a></li>
                            <li><a class="dropdown-item" href="./index.php?parque_id=9e2867f8-68eb-454f-b367-0ed0fd72d72a">⁠Aquatica</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="./index.php?parque_id=bb285952-7e52-4a07-a312-d0a1ed91a9ac">Legoland</a></li>
                        </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
            <li class="nav-item">
                    <button class="nav-link" onclick="window.location.reload();"><i class="fa-solid fa-rotate"></i></button>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="lista">
            <div class="lista-item titulo">
                <div class="tempo-titulo">
                    <a href="./index.php?parque_id=<?php if(isset($_GET['parque_id']) && !empty($_GET['parque_id'])){ echo $_GET['parque_id']; }else{ echo "75ea578a-adc8-4116-a54d-dccb60765ef9"; } ?>&item=tempo&ordem=<?php if(isset($_GET['ordem']) && !empty($_GET['ordem'])){ if($_GET['ordem'] === "ASC"){ echo "DESC"; }else{ echo "ASC"; }}else{echo "ASC";} ?>"><h6>Tempo</h6></a>
                </div>
                <div class="nome-titulo">
                    <a href="./index.php?parque_id=<?php if(isset($_GET['parque_id']) && !empty($_GET['parque_id'])){ echo $_GET['parque_id']; }else{ echo "75ea578a-adc8-4116-a54d-dccb60765ef9"; } ?>&item=nome&ordem=<?php if(isset($_GET['ordem']) && !empty($_GET['ordem'])){ if($_GET['ordem'] === "ASC"){ echo "DESC"; }else{ echo "ASC"; }}else{echo "ASC";} ?>"><h6>Atração</h6></a>
                </div>
            </div>
            <?php foreach($attractions as $attraction) { ?>
            <div class="lista-item">
                <div class="lista-tempo" style="background-color:<?php if($attraction['status'] === 'CLOSED'){echo '#683bcd !important';}elseif(isset($attraction['queue']['STANDBY']['waitTime']) && !empty($attraction['queue']['STANDBY']['waitTime'])){if($attraction['queue']['STANDBY']['waitTime'] >= 61){ echo '#ec0680 !important'; }elseif($attraction['queue']['STANDBY']['waitTime'] <= 60 && $attraction['queue']['STANDBY']['waitTime'] >= 31){ echo '#ffcc04 !important'; }elseif($attraction['queue']['STANDBY']['waitTime'] <= 30){ echo '#92d037 !important'; }}else{ echo '#683bcd !important'; } ?> ;">
                    <?php if(isset($attraction['queue']['STANDBY']['waitTime']) && $attraction['queue']['STANDBY']['waitTime'] != null){ echo '<span class="numero">'.$attraction['queue']['STANDBY']['waitTime'].'</span>'; } ?>

                    <?php if($attraction['status'] === 'CLOSED'){ echo '<span class="fechado">Fechado</span>'; }elseif(isset($attraction['queue']['STANDBY']['waitTime']) && $attraction['queue']['STANDBY']['waitTime'] != null){ echo '<span class="minutos">Minutos</span>'; }else{ echo '<span class="indisponivel">Não disponível</span>'; } ?>
               </div>
               <div class="lista-nome">
                    <h6><?php echo $attraction['name']; ?></h6>
               </div>
            </div>

            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>