<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet">
  <title>Mil Anuncios</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
    <section class="index_header_section"></section>
    <nav class="index_header_nav">
      <section class="index_header_nav_section1">
        <a href="index.html">Mil Anuncios</a>
      </section>
      <section class="index_header_nav_section2">
        <form name="FromFiltro" method="post" action="index.php">
          <label>Filtar por:</label>
          <select name="campos">
            <option value="nombre_subcategoria" selected>Sub-Categoría</option>
            <option value="titulo_anuncio">Título</option>
            <option value="descripcion">Descripción</option>
            <label>Con el valor</label>
            <input type="text" name="valor">
            <input name="ConsultarFiltro" value="Filtrar Datos" type="submit"/>
            <input name="ConsultarTodos" value="Ver Todos" type="submit"/>
          </form>
        </select>
      </section>
    </nav>
  </header>

    <section>
      <?php
      require_once("clases/categorias.php");
      $categorias = new categoria();
      $sub_categoria = $categorias->consultar_sub_categorias();

      if(array_key_exists('ConsultarTodos', $_POST)) {
      $filtros = new categoria();
      $sub_categoria_new = $filtros->consultar_sub_categorias();
      }

      if(array_key_exists('ConsultarFiltro', $_POST)) {
        $filtros = new categoria();
        $sub_categoria = $filtros->consultar_filtros($_REQUEST['campos'], $_REQUEST['valor']);
      }

      $nfilas = count($sub_categoria);

      if($nfilas > 0) {
      echo "<div class='section_filtro'>";
      echo "<br><br>";
      print ("<table>\n");
      print ("<tr>\n");
      print ("<th>Sub-categoria</th>\n");
      print ("<th>Título</th>\n");
      print ("<th>Descripción</th>\n");
      print ("</tr>\n");

      foreach ($sub_categoria as $resp) {
        print ("<tr>\n");
        print ("<td>" . $resp['nombre_subcategoria'] . "</td>\n");
        print ("<td>" . $resp['titulo_anuncio'] . "</td>\n");
        print ("<td>" . $resp['descripcion'] . "</td>\n");
        print ("</tr>\n");
      }
      print ("</table>\n");
      echo "</div>";
      echo "<hr>";
    }
    ?>
    </section>

    <section class="section1_categorias"><!--class="section1_categorias"-->
    <?php
      require_once("clases/categorias.php");
      $categorias = new categoria();
      $categoria = $categorias->consultar_categorias();

      $tamano_paginas = 1;

      $pagina = 1;
      $paginasig = 1;
      if(isset($_GET['pagina'])) {
      $pagina = $_GET['pagina'];
      $paginasig = $_GET['pagina'];
      }

      $nfilas = count($categoria);
      $total_paginas = ceil($nfilas/$tamano_paginas);
      $desde = ($pagina-1) * $tamano_paginas;
      $hasta = $desde + $tamano_paginas;

      if ($hasta > $nfilas){
      $hasta = $nfilas;
      }

      
      $obj_categoria = new categoria();
      $categoria2 = $obj_categoria->consultar_categorias_paginas($desde, $tamano_paginas);
      
      echo "<h1>";
      print($categoria2[0]["nombre_categoria"].":");
      echo "</h1>";

      echo "<div class='section2_subcategorias'>";
      if($categoria2) {
        $id = $categoria2[0]["id"];
        $sql2 = "select nombre_subcategoria from sub_categorias where id_categorias = $id";
        $subcategorias = new categoria();
        $subcategoria = $subcategorias->consultar_sub_categorias2($sql2);
        if($subcategoria == NULL) {
          echo "<br><b>Esta categoría aún no tiene subcategorías</b>";
        } else {
          $filas = count($subcategoria);

          echo "<br>";
          foreach ($subcategoria as $resultado) {
            echo "<ul>";
              echo "<li><a href='#' style=color:#379FD0>" . $resultado["nombre_subcategoria"] . "</a></li><br>";
            echo "</ul>";
          }
        }
      echo "</div>";
      }
    ?>
    </section>

    <section class="section_paginacion">
      <?php
      echo"<label class='paginacion'>Número de anuncios encontrados: ".$nfilas."</label><br/>";
      echo"<label class='paginacion'>Mostrando número de página: <b>".$pagina. "</b> de ". $total_paginas."</label> [";

      if ($pagina > 1) {
        $pagina--;
        echo"<a href='?pagina=". $pagina . "'>Anterior</a> |";
      }elseif ($pagina = 1) {
        echo"<label>Anterior</label> |";
      }

      for ($i=1; $i<=$total_paginas; $i++){
        echo "<a href='?pagina=". $i . "'>" . $i . "</a>  ";
      }

      echo " |";
      
      if($paginasig < $total_paginas) {
        $siguiente = $paginasig + 1;
        echo"<a href='?pagina=". $siguiente . "'>Siguiente</a> ]";
      } elseif ($paginasig == $total_paginas) {
        echo"<label>Siguiente</label>]";
      }

      echo"<br><br>";
      ?>
    </section>

  <footer>
    <div class="index_footer_div">
      <div class="index_header_nav_div1">
        <p>Design by: Christian Gómez</p>
      </div>
    </div>
  </footer>
</body>
</html>