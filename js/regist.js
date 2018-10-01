$(document).ready(function () {
    $('#login').on('submit',function(e){
        e.preventDefault();

        var str= $("#username").val();
        str=str.replace(/^\s*/,'').replace(/\s*$/,'');
        str=str.replace(/\s{2,}/g, " ").replace(/([.!?]+)(?=\S)/g, "$1 ");
        alert(">"+str+"<");


        if($("#password").val() === $("#passwordCopy").val())
        {  $.ajax({
                type: "POST",
                url: "/user/regist.php",
                datatype: "text",
                data: {userEmail: $("#userEmail").val().replace(/^\s*/,'').replace(/\s*$/,''),
                    username: $("#username").val().replace(/^\s*/,'').replace(/\s*$/,'').replace(/\s{2,}/g, " ")
                        .replace(/([.!?]+)(?=\S)/g, "$1 ")
                    , password: $("#password").val()},
                document:location.href="/user/regist.php",
            });
        }
        else {alert("Пароль було неправильно повторено");}
    });
});
