$(function(){ 



  $.ajax({ 

    method: "GET", 
    
    url: "getrecords_ajax.php",

  }).done(function( data ) { 

    var result= $.parseJSON(data); 


    var string='<div class="card mb-3"> \
                  <div class="card-header"> \
                      <i class="fas fa-table"></i> \
                      Data Table Example</div> \
                      <div class="card-body"> \
                          <div class="table-responsive"> \
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> \
                              <tr><th>Tipo</th><th> De pie </th> <th> Sentado </th> <th> Caminando </th>   <tr>';

   /* from result create a string of data and append to the div */
   
      string += '<tr> <td> Diario </td><td>44%</td><td>20%</td><td>36%</td>'; 
      string += '<tr> <td> Semanal </td><td>40%</td><td>26%</td><td>34%</td>'; 
      string += '<tr> <td> Mensual </td><td>42%</td><td>23%</td><td>35%</td>'; 

      string += '</table>\
              </div>\
          </div>\
      </div>'; 

    $("#records").html(string); 

   }); 

}); 