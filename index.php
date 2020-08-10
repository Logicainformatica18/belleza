<?php

include "head.php";
include "functiongenero.php";

?>
<div class="container" id="catalogo">
    <p></p>
    <h3 class="mbr-section-title align-center mbr-fonts-style
                    display-2">
       Eliga Catálogo</h3>
        <pre></pre>
    <?php   $genero->generoSelect2();    
    
    //$catalogo->catalogoSelectPublico();
    ?>
</div>
<p></p>
<div class="container" id="catalogo_detalle">
    <pre></pre>
    <h3 class="mbr-section-title align-center mbr-fonts-style
                    display-2">
       Estilos</h3>
        <p></p>
    <?php  
    $genero1=isset($_GET["genero"])? $_GET["genero"]:"";

    if($genero1==""){$genero1="%";}
   
    include "functioncatalogo.php"; $catalogo->catalogoSelectPublico($genero1);   
    
 
    ?>
    
</div>
</div>
<p></p>
<!-- <iframe id="seccion"src="catalogodetalle.php" frameborder="0" width="100%" height="1200px"> </iframe> -->


<?php

include "footer.php"

?>