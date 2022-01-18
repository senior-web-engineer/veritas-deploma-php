<?php  
	//include 'constant.php';
	require_once('../core/libs_ext/fpdf/fpdf.php');
	//require_once('../core/libs_ext/fpdf/qrcode/qrcode.class.php');
	include_once '../core/config/init_ajax.php';

	class PDF_BON_COMMANDE extends FPDF
	{
		var $angle=0;
		/**
		 * Encodage du texte
		 * @param  string $txt le texte
		 * @return string le texte encodé
		 */
		function utf8($txt)
		{
			$encode='UTF-8';
			$type='windows-1252';
			return iconv($encode, $type, $txt);
		}

		function Footer()
		{
		    // Positionnement à 1,5 cm du bas
		    $this->SetY(-15);
		    // Police Arial italique 8
		    $this->SetFont('Arial','B',8);
		    // Numéro de page centré
		    $txt = "RCCM/GN.KAL.2018. B.086 091 au capital de 10.000.000 GNF / NIF : 692534506\nMatam-Bonfi en face de l’agence BICIGUI / Tél : +224 627 27 99 00 / @ : contact@sbs-gn.com";
		    $this->MultiCell(0,5, $this->utf8($txt),0,'C');
		}
		
	}