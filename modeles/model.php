<?php
class Model
{
    private $bdd;
    private $req;
	public function __construct( $bdd ) { $this->bdd = $bdd; }
	//SELECT col1[, col2…], fonction1Groupe(…)[,fonction2Groupe(…)…] FROM nomTable [ WHERE condition ]
    //GROUP BY {col1 | expr1 | position1} [,{col2... }]
    // [HAVING condition]
    //[ORDER BY {col1 | expr1 | position1} [ASC | DESC] [,{col1 ... }] ];
    public function selectData($table, $req)
    {
        $sql = 'SELECT ';
        // Pour permettre de preciser les champs
        if(isset($req['fields'])):
            if(is_array($req['fields'])):
                $sql .= implode(', ', $req['fields']);
            else:
                $sql .= $req['fields'];
            endif;
        else:
            $sql .= '*';
        endif;
        $sql .= ' FROM '.$table. ' ';
        //LEFT JOIN matiere_group ON matiere.matiere_group_id = matiere_group.id 
        /*if(isset($req['join']) && isset($req['tableJoin']) ):
            $sql .= 'LEFT JOIN '.$req['tableJoin']. ' ON '
        endif;*/
        // Construction de la condition
        if(isset($req['conditions'])):
            $sql .=' WHERE ';
            if(!is_array($req['conditions'])):
                $sql .=$req['conditions'];
            else:
                $cond = array();
                foreach($req['conditions'] as $k=>$v):
                    if(!is_numeric($v)):
                        $v = '"'.$v.'"';        
                    endif;
                    $cond[] = "$k=$v";
                endforeach; 
                $sql .= implode(' AND ', $cond);
            endif;
        endif;
        if(isset($req['conditions2'])):
            $sql .= $req['conditions2'];
        endif;
        // Group by
        if(isset($req['groupby'])):
            $sql .= ' GROUP BY '.$req['groupby']. ' ';
        endif;
        // Order by
        if(isset($req['orderby'])):
            $sql .= ' ORDER BY '.$req['orderby']. ' ';
        endif;
        // Limit
        if(isset($req['limit'])):
            $sql .=' LIMIT '.$req['limit'];
        endif;
        //print_r($sql);
        $this->req = $this->bdd->prepare($sql);
        $this->req->execute();        
        return $this->req->fetchAll();
    }

    public function countData($table,  $req){
        $sql = 'SELECT ';
        if(isset($req['fields'])):
            $sql .= $req['fields'];
        endif;
        $sql .= ' FROM '.$table. ' ';
        if(isset($req['conditions'])):
            $sql .=' WHERE ';
            if(!is_array($req['conditions'])):
                $sql .=$req['conditions'];
            else:
                $cond = [];
                foreach($req['conditions'] as $k=>$v):
                    if(!is_numeric($v)):
                        $v = '"'.$v.'"';        
                    endif;
                    $cond[] = "$k=$v";
                endforeach; 
                $sql .= implode(' AND ', $cond);
            endif;
        endif;
        if(isset($req['conditions2'])):
            $sql .=$req['conditions2'];
        endif;
        //print_r($sql);
        $this->req = $this->bdd->prepare( $sql );
        $this->req->execute();
        return $this->req->fetchColumn();
    }

    public function singleData($table, $req)
    {
        return current($this->selectData($table, $req));
    }

    public function saveData($table, $data) 
    {
        $fields = [];
        $d = [];
        if(isset($data['fields'])):
            foreach ($data['fields'] as $k => $v):
                $fields[] = " $k=:$k";
                $d[":$k"] = $v; 
            endforeach;
        endif;
        // Pour savoir si la clé primaire a été posté
        if(isset($data['conditions'])):
            $cond = array();
            foreach($data['conditions'] as $k=>$v):
                $cond[] = "$k=:$v";
                $d[":$v"] = $v; 
            endforeach; 
            $where = implode(' AND ', $cond);
        
           $sql = 'UPDATE '.$table.' SET '.implode(', ', $fields).' WHERE '.$where;
        else:
            $sql = 'INSERT INTO '.$table.' SET '.implode(', ', $fields);
        endif;

        print_r($sql);
        
        $this->req = $this->bdd->prepare($sql);
        $this->req->execute($d); 
    }

    public function delete($table, $req)
    {
        $sql = "DELETE FROM $table ";
        if(isset($req['conditions'])):
            $sql .=' WHERE ';
            if(!is_array($req['conditions'])):
                $sql .=$req['conditions'];
            else:
                $cond = [];
                foreach($req['conditions'] as $k=>$v):
                    if(!is_numeric($v)):
                        $v = '"'.$v.'"';        
                    endif;
                    $cond[] = "$k=$v";
                endforeach; 
                $sql .= implode(' AND ', $cond);
            endif;
        endif;
        //print_r($sql); die();
        $this->req = $this->bdd->prepare($sql);
        $this->req->execute(); 
        //$this->db->query($sql);
    }

    public function transfert($table_emetteur, $table_destinateur, $req)
    {
        $sql = 'INSERT INTO '.$table_destinateur.' SELECT * FROM '.$table_emetteur.' ';
        // Construction de la condition
        if(isset($req['conditions'])):
            $sql .=' WHERE ';
            if(!is_array($req['conditions'])):
                $sql .=$req['conditions'];
            else:
                $cond = [];
                foreach($req['conditions'] as $k=>$v):
                    if(!is_numeric($v)):
                        $v = '"'.$v.'"';        
                    endif;
                    $cond[] = "$k=$v";
                endforeach; 
                $sql .= implode(' AND ', $cond);
            endif;
        endif;
        //print_r($sql);
        $this->req = $this->bdd->prepare($sql);
        $this->req->execute();
    }

    public function getSearchBonCommande($champ, $data, $lim=0, $offset=50)
    {
        $sql = "SELECT * FROM sbs_commande_item WHERE $champ LIKE '%' :data '%' AND status IN ('encours','partielle') LIMIT :lim, :offset";
               
        $this->req = $this->bdd->prepare( $sql );
        $this->req->bindParam(':data', $data, PDO::PARAM_STR);
        $this->req->bindParam(':lim', $lim, PDO::PARAM_INT);
        $this->req->bindParam(':offset', $offset, PDO::PARAM_INT);
        $this->req->execute() or trigger_error( 'ERROR '.$sql.' '.print_r($this->req->errorInfo()), E_USER_ERROR);
        $result = ($offset == 1) ? $this->req->fetch() : $this->req->fetchAll();
        return $result;
    }
    public function getSearchBonCommandeByStationAndProduit($champ, $data, $champ1, $data1, $champ2, $data2, $lim=0, $offset=50)
    {
        $sql = "SELECT * FROM sbs_commande_item WHERE $champ LIKE '%' :data '%' AND $champ1 =:data1 AND $champ2 =:data2 AND status IN ('encours','partielle') LIMIT :lim, :offset";
               
        $this->req = $this->bdd->prepare( $sql );
        $this->req->bindParam(':data', $data, PDO::PARAM_STR);
        $this->req->bindParam(':data1', $data1, PDO::PARAM_STR);
        $this->req->bindParam(':data2', $data2, PDO::PARAM_STR);
        $this->req->bindParam(':lim', $lim, PDO::PARAM_INT);
        $this->req->bindParam(':offset', $offset, PDO::PARAM_INT);
        $this->req->execute() or trigger_error( 'ERROR '.$sql.' '.print_r($this->req->errorInfo()), E_USER_ERROR);
        $result = ($offset == 1) ? $this->req->fetch() : $this->req->fetchAll();
        return $result;
    }
    /**
     * Recherche par reference et par type (Station ou produit)
    */
    public function getSearchBonCommandeByType($champ, $data, $champ1, $data1, $lim=0, $offset=50)
    {
        $sql = "SELECT * FROM sbs_commande_item WHERE $champ LIKE '%' :data '%' AND $champ1 =:data1 AND status IN ('encours','partielle') LIMIT :lim, :offset";
               
        $this->req = $this->bdd->prepare( $sql );
        $this->req->bindParam(':data', $data, PDO::PARAM_STR);
        $this->req->bindParam(':data1', $data1, PDO::PARAM_STR);
        $this->req->bindParam(':lim', $lim, PDO::PARAM_INT);
        $this->req->bindParam(':offset', $offset, PDO::PARAM_INT);
        $this->req->execute() or trigger_error( 'ERROR '.$sql.' '.print_r($this->req->errorInfo()), E_USER_ERROR);
        $result = ($offset == 1) ? $this->req->fetch() : $this->req->fetchAll();
        return $result;
    }

    public function bon_de_commande($id, $commande, $client, $items, $fournisseur, $count, $sign_users)
    {
        $pdf = new PDF_BON_COMMANDE('P','mm','A4');
        $pdf->SetMargins(5,5,5);
        $pdf->AddPage();
        // Recapitulatif
        $pdf->Image('../assets/images/logo.png',30,30,-150);
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(30, 70); $pdf->Cell(20, 10, 'DATE : ', 0, 0, 'L'); 
        $pdf->Cell(20, 10, explode('-', $commande['commande_at'])[2].'/'.explode('-', $commande['commande_at'])[1].'/'.explode('-', $commande['commande_at'])[0] , 0, 0, 'C'); 
        $pdf->SetXY(30, 80); $pdf->Cell(20, 10, 'CLIENT : ', 0, 0, 'L'); $pdf->Cell(20, 10, 'S.B.S '.$client['nom'], 0, 0, 'C'); 
        $tcx = ($count > 1)?'BORDEREAUX RECAPITULATIFS ':'BORDEREAU RECAPITULATIF ';
        $pdf->SetFont('Arial','B',15);
        $pdf->SetXY(0, 90); $pdf->Cell(0, 10, $tcx, 0, 0, 'C');
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(10, 100); 
        $pdf->Cell(10, 10, $pdf->utf8('N°') ,1, 0, 'C');
        $pdf->Cell(26, 10, $pdf->utf8('Référence') ,1, 0, 'C');
        $pdf->Cell(33, 10, $pdf->utf8('Destinations') ,1, 0, 'C');
        $pdf->Cell(22, 10, $pdf->utf8('Camions') ,1, 0, 'C');
        $pdf->Cell(24, 10, $pdf->utf8('Quantité') ,1, 0, 'C');
        $pdf->Cell(20, 10, $pdf->utf8('Produits') ,1, 0, 'C');
        $pdf->Cell(25, 10, $pdf->utf8('Prix Unitaire') ,1, 0, 'C');
        $pdf->Cell(30, 10, $pdf->utf8('Montant') ,1, 0, 'C'); $pdf->ln();
        $pdf->SetFont('Arial','',8);
        $camion = self::singleData(PREFIX.'camions', ['conditions'=>['id'=>$commande['camions']]]);
        $i = 1; $sumQty = 0; $sumMont = 0;
        foreach($items as $item):
            $station = self::singleData(PREFIX.'stations', ['conditions'=>['id'=>$item['stations']]]);
            $pdf->SetX(10); 
            $pdf->Cell(10, 15, $i++ ,1, 0, 'C');
            $pdf->Cell(26 , 15, $pdf->utf8(strtoupper($item['ref'])),1, 0, 'C');
            $pdf->Cell(33 , 15, $pdf->utf8(strtoupper($station['nom'])),1, 0, 'C');
            $pdf->Cell(22 , 15, $pdf->utf8(strtoupper($camion['immatriculation'])),1, 0, 'C');
            $pdf->Cell(24 , 15, number_format($item['qty'],'0','.',' ') ,1, 0, 'C');
            $pdf->Cell(20 , 15, $pdf->utf8(ucfirst($item['produit'])),1, 0, 'C');
            $pdf->Cell(25 , 15, number_format($client['prix_achat'],'0','.',' ') .' GNF',1, 0, 'C');
            $pdf->Cell(30 , 15, number_format($item['qty']*$client['prix_achat'], '0','.',' ').' GNF',1, 0, 'C'); $pdf->ln();
            $sumQty = $sumQty + $item['qty'];
            $sumMont = $sumMont + ($item['qty']*$client['prix_achat']);
        endforeach;
        $pdf->SetFont('Arial','B',8);
        $pdf->SetX(10); $pdf->Cell(91, 6, $pdf->utf8('TOTAL') ,1, 0, 'C');
        $pdf->Cell(24, 6, number_format($sumQty, '0','.',' ') ,1, 0, 'C');
        $pdf->Cell(20, 6, ' ',1, 0, 'C');
        $pdf->Cell(25, 6, ' ',1, 0, 'C');
        $pdf->Cell(30, 6, number_format($sumMont, '0','.',' ').' GNF', 1, 0, 'C');  $pdf->ln();
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(0, $pdf->GetY()+10); $pdf->Cell(0, 10, '', 0, 0, 'C');
        //$pdf->Image('../assets/images/cachet.png',$pdf->GetX()-75, $pdf->GetY()-4, -300);
        if($sign_users !='' OR $sign_users != null):
            $path = '../assets/images/sign/'.$sign_users.'.png';
            if(file_exists($path)):
                $pdf->Image($path ,$pdf->GetX()-80, $pdf->GetY()-4, -300);
            endif;
        endif;
        $pdf->Image('../assets/images/cachet.png',$pdf->GetX()-50, $pdf->GetY(), -300);
        // Bon de commande par reference
        $nb_page = $count;  
        $num = 1;  $limit_inf = 0; $limit_sup = 1;
        while($num <= $nb_page) 
        {   
            $pdf->AddPage();
            $pdf->Image('../assets/images/logo.png',30,30,-200);
            $pdf->SetFont('Arial','I',7);
            $pdf->SetXY(30,42); 
            $pdf->SetFont('Arial','BI',10);
            $pdf->SetXY(75, $pdf->GetY()+20); 
            $pdf->Cell(50, 10, 'Fournisseur :', 0, 0, 'C'); $pdf->Cell(10, 10, strtoupper($fournisseur['nom']) , 0, 0, 'C'); 
            $pdf->SetFont('Arial','',7);
            $pdf->SetXY(27, $pdf->GetY()-17); 
            $pdf->Cell(20, 10, 'Date : ', 0, 0, 'L'); $pdf->Cell(20, 10, $commande['commande_at'], 0, 0, 'C'); 
            $pdf->SetFont('Arial','B',7);
            $pdf->SetXY(27, $pdf->GetY()+30); 
            $pdf->Cell(20, 10, 'OBJET :', 0, 0, 'L'); $pdf->Cell(10, 10, strtoupper($commande['objet']) , 0, 0, 'C'); 
            $pdf->SetFont('Arial','',7);
            $pdf->SetXY(27, $pdf->GetY()+10); 
            $pdf->Cell(20, 10, 'CLIENT : ', 0, 0, 'L'); $pdf->Cell(20, 10, 'S.B.S '.$client['nom'], 0, 0, 'C'); 
            $pdf->SetFont('Arial','',7);
            $pdf->SetXY(27, $pdf->GetY()+10); $pdf->Cell(25, 10, 'MODE PAIEMENT : ', 0, 0, 'L'); 
            $pdf->Cell(20, 10, $pdf->utf8(strtoupper($commande['mode'])) , 0, 0, 'C'); 
            if($commande['mode'] == 'cheque'):
                $pdf->SetXY(140, $pdf->GetY()); $pdf->Cell(25, 10, 'REF DE PAIEMENT : ', 0, 0, 'L'); $pdf->Cell(20, 10, $pdf->utf8(strtoupper($commande['opt'])) , 0, 0, 'C'); 
            elseif($commande['mode'] == 'virement'):
                $pdf->SetXY(140, $pdf->GetY()); $pdf->Cell(25, 10, 'VIREMENT : ', 0, 0, 'L'); $pdf->Cell(20, 10, $pdf->utf8(strtoupper($commande['opt'])) , 0, 0, 'C'); 
            endif;
            $pdf->SetFont('Arial','B',8);
            $pdf->SetXY(22, 110);
            $pdf->Cell(42, 10, $pdf->utf8('Destinations') ,1, 0, 'C');
            $pdf->Cell(22, 10, $pdf->utf8('Camions') ,1, 0, 'C');
            $pdf->Cell(24, 10, $pdf->utf8('Quantité'), 1, 0, 'C');
            $pdf->Cell(24, 10, $pdf->utf8('Produits'), 1, 0, 'C');
            $pdf->Cell(25, 10, $pdf->utf8('Prix Unitaire') ,1, 0, 'C');
            $pdf->Cell(30, 10, $pdf->utf8('Montant'), 1, 0, 'C'); $pdf->ln();
            $pdf->SetFont('Arial','',8);
            $sumQtyi = 0; $sumMonti = 0;
            foreach(self::selectData(PREFIX.'commande_item', ['conditions'=>['id_commande'=>$id], 'orderby'=>'ref ASC', 'limit'=> $limit_inf.','.$limit_sup]) as $item):
                $pdf->SetXY(150, $pdf->GetY()-85); 
                $pdf->Cell(20, 10, $pdf->utf8('Référence :'), 0, 0, 'C');  $pdf->Cell(20, 10, $pdf->utf8($item['ref']), 0, 0, 'C'); 
                $station = self::singleData(PREFIX.'stations', ['conditions'=>['id'=>$item['stations']]]);
                $pdf->SetXY(22, $pdf->GetY()+85); 
                $pdf->Cell(42 , 40, $pdf->utf8(strtoupper($station['nom'])),1, 0, 'C');
                $pdf->Cell(22 , 40, $pdf->utf8(strtoupper($camion['immatriculation'])),1, 0, 'C');
                $pdf->Cell(24 , 40, number_format($item['qty'],'0','.',' ') ,1, 0, 'C');
                $pdf->Cell(24 , 40, $pdf->utf8(ucfirst($item['produit'])),1, 0, 'C');
                $pdf->Cell(25 , 40, number_format($client['prix_achat'],'0','.',' ') .' GNF',1, 0, 'C');
                $pdf->Cell(30 , 40, number_format($item['qty']*$client['prix_achat'], '0','.',' ').' GNF',1, 0, 'C');
                $sumQtyi = $sumQtyi + $item['qty'];
                $sumMonti = $sumMonti + ($item['qty']*$client['prix_achat']);$pdf->ln();
            endforeach;
            $pdf->SetFont('Arial','B',8);
            $pdf->SetX(22); $pdf->Cell(64, 6, $pdf->utf8('TOTAL') ,1, 0, 'C');
            $pdf->Cell(24, 6, number_format($sumQtyi, '0','.',' ') ,1, 0, 'C');
            $pdf->Cell(24, 6, ' ',1, 0, 'C');
            $pdf->Cell(25, 6, ' ',1, 0, 'C');
            $pdf->Cell(30, 6, number_format($sumMonti, '0','.',' ').' GNF', 1, 0, 'C');  $pdf->ln();
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(0, $pdf->GetY()+10); $pdf->Cell(0, 10, '', 0, 0, 'C');
            if($sign_users !='' OR $sign_users != null):
                $path = '../assets/images/sign/'.$sign_users.'.png';
                if(file_exists($path)):
                    $pdf->Image($path, $pdf->GetX()-80, $pdf->GetY()-4, -300);
                endif;
            endif;
            $pdf->Image('../assets/images/cachet.png',$pdf->GetX()-50, $pdf->GetY(), -300);
            $limit_inf++;
            $num++;
        }
        $pdf->AliasNbPages();
        $pdf->Output('F', '../bon/'.$id.'.pdf');
    }
  
    public function bon_par_num_commande($bc, $commande, $client, $fournisseur, $item, $sign_users)
    {
        $pdf = new PDF_BON_COMMANDE('P','mm','A4');
        $pdf->SetMargins(5,5,5);
        $pdf->AddPage();
        $pdf->Image('../assets/images/logo.png',30,30,-200);
        $pdf->SetXY(30,42); 
        $pdf->SetFont('Arial','BI',10);
        $pdf->SetXY(75, $pdf->GetY()+20); 
        $pdf->Cell(50, 10, 'Fournisseur :', 0, 0, 'C'); $pdf->Cell(10, 10, strtoupper($fournisseur['nom']) , 0, 0, 'C'); 
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY(27, $pdf->GetY()-17); 
        $pdf->Cell(20, 10, 'Date : ', 0, 0, 'L'); $pdf->Cell(20, 10, explode('-', $commande['commande_at'])[2].'/'.explode('-', $commande['commande_at'])[1].'/'.explode('-', $commande['commande_at'])[0], 0, 0, 'C'); 
        $pdf->SetFont('Arial','B',7);
        $pdf->SetXY(27, $pdf->GetY()+30); 
        $pdf->Cell(20, 10, 'OBJET :', 0, 0, 'L'); $pdf->Cell(10, 10, strtoupper($commande['objet']) , 0, 0, 'C'); 
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY(27, $pdf->GetY()+10); 
        $pdf->Cell(20, 10, 'CLIENT : ', 0, 0, 'L'); $pdf->Cell(20, 10, 'S.B.S '.$client['nom'], 0, 0, 'C'); 
        $pdf->SetFont('Arial','',7);
        $pdf->SetXY(27, $pdf->GetY()+10); $pdf->Cell(25, 10, 'MODE PAIEMENT : ', 0, 0, 'L'); $pdf->Cell(20, 10, $pdf->utf8(strtoupper($commande['mode'])) , 0, 0, 'C'); 
        if($commande['mode'] == 'cheque'):
            $pdf->SetXY(140, $pdf->GetY()); $pdf->Cell(25, 10, 'REF DE PAIEMENT : ', 0, 0, 'L'); $pdf->Cell(20, 10, $pdf->utf8(strtoupper($commande['opt'])) , 0, 0, 'C'); 
        elseif($commande['mode'] == 'virement'):
            $pdf->SetXY(140, $pdf->GetY()); $pdf->Cell(25, 10, 'VIREMENT : ', 0, 0, 'L'); $pdf->Cell(20, 10, $pdf->utf8(strtoupper($commande['opt'])) , 0, 0, 'C'); 
        endif;  
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(22, 110);
        $pdf->Cell(42, 10, $pdf->utf8('Destinations') ,1, 0, 'C');
        $pdf->Cell(22, 10, $pdf->utf8('Camions') ,1, 0, 'C');
        $pdf->Cell(24, 10, $pdf->utf8('Quantité') ,1, 0, 'C');
        $pdf->Cell(24, 10, $pdf->utf8('Produits') ,1, 0, 'C');
        $pdf->Cell(25, 10, $pdf->utf8('Prix Unitaire') ,1, 0, 'C');
        $pdf->Cell(30, 10, $pdf->utf8('Montant') ,1, 0, 'C'); $pdf->ln();
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(145, $pdf->GetY()-85); 
        $pdf->Cell(20, 10, $pdf->utf8('Référence :'), 0, 0, 'C'); $pdf->Cell(20, 10, $pdf->utf8($item['ref']), 0, 0, 'C'); 
        $station = self::singleData(PREFIX.'stations', ['conditions'=>['id'=>$item['stations']]]);
        $camion = self::singleData(PREFIX.'camions', ['conditions'=>['id'=>$commande['camions']]]);
        $pdf->SetXY(22, $pdf->GetY()+85);
        $pdf->Cell(42 , 40, $pdf->utf8(strtoupper($station['nom'])),1, 0, 'C');
        $pdf->Cell(22 , 40, $pdf->utf8(strtoupper($camion['immatriculation'])),1, 0, 'C');
        $pdf->Cell(24 , 40, number_format($item['qty'],'0','.',' ') ,1, 0, 'C');
        $pdf->Cell(24 , 40, $pdf->utf8(ucfirst($item['produit'])),1, 0, 'C');
        $pdf->Cell(25 , 40, number_format($client['prix_achat'],'0','.',' ') .' GNF',1, 0, 'C');
        $pdf->Cell(30 , 40, number_format($item['qty']*$client['prix_achat'], '0','.',' ').' GNF',1, 0, 'C');
        $sumQtyi = $item['qty'];
        $sumMonti = $item['qty']*$client['prix_achat'];
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(22, $pdf->GetY()+40);
        $pdf->Cell(64, 6, $pdf->utf8('TOTAL') ,1, 0, 'C');
        $pdf->Cell(24, 6, number_format($sumQtyi, '0','.',' ') ,1, 0, 'C');
        $pdf->Cell(24, 6, ' ',1, 0, 'C');
        $pdf->Cell(25, 6, ' ',1, 0, 'C');
        $pdf->Cell(30, 6, number_format($sumMonti, '0','.',' ').' GNF', 1, 0, 'C'); 
        $pdf->SetFont('Arial','',8);
        $pdf->SetXY(0, $pdf->GetY()+10); $pdf->Cell(0, 10, '', 0, 0, 'C');
        //$pdf->Image('../assets/images/sign.png',$pdf->GetX()-80, $pdf->GetY()+5, -300);
        if($sign_users !='' OR $sign_users != null):
            $path = '../assets/images/sign/'.$sign_users.'.png';
            if(file_exists($path)):
                $pdf->Image($path, $pdf->GetX()-80, $pdf->GetY()+5, -300);
            endif;
        endif;
        $pdf->Image('../assets/images/cachet.png',$pdf->GetX()-50, $pdf->GetY()+5, -300);
        $pdf->AliasNbPages();
        $pdf->Output('F', '../bon/'.$bc.'.pdf');
    }

    /**
    * Pour detruire l'instance de la base de données
    * @return boolean
    */      
    public function __destruct()
    {
        if( is_object($this->req)):
            $this->req->closeCursor();
        endif;
    }
}