<?php  
    //declare arrays
    $data_years = array();
    $data_makes = array();
    $data_models = array();
    $years = array();

    create_data();
    
    //which dropdown should I generate?
    if(count($_POST) == 0) { //first time on page
        generate_years();
    }
    else if (count($_POST) == 1) { //you've selected a year
        generate_makes();   
    }
    else { //you've selected a year and a make.. hollaaaaa
        generate_models();
    }

    function generate_years() {
        global $years, $data_years;

        for ($i = $data_years[0]; $i <= $data_years[count($data_years) - 1]; $i++) {
            array_push($years, $i);
        }
    }

    function generate_makes() {
        global $data_years, $data_makes;
        
        //returns the array of makes
        $makes = array();
        $target = $_POST["year"];
        
        $index = array_search($target, $data_years) + 1;
        
        for ($i = $index; $data_years[$i] == $target; $i++) {
            if (!in_array($data_makes[$i], $makes)) {
                array_push($makes, $data_makes[$i]);
            }
        }

        echo json_encode($makes);
    }

    function generate_models() {
        global $data_years, $data_makes, $data_models;
        
        //returns the array of models
        $models = array();
        $target_year = $_POST["year"];
        $target_make = $_POST["make"];
        
        //need to find where the model is
        $index = array_search($target_year, $data_years) + 1;

        for ($i = $index; $data_years[$i] == $target_year; $i++) {
            if (($data_makes[$i] == $target_make)) {
                array_push($models, $data_models[$i]);
            }
        }

        echo json_encode($models);
    }
    
    function create_data() {
        global $data_years, $data_makes, $data_models;
        
        //parse csv into $car_data 
        $car_data = array_map('str_getcsv', file('./csv/car-data.csv')); 

        //and move all data into separate arrays
        for ($i = 0; $i < count($car_data); $i++) {
            array_push($data_years, $car_data[$i][0]);
            array_push($data_makes, $car_data[$i][1]);
            array_push($data_models, $car_data[$i][2]);
        }

    }

?>
