<?php
echo'<div id="gdocu_'.$fila_anuncio["id_anuncio"].'" class="modal fade" role="dialog">
 <div class="modal-dialog">

   <!-- Modal content-->
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Gestor Documental </h4>
      <p class="text-right"><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=DOC&idpac='.$filap["id_paciente"].'&idadm='.$fila_adm['id_adm_hosp'].'&doc='.$filap["doc_pac"].'&servicio='.$_REQUEST["servicio"].'"><button type="button" class="btn btn-success"><span class="fa fa-file-text"></span>Cargar documento Nuevo</button></a></p>
     </div>
     <div class="modal-body">';
     $id=$fila_anuncio['id_anuncio'];
        $sql_doc="SELECT id_soport_anuncio,nombre_doc,foto,fcargue FROM soporte_anuncio
                        WHERE id_anuncio=$id";
        if ($tabla_doc=$bd1->sub_tuplas($sql_doc)){
          foreach ($tabla_doc as $fila_doc ) {
            echo'<section class="panel-body">';
              echo'<article class="col-md-12 ">';
                echo'<p><strong>Fecha Registro: </strong>'.$fila_doc['fcargue'].'</p>';
                echo'<p><strong>Nombre: </strong>'.$fila_doc['nombre_doc'].'</p>';
                echo'<p><a href="'.$fila_doc['foto'].'"><button type="button" class="btn btn-info btn-md" ><span class="fa fa-file-pdf-o"></span> </button></a>
                       <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=XDOC&idadm='.$fila_anuncio['id_anuncio'].'">
              <button type="button" class="btn btn-danger" ><span class="fa fa-times-circle"></span>	</button></a></p>';
              echo'</article>';
            echo'</section>';
          }
        }
     echo'</div>
     <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </div>
   </div>

 </div>
</div>';
 ?>
