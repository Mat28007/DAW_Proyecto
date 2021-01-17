
       
//$.datepicker.setDefaults($.extend($.datepicker.regional[""]));
/*$("#mydate").datepicker({
    onSelect: function(dateText, inst) {
    var dateAsString = dateText; 
    alert (dateAsString); //this prints out the right value.
    alert (mydate.value); //this value is the same as dateText
    }
});
*/
 $( "#datepicker" ).datepicker({
                showAnim: "drop", 
                showOptions: {direction: "up"},
                onSelect: function (date) {
               var fecha=date;
					
                },
            });
 $( "#datepicker2" ).datepicker({
                showAnim: "drop", 
                showOptions: {direction: "up"},
                onSelect: function (date) {
               var fecha2=date;
					
                },
            });
