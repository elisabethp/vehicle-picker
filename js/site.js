$(document).ready(function() {
    //update the makes select 
    $("#years").change(function() {
        $("#makes, #models, #selected-car").empty();
        $("#makes, #models").append('<option></option>').text('...');
        
        $.post("generate_data.php", {year: $("#years").val()},
            function(makes_array) {
                var makes = $.parseJSON(makes_array);
                
                $("#makes").removeAttr("disabled");
                $("#makes").append($("<option></option>").text("Choose a Model..."));
            
                for (var i = 0; i < makes.length; i++) {
                    $("#makes").append($('<option></option>').attr("value", makes[i]).text(makes[i]));
                }
        });
    });
    
    //update the models select 
    $("#makes").change(function() {
        $("#models, #selected-car").empty();
        
        $.post("generate_data.php", {year: $("#years").val(), make: $("#makes").val()},
            function(models_array) {
                var models = $.parseJSON(models_array);

                $("#models").removeAttr("disabled");
                $("#models").append($("<option></option>").text("Choose a Make..."));
            
                for (var i = 0; i < models.length; i++) {
                    $("#models").append($('<option></option>').attr("value", models[i]).text(models[i]));
                }
        });
        
    });
    
    $("#models").change(function() {
        $("#selected-car").empty();
        
        //display the chosen car
        $("#selected-car").append("You've selected a " + $("#years").val() + " " + $("#makes").val() + " " + $("#models").val() + "!" );
        
    });
    
});