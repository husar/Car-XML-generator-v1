<?php
/*
SEO URL
*/
function addCarToCD(){
    global $connect;
    
    if(isset($_POST['addCarToCD']) && $_POST['not_on_cd_id'] != ""){

        $insertCarToCDQuery="INSERT INTO cd_cars (cd_id, car_id) VALUES (".$_POST['not_on_cd_id'].", ".$_POST['car_id'].")";

        mysqli_query($connect,$insertCarToCDQuery);
        unset($_POST['addCarToCD']);
                                                                                                                                        
    }
    
}

function deleteCarFromCD(){
    global $connect;
    
    if(isset($_POST['deleteCarFromCD']) && $_POST['on_cd_id'] != ""){

        $deleteCarFromCDQuery="DELETE FROM cd_cars WHERE cd_id = ".$_POST['on_cd_id']." AND car_id = ".$_POST['car_id']."";

        mysqli_query($connect,$deleteCarFromCDQuery);
        unset($_POST['deleteCarFromCD']);
                                                                    
    } 
    
}

function updateCD(){
    global $connect;
    
    if(isset($_POST['editCD'])){

        $update_cd_id = $_POST['cd_id'];
        $update_name = $_POST['cd_name'];
        $update_number = $_POST['cd_number'];
        $update_date = $_POST['cd_date'];
        $update_codierung = 0;
        
        if($_POST['codierung'] != ""){
        
            $update_codierung = $_POST['codierung'];
            
        }
        
        $query = "UPDATE cd SET cd_name = '".$update_name."', cd_number = '".$update_number."', cd_date = '".$update_date."', codierung = ".$update_codierung." WHERE cd_id = ".$update_cd_id;
        $update_query = mysqli_query($connect, $query);
                                                    
        if($update_query){
            echo "<script> location.href='index.php?modul=spravovat-cd'; </script>";
            echo '<div class="alert alert-success">Údaje boli zmenené.</div>';  
            
        }else{
            echo '<div class="alert alert-danger">Údaje sa nepodarilo zaznamenať.</div>';
        }
        
    }
    
}

function deleteCD(){
    global $connect;
    
    if(isset($_POST['delete'])){    
        
       $query = "DELETE FROM cd WHERE cd_id = '".$_POST['cd_id']."'";
       $delete_cd_query = mysqli_query($connect,$query);
       $query = "DELETE FROM cd_cars WHERE cd_id = '".$_POST['cd_id']."'";
       $delete_cd_cars_query = mysqli_query($connect,$query);
        
            if(!$delete_cd_query){
                echo '<div class="alert alert-danger">Údaje sa nepodarilo vymazať.</div>';
            }else{
                echo '<div class="alert alert-success">Údaje boli úspešne vymazané.</div>';
            }
        
    }
}

function insertCD(){
    global $connect;
    
    if(isset($_POST['create_cd'])){
        $cd_name = mysqli_real_escape_string($connect,$_POST['cd_name']);
        $cd_number = mysqli_real_escape_string($connect,$_POST['cd_number']);
        $cd_date = $_POST['cd_date'];
        $codierung = isset($_POST['codierung'])?1:0;

        $query = "INSERT INTO cd (cd_name, cd_number, cd_date, codierung) ";
        $query .= "VALUES ('".$cd_name."','".$cd_number."','".$cd_date."',".$codierung.") ";
        $insert_cd_query = mysqli_query($connect, $query);

        if($insert_cd_query){
            
            echo '<div class="alert alert-success">Údaje boli zaznamenané.</div>';
                                            
        }else{

            die('QUERY FAILED '.mysqli_error($connect));
            echo '<div class="alert alert-danger">Údaje sa nepodarilo zaznamenať.</div>';

        }

        }
}

function updateRecord(){
    global $connect;
    
    if(isset($_POST['editCar'])){

        $update_car_id = $_POST['car_id'];
        $update_brand = $_POST['car_brand'];
        $update_model = $_POST['car_model'];
        $seven_pin = $_POST['7_pin'];
        $thirteen_pin = $_POST['13_pin'];
        $update_order = $_POST['car_order'];
        $query = "UPDATE cars SET car_brand = '".$update_brand."', car_model = '".$update_model."', 7_pin = '".$seven_pin."', 13_pin = '".$thirteen_pin."', car_order = ".$update_order." WHERE car_id = ".$update_car_id;
        $update_query = mysqli_query($connect, $query);
                                                    
        if($update_query){
            //echo "<script> location.href='index.php?modul=spravovat-zaznamy&cd_id=".$_GET['cd_id']."'; </script>";
            echo "<script> location.href='index.php?modul=spravovat-zaznamy&cd_id=".$_POST['cd_id']."'; </script>";
            echo '<div class="alert alert-success">Údaje boli zmenené.</div>';
            
        }else{
            echo '<div class="alert alert-danger">Údaje sa nepodarilo zaznamenať.</div>';
        }
        
    }
    
}

function insertRecord(){
    global $connect;
    
    if(isset($_POST['create_record'])){
        $car_brand = mysqli_real_escape_string($connect,$_POST['car_brand']);
        $car_model = mysqli_real_escape_string($connect,$_POST['car_model']);
        $seven_pin = mysqli_real_escape_string($connect,$_POST['7_pin']);
        $thirteen_pin = mysqli_real_escape_string($connect,$_POST['13_pin']);
        $car_order = $_POST['car_order'];

        $query = "INSERT INTO cars (car_brand, car_model, 7_pin, 13_pin, car_order) ";
        $query .= "VALUES ('".$car_brand."', '".$car_model."', '".$seven_pin."', '".$thirteen_pin."', ".$car_order.") ";
        $insert_car_query = mysqli_query($connect, $query);

        if($insert_car_query && isset($_POST['car_cd'])){
            
           $selectbox1=$_POST['car_cd'];
           $insertedCDs = array();
           $query = "SELECT car_id from cars WHERE car_brand='".$car_brand."' AND car_model='".$car_model."' AND 7_pin='".$seven_pin."' AND 13_pin='".$thirteen_pin."' AND car_order=".$car_order." ";
           $selected_id = mysqli_query($connect, $query);
           $row = mysqli_fetch_array($selected_id);
            
           foreach($selectbox1 as $slct1){    
                
                $query = "INSERT INTO cd_cars (car_id, cd_id) ";
                $query .= "VALUES ('".$row['car_id']."', '".$slct1."') ";
                $insert_car_cd_query = mysqli_query($connect, $query);
               
                if($insert_car_cd_query){
                    
                    array_push($groupInserted,true);
                    
                }
               
           }
            
        }
        if($insert_car_query && !in_array(false,$insertedCDs)){
            
            echo '<div class="alert alert-success">Údaje boli zaznamenané.</div>';
            
        }
        else{

            die('QUERY FAILED '.mysqli_error($connect));
            echo '<div class="alert alert-danger">Údaje sa nepodarilo zaznamenať.</div>';

        }

        }
}

function deleteCar(){
    global $connect;
    
    if(isset($_POST['delete'])){    
        
       $query = "DELETE FROM cars WHERE car_id = '".$_POST['car_id']."'";
       $delete_car_query = mysqli_query($connect,$query);
       $query = "DELETE FROM cd_cars WHERE car_id = '".$_POST['car_id']."'";
       $delete_cd_cars_query = mysqli_query($connect,$query);
        
            if(!$delete_car_query){
                echo '<div class="alert alert-danger">Údaje sa nepodarilo vymazať.</div>';
            }else{
                echo '<div class="alert alert-success">Údaje boli úspešne vymazané.</div>';
            }
        
    }
}

function url_slug($str, $options = array()) {
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	
	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => true,
	);
	
	// Merge options
	$options = array_merge($defaults, $options);
	
	$char_map = array(
		// Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
		'ß' => 'ss', 
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
		'ÿ' => 'y',

		// Latin symbols
		'©' => '(c)',

		// Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

		// Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 

		// Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',

		// Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

		// Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
		'Ž' => 'Z', 
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z', 

		// Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
		'Ż' => 'Z', 
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',

		// Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
	);
	
	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	
	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	
	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	
	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	
	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	
	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);
	
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function get_fullname($id,$connect){
$query_getfullname="SELECT id,fullname FROM user WHERE id=".$id;
$apply_getfullname=mysqli_query($connect,$query_getfullname);
$result_getfullname=mysqli_fetch_array($apply_getfullname);
return $result_getfullname['fullname'];
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function get_url_fullname($id,$connect){
$query_geurltfullname="SELECT id,url_fullname FROM user WHERE id=".$id;
$apply_geurltfullname=mysqli_query($connect,$query_geurltfullname);
$result_geurltfullname=mysqli_fetch_array($apply_geurltfullname);
return $result_geurltfullname['url_fullname'];
}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function date_month_short($datum){
$month=substr($datum, 5, 2);
if($month=="01"){$month_short="Jan";}
elseif($month=="02"){$month_short="Feb";}
elseif($month=="03"){$month_short="Mar";}
elseif($month=="04"){$month_short="Apr";}
elseif($month=="05"){$month_short="Máj";}
elseif($month=="06"){$month_short="Jún";}
elseif($month=="07"){$month_short="Júl";}
elseif($month=="08"){$month_short="Aug";}
elseif($month=="09"){$month_short="Sep";}
elseif($month=="10"){$month_short="Okt";}
elseif($month=="11"){$month_short="Nov";}
elseif($month=="12"){$month_short="Dec";}
echo $month_short;
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function date_nice_format($datum){
$day=substr($datum, 8, 2);
$month=substr($datum, 5, 2);
$year=substr($datum, 0, 4);
if($month=="01"){$month="Január";}
elseif($month=="02"){$month="Február";}
elseif($month=="03"){$month="Marec";}
elseif($month=="04"){$month="Apríl";}
elseif($month=="05"){$month="Máj";}
elseif($month=="06"){$month="Jún";}
elseif($month=="07"){$month="Júl";}
elseif($month=="08"){$month="August";}
elseif($month=="09"){$month="Septemper";}
elseif($month=="10"){$month="Október";}
elseif($month=="11"){$month="November";}
elseif($month=="12"){$month="December";}
echo $day.". ".$month." ".$year;
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function date_month($datum){
$month=substr($datum, 5, 2);
if($month=="01"){$month="Január";}
elseif($month=="02"){$month="Február";}
elseif($month=="03"){$month="Marec";}
elseif($month=="04"){$month="Apríl";}
elseif($month=="05"){$month="Máj";}
elseif($month=="06"){$month="Jún";}
elseif($month=="07"){$month="Júl";}
elseif($month=="08"){$month="August";}
elseif($month=="09"){$month="Septemper";}
elseif($month=="10"){$month="Október";}
elseif($month=="11"){$month="November";}
elseif($month=="12"){$month="December";}
echo $month;
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// pr.:    makeThumbnails("images/articles/thumbnail/", "images/articles/photo/".$photo_name, $photo_name,$MaxWe=200,$MaxHe=150);
 function makeThumbnails($dest,$file,$nw,$nh){
 
/* Opening the thumbnail directory and looping through all the thumbs: */

 
$allowed_types=array('jpg','jpeg','gif','png');
$file_parts=array();
$ext='';


 
    $file_parts = explode('.',$file);    //This gets the file name of the images
    $ext = strtolower(array_pop($file_parts));
 
    /* Using the file name (withouth the extension) as a image title: */
    $title = implode('.',$file_parts);
    $title = htmlspecialchars($title);
 
    /* If the file extension is allowed: */
    if(in_array($ext,$allowed_types))
    {
 
        /* If you would like to inpute images into a database, do your mysql query here */
 
        /* The code past here is the code at the start of the tutorial */
        /* Outputting each image: */

        $source = $file;
        $stype = explode(".", $source);
        $stype = $stype[count($stype)-1];
       
 
        $size = getimagesize($source);
        $w = $size[0];
        $h = $size[1];
 
        switch($stype) {
            case 'gif':
                $simg = imagecreatefromgif($source);
                break;
            case 'jpg':
                $simg = imagecreatefromjpeg($source);
                break;
            case 'png':
                $simg = imagecreatefrompng($source);
                break;
        }
 
        $dimg = imagecreatetruecolor($nw, $nh);
        $wm = $w/$nw;
        $hm = $h/$nh;
        $h_height = $nh/2;
        $w_height = $nw/2;
 
        if($w> $h) {
            $adjusted_width = $w / $hm;
            $half_width = $adjusted_width / 2;
            $int_width = $half_width - $w_height;
            imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
        } elseif(($w <$h) || ($w == $h)) {
            $adjusted_height = $h / $wm;
            $half_height = $adjusted_height / 2;
            $int_height = $half_height - $h_height;
 
            imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
        } else {
            imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
        }
            imagejpeg($dimg,$dest,100);
        }


 }
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function get_category_seoname($id,$connect){
$query_category_seoname="SELECT id,category_seoname FROM categories WHERE id=".$id;
$apply_category_seoname=mysqli_query($connect,$query_category_seoname);
$result_category_seoname=mysqli_fetch_array($apply_category_seoname);
return $result_category_seoname['category_seoname'];
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function get_category_name($id,$connect){
$query_category_name="SELECT id,category_name FROM categories WHERE id=".$id;
$apply_category_name=mysqli_query($connect,$query_category_name);
$result_category_name=mysqli_fetch_array($apply_category_name);
return $result_category_name['category_name'];
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function get_category_name_from_seoname($seoname,$connect){
$query_category_name="SELECT category_name,category_seoname FROM categories WHERE category_seoname='".$seoname."'";
$apply_category_name=mysqli_query($connect,$query_category_name);
$result_category_name=mysqli_fetch_array($apply_category_name);
if(count($result_category_name)!=0){
return $result_category_name['category_name'];
}
else{return $najnovsie="Najnovšie fotografie"; }
}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 function pagination($query, $per_page = 10,$page = 1, $url='?',$connect){         
    	$query = "SELECT COUNT(*) as `num` FROM {$query}";
		
    	$row = mysqli_fetch_array(mysqli_query($connect,$query));
    	$total = $row['num'];
        $adjacents = "2"; 

    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;
    	
    	$pagination = "";
    	if($lastpage > 1)
    	{	
    		$pagination .= "<ul class='pagination pagination-lg'>";
                    $pagination .= "";
					if($page<2){
					$pagination.= "<li><a>Predchádzajúca</a></li>";
					}
					else{
					$pagination.= "<li><a href='{$url}/$prev'>Predchádzajúca</a></li>";
					}
    		if ($lastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<li class='active'><a>$counter</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}/$counter'>$counter</a></li>";					
    			}
    		}
    		elseif($lastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li class='active'><a>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}/$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'><a>..</a></li>";
    				$pagination.= "<li><a href='{$url}/$lpm1'>$lpm1</a></li>";
    				$pagination.= "";		
    			}
    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$pagination.= "<li><a href='{$url}/1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}/2'>2</a></li>";
    				$pagination.= "<li class='dot'><a>..</a></li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li class='active'><a>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}/$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'><a>..</a></li>";
    				$pagination.= "<li><a href='{$url}/$lpm1'>$lpm1</a></li>";
    				$pagination.= "";		
    			}
    			else
    			{
    				$pagination.= "<li><a href='{$url}/1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}/2'>2</a></li>";
    				$pagination.= "<li class='dot'><a>..</a></li>";
    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li class='active'><a>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}/$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$pagination.= "<li><a href='{$url}/$next'>Ďalšia</a></li>";
                $pagination.= "";
    		}else{
    			$pagination.= "<li><a>Ďalšia</a></li>";
                $pagination.= "";
            }
    		$pagination.= "</ul>\n";		
    	}
    
    
        return $pagination;
    } 
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function pagination_search($query, $per_page = 10,$page = 1, $url='?',$connect){         
    	$query = "SELECT COUNT(*) as `num` FROM {$query}";
		
    	$row = mysqli_fetch_array(mysqli_query($connect,$query));
    	$total = $row['num'];
        $adjacents = "2"; 

    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;
    	
    	$pagination = "";
    	if($lastpage > 1)
    	{	
    		$pagination .= "<ul class='pagination pagination-lg'>";
                    $pagination .= "";
					if($page<2){
					$pagination.= "<li><a>Predchádzajúca</a></li>";
					}
					else{
					$pagination.= "<li><a href='{$url}$prev'>Predchádzajúca</a></li>";
					}
    		if ($lastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<li class='active'><a>$counter</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";					
    			}
    		}
    		elseif($lastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li class='active'><a>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'><a>..</a></li>";
    				$pagination.= "<li><a href='{$url}$lpm1'>$lpm1</a></li>";
    				$pagination.= "";		
    			}
    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$pagination.= "<li><a href='{$url}1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}2'>2</a></li>";
    				$pagination.= "<li class='dot'><a>..</a></li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li class='active'><a>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'><a>..</a></li>";
    				$pagination.= "<li><a href='{$url}$lpm1'>$lpm1</a></li>";
    				$pagination.= "";		
    			}
    			else
    			{
    				$pagination.= "<li><a href='{$url}1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}2'>2</a></li>";
    				$pagination.= "<li class='dot'><a>..</a></li>";
    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li class='active'><a>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$pagination.= "<li><a href='{$url}$next'>Ďalšia</a></li>";
                $pagination.= "";
    		}else{
    			$pagination.= "<li><a>Ďalšia</a></li>";
                $pagination.= "";
            }
    		$pagination.= "</ul>\n";		
    	}
    
    
        return $pagination;
    } 
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//***********************************************************************************************************
function get_metatags($modul,$param,$connect){
	$parameter = explode("/", $param);
	$query_menu="SELECT * FROM menu WHERE module_filename='".$modul."'";
	$apply_menu=mysqli_query($connect,$query_menu);
	$result_menu=mysqli_fetch_array($apply_menu);
	$title="<title>".$result_menu['name']." | Investcom.sk</title>
	";
	$og_url='<meta property="og:url" content="http://investcom.pozri-sa.sk/'.$param.'" />
	';
	$og_type='<meta property="og:type" content="article" />
	';
	$og_title='<meta property="og:title" content="'.$result_menu['name'].' | Investcom.sk" />
	';
	$og_description='<meta property="og:description" content="Investcom.sk - portál pre Vaše podnikanie. Články, služby a inzercia v oblasti podnikania" />
	';
	$og_image='<meta property="og:image" content="http://investcom.pozri-sa.sk/img/logo.png" />
	';
	if($result_menu['seo_name']=="clanok"){
		$seotitle=$parameter[2];
		$id=$parameter[3];
		$query_article="SELECT id,title,seo_title,article,main_photo,published FROM articles WHERE seo_title='".$seotitle."' AND id='".$id."' AND published='1'";
		$apply_article=mysqli_query($connect,$query_article);
		$result_article=mysqli_fetch_array($apply_article);
		$title="<title>".$result_article['title']." | Investcom.sk</title>";
		$og_title='<meta property="og:title" content="'.$result_article['title'].' | Investcom.sk" />
		';
		
		$og_image='<meta property="og:image" content="http://investcom.pozri-sa.sk/images/articles/photo/'.$result_article['main_photo'].'" />';
	}
	if($result_menu['seo_name']=="sluzby/detail"){
		$seotitle=$parameter[3];
		$id=$parameter[4];
		$query_article="SELECT id,title,seo_title,main_photo,published FROM services WHERE seo_title='".$seotitle."' AND id='".$id."' AND published='1'";
		$apply_article=mysqli_query($connect,$query_article);
		$result_article=mysqli_fetch_array($apply_article);
		$title="<title>".$result_article['title']." | Investcom.sk</title>";
		$og_title='<meta property="og:title" content="'.$result_article['title'].' | Investcom.sk" />
		';
		
		$og_image='<meta property="og:image" content="http://investcom.pozri-sa.sk/images/services/photo/'.$result_article['main_photo'].'" />';
	}
	if($result_menu['seo_name']=="biznis-reality/ponuka"){
		$seotitle=$parameter[3];
		$id=$parameter[4];
		$query_article="SELECT id,title,seo_title,main_photo,published FROM reality WHERE seo_title='".$seotitle."' AND id='".$id."' AND published='1'";
		$apply_article=mysqli_query($connect,$query_article);
		$result_article=mysqli_fetch_array($apply_article);
		$title="<title>".$result_article['title']." | Investcom.sk</title>";
		$og_title='<meta property="og:title" content="'.$result_article['title'].' | Investcom.sk"/>
		';
		
		$og_image='<meta property="og:image" content="http://investcom.pozri-sa.sk/images/reality/photo/'.$result_article['main_photo'].'"/>';
	}
	if($result_menu['seo_name']=="inzercia/inzerat"){
		$seotitle=$parameter[3];
		$id=$parameter[4];
		$query_article="SELECT id,title,seo_title,main_photo,published FROM advertisements WHERE seo_title='".$seotitle."' AND id='".$id."' AND published='1'";
		$apply_article=mysqli_query($connect,$query_article);
		$result_article=mysqli_fetch_array($apply_article);
		$title="<title>".$result_article['title']." | Investcom.sk</title>
		";
		$og_title='<meta property="og:title" content="'.$result_article['title'].' | Investcom.sk"/>
		';
		
		$og_image='<meta property="og:image" content="http://investcom.pozri-sa.sk/images/advertising/photo/'.$result_article['main_photo'].'"/>';
	}
	echo $title;
	echo $og_url;
	echo $og_type;
	echo $og_title;
	echo $og_description;
	echo $og_image;
}
//******************************************************************

function count_visits($parameter,$connect){
$query_count_views="SELECT COUNT(*) FROM page_views WHERE url='".$parameter."'";
$apply_count_views=mysqli_query($connect,$query_count_views);
$result_count_views=mysqli_fetch_array($apply_count_views);
echo $result_count_views[0];
}
function count_votes($parameter,$connect){
$query_count_votes="SELECT COUNT(*) FROM votes WHERE photo_id='".$parameter."'";
$apply_count_votes=mysqli_query($connect,$query_count_votes);
$result_count_votes=mysqli_fetch_array($apply_count_votes);
echo $result_count_votes[0];
}
function count_downloads($parameter,$connect){
$query_count_downloads="SELECT COUNT(*) FROM downloads WHERE photo_id='".$parameter."'";
$apply_count_downloads=mysqli_query($connect,$query_count_downloads);
$result_count_downloads=mysqli_fetch_array($apply_count_downloads);
echo $result_count_downloads[0];
}
function pf_email($email_to,$email_from,$msg){
	return true;
}
?>