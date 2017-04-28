<?php
class MysqlClass
{
  // parametri per la connessione al database
  private $nomehost = "localhost";     
  private $nomeuser = "u760134217_luca";          
  private $password = "wcallu86"; 
  private $dbname = "u760134217_mf";
          
  // controllo sulle connessioni attive
  private $attiva = false;
 
  // funzione per la connessione a MySQL
public function connetti()
 {
   if(!$this->attiva)
    {
     if($connessione = mysql_connect($this->nomehost,$this->nomeuser,$this->password) or die (mysql_error()))
      {
       // selezione del database
       $selezione = mysql_select_db($this->dbname,$connessione) or die (mysql_error());
      }
     }else{
       return true;
     }
    }
    
    
// funzione per la chiusura della connessione
 public function disconnetti()
{
        if($this->attiva)
        {
                if(mysql_close())
                {
         $this->attiva = false; 
             return true; 
                }else{
                        return false; 
                }
        }
 }
 
//funzione per l'esecuzione delle query 
 public function query($sql)
 {
  if(isset($this->attiva))
  {
  $sql = mysql_query($sql) or die (mysql_error());
  return $sql;
  }else{
  return false; 
  }
 }

 
 // funzione per l'estrazione dei record 
public function estrai($risultato)
 {
  if(isset($this->attiva))
  {
  $r = mysql_fetch_object($risultato);
  return $r;
  }else{
  return false; 
  }
 }
 
}

?>
