$('form').submit(function(e){
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "user/autorization.php",
        datatype: "text",
        data: {username : $("#username").val(),password:$("#password").val() },
        success: function(data) {
            console.log(data);
        }
    });
});