
<?php 
error_reporting(E_ALL);
// require_once 'config.php';
if (isset($_POST['task'])) {
	$task = $_POST['task'];
} else if (isset($_GET['task'])) {
	$task = $_GET['task'];
}

switch($task) {
    case 'uploadModel':
	uploadModel();
	break;
    case 'createFolder':
    createfolder();
    break;
    case 'uploadImages':
    uploadImages();
    break;
}

function uploadModel () {
    // traitement des images//
    $folderName = $_POST['folderName'];
     if (!file_exists("../server/models/".$folderName)) {
        mkdir("../server/models/".$folderName, 0777, true);
    }
    if(isset($_FILES['file_array'])){
        $name_array = $_FILES['file_array']['name'];
        $tmp_name_array = $_FILES['file_array']['tmp_name'];
        $type_array = $_FILES['file_array']['type'];
        $size_array = $_FILES['file_array']['size'];
        $error_array = $_FILES['file_array']['error'];
        for($i = 0; $i < count($tmp_name_array); $i++){
            if (!file_exists("models/".$folderName)) {
                mkdir("models/".$folderName, 0777, true);
            }
            if(move_uploaded_file($tmp_name_array[$i], $folderName.'/'."/".$name_array[$i])){
                echo " <br>";
                // DB::insert('rotating_banners', array(
                //     'domain' => $_SESSION['domainURL'],
                //     'image' => $name_array[$i],
                //     'date' => '3000-12-31'
                // ));
            } else {
                echo "Upload error for ".$name_array[$i]."<br>";
            }
        }
    }
    // header('Location: index.php');
}
function createfolder(){
    $folderName = $_POST['folderName'];
    $folder = '../server/'.$folderName;
        if (is_dir($folder)) {
            echo 'This folder already exists!';  
            }
         else { 
            mkdir($folder, 0777);
            echo ' The  folder '.$folderName.' is created<br>';      
        }
      
}

function uploadImages () {
   // traitement des images//
    if(isset($_FILES['file_array'])){
        $name_array = $_FILES['file_array']['name'];
        $tmp_name_array = $_FILES['file_array']['tmp_name'];
        $type_array = $_FILES['file_array']['type'];
        $size_array = $_FILES['file_array']['size'];
        $error_array = $_FILES['file_array']['error'];
        for($i = 0; $i < count($tmp_name_array); $i++){
            if(move_uploaded_file($tmp_name_array[$i], '../server/'.$_POST['folder']."/".$name_array[$i])){
                 echo ' The  file is upload<br>';
                  
            } else {
                echo "Upload error for ".$name_array[$i]."<br>";
            }
        }
    }
    header('Location: index.php?folder=' . $_POST['folder']);
}

?>
