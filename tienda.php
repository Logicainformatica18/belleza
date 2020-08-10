<?php
include "head.php";
include "functionproductos.php";

?>
<div class="container" id="productos">
    <p></p>
    <h3 class="mbr-section-title align-center mbr-fonts-style
                    display-2">
        Productos</h3>
    <pre></pre>
    <?php $productos->productosSelect2();
    //$catalogo->catalogoSelectPublico();
    ?>
</div>
<p></p>
<div class="container" id="productos_detalle">
    <pre></pre>
    <h3 class="mbr-section-title align-center mbr-fonts-style
                    display-2">
        Detalle</h3>
    <p></p>
    <?php
    $productos1 = isset($_GET["productos"]) ? $_GET["productos"] : "";

    if ($productos1 != "") {

        $_SESSION["productos"] =   $productos1;
        echo "   <iframe id='seccion' src='catalogodetalle.php' frameborder='0' width='90%' height='1000px'> </iframe>
";
    }
    ?>

</div>


<?php
include "footer.php";
?>