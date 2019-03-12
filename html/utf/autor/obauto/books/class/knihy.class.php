<?php

class Knihy {

    private $DB;
  
    function __construct() {
      //$this->DB->debug = true;
      $this->DB = NewDB();
    }
    
    function ins_book_autor($idbook, $idauthor) {
      //$this->DB->debug = true;
      $array['idbook'] = $idbook;
      $array['idauthor'] = $idauthor;
      if ( ! $this->DB->AutoExecute("book_author", $array, 'INSERT') )
        return "Autora se nepodarilo zapsat.";
      return "<br />Autor zapsan.<br />";
    }
    
    function ins_book_subject($idbook, $subject) {
      //$this->DB->debug = true;
      $array['idbook'] = $idbook;
      $array['subject'] = $subject;
      if ( ! $this->DB->AutoExecute("book_subject", $array, 'INSERT') )
        return "Subject se nepodarilo zapsat.";
      return "<br />Subject zapsan.<br />";
    }
    
    function ins_book($REQUEST) {
      //$this->DB->debug = true;
      
      //$array['location'] = 'NULL';
      //$array['autophoto'] = 'NULL';
      $array['type'] = $REQUEST['type'];
      $array['title'] = $REQUEST['title'];
      $array['subtitle'] = $REQUEST['subtitle'];
      $array['volume'] = $REQUEST['volume'];
      $array['volume_shortcut'] = $REQUEST['volume_shortcut'];
      $array['number'] = $REQUEST['number'];
      $array['year'] = $REQUEST['year'];
      $array['place'] = $REQUEST['place'];
      $array['publisher'] = $REQUEST['publisher'];
      $array['isbn'] = $REQUEST['isbn_1'].'-'.$REQUEST['isbn_2'].'-'.$REQUEST['isbn_3'].'-'.$REQUEST['isbn_4'];
      $array['description'] = $REQUEST['description'];
      $array['subject'] = "SUBJECT";
      $array['fpage'] = "FPAGE";
      $array['tpage'] = "TPAGE";
      $array['auth'] = "AUTH";
      $array['issn'] = $REQUEST['issn'];
      $array['volumesubnumber'] = $REQUEST['volumesubnumber'];
      $array['pageframe'] = $REQUEST['pageframe'];
      $array['increasenumber1'] = (Empty($REQUEST['increasenumber1'])? 0 : $REQUEST['increasenumber1']);
      $array['increasenumber2'] = (Empty($REQUEST['increasenumber2'])? 0 : $REQUEST['increasenumber2']);
      $array['note'] = $REQUEST['note'];
      $array['signature'] = $REQUEST['signature'];
      
      if ( ! $this->DB->AutoExecute("book", $array, 'INSERT') )
        return "Knihu se nepodarilo zapsat.";
      $hlaska .= "<br />Kniha zapsana.<br />";
      
      $idbook = $this->DB->Insert_ID();

// zapisuji autory
      foreach($REQUEST['idauthor'] as $key=>$idauthor) {
        if ($idauthor!= -1 && !empty($idauthor)) {
          $hlaska .= $this->ins_book_autor($idbook, $REQUEST['author']);
        }
      }
   

// zapisuji subjecty
      foreach($REQUEST['idsubject'] as $key=>$idsubject) {
        if ($idsubject!= -1 && !empty($idsubject)) {
          $hlaska .= $this->ins_book_subject($idbook, $REQUEST['author']);
        }
      }
      return $hlaska;
    }


    function update_book($REQUEST) {
      //$this->DB->debug = true;
      
      //$array['location'] = 'NULL';
      //$array['autophoto'] = 'NULL';
      $array['type'] = $REQUEST['type'];
      $array['title'] = $REQUEST['title'];
      $array['subtitle'] = $REQUEST['subtitle'];
      $array['volume'] = $REQUEST['volume'];
      $array['volume_shortcut'] = $REQUEST['volume_shortcut'];
      $array['number'] = $REQUEST['number'];
      $array['year'] = $REQUEST['year'];
      $array['place'] = $REQUEST['place'];
      $array['publisher'] = $REQUEST['publisher'];
      $array['isbn'] = $REQUEST['isbn_1'].'-'.$REQUEST['isbn_2'].'-'.$REQUEST['isbn_3'].'-'.$REQUEST['isbn_4'];
      $array['description'] = $REQUEST['description'];
      $array['subject'] = "SUBJECT";
      $array['fpage'] = "FPAGE";
      $array['tpage'] = "TPAGE";
      $array['auth'] = "AUTH";
      $array['issn'] = $REQUEST['issn'];
      $array['volumesubnumber'] = $REQUEST['volumesubnumber'];
      $array['pageframe'] = $REQUEST['pageframe'];
      $array['increasenumber1'] = (Empty($REQUEST['increasenumber1'])? 0 : $REQUEST['increasenumber1']);
      $array['increasenumber2'] = (Empty($REQUEST['increasenumber2'])? 0 : $REQUEST['increasenumber2']);
      $array['note'] = $REQUEST['note'];
      $array['signature'] = $REQUEST['signature'];
      
      if ( ! $this->DB->AutoExecute("book", $array, 'UPDATE', 'idbook = '.$REQUEST['idbook']) )
        return "Knihu se nepodarilo ulozit.";
      $hlaska .= "<br />Kniha ulozena.<br />";
      
      //mazu vsechny autory a subjecty
      $this->DB->Execute("delete from book_author where idbook = ?", $REQUEST['idbook']);
      $this->DB->Execute("delete from book_subject where idbook = ?", $REQUEST['idbook']);
      
      // zapisuji autory znova
      foreach($REQUEST['idauthor'] as $key=>$idauthor) {
        if ($idauthor!= -1 && !empty($idauthor)) {
          $hlaska .= $this->ins_book_autor($REQUEST['idbook'], $idauthor);
        }
      }
      // zapisuji subjecty znova
      foreach($REQUEST['idsubject'] as $key=>$subject) {
        if ($subject!= -1 && !empty($subject)) {
          $hlaska .= $this->ins_book_subject($REQUEST['idbook'], $subject);
        }
      }
      return $hlaska;
      
    }
    
    function get_book($idbook) {
      //$this->DB->debug = true;
      $pole = $this->DB->GetRow('select * from book where idbook = ? order by idbook', array($idbook));
      
      $poleauthor = $this->DB->GetAll('select idauthor from book_author where idbook = ?', array($idbook));
      $polesubj = $this->DB->GetAll('select subject from book_subject where idbook = ?', array($idbook));

      foreach($poleauthor as $key=>$val) {
        $pole['idauthor'][] = $val['idauthor'];
      }

      foreach($polesubj as $key=>$val) {
        $pole['idsubject'][] = $val['subject'];
      }
      return $pole;
    }
    
} // END class Knihy


