<?php
    
function createCarsXML(){
    $query = "SELECT * FROM cars ";
    $selected_cars = mysqli_query($connect, $query);
    $records = new array();

    while($row = mysqli_fetch_assoc($selected_cars)){

    $seven_pin = "7pol\\".$row['7_pin'];
        
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
    }

    return $records;
    
}
?>