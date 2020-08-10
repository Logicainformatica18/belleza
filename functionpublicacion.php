<?php
if (!class_exists("connection")) {
  include("conexion.php");
}
//variables POST
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
$metodo = isset($_POST['metodo']) ? $_POST['metodo'] : "";

$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : "";
$pagina = str_replace(" ", "-", $pagina);
$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : "";
$post = isset($_POST['post']) ? $_POST['post'] : "";
//filtro




class publicacion extends connection
{
  public function publicacionSelect()
  {
    //consulta todos los empleados
    $sql = mysqli_query($this->open(), "SELECT * FROM publicacion;");
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">


                    <div class="card-header">
                        <h3 class="card-title">Tabla de Publicaciones</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="background-color:white">
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Título</th>
                                    <th>Ver blog</th>
                                    <th>Modificar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                    while ($row = mysqli_fetch_array($sql)) {
                      echo "<tr>";
                      $publicacionid = $row[0];
                      $pagina = str_replace(" ", "-", $row[1]);
                      echo "<td>" .  $publicacionid . "</td>";
                      echo "<td>" . $row[1] . "</td>";
                    ?>
                                <!-- Button trigger modal -->
                                <td><a href="blog/<?php echo $pagina . ".php" ?>" target="_blank"
                                        class="btn btn-danger">Ver</a></td>
                                <!-- Button trigger modal -->
                                <td><button type="button" class="btn btn-primary note-icon-pencil" data-toggle="modal"
                                        data-target="#exampleModal"
                                        onclick="publicacionSelectOne('<?php echo $publicacionid ?>');  return false"></button>
                                </td>
                                <!-- <button class="note-icon-pencil" ></button> -->
                                <td><button class="btn btn-danger  note-icon-trash"
                                        onclick="publicacionDelete('<?php echo $publicacionid ?>','<?php echo $row[4] ?>');  return false"></button>
                                </td>
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
  public function publicacionSelect2()
  {
    //consulta todos los empleados
    $sql = mysqli_query($this->open(), "SELECT cod_publicacion,titulo FROM publicacion;");
  ?>
<!-- Main content -->
<section class="content"style='background-color:white'>
    <div class="container-fluid">
        <div class="row">
            




                    <?php
                while ($row = mysqli_fetch_array($sql)) {
                  $pagina=str_replace(" ","-",$row[1]);
                  echo "<div class='col-md-6 col-sg-12'>
                          <div class='card'>
                            <div class='card-body'>
                              <div class='card-header'>"; 
                                echo  "<h3 class='card-title'><a target='_blank' href='blog/$pagina.php'>" .  $row[1] . "</a></h3>";
                                //  echo "<p class='card-text'>".$row[2]."...</p>"; 
                      echo "   </div>
                            </div>
                          </div>
                        </div>";
                }
                ?>

                
        </div>
    </div>
</section>
<!-- /.content -->
<?php
  }
  public function publicacionDelete($codigo, $pagina)
  {
    //registra los datos del empleados
    $sql = "DELETE FROM publicacion where cod_publicacion='$codigo';";
    if (mysqli_query($this->open(), $sql)) {
      unlink("blog/$pagina.php");
      echo "<script> alert('Eliminado Correctamente $pagina'); </script>";
    } else {
    }
    $this->publicacionSelect();
  }
  public function publicacionInsert($titulo, $post)
  {
    // reemplazar espacion por guiones del titulo
    $page = str_replace(" ", "-", $titulo);
    //registra los datos del publicacion
    $sql = "INSERT INTO publicacion (titulo,post,archivo,fec_reg) VALUES ('$titulo','$post','$titulo',now())";
    if (mysqli_query($this->open(), $sql)) {
      $titulo_post="<!DOCTYPE html>
      <html>
      <head>
          <meta charset='UTF-8'>
          <meta http-equiv='X-UA-Compatible' content='IE=edge'>
          <meta name='generator' content='Mobirise v4.12.4, mobirise.com'>
          <meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1'>
          <link rel='shortcut icon' href='../assets/images/mbr-1-184x242.png' type='image/x-icon'>
          <meta name='description' content='Web Site Builder Description'>
          <title>$page</title>";
      $php1 = "<?php include ('head.php') ?>";
$php2 = "<?php include ('footer.php') ?>";

$facebook_comment = "<div id='fb-root'></div>
<script async defer crossorigin='anonymous' src='https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v7.0'
    nonce='R392LXB9'></script>
<div class='fb-comments' data-href='$page.php' data-numposts='5' data-width='100%'></div>";
$facebook_compartir = "<div class='fb-like' data-href='$page.php' data-width='' data-layout='button_count'
    data-action='like' data-size='small' data-share='true'></div>";

$contenido =$titulo_post. $php1 . "<h1 class='titulo_post'>$titulo</h1>$facebook_compartir <p>$post</p>$facebook_comment" . $php2;

file_put_contents("blog/$page.php", $contenido);


echo "<script>
alert('Registrado Correctamente');
publicacionNuevo();
</script>";
} else {
die('Error. ' . mysqli_error($sql));
}

$this->publicacionSelect();
}
public function publicacionSelectOne($codigo)
{
//registra los datos del empleados
$sql = mysqli_query($this->open(), "SELECT * from publicacion where cod_publicacion ='$codigo'");
$r = mysqli_fetch_assoc($sql);
$codigo = $r["cod_publicacion"];
$titulo = $r["titulo"];
$post = $r["post"];
$_SESSION["post"]=$post;
echo "<script>

publicacion.codigo.value = '$codigo';
publicacion.titulo.value = '$titulo';
document.getElementById('post').innerHTML='$post';
</script>";

$this->publicacionSelect();
}

public function publicacionUpdate($codigo, $titulo, $post)
{
$sql = "UPDATE publicacion set titulo='$titulo',post='$post'where
cod_publicacion='$codigo'";
mysqli_query($this->open(), $sql) or die('Error. ' . mysqli_error($sql));
echo "<script>
publicacion.codigo.value = '$codigo';
publicacion.titulo.value = '$titulo';
document.getElementById('post').innerHTML='$post';
</script>";

//rename("blog/$titulo.php",);
$this->publicacionSelect();
}
}

$publicacion = new publicacion();
if ($metodo == "delete") {
$publicacion->publicacionDelete($codigo, $pagina);
} elseif ($metodo == "insert") {
$publicacion->publicacionInsert($titulo, $post);
} elseif ($metodo == "select") {
$publicacion->publicacionSelectOne($codigo);
} elseif ($metodo == "update") {
$publicacion->publicacionUpdate($codigo, $titulo, $post);
}