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

        $("body").on('click', '#new', function() {
            var context = $(this).attr("data-context");
            $.get("/"+LANG+"/" + context + "/newForm", function (data) {
                    $(".content > form").hide();
                    $(".content > div").hide();
                    $(".content > form#newRecord").show();
                    $(".content > form#newRecord button").attr('data-context', context);

                    createForm('#newRecord', data);
                },
                'jSON'
            ).fail(function (data) {
                console.log("FAILED");
                console.log(data);
            });
        });

        $("body").on('click', '#edit', function() {
            var context = $(this).attr("data-context"),
                id = $(this).attr("data-id");
            $.get("/"+LANG+"/" + context + "/editForm/" + id, function (data) {
                    $(".content > form").hide();
                    $(".content > div").hide();
                    $(".content > form#updateRecord").show();
                    $(".content > form#updateRecord button").attr('data-context', context);
                    $(".content > form#updateRecord button").attr('data-id', id);

                    createForm('#updateRecord', data);
                    populateForm(data);
                },
                'jSON'
            ).fail(function (data) {
                console.log("FAILED");
                console.log(data);
            });
        });

        $("body").on('click', '#delete', function() {
            var context = $(this).attr("data-context"),
                id = $(this).attr("data-id");
            $.ajax({
                type: "DELETE",
                url: "/"+LANG+"/" + context + "/delete/" + id,
                dataType: 'JSON',
                success: function(data) {
                    loadList(context);
                }
            });
        });

        $("body").on('click', '#newRecord button', function(e) {
            e.preventDefault();
            var context = $(this).attr("data-context");
            $.ajax({
                type: "POST",
                url: "/"+LANG+"/" + context + "/create",
                data: $("form#newRecord").serialize(),
                dataType: 'JSON',
                success: function(data) {
                    loadList(context);
                }
            });
        });

        $("body").on('click', '#updateRecord button', function(e) {
            e.preventDefault();
            var context = $(this).attr("data-context"),
                id = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: "/"+LANG+"/" + context + "/update/" + id,
                data: $("form#updateRecord").serialize(),
                dataType: 'JSON',
                success: function(data) {
                    loadList(context);
                }
            });
        });

    function createForm(selector, data) {
        var form = $(selector).children('.inputGroup');

        form.html("");

        console.log(data);

        data["data"]["fields"].forEach(function(e,i,a) {
            form.append('<label>'+e["title"]+'</label>');

            if (e["type"] === "text")
                form.append('<input type="text" id="'+e["name"]+'" name="'+e["name"]+'" />');
            else {
                var html = '<select id="'+e["name"]+'" name="'+e["name"]+'">';

                e["options"].forEach(function(q,w,r) {
                    html += '<option value="'+q["value"]+'">'+q["title"]+'</option>';
                });

                form.append(html +'</select>');
            }
        });
    }

    function populateForm(data) {
        var form = $('#updateRecord').children('.inputGroup');

        data["data"]["fields"].forEach(function(e,i,a) {
            var element = form.children('#'+e["name"]);

            element.val(e["value"]);
        });
    }

    function loadList(link) {
        $.get("/"+LANG+"/" + link + "/listAll", function (data) {
                $(".content > form").hide();
                $(".content > div").show();
                $(".content > div .title").html(data["data"]["page"]);
                $(".content > div #new").attr("data-context", link);
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
                    $("tbody").append('<td><button id="edit" data-context="'+link+'" data-id="'+e[0]+'">'+data["data"]["edit"]+'</button> <button id="delete" data-context="'+link+'" data-id="'+e[0]+'">'+data["data"]["delete"]+'</button></td></tr>');
                });
            },
            'jSON'
        ).fail(function (data) {
            console.log("FAILED");
            console.log(data);
        });
    }

});