<section class="panel panel-default bg-section">
  <section class="panel-heading">
    <h1 class="display-5 animated zoomIn">Hola, <?php echo $_SESSION['AUT']['nombre'] ?></h1>
    <h3>Aqui puedes realizar Consulta de profesionales activos, Creación de anuncios y upload de capacitaciones.</h3>
  </section>
  <section class="panel-body">
    <article class="col-md-4 col-sm-12">
      <button data-toggle="collapse" class="btn btn-info btn-lg text-center" data-target="#lista_profesionales"><span class="fa fa-user-md fa-4x"></span><br> Profesionales activos</button>
    </article>
    <article class="col-md-4  col-sm-12">
      <?php
      echo'<a href="'.PROGRAMA.'?opcion=196"><button type="button" class="btn btn-success btn-lg" ><span class="fa fa-newspaper fa-4x"></span><br> Crear Anuncio </button></a>';
       ?>
    </article>
    <article class="col-md-4  col-sm-12">
      <?php
      echo'<a href="'.PROGRAMA.'?opcion=197"><button type="button" class="btn btn-danger btn-lg" ><span class="fa fa-thumbs-down fa-4x"></span><br> NO Like </button></a>';
       ?>
    </article>
  </section>
</section>
