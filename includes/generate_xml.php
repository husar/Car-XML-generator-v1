 <?php
include "../connect.ini.php";
                                        
    if($_GET['action'] == "generateXML"){
        
        $file_name = "files/header.txt";
        
        if($handle = fopen($file_name, 'r')){
        
            $content = fread($handle,filesize($file_name));
            fclose($handle);

        }else{

            echo "The file could not be written. <br>";

        }
        
        $file = 'files/example.xml';
// Open the file to get existing content
        $current = file_get_contents("files/header.txt");
// Append a new person to the file
        $query = "SELECT * FROM cars ";
        $selected_cars = mysqli_query($connect, $query);
        
        if($row['7_pin']==null){
            
            $pin = "7pol\\"."aaaa";
            
        }else{
            
            $pin = "13pol\\".$row['13_pin'];
            
        }
        
        while($row = mysqli_fetch_assoc($selected_cars)){
        
            $current .= "\n<state-button unique=\"".$row['car_id']."\" type=\"aed-state-button-action\" name=\"".$row['car_brand']."\" coloured=\"true\" rotation=\"0\" visible=\"true\" modified=\"true\" label=\"".$row['car_brand']."\" hint=\"\">
          <center x=\"146.5\" y=\"178.042\"/>
          <size width=\"87\" height=\"27.4556\"/>
          <tags>
            <button/>
            <small/>
          </tags>
          <skin unique=\"7432667595\" type=\"buttonskin\"/>
          <action e-mail=\"\" website=\"\" command=\"\" params=\"\" language=\"\" page=\"\" folder=\"\" file=\"".$pin."\" valid=\"true\" type=\"run-file\" change-page=\"go-back\"/>
        </state-button>";
        
        }
// Write the contents back to the file
        file_put_contents($file, $current);
        
        /*$current = file_get_contents("files/example.xml");
// Append a new person to the file
       
        file_put_contents($file, $current);*/

    }




    
    

   /* while($row = mysqli_fetch_assoc($selected_cars)){

    
        
    array_push($records,"<state-button unique=\"".$row['car_id']."\" type=\"aed-state-button-action\" name=\"".$row['car_brand']."\" coloured=\"true\" rotation=\"0\" visible=\"true\" modified=\"true\" label=\"".$row['car_brand']."\" hint="">
          <center x=\"146.5\" y=\"178.042\"/>
          <size width=\"87\" height=\"27.4556\"/>
          <tags>
            <button/>
            <small/>
          </tags>
          <skin unique=\"7432667595\" type=\"buttonskin\"/>
          <action e-mail="" website="" command="" params="" language="" page="" folder="" file=\"".$seven_pin."\" valid=\"true\" type=\"run-file\" change-page=\"go-back\"/>
        </state-button>")
    }*/
                                        
?>
                                        
                                       
                                      
                                     
                                    
                                   
                                  
                                 
                                
                               
                              
                             
                         <?php    
                           
                          /*$dom = new DOMDocument();
                                                $dom->encoding = 'utf-8';
                                                $dom->xmlVersion = '1.0';
                                                $dom->formatOutput = true;
                                                $xml_file_name = 'car_list.xml';

                                                $root = $dom->createElement('Cars');
                                                
                                                $query = "SELECT * from cars ORDER BY car_order ";
                                                $selected_cars = mysqli_query($connect, $query);
                                                
                                                while($row=mysqli_fetch_array($selected_cars)){

                                                    $movie_node = $dom->createElement('ID');

                                                    $attr_movie_id = new DOMAttr('car_id', $row['car_id']);

                                                    $movie_node->setAttributeNode($attr_movie_id);

                                                    $child_node_title = $dom->createElement('brand', $row['car_brand']);

                                                    $movie_node->appendChild($child_node_title);

                                                    $child_node_year = $dom->createElement('model', $row['car_model']);

                                                    $movie_node->appendChild($child_node_year);

                                                    $child_node_genre = $dom->createElement('seven_pin', $row['7_pin']);

                                                    $movie_node->appendChild($child_node_genre);

                                                    $child_node_ratings = $dom->createElement('thirteen_pin', $row['13_pin']);

                                                    $movie_node->appendChild($child_node_ratings);
                                                    
                                                    $child_node_order = $dom->createElement('order', $row['car_order']);

                                                    $movie_node->appendChild($child_node_order);
                                                    
                                                    $root->appendChild($movie_node);
                                                }

                                                $dom->appendChild($root);

                                                $dom->save("files/".$xml_file_name);
                                               ?>
                                               
                                                  <a href="files/car_list.xml" download class="btn" title="Download"><button class="btn"  name="download">Stiahnuť XML</button></a>   
                                                            
                                               
                                            }*/?>