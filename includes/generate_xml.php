 <?php
include "../connect.ini.php";
                                        
    if($_GET['action'] == "generateXML"){
        
        /*Zmaze vsetky stare subory v priecinku files/downloads*/
        $files = glob('files/downloads/*'); // get all file names
        
        foreach($files as $file){ // iterate files
            
          if(is_file($file)) {
              
            unlink($file); // delete file
              
          }
            
        }
        
        /*Vlozi vsetok text na zaciatok suboru product.xml zo suboru header.txt*/
        $file_name = "files/header_first_part.txt";
        
        if($handle = fopen($file_name, 'r')){
        
            $content = fread($handle,filesize($file_name));
            
            fclose($handle);

        }
        
        $file = 'files/downloads/product.xml';
        $current = file_get_contents("files/header_first_part.txt");
        $y_start_position_brand = 52;
        $distance_between_brand_y_positions = 25;
        if($_GET['cd_id']!=""){
            $query = "SELECT COUNT(*) AS count_of_cars FROM cars INNER JOIN cd_cars ON cars.car_id = cd_cars.car_id WHERE cd_cars.cd_id =".$_GET['cd_id']." ORDER BY cars.car_order";
        }else{
            $query = "SELECT COUNT(*) AS count_of_cars FROM cars";
        }
        $count_of_cars_query = mysqli_query($connect,$query);
        $row = mysqli_fetch_assoc($count_of_cars_query);
        $car_count = $row['count_of_cars'];
        $current .= "<center x=\"312\" y=\"".(($y_start_position_brand+($car_count*$distance_between_brand_y_positions)+185)/2)."\"/>
        <size width=\"650\" height=\"".($y_start_position_brand+($car_count*$distance_between_brand_y_positions)+185)."\"/>";
        
        $file_name = "files/header_second_part.txt";
        
                if($handle = fopen($file_name, 'r')){

                    $current .= "\n".fread($handle,filesize($file_name));
            
                    fclose($handle);

                }
        
        /*Vyberie z databazy vsetky auta */
        if($_GET['cd_id']!=""){
            $query = "SELECT * FROM cars INNER JOIN cd_cars ON cars.car_id = cd_cars.car_id WHERE cd_cars.cd_id =".$_GET['cd_id']." ORDER BY cars.car_order";
        }else{
            $query = "SELECT * FROM cars ORDER BY car_order";
        }
        $selected_cars = mysqli_query($connect, $query);
        /*Vypocet pozicii tlacidiel a textu*/
        $index=0;
        $y_start_position_model = 51;
        $distance_between_model_y_positions = 27;
        /*vytvorenie zatial prazdneho, koncoveho zip suboru, ktory je stiahnuty*/
        $zip = new ZipArchive();
        $filename = "files/downloads/content.aed";

        if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
            
            exit("cannot open <$filename>\n");
            
        }
        /*Vkladanie suborov, do zip archivu (tieto subory sa nemenia)*/
        $file_path = "files/static_files/";
        
        $zip->addFile($file_path."image0.jpg","image0.jpg");
        $zip->addFile($file_path."image3.png","image3.png");
        $zip->addFile($file_path."image4.png","image4.png");
        $zip->addFile($file_path."image5.png","image5.png");
        $zip->addFile($file_path."image6.png","image6.png");
        $zip->addFile($file_path."text1.xml","text1.xml");
        $zip->addFile($file_path."text2.xml","text2.xml");
        $zip->addFile($file_path."text8.xml","text8.xml");
        $zip->addFile($file_path."text9.xml","text9.xml");
        $zip->addFile($file_path."text11.xml","text11.xml");
        
        /*vkladanie vsetkych aut z databazy do suboru product.xml*/
        /*vsetky unique 7pin sa zacinaju predponou 17*/
        while($row = mysqli_fetch_assoc($selected_cars)){
        
            $current .= "\n<state-button unique=\"17".$row['car_id']."\" type=\"aed-state-button-action\" name=\"".$row['car_brand']."\" coloured=\"true\" rotation=\"0\" visible=\"true\" modified=\"true\" label=\"".$row['car_brand']."\" hint=\"\">
            <center x=\"146.5\" y=\"".($y_start_position_brand + ($index * $distance_between_model_y_positions))."\"/>
            <size width=\"87\" height=\"27.4556\"/>
            <tags>
            <button/>
            <small/>
            </tags>";
            
            if($index == 0){
                
                $file_name = "files/button_skin.txt";
        
                if($handle = fopen($file_name, 'r')){

                    $current .= "\n".fread($handle,filesize($file_name));
            
                    fclose($handle);

                }
                
            }else{
                
                $current .= "\n"."<skin unique=\"7432667595\" type=\"buttonskin\"/>";
                
            }
            
            $current .= "\n"."<action e-mail=\"\" website=\"\" command=\"\" params=\"\" language=\"\" page=\"\" folder=\"\" file=\"7pol\\".$row['7_pin']."\" valid=\"true\" type=\"run-file\" change-page=\"go-back\"/>
            </state-button>";
            /*vsetky unique 13pin sa zacinaju predponou 313*/
            $current .= "\n"."<state-button unique=\"313".$row['car_id']."\" type=\"aed-state-button-action\" name=\"".$row['car_brand']."\" coloured=\"true\" rotation=\"0\" visible=\"true\" modified=\"true\" label=\"".$row['car_brand']."\" hint=\"\">
          <center x=\"446.5\" y=\"".($y_start_position_brand + ($index * $distance_between_model_y_positions))."\"/>
          <size width=\"87\" height=\"28.1415\"/>
          <tags>
            <button/>
            <small/>
          </tags>
          <skin unique=\"7432667595\" type=\"buttonskin\"/>
          <action e-mail=\"\" website=\"\" command=\"\" params=\"\" language=\"\" page=\"\" folder=\"\" file=\"13pol\\".$row['13_pin']."\" valid=\"true\" type=\"run-file\" change-page=\"go-back\"/>
        </state-button>";
            /*vytvaranie xml suborov pre jednotlive auta*/
            $file_name = "text00".$row['car_id'].".xml";            
            $file_path = "files/downloads/".$file_name;

            if($handle = fopen($file_path, 'w')){
        
                fwrite($handle,"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                <richtext version=\"1.0.0.0\" xmlns=\"http://www.wxwidgets.org\">
                  <paragraphlayout textcolor=\"#000000\" fontsize=\"10\" fontstyle=\"90\" fontweight=\"90\" fontunderlined=\"0\" fontface=\"Arial\" alignment=\"0\" leftindent=\"0\" leftsubindent=\"0\" rightindent=\"0\" parspacingafter=\"0\" parspacingbefore=\"0\" linespacing=\"0\" bulletstyle=\"0\" bulletnumber=\"0\" parstyle=\"Normal\" tabs=\"\">
                    <paragraph textcolor=\"#FFFFFF\" fontsize=\"9\" fontstyle=\"90\" fontweight=\"92\" fontunderlined=\"0\" fontface=\"Arial\" alignment=\"2\">
                      <text textcolor=\"#FFFFFF\" fontsize=\"9\" fontstyle=\"90\" fontweight=\"92\" fontunderlined=\"0\" fontface=\"Arial\">".$row['car_model']."</text>
                    </paragraph>
                  </paragraphlayout>
                </richtext>
                ");

                fclose($handle);
        
            }
            
            $zip->addFile($file_path,$file_name);
            
            /*vsetky unique modelov aut sa zacinaju predponou 213*/
            $current .= "\n<text unique=\"213".$row['car_id']."\" type=\"text\" name=\"".$row['car_model']."\" coloured=\"true\" rotation=\"0\" visible=\"true\" modified=\"true\">
              <center x=\"297.5\" y=\"".($y_start_position_model+($index * $distance_between_model_y_positions))."\"/>
              <size width=\"83\" height=\"14.4348\"/>
              <attachment-richtextbuffer name=\"".$file_name."\"/>
            </text>";
            $index++;
        
        }
        
        /*doplnenie zvysku dat z danych suborov do suboru product.xml*/
        $query = "SELECT * FROM cd WHERE cd_id = ".$_GET['cd_id'];
        $selected_cd = mysqli_query($connect,$query);
        $cd = mysqli_fetch_array($selected_cd);
        $current .= "<text unique=\"64945128\" type=\"text\" name=\"".$cd['cd_number']."\" coloured=\"true\" rotation=\"0\" visible=\"true\" modified=\"true\">
          <center x=\"490\" y=\"".($y_start_position_model+($index * $distance_between_model_y_positions)+50)."\"/>
          <size width=\"71\" height=\"20\"/>
          <attachment-richtextbuffer name=\"text7.xml\"/>
        </text>";
        $file_name = "files/static_files/text7.xml";
        
        if($handle = fopen($file_name, 'w')){

            fwrite($handle,"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<richtext version=\"1.0.0.0\" xmlns=\"http://www.wxwidgets.org\">
  <paragraphlayout textcolor=\"#000000\" fontsize=\"9\" fontstyle=\"90\" fontweight=\"90\" fontunderlined=\"0\" fontface=\"Arial\" alignment=\"0\" leftindent=\"0\" leftsubindent=\"0\" rightindent=\"0\" parspacingafter=\"0\" parspacingbefore=\"0\" linespacing=\"0\" bulletstyle=\"0\" bulletnumber=\"0\" parstyle=\"Normal\" tabs=\"\">
    <paragraph>
      <text textcolor=\"#FFFFFF\" fontsize=\"9\">".$cd['cd_number']."</text>
    </paragraph>
  </paragraphlayout>
</richtext>");
            
            fclose($handle);

        }
        
        $zip->addFile("files/static_files/text7.xml","text7.xml");
        $current .= "<text unique=\"64939928\" type=\"text\" name=\"".date("d.m.y",strtotime($cd['cd_date']))."\" coloured=\"true\" rotation=\"0\" visible=\"true\" modified=\"true\">
          <center x=\"560\" y=\"".($y_start_position_model+($index * $distance_between_model_y_positions)+50)."\"/>
          <size width=\"62\" height=\"20\"/>
          <attachment-richtextbuffer name=\"text8.xml\"/>
        </text>";
        $file_name = "files/static_files/text8.xml";
        
        if($handle = fopen($file_name, 'w')){

            fwrite($handle,"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<richtext version=\"1.0.0.0\" xmlns=\"http://www.wxwidgets.org\">
  <paragraphlayout textcolor=\"#000000\" fontsize=\"9\" fontstyle=\"90\" fontweight=\"90\" fontunderlined=\"0\" fontface=\"Arial\" alignment=\"0\" leftindent=\"0\" leftsubindent=\"0\" rightindent=\"0\" parspacingafter=\"0\" parspacingbefore=\"0\" linespacing=\"0\" bulletstyle=\"0\" bulletnumber=\"0\" parstyle=\"Normal\" tabs=\"\">
    <paragraph>
      <text textcolor=\"#FFFFFF\" fontsize=\"9\">".date("d.m.y",strtotime($cd['cd_date']))."</text>
    </paragraph>
  </paragraphlayout>
</richtext>");
            
            fclose($handle);

        }
        
        $zip->addFile("files/static_files/text8.xml","text8.xml");
        
        if($cd['codierung']==1){
        
            $current .= "<text unique=\"64940344\" type=\"text\" name=\"Freischaltung / Codierung Set up trailer operation\" coloured=\"true\" rotation=\"0\" visible=\"true\" modified=\"true\">
              <center x=\"130.5\" y=\"".($y_start_position_model+($index * $distance_between_model_y_positions)+50)."\"/>
              <size width=\"161\" height=\"28\"/>
              <attachment-richtextbuffer name=\"text11.xml\"/>
            </text>";
            $current .= "<state-button unique=\"64908104\" type=\"aed-state-button-action\" name=\"D / UK\" coloured=\"true\" rotation=\"0\" visible=\"true\" modified=\"true\" label=\"D / UK\" hint=\"\">
              <center x=\"124.5\" y=\"".($y_start_position_model+($index * $distance_between_model_y_positions)+100)."\"/>
              <size width=\"105\" height=\"21\"/>
              <tags>
                <button/>
                <small/>
              </tags>
              <skin unique=\"7432667595\" type=\"buttonskin\"/>
              <action e-mail=\"\" website=\"\" command=\"\" params=\"\" language=\"\" page=\"\" folder=\"\" file=\"87501889 - 12-21500601 CD codierung.pdf\" valid=\"true\" type=\"run-file\" change-page=\"go-back\"/>
            </state-button>";
            
        }
        
        $file_name = "files/footer.txt";
        
                if($handle = fopen($file_name, 'r')){

                    $current .= "\n".fread($handle,filesize($file_name));
            
                    fclose($handle);

                }
        $current .= "  <clientsize width=\"620\" height=\"".($y_start_position_brand+($car_count*$distance_between_brand_y_positions)+185)."\"/>
  <translations/>
</product>";
        
        /*vlozenie celeho spojeneho stringu do suboru product.xml*/
        file_put_contents($file, $current);
        
        /*vlozenie suboru product.xml do zip archivu s nazvom content.zip*/
        $zip->addFile("files/downloads/product.xml","product.xml");
        $zip->close();

        
?>
   <!--tlacidlo na stiahnutie archivu-->
   <a href="files/downloads/content.aed" download class="btn" title="Download"><button class="btn"  name="download">Stiahnuť XML</button></a> 
   
   <?php
        
    }
                             
?>
                                        
                                       
                                      
                                     
                                    
                                   
                                  
                                 
                                
                               
                              
                             
                        
                                               
                                                   
                                                            
                                               
                                            