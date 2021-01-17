
    $("#importeDia").on({
      blur:function(){
        $("#div1").fadeIn();
        $("#div2").fadeIn("slow");
        $("#div3").fadeIn(3000);
      },
      mouseleave: function() {
        $("#div1").fadeIn();
        $("#div2").fadeIn("slow");
        $("#div3").fadeIn(3000);
      }
    });
 
//controla si el importe es numerico y tiene que ser un Integer
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  }

//controla si el importe es numerico y puede ser Double
//se implementa con la class "filterme"
$('.filterme').keypress(function(eve) {
  if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0)) {
    eve.preventDefault();
  }

  // this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
  $('.filterme').keyup(function(eve) {
    if ($(this).val().indexOf('.') == 0) {
      $(this).val($(this).val().substring(1));
    }
  });
});

  function multiplicar(){
    m1  =  document.getElementById("importeDia").value;
    r   =  m1*2;
    re  =  m1*7;
    res =  m1*30;

    document.getElementById("resulFindeSemana").value = r;
    document.getElementById("resulSemana").value = re;
    document.getElementById("resulMes").value = res;
  }

// Obtener referencia al input y a la imagen

const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
$imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

// Escuchar cuando cambie
$seleccionArchivos.addEventListener("change", () => {
  // Los archivos seleccionados, pueden ser muchos o uno
  const archivos = $seleccionArchivos.files;
  // Si no hay archivos salimos de la función y quitamos la imagen
  if (!archivos || !archivos.length) {
    $imagenPrevisualizacion.src = "";
    return;
  }
  // Ahora tomamos el primer archivo, el cual vamos a previsualizar
  const primerArchivo = archivos[0];
  // Lo convertimos a un objeto de tipo objectURL
  const objectURL = URL.createObjectURL(primerArchivo);
  // Y a la fuente de la imagen le ponemos el objectURL
  $imagenPrevisualizacion.src = objectURL;
});