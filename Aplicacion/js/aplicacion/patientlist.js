$(function(){ 

    $.ajax({ 

      method: "GET", 
      
      url: "getrecords_ajax.php",

    }).done(function( data ) { 

      var result= $.parseJSON(data); 

    
      var string='<div class="card mb-3"> \
      <div class="card-header"> \
          <i class="fas fa-table"></i> \
          Listado pacientes</div> \
          <div class="card-body"> \
              <div class="table-responsive"> \
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> \
                  <tr><th>id</th> <th>nombre</th>  <th>apellidos</th> <th>dni</th> \
                    <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2"> \
                        <ul id ="myUL">';

     /* from result create a string of data and append to the div */
     for ( i = 0; i < result.length; i++){
        if (myvar == result[i]['idMedico']) { 
            string +=  '<p><a href="patientHARc.php">' + result[i]["id"] + "   " + result[i]['nombre'] + "   "  + result[i]['apellidos'] + "   "  + result[i]['dni'] + '</a></p>' ; 
        }
    }
           string += '</ul> \
                    </table> \
                </div> \
            </div> \
        </div>';
        
        $("#records").html(string); 
         
    });

}); 
function myFunction() {
    
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    console.log("Pedo")
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("p");
    for (i = 0; i < li.length / 2; i++) {
        a = li[i].getElementsByTagName("a")[0];
        console.log(a)
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}