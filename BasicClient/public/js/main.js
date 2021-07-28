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
let categoryListing = () => {
    $.ajax({
        url: "http://127.0.0.1/php-api/api/?mode=category&process=root",
        type: "GET",
        dataType: "json",
        success: function (result) {
            // data found
            if (result.data.length != 0) {
                var html = "";
                $.each(result.data, function (i, e) {
                    html += '<li><a href="./category.php?id=' + e.id + '">' + e.name + '</a>'
                });

                $(".category").html(html);
            }
            //not found
            else {
                $(".category").html("<p>Kategori yok'</p>");
            }
        }
    });
}

//get child categories 
let childCategoryListing = (parent_id) => {
    //var parent_id = $("#parent_id").val();
    $.ajax({
        url: "http://127.0.0.1/php-api/api/?mode=category&process=child&parent_id=" + parent_id,
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
}

//get posts
let postListing = (category_id) => {
    $.ajax({
        url: "http://127.0.0.1/php-api/api/?mode=post&process=list&category_id=" + category_id,
        type: "GET",
        dataType: "json",
        success: function (result) {
            console.log(result);
            // data found
            if (result.data.length != 0) {
                var html = "";
                $.each(result.data, function (i, e) {
                    html += '<li><img src="' + e.image + '"style="width:120px;""><a href="./post_detail.php?id=' + e.id + '">' + e.name + '</a>'
                });

                $(".post").html(html);
            }
            //not found
            else {
                $(".post").html("<p>Gönderi yok</p>");
            }
        }
    })
}

//get post detail
let postDetail = (post_id) => {
    $.ajax({
        url: "http://127.0.0.1/php-api/api/?mode=post&process=detail&post_id=" + post_id,
        type: "GET",
        dataType: "json",
        success: function (result) {
            // status true
            if (result.status == true) {
                $("#title").html(result.data.name);
                $("#image").attr("src", result.data.image);
                $("#text").html(result.data.text);
            }
        }
    })
}