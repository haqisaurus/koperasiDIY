
    function ceklogin()
    {
        if($("#username").val()=="" || $("#password").val()=="")
        {
            alert("Username/Password masih kosong!");
            return false;
        }
    }



    $(document).ready(function()
    {
        //pengaturan login supaya langsung fokus
        $("#username").focus();

        //pengaturan styling class table_data
        var i = 0;
        $(".table_data > tbody > tr").each(function()
        {
            if(i==2)
            {
                $(this).attr("class","genep");
                i=0;
            }

            if($(this).children().children().attr("id")=="checkAll")
            {

                $(this).children().eq(0).css("width",25);

            }
            i++;
        });



        //pengaturan styling class table_form
        $(".table_form > tbody > tr").each(function()
        {

            $(this).children().eq(0).attr("class","genep");
            $(this).children().eq(0).css("width",210);
        });
        var anak = ($(".table_form > tbody > tr").last().index())+1;
        $(".table_form > tbody").prepend("<tr><th colspan='"+anak+"'>"+$(".table_form").attr("judul")+"</th></tr>");

        //checkAll
        $("#checkAll").click(function()
        {
            if($(this).val()=="check")
            {
                var n = $(this).parent().parent().siblings().length;
                for(var i=0;i<n;i++)
                {
                    $(this).parent().parent().siblings().eq(i).children().eq(0).children().prop("checked",true);
                }
                $(this).val("uncheck");
                //$(".table_form input[type='checkbox']").change();
            }
            else
            {
                var n = $(this).parent().parent().siblings().length;
                for(var i=0;i<n;i++)
                {
                    $(this).parent().parent().siblings().eq(i).children().eq(0).children().prop("checked",false);
                }
                $(this).val("check");
            }
        })

        //murbox
        $("a").each(function(){
            if($(this).attr("rel")=="murbox1")
            {
                var dest = $(this).attr("href");
                $(dest).attr("class","divmurbox1");
                $(dest).attr("show","false");
            }

        });
        $("a").click(function(){
            var dest = $(this).attr("href");
            if($(this).attr("rel")=="murbox1")
            {
                if($(this).attr("var")=="black")
                {
                    $("html").prepend("<div id='murblack'></div>");
                   $("#murblack").fadeIn("fast");
                }
                if($(dest).attr("show")=="false")
                {

                    $("a").each(function(){
                        if($(this).attr("rel")=="murbox1")
                        {
                            var dest2 = $(this).attr("href");
                            if($(dest2).attr("show")=="true")
                            {
                                $(dest2).slideUp("fast");
                                $(dest2).attr("show","false");
                            }
                            $(dest2).hover(function(){
                                mouse_is_inside=true;
                            }, function(){
                                mouse_is_inside=false;
                            });

                            $("body").mouseup(function(){
                                if(! mouse_is_inside) $(dest2).slideUp("fast");
                            });



                        }

                    });
                    $(dest).slideDown("fast");
                    $(dest).attr("show","true");
                }
                else
                {
                    $(dest).slideUp("fast");
                    $(dest).attr("show","false");
                }
            }
        });

        //arrow suckerfish
        $(".arrow").each(function(){
            var width = $(this).parent().width() - 15;
            $(this).css("margin-left",width);
        });
        
        //padding sucker fish
        $("#nav-one > li > a").each(function(){
        	$(this).css("height",20);
        	$(this).css("padding-top",4);
            
        });
        
        
       
    });




