$(document).ready(function(){
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
