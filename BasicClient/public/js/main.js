$(document).ready(function () {

    //post register
    $("#register").click(function () {
        var data = $("form").serialize();
        $.ajax({
            url: "http://127.0.0.1/php-api/api/?mode=user&process=add",
            type: "POST",
            data: data,
            dataType: "json",
            success: function (result) {
                //check error
                if (result.status == false) {
                    $(".status").html(result.message).show();
                } else {
                    //true statement
                    $(".status").html(result.message).show();
                    //for the session
                    $.post("./api/index.php", data);
                    $("form")[0].reset();
                }
            }
        })
    });

    //post login
    $("#login").click(function () {
        var data = $("form").serialize();
        $.ajax({
            url: "http://127.0.0.1/php-api/api/?mode=user&process=login",
            type: "POST",
            data: data,
            dataType: "json",
            success: function (result) {
                //check error
                if (result.status == false) {
                    $(".status").html(result.message).show();
                } else {
                    //true statement
                    $(".status").html(result.message).show();
                    //for the session
                    $.post("./api/index.php", data);
                    $("form")[0].reset();
                }
            }
        })
    });

    //get categories 
    $.ajax({
        url: "http://127.0.0.1/php-api/api/?mode=category&process=root",
        type: "GET",
        dataType: "json",
        success: function (result) {
            // data found
            if (result.data.length != 0) {
                var html = "";
                $.each(result.data, function (i, e) {
                    html += '<li><a href=". /category.php?id=' + e.id + '">' + e.name + '</a>'
                });

                $(".category").html(html);
            }
            //not found
            else {
                $(".category").html("<p>Kategori yok'</p>");
            }
        }
    });


    var parent_id = $("#parent_id").val();
    //get child categories 
    $.ajax({
        url: "http://127.0.0.1/php-api/api/?mode=category&process=child&parent_id="+parent_id,
        type: "GET",
        dataType: "json",
        success: function (result) {
            // data found
            if (result.data.length != 0) {
                var html = "";
                $.each(result.data, function (i, e) {
                    html += '<li><a href="./post.php?id=' + e.id + '">' + e.name + '</a>'
                });

                $(".categoryChild").html(html);
            }
            //not found
            else {
                $(".categoryChild").html("<p>Kategori yok</p>");
            }
        }
    })

})