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
        $file_name = "files/header.txt";
        
        if($handle = fopen($file_name, 'r')){
        
            $content = fread($handle,filesize($file_name));
            
            fclose($handle);

        }
        
        $file = 'files/downloads/product.xml';
        $current = file_get_contents("files/header.txt");
        /*Vyberie z databazy vsetky auta */
        $query = "SELECT * FROM cars ORDER BY car_order";
        $selected_cars = mysqli_query($connect, $query);
        /*Vypocet pozicii tlacidiel a textu*/
        $index=0;
        $y_start_position_brand = 42;
        $distance_between_brand_y_positions = 25;
        $y_start_position_model = 41;
        $distance_between_model_y_positions = 27;
        /*vytvorenie zatial prazdneho, koncoveho zip suboru, ktory je stiahnuty*/
        $zip = new ZipArchive();
        $filename = "files/downloads/content.zip";

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
        $zip->addFile($file_path."text7.xml","text7.xml");
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
        $file_name = "files/text_and_language_button.txt";
        
        if($handle = fopen($file_name, 'r')){

            $current .= "\n".fread($handle,filesize($file_name));
            
            fclose($handle);

        }
        
        $file_name = "files/footer.txt";
        
                if($handle = fopen($file_name, 'r')){

                    $current .= "\n".fread($handle,filesize($file_name));
            
                    fclose($handle);

                }
        
        /*vlozenie celeho spojeneho stringu do suboru product.xml*/
        file_put_contents($file, $current);
        
        /*vlozenie suboru product.xml do zip archivu s nazvom content.zip*/
        $zip->addFile("files/downloads/product.xml","product.xml");
        $zip->close();

        
?>
   <!--tlacidlo na stiahnutie archivu-->
   <a href="files/downloads/content.zip" download class="btn" title="Download"><button class="btn"  name="download">Stiahnuť XML</button></a> 
   
   <?php
        
    }
                             
?>
                                        
                                       
                                      
                                     
                                    
                                   
                                  
                                 
                                
                               
                              
                             
                        
                                               
                                                   
                                                            
                                               
                                            