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

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
$preciounitario = isset($_POST['preciounitario']) ? $_POST['preciounitario'] : "";
$preciopaquete = isset($_POST['preciopaquete']) ? $_POST['preciopaquete'] : "";
$unidadesporpaquete = isset($_POST['unidadesporpaquete']) ? $_POST['unidadesporpaquete'] : "";
$unidadesenstock = isset($_POST['unidadesenstock']) ? $_POST['unidadesenstock'] : "";
$servicio = isset($_POST['servicio']) ? $_POST['servicio'] : "";
$proveedor = isset($_POST['proveedor']) ? $_POST['proveedor'] : "";
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
$foto = isset($_FILES['foto']['tmp_name']) ? $_FILES['foto']['tmp_name'] : "";
//comprobamos si hay una foto o no
if ($foto != "") {
    //Convertimos la información de la imagen en binario para insertarla en la BBDD
    $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
}
class productos extends connection
{


  public function productosSelect()
  {
    //consulta todos los empleados
    $sql = mysqli_query($this->open(), "SELECT p.IdProducto, p.NombreProducto,p.PrecioUnitario,p.preciopaquete,p.unidadesporpaquete,p.UnidadesEnStock,p.foto from
    productos p inner join servicio s inner join proveedores pro on p.cod_servicio=s.cod_servicio and
    p.IdProveedor=pro.IdProveedor;");
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">


              <div class="card-header">
                <h3 class="card-title">Tabla de productos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Precio x Paquete</th>
                      <th>Unidades x Paquete</th>
                      <th>Stock</th>
                      <th>Foto</th>
                      <th>Imágenes</th>
                      <th>Modificar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($sql)) {
                      echo "<tr>";
                      $productosid = $row[0];
                      echo "<td>" . $row[1] . "</td>";
                      echo "<td>s/" . $row[2] . "</td>";
                      echo "<td>" . $row[3] . "</td>";
                      echo "<td>" . $row[4] . "</td>";
                      echo "<td>" . $row[5] . "</td>";
                             // decodificar base 64
                             $foto = base64_encode($row[6]);
                             if ($foto == "") {
                                 echo "<td height='50'>No Disponible</td>";
                             } else {
                                 echo "<td height='50'><img src='data:image/jpeg;base64,$foto' width='50'height='50'></td>";
                             }
                        
                    ?>
                     <!-- Button trigger modal -->
                     <td><button type="button" class="btn btn-primary note-icon-pencil" data-toggle="modal" data-target="#exampleModal" onclick="productosDetalle('<?php echo $productosid ?>'); return false"> Imágenes</button></td>
                      <!-- Button trigger modal -->
                      <td><button type="button" class="btn btn-primary note-icon-pencil" data-toggle="modal" data-target="#exampleModal" onclick="productosSelectOne('<?php echo $productosid ?>'); productosEditar();  return false"></button></td>
                      <!-- <button class="note-icon-pencil" ></button> -->
                      <td><button class="btn btn-danger note-icon-trash" onclick="productosDelete('<?php echo $productosid ?>');  return false"></button></td>
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

  <?php
  }
  public function productosDelete($codigo)
  {
    //registra los datos del empleados
    $sql = "DELETE FROM productos where idproducto='$codigo';";
    if (mysqli_query($this->open(), $sql)) {
    } else {
    }
    $this->productosSelect();
  }
  public function productosInsert($nombre, $preciounitario, $preciopaquete, $unidadesporpaquete, $unidadesenstock, $servicio, $proveedor,$descripcion,$foto)
  {
    //registra los datos del productos
    $sql = "INSERT INTO productos (nombreproducto,preciounitario,preciopaquete,unidadesporpaquete,unidadesenstock,cod_servicio,idproveedor,descripcion,foto) VALUES ('$nombre',$preciounitario,$preciopaquete,$unidadesporpaquete,$unidadesenstock,'$servicio','$proveedor','$descripcion','$foto')";
  

 mysqli_query($this->open(), $sql) or die('Error. ' . mysqli_error($sql));
    $this->productosSelect();
  }
  public function productosSelectOne($codigo)
  {
    $sql = mysqli_query($this->open(), "SELECT p.IdProducto, p.NombreProducto,p.PrecioUnitario,p.preciopaquete,p.unidadesporpaquete,p.UnidadesEnStock,s.cod_servicio,p.IdProveedor,p.descripcion,p.foto from
    productos p inner join servicio s inner join proveedores pro on p.cod_servicio=s.cod_servicio and
    p.IdProveedor=pro.IdProveedor where idProducto ='$codigo'");
    $r = mysqli_fetch_assoc($sql);
    $codigo = $r["IdProducto"];
    $nombre = $r["NombreProducto"];
    $preciounitario = $r["PrecioUnitario"];
    $preciopaquete = $r["preciopaquete"];
    $unidadesporpaquete = $r["unidadesporpaquete"];
    $unidadesenstock = $r["UnidadesEnStock"];
    $servicio = $r["cod_servicio"];
    $proveedor = $r["IdProveedor"];
    $descripcion = $r["descripcion"];
    $foto = base64_encode($r["foto"]);
    echo "<script>
      productos.codigo.value='$codigo';
      productos.nombre.value='$nombre';
      productos.preciounitario.value='$preciounitario';
      productos.preciopaquete.value='$preciopaquete';
      productos.unidadesporpaquete.value='$unidadesporpaquete';
      productos.unidadesenstock.value='$unidadesenstock';
      productos.servicio.value='$servicio';
      productos.proveedor.value='$proveedor';
      productos.descripcion.value='$descripcion';
      productos.fotografia.src='data:image/jpeg;base64,$foto';
      </script>";
    $this->productosSelect();
  }
  public function productosUpdate($codigo, $nombre, $preciounitario, $preciopaquete, $unidadesporpaquete, $unidadesenstock, $servicio, $proveedor,$descripcion,$foto)
  {
    $sql = "UPDATE productos set nombreproducto='$nombre' ,preciounitario='$preciounitario',preciopaquete='$preciopaquete',unidadesporpaquete='$unidadesporpaquete',unidadesenstock='$unidadesenstock',
cod_servicio='$servicio',idproveedor='$proveedor' ,descripcion='$descripcion',foto='$foto' where idproducto='$codigo'";
    mysqli_query($this->open(), $sql) or die('Error. ' . mysqli_error($sql));
    echo "<script>	
    productos.codigo.value='$codigo';
    productos.nombre.value='$nombre';
    productos.preciounitario.value='$preciounitario';
    productos.preciopaquete.value='$preciopaquete';
    productos.unidadesporpaquete.value='$unidadesporpaquete';
    productos.unidadesenstock.value='$unidadesenstock';
    productos.servicio.value='$servicio';
    productos.proveedor.value='$proveedor';
    productos.descripcion.value='$descripcion';
    productos.fotografia.src='data:image/jpeg;base64,$foto';
        </script>";
    $this->productosSelect();
  }
  public function productosDetalle($codigo)
  {
     $_SESSION["productos"] = $codigo;
     echo "<script>	window.location.href='admin_productosdetalle.php';</script>";
  }

  public function productosSelect2()
  {
    $sql = mysqli_query($this->open(), "SELECT idproducto,nombreproducto,descripcion,foto from productos;");

    echo "<div class='row'>";
    while ($row = mysqli_fetch_array($sql)) {
      $codigo=$row[0];
      $descripcion = $row[1];
      $detalle = $row[2];
      // decodificar base 64
      $foto = base64_encode($row[3]);

      echo "
      <div class='card text-black col-lg-4 col-md-6 '><p></p> ";
?>
 
      <a href='#'onclick="elegirProductos('<?php echo $codigo?>');">
      <?php
 echo "     <h5 class='card-title'>$descripcion</h5>";
      
      if ($foto == "") {
        echo "No disponible";
      } else {
        echo "<img src='data:image/jpeg;base64,$foto'class='card-img-top' height='230'>";
      }
    echo "<div class='card'>
       
        <p class='card-text text-black'>$detalle.</p>
      </div>
      </a>
      </div>
     
      ";
    }
  ?>

    </div>

<?php

  }

}

$productos = new productos();
if ($metodo == "delete") {
  $productos->productosDelete($codigo);
} elseif ($metodo == "insert") {
  $productos->productosInsert($nombre, $preciounitario, $preciopaquete, $unidadesporpaquete, $unidadesenstock, $servicio, $proveedor,$descripcion,$foto);
} elseif ($metodo == "select") {
  $productos->productosSelectOne($codigo);
} elseif ($metodo == "update") {
  $productos->productosUpdate($codigo, $nombre, $preciounitario, $preciopaquete, $unidadesporpaquete, $unidadesenstock, $servicio, $proveedor,$descripcion,$foto);
}
elseif ($metodo == "detalle") {
  $productos->productosDetalle($codigo);
}