$(window).ready(function() {

    var LANG = $("script[src='/views/js/main.js']").attr('data-lang');

    // LOGIN

    $("#login").on("click", function () {
        var email = $("#email").val(),
            pass = $("#password").val();

        $("#email").removeClass("withError");
        $("#password").removeClass("withError");
        $(".errorMsg").html("");

        $.post("/"+LANG+"/login/authenticate", {"email": email, "password": pass}, function(data){
            if (data.code == 200) {
                $.get("/"+LANG+"/login/homeLoggedIn", function(data) {
                    $("body").html(data);
                    $("#logged-email").html(email);
                    loadList('usage');
                });
            }
        }, 'jSON').fail(function(data) {
            $("#email").addClass("withError");
            $("#password").addClass("withError");
            $(".errorMsg").html(data.responseJSON.error);
        });
    });

    // MENU

        $("body").on('click', ".link-list", function () {
            var link = $(this).attr("link");
            loadList(link);
        });

    function loadList(link) {
        $.get("/"+LANG+"/" + link + "/listAll", function (data) {
                $(".content > form").hide();
                $(".content > div").show();
                $(".content > div .title").html(data["data"]["page"]);
                $(".content > div #new").html(data["data"]["new"]);
                $("thead tr").html("");

                data["data"]["columns"].forEach(function(e,i,a){
                    $("thead tr").append('<th>'+e+'</th>');
                });

                $("thead tr").append('<th style="text-align: center;">-</th>');

                $("tbody").html("");
                data["data"]["list"].forEach(function(e,i,a){
                    $("tbody").append('<tr class="">');
                    e.forEach(function(q,w,r) {
                        $("tbody").append('<td>'+q+'</td>');
                    });
                    $("tbody").append('<td><button id="edit">'+data["data"]["edit"]+'</button> <button id="delete">'+data["data"]["delete"]+'</button></td></tr>');
                });
            },
            'jSON'
        ).fail(function (data) {
            console.log("FAILED");
            console.log(data);
        });
    }

});