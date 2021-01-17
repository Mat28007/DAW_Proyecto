
function validarAdresse()
{
    var searchInput = 'direccion';
    $(document).ready(function () {
      var autocomplete;
      autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
        types: ['geocode'],
      });

      google.maps.event.addListener(autocomplete, 'place_changed', function () 
      {
        var place = autocomplete.getPlace();
        console.log(place)

        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value  = place.geometry.location.lng();

        for(var count=0; count<place.address_components.length; count++){
          switch(place.address_components[count].types[0]){
            case 'route':
            document.getElementById('addrese').value  = place.address_components[count].long_name;
            break;
            case 'locality':
            document.getElementById('ciudad').value  = place.address_components[count].long_name;
            break;
            case 'postal_code':
            document.getElementById('cp').value  = place.address_components[count].long_name;
            break;
            case 'administrative_area_level_2':
            document.getElementById('provincia').value  = place.address_components[count].long_name;
            break;
          }
        }
      });
    });
}


function validateMail(idMail) 
{
    //Creamos un objeto 
    object = document.getElementById(idMail);
    valueForm = object.value;
    // Patron para el correo
    var patron = /^(?:[^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*|"[^\n"]+")@(?:[^<>()[\].,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,63}$/i;
    if (valueForm.search(patron) == 0) {
        //Mail correcto
        object.style.color = "#000";
        return;
      }
    //Mail incorrecto
    object.style.color = "#f00";
  }

  //pone el nombre de la ciudad en mayuscula
  function myFunction() {
  var x = document.getElementById("ciudad");
  x.value = x.value.toUpperCase();
}


  function mostrarLocalizacion(_ciudad){
    //Creamos un objeto 
    object = document.getElementById(_ciudad);
    valueForm = object.value;
    alert(valueForm)
       $(valueForm).on({
    
      blur:function(){
        $("#ciudad").fadeIn();
        $("#provincia").fadeIn("slow");
        $("#div3").fadeIn(3000);
      },
      mouseleave: function() {
        $("#ciudad").fadeIn();
        $("#provincia").fadeIn("slow");
        $("#div3").fadeIn(3000);
      }
    });
    
  }

  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  }
//////////////////////////////////////////////
var checkForm = function(e) {
  var f = e.target;

  if( f.nombre.value == ''){
    f.nombre.style.backgroundColor = ' #ffdddd' ;
    f.nombre.focus();
    e.preventDefault();
    return;
  }

  else if( f.id_mail.value == ''){
    f.id_mail.style.backgroundColor = ' #ffdddd' ;
    f.id_mail.focus();
    e.preventDefault();
    return;
  }

  else if( f.direccion.value == ''){
    f.direccion.style.backgroundColor = ' #ffdddd' ;
    f.direccion.focus();
    e.preventDefault();
    return;
  }

  else if(f.password.value=='') {
    f.password.style.backgroundColor = ' #ffdddd' ;
    f.password.focus();
    e.preventDefault();
    return;
  }

  else if( f.confirm.value == ''){
    f.confirm.style.backgroundColor = ' #ffdddd' ;
    f.confirm.focus();
    e.preventDefault();
    return;
  }
  
  else if (f.password.value != f.confirm.value) {
    f.password.style.backgroundColor = ' #ffdddd' ;
    f.confirm.style.backgroundColor = ' #ffdddd' ;
    f.password.focus();
    e.preventDefault();
    return;
    
  }   
};
// check casillas del formulario con la variable checkForm
/*Our checkForm function then needs to be defined as a variable (var or const),
and instead of returning false we use e.preventDefault() to prevent form submission, and there's no need to return true.*/
if(document.getElementById("formCrearCuenta")!==null){
  document.getElementById("formCrearCuenta").addEventListener("submit", checkForm, false);
}






