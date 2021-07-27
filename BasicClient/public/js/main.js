$(document).ready(function () {
    $("#register").click(function () {
        var data = $("form").serialize();
        $.ajax({
            url: "http://127.0.0.1/php-api/api/?mode=user&process=add",
            type: "POST",
            data: data,
            dataType: "json",
            success: function (result) {
                console.log(data);
                console.log(result);
                //check error
                if (result.status == false) {
                    $(".status").html(result.message).show();
                    console.log(data);
                    console.log(result);
                }else{
                    $(".status").html(result.message).show();
                }
            }
        })
    });
})