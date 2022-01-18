<?php
	include_once '../core/config/init_ajax.php';
  $output_dir = "../tmp/";
  //$hack = empty($_POST["id"]) ? $util->better_hack() : $_POST["id"];
  $hack = strtoupper(substr(md5(uniqid(time())), 0,10));
  if(isset($_FILES["myfile"])):
    $ret = [];
    if(!is_array($_FILES["myfile"]['name'])):
      $fileName = $_FILES["myfile"]["name"];
      $fileInfo = pathinfo($fileName);
      $ext = strtolower($fileInfo['extension']);
      move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$hack.'.'.$ext);
      $ret['fileRealName']= $fileName;
      $ret['fileName']= $output_dir.$hack.'.'.$ext;
      $ret['ext']= $ext;
      $ret['hackName']= $hack;
    endif;
    echo json_encode($ret);
  endif;
?>