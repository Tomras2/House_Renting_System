// console.log("hello world");
// $('.datepicker').datepicker();
    // $(document).ready(function(){
    //   var date_input=('.input-daterange input'); //our date input has the name "date"
    //   var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    //   var options={
    //     format: 'mm/dd/yyyy',
    //     container: container,
    //     todayHighlight: true,
    //     autoclose: true,
    //     orientation: "top",
    //   };
      
    //   date_input.datepicker(options);
    // })
    var disabledDays = ["12-30-2020","12-31-2020"];

function nationalDays(date) {
  var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
  for (i = 0; i < disabled.length; i++) {
      if($.inArray((m+1) + '-' + d + '-' + y,disabled) != -1 || new Date() > date) {
          return [false];
      }
  }
  return [true];
}

jQuery(document).ready(function() {
  jQuery('#dt').datepicker({
      minDate: Date.now(),
      dateFormat: 'yy, MM, dd',
      constrainInput: true,
      beforeShowDay: nationalDays
  });
});