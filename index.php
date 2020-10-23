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
          </form>
        </select>
      </section>
    </nav>
  </header>
    <section class="section1_categorias">
    <?php
        require_once("clases/categorias.php");
        $estado = 1;
        $sql = "select nombre_categoria from categorias where id = 1";
        $categorias = new categoria();
        $categoria = $categorias->consultar_categorias($sql);

        if(array_key_exists('ConsultarFiltro', $_POST)) {
          $filtros = new categoria();
          $categoria = $filtros->consultar_filtros($_REQUEST["campos"], $_REQUEST["valor"]);
          var_dump($categoria);
        }
        
        echo "<div class='section2_subcategorias'>";
        echo "<br><br>";
        print ("<TABLE>\n");
        print ("<TR>\n");
        print ("<TH>Sub-categoria</TH>\n");
        print ("<TH>Título</TH>\n");
        print ("<TH>Descripción</TH>\n");
        print ("</TR>\n");
        foreach ($categoria as $resp) {
          print ("<TR>\n");
          print ("<TD>" . $resp['nombre_subcategoria'] . "<TD>\n");
          print ("<TD>" . $resp['titulo_anuncio'] . "<TD>\n");
          print ("<TD>" . $resp['descripcion'] . "<TD>\n");
          print ("</TR>\n");
        }
        print ("</TABLE>\n");
        echo "</div>";


        // echo "<h1>";
        // print($categoria[0]["nombre_categoria"]);
        // echo "</h1>";

        echo "<div class='section2_subcategorias'>";
        if($estado = 1) {
          $sql2 = "select nombre_subcategoria from sub_categorias where id_categorias = 1";
          $subcategorias = new categoria();
          $subcategoria = $subcategorias->consultar_sub_categorias($sql2);
          $filas = count($subcategoria);
          echo "<br><br>";
          foreach ($subcategoria as $resultado) {
            echo "<ul>";
              echo "<li>" . $resultado["nombre_subcategoria"] . "</li><br>";
            echo "</ul>";
          }
        echo "</div>";
        }
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