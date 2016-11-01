$(document).ready(function(){


      var dataString = "PIN=" + PIN;

      $.ajax({
          type: "POST",
          url: "f1.php",
          dataType: "html",
          data: dataString,
          cache: false,
          success: function(site)
              {
                  console.log("site name is:" + site);
              }
      });
});
