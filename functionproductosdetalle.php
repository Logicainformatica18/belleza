<?php
if (!class_exists("connection")) {
    include("conexion.php");
}
if (!class_exists("session")) {
    include("session.php");
}
//variables POST
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
$metodo = isset($_POST['metodo']) ? $_POST['metodo'] : "";

$productos = isset($_SESSION["productos"]) ? $_SESSION["productos"] : "";
$foto = isset($_FILES['foto']['tmp_name']) ? $_FILES['foto']['tmp_name'] : "";
//comprobamos si hay una foto o no
if ($foto != "") {
    //Convertimos la información de la imagen en binario para insertarla en la BBDD
    $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
}

class productosdetalle extends connection
{
    public $nombre;
    public $foto;
    public $descripcion;
    public function productosdetalleSelect()
    {
        $productos = $_SESSION["productos"];
        //consulta todos los empleados
        $sql = mysqli_query($this->open(), "SELECT pd.cod_productos_detalle, pd.foto from productos_detalle pd inner join
    productos p on pd.idproducto=p.idproducto where p.idproducto='$productos';");
?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabla de productosdetalle</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Modificar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_array($sql)) {
                                            echo "<tr>";
                                            $productosdetalleid = $row[0];
                                            // decodificar base 64
                                            $foto = base64_encode($row[1]);
                                            if ($foto == "") {
                                                echo "<td height='50'>No Disponible</td>";
                                            } else {
                                                echo "<td height='50'><img src='data:image/jpeg;base64,$foto' width='50'height='50'></td>";
                                            }

                                        ?>

                                            <!-- Button trigger modal -->
                                            <td><button type="button" class="btn btn-primary note-icon-pencil" data-toggle="modal" data-target="#exampleModal" onclick="productosdetalleSelectOne('<?php echo $productosdetalleid ?>'); productosdetalleEditar();  return false"></button></td>
                                            <!-- <button class="note-icon-pencil" ></button> -->
                                            <td><button class="btn btn-danger note-icon-trash" onclick="productosdetalleDelete('<?php echo $productosdetalleid ?>');  return false"></button></td>
                                        <?php
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->

        <iframe id="seccion" src="catalogodetalle.php" frameborder="0" width="100%" height="1200px"> </iframe>
<?php


    }
    public function productosdetalleDelete($codigo)
    {
        //registra los datos del empleados
        $sql = "DELETE FROM productos_detalle where cod_productos_detalle='$codigo';";
        if (mysqli_query($this->open(), $sql)) {
        } else {
        }
        $this->productosdetalleSelect();
    }
    public function productosdetalleInsert($productos, $foto)
    {
        //registra los datos del productosdetalle
        $sql = "INSERT INTO productos_detalle (idproducto,foto)values('$productos','$foto')";


        mysqli_query($this->open(), $sql) or die('Error. ' . mysqli_error($sql));
        $this->productosdetalleSelect();
    }
    public function productosdetalleSelectOne($codigo)
    {
        $sql = mysqli_query($this->open(), "SELECT pd.cod_productos_detalle, pd.foto from productos_detalle pd inner join
        productos p on pd.idproducto=p.idproducto where pd.cod_productos_detalle='$codigo'");
        $r = mysqli_fetch_assoc($sql);
        $codigo = $r["cod_productos_detalle"];
        $foto = base64_encode($r["foto"]);
        echo "<script>
      productosdetalle.codigo.value='$codigo';
      productosdetalle.fotografia.src='data:image/jpeg;base64,$foto';
      </script>";
        $this->productosdetalleSelect();
    }
    public function productosdetalleUpdate($codigo, $foto)
    {
        $sql = "UPDATE productos_detalle set foto='$foto' where cod_productos_detalle='$codigo'";
        mysqli_query($this->open(), $sql) or die('Error. ' . mysqli_error($sql));
        echo "<script>	
        productosdetalle.codigo.value='$codigo';
        productosdetalle.fotografia.src='data:image/jpeg;base64,$foto';
        </script>";
        $this->productosdetalleSelect();
    }
    public function productosdetalleFotos($productos)
    {

        //consulta todos los empleados
        $sql = mysqli_query($this->open(), "SELECT pd.cod_productos_detalle, pd.foto from productos_detalle pd inner join
    productos p on pd.idproducto=p.idproducto where p.idproducto='$productos';");

        while ($row = mysqli_fetch_array($sql)) {
            // decodificar base 64
            $foto = base64_encode($row[1]);
            echo "<div class='product-image-thumb'><img src='data:image/jpeg;base64,$foto' alt='Product Image'></div>";
        }
    }
    public function productosdetalleOne($productos)
    {

        //consulta todos los empleados
        $sql = mysqli_query($this->open(), "SELECT  p.IdProducto, p.NombreProducto,pd.foto,p.PrecioUnitario,p.preciopaquete,p.descripcion from
        productos p inner join servicio s inner join proveedores pro inner join productos_detalle pd on p.cod_servicio=s.cod_servicio and
        p.IdProveedor=pro.IdProveedor and pd.idproducto=p.idproducto   where p.idproducto='$productos' limit 1;");

        $row = mysqli_fetch_assoc($sql);
        // decodificar base 64
        $foto = base64_encode($row["foto"]);
        
        $this->foto = " <img src='data:image/jpeg;base64,$foto' class='product-image' alt='Product Image'height='200' > ";
        $this->nombre=$row["NombreProducto"];
        $this->precio="s/ ".$row["PrecioUnitario"];
        $this->descripcion=$row["descripcion"];
        // echo " <img src='data:image/jpeg;base64,$foto' class='product-image' alt='Product Image'> ";

    }

    


}

$productosdetalle = new productosdetalle();
if ($metodo == "delete") {
    $productosdetalle->productosdetalleDelete($codigo);
} elseif ($metodo == "insert") {
    $productosdetalle->productosdetalleInsert($productos, $foto);
} elseif ($metodo == "select") {
    $productosdetalle->productosdetalleSelectOne($codigo);
} elseif ($metodo == "update") {
    $productosdetalle->productosdetalleUpdate($codigo, $foto);
}
