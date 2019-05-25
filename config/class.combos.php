<?php

class selects extends MySQL
{
	var $code = "";

	function cargarPaises()
	{
		$consulta = parent::consulta("SELECT coddep,descripdep FROM departamento ORDER BY coddep ASC");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$paises = array();
			while($pais = parent::fetch_assoc($consulta))
			{
				$code = $pais["coddep"];
				$name = $pais["descripdep"];
				$paises[$code]=$name;
			}
			return $paises;
		}
		else
		{
			return false;
		}
	}
	function cargarEstados()
	{
		$consulta = parent::consulta("SELECT codmuni,descrimuni FROM municipios WHERE coddep = '".$this->code."'");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$estados = array();
			while($estado = parent::fetch_assoc($consulta))
			{
				$code1 = $estado["codmuni"];
				$name = $estado["descrimuni"];
				$estados[$code1]=$name;
			}
			return $estados;
		}
		else
		{
			return false;
		}
	}
	function cargarips()
	{
		$consulta = parent::consulta("SELECT id_ips,nom_ips FROM ips ORDER BY id_ips ASC");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$paises = array();
			while($pais = parent::fetch_assoc($consulta))
			{
				$code = $pais["id_ips"];
				$name = $pais["nom_ips"];
				$paises[$code]=$name;
			}
			return $paises;
		}
		else
		{
			return false;
		}
	}
	function cargarsedes()
	{
		$consulta = parent::consulta("SELECT nom_sedes FROM sedes_ips WHERE id_ips = '".$this->code."'");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$estados = array();
			while($estado = parent::fetch_assoc($consulta))
			{
				$name = $estado["nom_sedes"];
				$estados[$name]=$name;
			}
			return $estados;
		}
		else
		{
			return false;
		}
	}

}

?>
