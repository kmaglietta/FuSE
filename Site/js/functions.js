function search(){
    var classN = document.getElementById('class');
    var tutor = document.getElementById('tutor');
    var date = document.getElementById('date');
    var location = document.getElementById('location');
    $.post(
        "../index.php",
        {
            field: "value",
            name: "john"
        }.done(
            function(data){
                $('#fromAjax').html(data);
            }    
        )
    )
}