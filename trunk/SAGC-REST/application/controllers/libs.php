<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Libs extends MY_Controller{
    protected function checarAutenticacao(){}

    function __construct(){
            parent::__construct();
    }
    
    public function uploadify(){
        /*
        Uploadify
        Copyright (c) 2012 Reactive Apps, Ronnie Garcia
        Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
        */

        // Define a destination
        //$targetFolder = '/sim/uploads/jovens'; // Relative to the root
        
        if($_POST['targetFolder'] == 'profissionais'){
            $targetFolder = 'profissionais';
        }else{
            $targetFolder = 'jovens';
        }
        
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            //$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            if(isset($_POST['targetFileName'])){
                preg_match("/(\..+?)$/", $_FILES['Filedata']['name'], $m);
                $ext = strtolower($m[1]);
                
                //$targetFile = rtrim($targetPath,'/') . '/' . $_POST['targetFileName'] . $ext;
                $targetFile = './uploads/'.$targetFolder.'/' . $_POST['targetFileName'] . $ext;
            }else{
                //$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
                $targetFile = './uploads/'.$targetFolder.'/' . $_FILES['Filedata']['name'];
            }

            // Validate the file type
            $fileTypes = array('jpg','jpeg', 'JPG', 'JPEG'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'],$fileTypes)) {
                move_uploaded_file($tempFile,$targetFile);
                echo '1';
            } else {
                echo 'Tipo de arquivo inválido.';
            }
        }
    }
}