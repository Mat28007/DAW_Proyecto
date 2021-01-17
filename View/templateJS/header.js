
    // Function used to shrink nav bar removing paddings and adding black background 
    const listItems = document.querySelectorAll('.navlinks li a');

    $(window).scroll(function() {
      if ($(document).scrollTop() > 50) {
        $('.nav').addClass('affix');
        for (let i = 0; i < listItems.length; i++) {
         listItems[i].style.color = "black";
       }

       $(" li a").mouseover(function(){
        $(this).css("color", "#8B0000");
      });
       $(" li a").mouseout(function(){
        $(this).css("color", "black");
      });
       $('.dropdown-content').css("color" , 'black');
       $(".dropdown-content ul").mouseover(function(){
        $(this).css("color", "#8B0000");
      });
       $(" .dropdown-content ul").mouseout(function(){
        $(this).css("color", "black");
      });


        //logo
        $('.logo a').css("color",'black');
        $(".logo a").mouseover(function(){
          $(this).css("color", "#8B0000");
        });
        $(".logo a").mouseout(function(){
          $(this).css("color", "black");
        });

      } else {

        $('.nav').removeClass('affix');
        for (let i = 0; i < listItems.length; i++) {
         listItems[i].style.color = "white";

       }
       $("li a").mouseover(function(){
        $(this).css("color", "#8B0000");
      });
       $("li a").mouseout(function(){
        $(this).css("color", "white");
      });


       $(".dropdown-content ul").mouseover(function(){
        $(this).css("color", "#8B0000");
      });
       $(".dropdown-content ul").mouseout(function(){
        $(this).css("color", "black");
      });


       $('.logo a').css("color","white");
       $(".logo a").mouseover(function(){
        $(this).css("color", "#8B0000");
      });
       $(".logo a").mouseout(function(){
        $(this).css("color", "white");
      });


     }
   });

/********  mostrar barras header  **********/
    $('.navTrigger').click(function () {
      $(this).toggleClass('active');
      $("#mainListDiv").toggleClass("show_list");
      $("#mainListDiv").fadeIn();
    });

    /*cuando el usuario click sobre el icono de usuario, muestra o esconde el dropdown content*/

    function dropdownHeader() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

