<?php
/**
 * Permet d'effectuer une sauvegarde d'une base de données MySQL
 * A appeler via une tâche CRON : www.setcronjob.com
 * Gestion de la suppression des anciennes sauvegardes.
 */
class BackupMysql
{
  private $db_charset;// encodage de la base utf8 ou latin1

  private $db_server;// Nom du serveur MySQL  ex. mysql5-26.perso
  private $db_name;// Nom de la base de données
  private $db_username; // Nom d'utilisateur de la base de données
  private $db_password;// Mot de passe de la base de données
  private $port;// Port de la base de donnée

  private $nFileDuration;// Ancienneté des fichiers à conserver en s
  private $repertoire_sauvegardes;// répertoire des sauvegardes
  private $archive_GZIP;// nom de l'archive gzip

  /**
   * initialisation des variables
   * @param [type]  $sDBServer     [description]
   * @param [type]  $sDBName       [description]
   * @param [type]  $sDBUsername   [description]
   * @param [type]  $sDBPassword   [description]
   * @param string  $sDBPort       [description]
   * @param integer $sFileDuration [description]
   * @param string  $sRepSave      [description]
   * @param [type]  $sNameZip      [description]
   */
  function __construct($sDBServer, $sDBName, $sDBUsername, $sDBPassword, $sDBCharset = 'latin1', $sRepSave ='/', $sNameZip = '',  $sDBPort = '3306')
  {
    $this->db_charset = $sDBCharset;       
    $this->db_server = $sDBServer;
    $this->db_name = $sDBName;
    $this->db_username = $sDBUsername;
    $this->db_password = $sDBPassword;
    $this->port = $sDBPort;
    $this->repertoire_sauvegardes = $sRepSave;
    $this->archive_GZIP = $sNameZip.date('dmYHis').".sql";
  }

  /**
   * suppression des anciennes sauvegardes
   * @param  integer $sFileDuration : 3600s = 1h ---> 90 jours = 7776000
   * @return [type]                 [description]
   */
  public function deleteOldFile($nDuration = 7776000)
  {
      $this->nFileDuration = $nDuration;
      echo "<br /> Liste des fichiers du repertoire : ".$this->repertoire_sauvegardes; 

      // liste les fichiers présents dans le répertoire
      foreach (glob( $this->repertoire_sauvegardes."*") as $file) 
      {
          echo "<br />".$file;  
          if ( filemtime($file) <=  (time() - $this->nFileDuration) )
              unlink($file);// supprime les vieux fichiers
      }

      echo "<br /><br /> Suppression des anciens fichiers effectuee.";  
  }


  /**
   * Effectue la sauvegarde de la base de données dans un fichier gzip.
   * 
   */
    public function setBbackupMySQL()
    {
      // Vérification et création dossier sauvegarde
      if( is_dir($this->repertoire_sauvegardes) === FALSE )
      {
        // 0700 repertoire non visible par les visiteurs
        if( mkdir($this->repertoire_sauvegardes, 0700) === FALSE )
          exit('<br /><br />Impossible de creer le repertoire pour la sauvegarde mysql!!!');
      }

      echo "<br />Fin de la configuration mysql";

        //---------------------------------------------
        // execution de la commande mysql dump
        //---------------------------------------------
        
        $commande  = 'mysqldump';
        $commande .= ' --host='.$this->db_server;
        $commande .= ' --port='.$this->port;
        $commande .= ' --user='.$this->db_username;
        $commande .= ' --password='.$this->db_password ;
        $commande .= ' --skip-opt';
        $commande .= ' --compress';
        $commande .= ' --add-locks';
        $commande .= ' --create-options';
        $commande .= ' --disable-keys';
        $commande .= ' --quote-names';
        $commande .= ' --quick';
        $commande .= ' --extended-insert';
        $commande .= ' --complete-insert';
        $commande .= ' --default-character-set='.$this->db_charset;
        $commande .= ' --compatible=mysql40';
        //$commande .= ' --result-file='.$archive_GZIP ;
        $commande .= ' '.$this->db_name ;
        $commande .= ' > '.$this->repertoire_sauvegardes.$this->archive_GZIP;
        //$commande .= ' | gzip -c > '.$this->repertoire_sauvegardes.$this->archive_GZIP;

        system($commande);

        /*$folder = 'c:\Backup/';
        $filename = 'base_de_donnee_sauvegarde_'.date("d-m-Y_H-i-s").'.sql';
        $file = $folder.$filename;
        $test = exec('mysqldump --user=root --password="" --host=localhost gsdbosco > "'.$file);*/

        echo "<br /><br />Sauvegarde terminee pour le fichier : ".$this->archive_GZIP;
    }
}
?>