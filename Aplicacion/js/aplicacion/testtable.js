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
                                <tr><th>id</th><th>nombre</th> <th>apellidos</th> <th>dni</th> <th>fechaNacimineto</th><th>sexo</th><th>notasMedicas</th><th>IndiceBarthel</th><tr>';

     /* from result create a string of data and append to the div */
      $.each( result, function( key, value ) { 
        console.log("aqui ahora" + value['idMedico']);
        if (myvar == value['idMedico']) { 
            string += "<tr> <td>"+value['id'] + "</td><td>"+value['nombre']+'</td><td>'+value['apellidos']+'</td><td>'+value['dni']+'</td><td>'+value['fechaNacimineto']+'</td><td>'+value['sexo']+'</td><td>'+value['notasMedicas']+'</td><td>'+value['IndiceBarthel']+'</td> '; 
      }}); 

           string += '</table>\
                    </div>\
                </div>\
            </div>'; 

        $("#records").html(string); 

     }); 

}); 