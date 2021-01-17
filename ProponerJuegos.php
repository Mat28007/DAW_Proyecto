<?php 
session_start();
?>
<html>
<head>
	<title>Proponer mis juegos</title>
</head>

<header>
	<?php 
  include_once 'View/includes/header.php'; 
  
  include_once 'Controlador/productos/Producto_controler.php';
  ?>
  <!-- class de styleHeader.css   -->
  <div class="contenedoor "> </div>
</header>

<body>
	<div class ="text-center mt-5  ">
		<h1 class="section-heading  ">Registrar los juegos que quieres vender o alquilar</h1><br>

	</div>

	<div  id="content" class=" d-flex justify-content-center" >
   <form action="" method="POST" role="search" > 
     <div class="p-1 bg-info rounded rounded-pill shadow-lg p-1 mb-1 rounded">
      <div class="input-group mb-1">

       <input  type="text" autocomplete="off" placeholder="Vuestro juego de mesa..." name="myInput" id="myInput"  aria-describedby="button-addon1" 
       class="form-control border-0 bg-info">
       <div class="input-group-append">
        <button id="button-addon1" class="btn btn-link text-primary">
         <i class="fa fa-search fa-5x "></i>
       </button>
     </div>
   </div>
 </div>
 <div id="suggestions" class=" overflow-auto"></div>
</form>

</div>

<!--    resultado busqueda            -->

<?php

$imge= $precioVenta= $precioMes= $precioWeek= $precioWeekend= $precioDia= $ageJuego=  
$tiempoJuego= $minJugadores= $maxJugadores= $category= $description= $nom = $imge = '';

// si nombre juego existe
if(isset($_POST['myInput']))
{
  $myInput = $_POST['myInput'];
  //si juego existe recuperamos los campos del juego
  if($myInput != ''){

    $product = new ProductoControler();
    $producto =  $product->getProductName($myInput);

    if($producto != '')
    {
      $nom =          $producto['product_name'];
      $imge=          $producto['product_image'];
      $description=   $producto['product_description'];
      $category=      $producto['product_category'];
      $maxJugadores=  $producto['product_playersMax'];
      $minJugadores=  $producto['product_playersMin'];
      $tiempoJuego=   $producto['product_time'];
      $ageJuego=      $producto['product_age'];
    }
  }
}
//button Submit Validar Juego
if(isset($_POST['registrarJuego'])) 
{
//  1. hay que comprobar si el nombre del juego esta en la BDD

 $nombreJuego = $_POST['nombre'];
 $product = new ProductoControler();
 $idGame = $product-> getIdFromNameControler($nombreJuego);

    //si SI -> insertamos los precios al juego y al usuario sin duplicar el juego
      //Hay que comprobar que el usuario ya no tiene este juego associado a su cuenta.
        //Obtenemos el array de los id de los juegos del usuario.
    $juegoExiste=false;
    $usuarioID= $_SESSION['id_user'];
    $idProd=  $product->getlistGamesUsuario($usuarioID);


function value_exists($array, $search) {
    foreach($array as $value) {
        if(is_array($value)) {
            if(true === value_exists($value, $search)) {
                return true;
            }
        }
        else if($value == $search) {
            return true;
        }
    }
    return false;
}

if(value_exists($idProd, $idGame)) {
echo'Ya tiene este juego registrado, si desea modificar los precios dirigense a preferencias';
}
else{

//Si el juego existe pero el usuario no lo tiene registrado -> insertamos los precios
  if($idGame !=''  ) {
   
    $usuarioID=       $_SESSION['id_user'];
    $precioDia=       floatval($_POST['importeDia']);
    $precioSemana=    floatval($_POST['resulSemana']);
    $precioFinSemana= floatval($_POST['resulFindeSemana']);
    $precioMes=       floatval($_POST['resulMes']);
    $precioVenta=     floatval($_POST['importeVenta']);

    $precioDia=((float)number_format($precioDia, 2) + 0);
    $precioSemana=((float)number_format($precioSemana, 2) + 0);
    $precioFinSemana=((float)number_format($precioFinSemana, 2) + 0);
    $precioMes=((float)number_format($precioMes, 2) + 0);
    $precioVenta=((float)number_format($precioVenta, 2) + 0);

    $product = new ProductoControler();
    $product->insertProductoPrecios($idGame,$usuarioID,$precioDia,$precioSemana,$precioFinSemana,$precioMes,$precioVenta);
     } else {
    //Si el juego NO existe creamos el juego con precios y el usuario

      $usuarioID=       $_SESSION['id_user'];
      $nom =            $_POST['nombre'];
      $description=     $_POST['description'];
      $category=        $_POST['type'];
      $maxJugadores=    $_POST['maxJ'];
      $minJugadores=    $_POST['minJ'];
      $tiempoJuego=     $_POST['tiempo'];
      $ageJuego=        $_POST['edad'];
      $precioDia=       floatval($_POST['importeDia']);
      $precioSemana=    floatval($_POST['resulSemana']);
      $precioFinSemana= floatval($_POST['resulFindeSemana']);
      $precioMes=       floatval($_POST['resulMes']);
      $precioVenta=     floatval($_POST['importeVenta']);

      $precioDia=((float)number_format($precioDia, 2) + 0);
      $precioSemana=((float)number_format($precioSemana, 2) + 0);
      $precioFinSemana=((float)number_format($precioFinSemana, 2) + 0);
      $precioMes=((float)number_format($precioMes, 2) + 0);
      $precioVenta=((float)number_format($precioVenta, 2) + 0);

        if(!empty($_FILES)){
          $product = new ProductoControler();
          $imge = $product->datos_imagen($_FILES);
          echo '$image 1. '.$imge.'<br>';
        }
      $product = new ProductoControler();
      $product->insertProducto($nom,$imge, $description, $category, $maxJugadores,$minJugadores,$tiempoJuego,$ageJuego,$usuarioID,$precioDia,$precioSemana,$precioFinSemana,$precioMes,$precioVenta);
    }
  }
}
?>

<form action ="" method="POST" enctype="multipart/form-data" id="ici">
  <div class="container">
    <div class = “form-control” >
      <div class="row">

        <?php
        if($imge != ""){
          ?>
          <div class="col-md-4 mb-3 fondo">
            <img class="img-fluid"  src="/tmp/<?php echo $imge; ?>" alt="imagen del juego" width="560" height="545">
          </div>
          <?php
        }else {
          ?>
          <div class="col-md-2 mb-3 fondo">
            <label for="imagen"class="subir"> </label>

            <div id="upload">
              <input type="file"  id="seleccionArchivos" name="seleccionArchivos"   size="20">
            </div>
          </div>
          <div class="col-md-2 mb-3 fondo">
           <img id="imagenPrevisualizacion" size="20">
         </div>
         <!-- La imagen que vamos a usar para previsualizar lo que el usuario selecciona -->

         <!--     <input type="submit" id="monform" name="monform" value="Enviar Imagen">  -->


       <?php } ?>


       <div class="col-md-8 mb-3 fondo">
        <label for="nombre">Nombre 
          <i class=" fa fa-cubes"></i>
        </label>

        <input type="text" autocomplete="off" class="" id="nombre" name='nombre' placeholder="Nombre del juego de mesa..." value="<?= $nom ?>" required 
        <?php if( $nom!='') { ?> readonly  <?php } ?> 
        >
        
        <label for="Descripcion">Descripcion <i class=" fa fa-edit"></i>
        </label>
        <div class="comment">
          <textarea class="textinput " id='description' name='description' placeholder=" Descripcion del juego de mesa..."  required

          <?php if( $nom!='') { ?> readonly  <?php } ?> 

          ><?php echo htmlspecialchars($description); ?></textarea>
        </div>
      </div>

      <div class="form-row" style="color:blue;margin-top: 25px;">
        <div class="col-md-6 mb-3 fondo">
          <label for="categorias" >Categoría
            <i class=" fa fa-gears" ></i>
          </label>
          <?php
          $types = array('Juego de dados','Juego de fichas','Juego de cartas','Juego de rol','Juego de tablero tradicionales','Juego de tablero contemporáneos','Juego de guerra','Juego de miniaturas','Juego temáticos');

          $type = isset($_POST['type']) && in_array($_POST['type'],$types)?$_POST['type']:'Juego de dados';

          echo '<select name="type">';

          foreach($types as $option) {
           echo '<option value="'.$option.'"'.(strcmp($option,$type)==0?' selected="selected"':'').'>'.$option.'</option>';
         }
         echo '</select>';
         ?>

       </div>
       <div class="col-md-2 mb-3 fondo">
        <label for="Numero"> Jugadores</label>
      </div>
      <div class="col-md-2 mb-3 fondo"> 
        <input type="text" class="" id='minJ' name='minJ' onkeypress="return isNumber(event)"  placeholder="Min jugadores" required
        <?php if( $nom!='') { ?> readonly  <?php } ?> 

        <?php if($minJugadores=='') {  ?> value='';><?php 
      } else { ?> value="<?= $minJugadores ?>" >   <?php } ?>

    </div>
    <div class="col-md-2 mb-3 fondo">
      <input type="text" class="" id='maxJ' name='maxJ' onkeypress="return isNumber(event)"  placeholder="Max jugadores" required
      <?php if( $nom!='') { ?> readonly  <?php } ?> 

      <?php if($maxJugadores=='') {  ?> value='';><?php 
    } else { ?> value="<?= $maxJugadores ?>" >   <?php } ?>

  </div>


  <div class="col-md-6 mb-3 fondo">
    <label for="Duracion">Duracion 
      <i class=" fa fa-hourglass-2"></i>
    </label>
    <input type="text" class="" id='tiempo' name='tiempo' onkeypress="return isNumber(event)"  placeholder="Tiempo estimado en minutos del juego" required
    <?php if( $nom!='') { ?> readonly  <?php } ?> 

    <?php if($tiempoJuego=='') {  ?> value='';><?php 
  } else { ?> value="<?= $tiempoJuego ?>" >   <?php } ?>
</div>

<div class="col-md-6 mb-3 fondo"> 
  <label for="edad">Edad minima</label>
  <input type="text" class="" id="edad" name="edad" onkeypress="return isNumber(event)"  placeholder="Edad minima mencionada en la caja" required
  <?php if( $nom!='') { ?> readonly  <?php } ?> 

  <?php if($ageJuego=='') {  ?> value='';><?php 
} else { ?> value="<?= $ageJuego ?>" >   <?php } ?>
</div>

<div class="col-md-12 mb-3 fondo">
  <label for="Precio">Precio del Alquiler
    <i class=" fa fa-money"></i>
  </label>
  <p>Puede definir el precio del alquiler de su juego al dia, para un fin de semana, una semana, o un mes. </p>
</div>
<div class="col-md-5 mb-3 fondo">Introducir el precio estimado del juego al dia: </div>
<div class="col-md-5 mb-3 fondo">
  <input type="text" class="filterme" id="importeDia"  name="importeDia" onChange="multiplicar();" 
  placeholder="importe €/Dia" required >
</div>

<div class="col-md-1 mb-3 fondo"></div>

<div class="col-md-4 mb-3 fondo" id="div1" style="display:none">
  <label for="" >Importe de un fin de semana</label>
  <input type="text" class="" id="resulFindeSemana" name="resulFindeSemana" placeholder="importe €/Fin de Semana" required>
</div>

<div class="col-md-4 mb-3 fondo" id="div2" style="display:none">
  <label for="" >Importe a la semana</label>
  <input type="text" class="" id="resulSemana" name="resulSemana" placeholder="importe €/Semana" required >
</div>

<div class="col-md-4 mb-3 fondo" id="div3" style="display:none">
  <label for="" >Importe para un mes</label>
  <input type="text" class="" id="resulMes"name="resulMes" placeholder="importe €/Mes" required>
</div>

<div class="col-md-12 mb-3 fondo">
  <label for="Precio">Precio Venta
    <i class=" fa fa-money"></i>
  </label>
</div>
<div class="col-md-4 mb-3 fondo">Introducir precio de venta: </div>

<div class="col-md-6 mb-3 fondo">
  <input type="text" class="filterme"  id="importeVenta" name="importeVenta" placeholder="importe €/Total" >
</div>

<div class="col-md-2 mb-3 fondo"></div>
</div>

<button class="btn btn-primary btn-lg btn-block" style="margin-top:10px"   
type="submit" id="registrarJuego"name="registrarJuego">
<h3>Registrar mi juego de mesa</h3>
</button>

</div>
</div>
</div>

</form>
<?php

$searchTerm = "";
if(isset($_GET['term'])) 
{
  $searchTerm = $_GET['term'];
}

$product = new ProductoControler();
$lists = $product->searchProducto($searchTerm);

?>
</body>



<script type="text/javascript">
//function de la pagina Proponer Juegos para escribir las sugerencias de la consulta SQL 

$(document).ready(function() {  
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  function autocomplete(inp, arr) {
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {

        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");

          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
            /*insert the value for the autocomplete text field:*/
            inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
            });

          a.appendChild(b);
        }
      }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
       // e.preventDefault();
       if (currentFocus > -1) {
        /*and simulate a click on the "active" item:*/
        if (x) x[currentFocus].click();
      }
    }
  });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
    closeAllLists(e.target);

  });
}

var js_array =<?php echo json_encode($lists);?>;

/*initiate the autocomplete function on the "myInput" element, and pass along the board Games array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), js_array);
});

</script>
<script src="View/templateJS/formJuego.js" type="text/javascript" charset="utf-8" async defer></script>
<div style="margin-top: 100px;"></div>
  

<?php include_once 'View/includes/footer.html';  ?>




