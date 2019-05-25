<?php
switch ($cod) {
  // en caso de lamotrigina
  case 1069:
    if ($dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
      echo'<p class="text-success"><strong>POS por dx</strong> </p>';
      $mipres1=0;
    }
  break;
  case 1083:
    if ($dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
      echo'<p class="text-success"><strong>POS por dx</strong> </p>';
      $mipres1=0;
    }
  break;
  case 1084:
    if ($dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
      echo'<p class="text-success"><strong>POS por dx</strong> </p>';
      $mipres1=0;
    }
  break;
  case 1085:
    if ($dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
      echo'<p class="text-success"><strong>POS por dx</strong> </p>';
      $mipres1=0;
    }
  break;
  case 1086:
    if ($dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
      echo'<p class="text-success"><strong>POS por dx</strong> </p>';
      $mipres1=0;
    }
  break;
  case 1087:
    if ($dx == 'G400' || $dx == 'G401' || $dx == 'G402' || $dx == 'G403' || $dx == 'G404' || $dx == 'G408' || $dx == 'G409') {
      echo'<p class="text-success"><strong>POS por dx</strong> </p>';
      $mipres1=0;
    }
  break;
 // en caso de fluvoxamina, paroxetina,escitalopram y aripiprazol
 case 851:
   if ($dx == 'F321' || $dx == 'F322' || $dx == 'F323' || $dx == 'F331' || $dx == 'F332'|| $dx == 'F333') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }
 break;
 case 1416:
   if ($dx == 'F321' || $dx == 'F322' || $dx == 'F323' || $dx == 'F331' || $dx == 'F332'|| $dx == 'F333') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }
 break;
 case 1371:
   if ($dx == 'F321' || $dx == 'F322' || $dx == 'F323' || $dx == 'F331' || $dx == 'F332'|| $dx == 'F333') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }
 break;
 case 1372:
   if ($dx == 'F321' || $dx == 'F322' || $dx == 'F323' || $dx == 'F331' || $dx == 'F332'|| $dx == 'F333') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }
 break;
 case 1525:
   if ($dx == 'F321' || $dx == 'F322' || $dx == 'F323' || $dx == 'F331' || $dx == 'F332'|| $dx == 'F333'|| $dx == 'F320') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }
 break;
 // en caso de memantina
 case 1184:
 if ($dx == 'F000' || $dx == 'F001' || $dx == 'F002' || $dx == 'F003' || $dx == 'F004'|| $dx == 'F005'|| $dx == 'F006' ||
     $dx == 'F007' || $dx == 'F008' || $dx == 'F009') {
   echo'<p class="text-success"><strong>POS por dx</strong> </p>';
   $mipres1=0;
 }
 break;
 case 1185:
 if ($dx == 'F000' || $dx == 'F001' || $dx == 'F002' || $dx == 'F003' || $dx == 'F004'|| $dx == 'F005'|| $dx == 'F006' ||
     $dx == 'F007' || $dx == 'F008' || $dx == 'F009') {
   echo'<p class="text-success"><strong>POS por dx</strong> </p>';
   $mipres1=0;
 }
 break;
 case 1186:
 if ($dx == 'F000' || $dx == 'F001' || $dx == 'F002' || $dx == 'F003' || $dx == 'F004'|| $dx == 'F005'|| $dx == 'F006' ||
     $dx == 'F007' || $dx == 'F008' || $dx == 'F009') {
   echo'<p class="text-success"><strong>POS por dx</strong> </p>';
   $mipres1=0;
 }
 break;
 case 1187:
 if ($dx == 'F000' || $dx == 'F001' || $dx == 'F002' || $dx == 'F003' || $dx == 'F004'|| $dx == 'F005'|| $dx == 'F006' ||
     $dx == 'F007' || $dx == 'F008' || $dx == 'F009') {
   echo'<p class="text-success"><strong>POS por dx</strong> </p>';
   $mipres1=0;
 }
 break;
 case 1188:
   if ($dx == 'F000' || $dx == 'F001' || $dx == 'F002' || $dx == 'F003' || $dx == 'F004'|| $dx == 'F005'|| $dx == 'F006' ||
       $dx == 'F007' || $dx == 'F008' || $dx == 'F009') {
     echo'<p class="text-success"><strong>POS por dx</strong> </p>';
     $mipres1=0;
   }
 break;
// en caso de olanzapina
case 1348:
  if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
      $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
    echo'<p class="text-success"><strong>POS por dx</strong> </p>';
    $mipres1=0;
  }
break;
case 1349:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}
break;
case 1351:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}
break;
// en caso de Quetiapina
case 1498:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}
break;
case 1499:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}
break;
case 1500:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}
break;
case 1501:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}
break;
case 1503:
if ($dx == 'F310' || $dx == 'F311' || $dx == 'F312' || $dx == 'F313' || $dx == 'F314'|| $dx == 'F315'|| $dx == 'F316' ||
    $dx == 'F317' || $dx == 'F318' || $dx == 'F319') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}
break;
// en caso de risperidona
case 1526:
if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
    $dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}
break;
case 1527:
if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
    $dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}
break;
case 1529:
if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
    $dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}
break;
case 1530:
if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
    $dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}
break;
case 1531:
if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
    $dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}
break;
case 1532:
if ($dx == 'F200' || $dx == 'F201' || $dx == 'F202' || $dx == 'F203' || $dx == 'F204' ||
    $dx == 'F205' || $dx == 'F206' || $dx == 'F207' || $dx == 'F208' || $dx == 'F209') {
  echo'<p class="text-success"><strong>POS por dx</strong> </p>';
  $mipres1=0;
}
break;

 default:

 echo'<p class="text-danger"><strong>NO POS </strong></p>';

 $rad=$fila['rad_mipres'];
 if ($rad=='') {
   echo'<p class="alert alert-danger">No se ha realizado MIPRES</p>';
   $mipres1=1;
 }else {
   echo'<p class="text-success">'.$rad.'</p>
        <a href="./'.$fila['soporte'].'" target="_blank"><button type="button" class="btn btn-info btn-xs" ><span class="fa fa-print"></span></button></a>';
  $mipres1=0;
 }
 break;
}
 ?>
