<?php
switch ($cod) {
  // en caso de aripiprazol
  case 193:
    if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F314' || $dx == 'F315' || $dx == 'F316'
        || $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
      echo'<p class="text-success"><strong>POS por dx</strong> </p>';
      $mipres1=0;
    }else {
      echo'<p class="text-danger"><strong>NO POS</strong></p>';
      $rad=$fila['rad_mipres'];
      if ($rad=='') {
        echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
      }else {
        echo'<p class="text-success">'.$rad.'</p>
             <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
      }
    }
  break;
  case 194:
    if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F314' || $dx == 'F315' || $dx == 'F316'
        || $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
      echo'<p class="text-success"><strong>POS por dx</strong> </p>';
      $mipres1=0;
    }else {
      echo'<p class="text-danger"><strong>NO POS</strong></p>';
      $rad=$fila['rad_mipres'];
      if ($rad=='') {
        echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
      }else {
        echo'<p class="text-success">'.$rad.'</p>
             <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
      }
    }
  break;
  // en caso de AZITROMICINA
  case 231:
    if ($dx == 'J128' || $dx == 'J129' || $dx == 'J13X' || $dx == 'J14X' || $dx == 'J151' || $dx == 'J152' ||
        $dx == 'J153' || $dx == 'J154' || $dx == 'J155' || $dx == 'J156' || $dx == 'J157' || $dx == '158 '|| $dx == '159 '||
        $dx == 'J160' || $dx == 'J168' || $dx == 'J170' || $dx == 'P230' || $dx == 'P231' || $dx == 'P232' || $dx == 'P233' ||
        $dx == 'P234' || $dx == 'P235' || $dx == 'P236' || $dx == 'P237' || $dx == 'P238' || $dx == 'P239') {
      echo'<p class="text-success"><strong>POS por dx</strong> </p>';
      $mipres1=0;
    }else {
      echo'<p class="text-danger"><strong>NO POS</strong></p>';
      $rad=$fila['rad_mipres'];
      if ($rad=='') {
        echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
      }else {
        echo'<p class="text-success">'.$rad.'</p>
             <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
      }
    }
  break;
  case 232:
    if ($dx == 'J128' || $dx == 'J129' || $dx == 'J13X' || $dx == 'J14X' || $dx == 'J151' || $dx == 'J152' ||
        $dx == 'J153' || $dx == 'J154' || $dx == 'J155' || $dx == 'J156' || $dx == 'J157' || $dx == 'J158'|| $dx == 'J159'||
        $dx == 'J160' || $dx == 'J168' || $dx == 'J170' || $dx == 'P230' || $dx == 'P231' || $dx == 'P232' || $dx == 'P233' ||
        $dx == 'P234' || $dx == 'P235' || $dx == 'P236' || $dx == 'P237' || $dx == 'P238' || $dx == 'P239') {
      echo'<p class="text-success"><strong>POS por dx</strong> </p>';
      $mipres1=0;
    }else {
      echo'<p class="text-danger"><strong>NO POS</strong></p>';
      $rad=$fila['rad_mipres'];
      if ($rad=='') {
        echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
      }else {
        echo'<p class="text-success">'.$rad.'</p>
             <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
      }
    }
  break;
 // en caso de fluvoxamina
 case 851:
   if ($dx == 'F321' || $dx == 'F321' || $dx == 'F322' || $dx == 'F323' || $dx == 'F428' || $dx == 'F429') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 // en caso de Lacosamida, LAMOTRIGINA y LEVETIRACETAM
 case 1069:
   if ($dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1083:
   if ($dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1084:
   if ($dx == 'F321' || $dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1084:
   if ($dx == 'F321' || $dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1085:
   if ($dx == 'F321' || $dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1086:
   if ($dx == 'F321' || $dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1087:
   if ($dx == 'F321' || $dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1100:
   if ($dx == 'F321' || $dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1101:
   if ($dx == 'F321' || $dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1102:
   if ($dx == 'F321' || $dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1103:
   if ($dx == 'F321' || $dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1104:
   if ($dx == 'F321' || $dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1105:
   if ($dx == 'F321' || $dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;

 case 1416:
   if ($dx == 'F321' || $dx == 'F322' || $dx == 'F323' || $dx == 'F331' || $dx == 'F332'|| $dx == 'F333') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1371:
   if ($dx == 'F321' || $dx == 'F322' || $dx == 'F323' || $dx == 'F331' || $dx == 'F332'|| $dx == 'F333') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1372:
   if ($dx == 'F321' || $dx == 'F322' || $dx == 'F323' || $dx == 'F331' || $dx == 'F332'|| $dx == 'F333') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 case 1525:
   if ($dx == 'F321' || $dx == 'F322' || $dx == 'F323' || $dx == 'F331' || $dx == 'F332'|| $dx == 'F333'|| $dx == 'F320') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
 // en caso de memantina
 case 1184:
 if ($dx == 'G300' || $dx == 'G301' || $dx == 'G308' || $dx == 'G309') {
   echo'<p class="text-success"><strong>POS por dx</strong> </p>';
   $mipres1=0;
 }else {
   echo'<p class="text-danger"><strong>NO POS</strong></p>';
   $rad=$fila['rad_mipres'];
   if ($rad=='') {
     echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
   }else {
     echo'<p class="text-success">'.$rad.'</p>
          <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
   }
 }
 break;
 case 1185:
 if ($dx == 'G300' || $dx == 'G301' || $dx == 'G308' || $dx == 'G309') {
   echo'<p class="text-success"><strong>POS por dx</strong> </p>';
   $mipres1=0;
 }else {
   echo'<p class="text-danger"><strong>NO POS</strong></p>';
   $rad=$fila['rad_mipres'];
   if ($rad=='') {
     echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
   }else {
     echo'<p class="text-success">'.$rad.'</p>
          <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
   }
 }
 break;
 case 1186:
 if ($dx == 'G300' || $dx == 'G301' || $dx == 'G308' || $dx == 'G309') {
   echo'<p class="text-success"><strong>POS por dx</strong> </p>';
   $mipres1=0;
 }else {
   echo'<p class="text-danger"><strong>NO POS</strong></p>';
   $rad=$fila['rad_mipres'];
   if ($rad=='') {
     echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
   }else {
     echo'<p class="text-success">'.$rad.'</p>
          <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
   }
 }
 break;

 case 1187:
if ($dx == 'G300' || $dx == 'G301' || $dx == 'G308' || $dx == 'G309') {
   echo'<p class="text-success"><strong>POS por dx</strong> </p>';
   $mipres1=0;
 }else {
   echo'<p class="text-danger"><strong>NO POS</strong></p>';
   $rad=$fila['rad_mipres'];
   if ($rad=='') {
     echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
   }else {
     echo'<p class="text-success">'.$rad.'</p>
          <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
   }
 }
 break;
 case 1188:
   if ($dx == 'G300' || $dx == 'G301' || $dx == 'G308' || $dx == 'G309') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }else {
     echo'<p class="text-danger"><strong>NO POS</strong></p>';
     $rad=$fila['rad_mipres'];
     if ($rad=='') {
       echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
     }else {
       echo'<p class="text-success">'.$rad.'</p>
            <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
     }
   }
 break;
// en caso de olanzapina
case 1348:
  if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
      $dx == 'F317' || $dx == 'F318' || $dx == 'F319'|| $dx=='F200' || $dx=='F201' || $dx=='F202' || $dx=='F203' || $dx=='F204' || $dx=='F205' ||
      $dx=='F206' || $dx=='F207' || $dx=='F208' || $dx=='F209') {
    echo'<p class="text-success"><strong>POS por dx</strong> </p>';
    $mipres1=0;
  }else {
    echo'<p class="text-danger"><strong>NO POS</strong></p>';
    $rad=$fila['rad_mipres'];
    if ($rad=='') {
      echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
    }else {
      echo'<p class="text-success">'.$rad.'</p>
           <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
    }
  }
break;
case 1349:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319'|| $dx=='F200' || $dx=='F201' || $dx=='F202' || $dx=='F203' || $dx=='F204' || $dx=='F205' ||
    $dx=='F206' || $dx=='F207' || $dx=='F208' || $dx=='F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
case 1351:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319' || $dx=='F200' || $dx=='F201' || $dx=='F202' || $dx=='F203' || $dx=='F204' || $dx=='F205' ||
    $dx=='F206' || $dx=='F207' || $dx=='F208' || $dx=='F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
// en caso de Quetiapina
case 1498:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
case 1499:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
case 1500:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
case 1501:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
case 1503:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
// en caso de risperidona
case 1526:
if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
    $dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
case 1527:
if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
    $dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
case 1529:
if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
    $dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
case 1530:
if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
    $dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
case 1531:
if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
    $dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
case 1532:
if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
    $dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
case 1526:
if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
    $dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}else {
  echo'<p class="text-danger"><strong>NO POS</strong></p>';
  $rad=$fila['rad_mipres'];
  if ($rad=='') {
    echo'<p><a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a></p>';
  }else {
    echo'<p class="text-success">'.$rad.'</p>
         <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  }
}
break;
 default:

 echo'<p class="text-danger">
       <a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=UPT&idma='.$fila["id_m_fmedhosp"].'
                &idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&atencion='.$_REQUEST['atencion'].'&sede='.$_REQUEST['sede'].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'">
        <button type="button" class="btn btn-warning sombra_movil" ><span class="fa fa-edit"></span> Editar <br>Medicamento</button></a>
       </p>';
 echo'<p class="text-danger"><strong>NO POS </strong></p>';

 $rad=$fila['rad_mipres'];
 if ($rad=='') {
   echo'<a href="'.PROGRAMA.'?opcion='.$_REQUEST["opcion"].'&mante=MIPRES&idma='.$fila["id_m_fmedhosp"].'&idm='.$fila["id_d_fmedhosp"].'&idadmhosp='.$fila["id_adm_hosp"].'&doc='.$doc.'&servicio='.$fila['tipo_servicio'].'&tf='.$_REQUEST['tf'].'"><button type="button" class="btn btn-success btn-xs" ><span class="fa fa-play-circle"></span> <br>MIPRES</button></a>';
 }else {
   echo'<p class="text-success">'.$rad.'</p>
        <a href="../'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
 }
 break;
}
 ?>
