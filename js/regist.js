
$('form').submit(function(e){
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "user/regist.php",
        datatype: "text",
        data: {userEmail : $("#userEmail").val(),username : $("#username").val(),password:$("#password").val() },
        success: function(data) {
            console.log(data);
        }
    });
});