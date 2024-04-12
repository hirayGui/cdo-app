<?php
$parques = array(
    array(
        'nome' => 'Magic Kingdom',
        'id' => '75ea578a-adc8-4116-a54d-dccb60765ef9',
        "imagem" => './assets/parques/magic-kingdom.webp'
    ),
    array(
        'nome' => '⁠Hollywood Studios',
        'id' => '288747d1-8b4f-4a64-867e-ea7c9b27bad8',
        "imagem" => './assets/parques/magic-kingdom.webp'
    ),
    array(
        'nome' => '⁠Epcot',
        'id' => '47f90d2c-e191-4239-a466-5892ef59a88b',
        "imagem" => './assets/parques/magic-kingdom.webp'
    )
);

/* 
Disney e957da41-3552-4cf6-b636-5babc5cbc4e5
- Magic Kingdom 75ea578a-adc8-4116-a54d-dccb60765ef9
- ⁠Hollywood Studios 288747d1-8b4f-4a64-867e-ea7c9b27bad8
- ⁠Epcot 47f90d2c-e191-4239-a466-5892ef59a88b
- ⁠Animal Kingdom 1c84a229-8862-4648-9c71-378ddd2c7693

Universal 89db5d43-c434-4097-b71f-f6869f495a22
- Universal Orlando eb3f4560-2383-4a36-9152-6b3e5ed6bc57
- ⁠Islands of Adventure 267615cc-8943-4c2a-ae2c-5da728ca591f
- ⁠Volcano Bay fe78a026-b91b-470c-b906-9d2266b692da

SeaWorld 643e837e-b244-4663-8d3a-148c26ecba9c
- Seaworld 27d64dee-d85e-48dc-ad6d-8077445cd946
- ⁠Busch Gardens
- ⁠Aquatica 9e2867f8-68eb-454f-b367-0ed0fd72d72a

Legoland 7a4adf8d-8c3f-4300-b277-19707e4f8e12
- Legoland bb285952-7e52-4a07-a312-d0a1ed91a9ac
- ⁠Peppa Pig

Se tiverem tempo de espera:
- Blizzard Beach ead53ea5-22e5-4095-9a83-8c29300d7c63
- Typhoon Lagoon b070cbc5-feaa-4b87-a8c1-f94cca037a18
*/


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
    <nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary" style="background-color: #6f2cf5 !important;" data-bs-theme="dark">
        <div class="container-md">
            <a class="navbar-brand" href="#">
                <img src="./assets/travel.png" alt="" style="width: 100px; height: auto;">
            </a>
        </div>
    </nav>

    <div class="container">
        <?php
        foreach ($parques as $parque) {
        ?>
        <a href="./index.php?parque_id=<?php echo $parque['id']; ?>">
            <div class="parque-card">
                <div class="parque-card-title">
                    <h5><?php echo $parque['nome']; ?></h5>
                </div>

                <div class="parque-card-img">
                    <img src="<?php echo $parque['imagem']; ?>" alt="atração">
                </div>
            </div>
        </a>
            

        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>