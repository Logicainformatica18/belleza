    <link rel="stylesheet" href="../assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">
    <link rel="stylesheet" href="../assets/web/assets/mobirise-icons2/mobirise2.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../assets/dropdown/css/style.css">
    <link rel="stylesheet" href="../assets/tether/tether.min.css">
    <link rel="stylesheet" href="../assets/socicon/css/styles.css">
    <link rel="stylesheet" href="../assets/theme/css/style.css">
    <link rel="preload" as="style" href="../assets/mobirise/css/mbr-additional.css">
    <link rel="stylesheet" href="../assets/mobirise/css/mbr-additional.css" type="text/css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="function.js"></script>
</head>

<body>
    <section class="menu cid-qTkzRZLJNu" once="menu" id="menu1-23">



        <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm bg-color transparent">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="menu-logo">
                <div class="navbar-brand">
                    <span class="navbar-logo">
                        <a href="../index.php">
                          
                        </a>
                    </span>
                    <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-2" href="#">Estética Doris</a></span>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                    <li class="nav-item"><a class="nav-link link text-white display-4" href="../index.php">
                            INICIO</a></li>
                            <?php
                    echo " <li class='nav-item dropdown'><a class='nav-link link text-white dropdown-toggle display-4'
                               href='#' aria-expanded='true' data-toggle='dropdown-submenu'>CATALOGO</a>";
                    echo " <div class='dropdown-menu'>";
                    include "../conexion.php";
                    $con = new connection();
                    $sql = mysqli_query($con->open(), "SELECT cod_genero,descripcion from genero");
                    while ($row = mysqli_fetch_array($sql)) {
                        $cod_genero = $row[0];
                        $descripcion = $row[1];
                        ?>
 
                        <a class='text-white dropdown-item display-4' href='#'onclick="elegirGenero('<?php echo $descripcion?>');"aria-expanded='false'>
                        <?php echo $descripcion?></a>
                        <?php
                       
                    }
                    echo " </div>";
                    echo "</li>";
                    ?>
                    <li class="nav-item"><a class="nav-link link text-white     display-4"
                            href="../tienda.php#productos">TIENDA</a>
                        <!-- <div class="dropdown-menu">
                            <div class="dropdown"><a class="text-white dropdown-item dropdown-toggle display-4"
                                    href="catalogo.php" aria-expanded="false" data-toggle="dropdown-submenu">Cabello</a>
                                <div class="dropdown-menu dropdown-submenu"><a
                                        class="text-white dropdown-item display-4" href="catalogo.php"
                                        aria-expanded="false">Shampoo</a><a class="text-white dropdown-item display-4"
                                        href="catalogo.php" aria-expanded="false">Acondicionador</a><a
                                        class="text-white dropdown-item display-4" href="catalogo.php"
                                        aria-expanded="false">Tratamiento</a><a
                                        class="text-white dropdown-item display-4" href="catalogo.php"
                                        aria-expanded="false">Mascarilla</a></div>
                            </div>
                            <div class="dropdown"><a class="text-white dropdown-item dropdown-toggle display-4"
                                    href="catalogo.php" aria-expanded="false" data-toggle="dropdown-submenu">Cuidado de
                                    piel</a>
                                <div class="dropdown-menu dropdown-submenu"><a
                                        class="text-white dropdown-item display-4" href="catalogo.php"
                                        aria-expanded="false">Limpieza y Tónicos</a><a
                                        class="text-white dropdown-item display-4" href="catalogo.php"
                                        aria-expanded="false">Cremas</a><a class="text-white dropdown-item display-4"
                                        href="catalogo.php" aria-expanded="false"></a></div>
                            </div>
                        </div> -->
                    </li>

 
                    <li class="nav-item">
                        <a class="nav-link link text-white display-4" href="../blog.php">&nbsp;BLOG</a>
                    </li>
                    <li class="nav-item"><a class="nav-link link text-white display-4" href="../login.php"><span class="mobi-mbri mobi-mbri-user-2 mbr-iconfont mbr-iconfont-btn"></span>MI CUENTA</a></li>
                  
                </ul>

            </div>
        </nav>
    </section>

    <style>
        .fondo {
            height: 200px;
            background-image: url("https://www.academiadebellezazeus.com/t/uploads/hj0f17c39b99.jpg/1920/1200?maxcrop=1");
        }
    </style>
    <!-- <section class="engine"><a href="https://mobirise.info/x">free css templates</a></section> -->
    <section class="mbr-section info3 cid-s2HaqXQMaZ  fondo" id="info3-2m">



        <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(35, 35, 35);">
        </div>


        <div class="container">
            <div class="row justify-content-center">
                <div class="media-container-column title col-12 col-md-10">
                    <h2 class="align-left mbr-bold mbr-white pb-3 mbr-fonts-style display-2">

                    </h2>
                    <h3 class="mbr-section-subtitle align-left mbr-light mbr-white pb-3 mbr-fonts-style display-5">

                    </h3>
                    <p class="mbr-text align-left mbr-white mbr-fonts-style display-7">

                    </p>
                    <div class="mbr-section-btn align-left py-4">

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="mbr-section form1 cid-s2HanEaOym white" id="form1-2l">




        <div class="container">
     
            <div class="row justify-content-center">
                <div class="title col-12 col-lg-8">
                    <p></p>
                    <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">Blog</h2>
        
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="media-container-column col-lg-8" data-form-type="formoid"> -->



<style>
.titulo_post{
    color:crimson;
   /* font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;*/
    font-size:50px;

}
</style>



    <div class="row">
        <div class="col-md-8 col-lg-8 ">
            <div class="card" >

                <div class="card-body">
                        <p></p>
                  
    