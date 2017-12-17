<html>
    <head>
        <title>Laravel infinite scroll pagination</title>
        <meta name="_token" content="{{ csrf_token() }}" />
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Comment Feed CSS -->
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css">
        <link rel="stylesheet" href="{{url('/public/css/comment.css')}}">
        <style type="text/css">
            .ajax-load{
                background: #e1e1e1;
                padding: 10px 0px;
                width: 100%;
            }
            .list li {
                list-style: none;
            }
        </style>
    </head>
    <body>
        <div class="container" style="position:relative">
            <div class="col-md-12 com-sm-12 col-xs-12 col-lg-12 ">
                <h1><center>Gallery</center></h1>
                <ul class="list" id="list">
                    <div id="product-data">
                        <!-- Data Loading From data.blade.php file -->
                        @include('data')
                    </div>
                </ul>

            </div>
        </div>
        <!-- Load More icon at bottom -->
        <div class="ajax-load text-center" style="display:none">
            <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More</p>
        </div>
        
        <script type="text/javascript">
        $(document).ready(function () {
            
//            Initially Loading 1 page (24 Images) only. On scroll it will load others.
            var page = 1;
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    page++;
                    loadMoreData(page);
                }
            });
            
//            Load More Data  Function
            function loadMoreData(page) {
                $.ajax(
                        {
                            url: '?page=' + page,
                            type: "get",
                            beforeSend: function ()
                            {
                                $('.ajax-load').show();
                            }
                        })
                        .done(function (data)
                        {
                            if (data.html == "") {
                                $('.ajax-load').html("No more records found");
                                return;
                            }
                            $('.ajax-load').hide();
                            $("#product-data").append(data.html);
                        })
                        .fail(function (jqXHR, ajaxOptions, thrownError)
                        {
                            alert('server not responding...');
                        });
            }
            
            
            $('div#product-data').on('click', '.products', function () {
                var dataString = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                    url: './view-counter',
                    data: {dataString: dataString},
                    success: function (data) {
                        //                alert(data.view);
                        var dataNew = data;
                        console.log(dataNew);
                        //return false; 
                        $("#view_counter_" + dataString).html('Views ' + dataNew.view);
                        var result = '';
                        var result1 = '';
                        $("#comment_" + dataString).html("");
                        $.each(dataNew.names, function (key, value) {


                            /// do stuff with key and value

                            result += "<li><b>" + value.name + "</b> " + value.comment + "<br/> <h6><i>" + value.created_at + "</i></h6></li>"


                        });


                        //                $.each(dataNew.names, function (key1, value1) {
                        //                    result1 += "<tr style='height: 200px'><td>" + value1.name + "</td></tr>";
                        //                 });
                        //                 $("#id_" + dataString).append(result1);
                        $("#comment_" + dataString).append(result);

                        //                
                    }
                });
            });
            //Likes
            $('div#product-data').on('click', '.likes', function () {
                var dataString = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                    url: './like-counter',
                    data: {dataString: dataString},
                    success: function (status) {
                        //alert(status);
                        //return false; 
                        $("#like_counter_" + dataString).html(status + ' Likes');
                    }
                });
            });

            // next
            $('div#product-data').on('click', ".next_button", function () {

                var this_modal = $(this).parent('div').parent('div').parent('div').parent('div').attr('id');
                var next_modal = $(this).parent('div').parent('div').parent('div').parent('div').parent('li').next('li').find('div.modal').attr('id');

                var dataString = $(this).parent('div').parent('div').parent('div').parent('div').siblings('form').parent('li').next('li').find('input.pid').val();

                //        alert(dataString);

                $.ajax({
                    type: "POST",
                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                    url: './view-counter',
                    data: {dataString: dataString},
                    success: function (data) {
                        //                alert(data.view);
                        var dataNew = data;
                        console.log(dataNew);
                        //return false; 
                        $("#view_counter_" + dataString).html('Views ' + dataNew.view);
                        $("#" + this_modal).modal('hide');
                        $("#" + next_modal).modal('show');



                    }
                });




            });

            //prev
            $('div#product-data').on('click', ".prev_button", function () {

                var this_modal = $(this).parent('div').parent('div').parent('div').parent('div').attr('id');
                var prev_modal = $(this).parent('div').parent('div').parent('div').parent('div').parent('li').prev('li').find('div.modal').attr('id');

                var dataString = $(this).parent('div').parent('div').parent('div').parent('div').siblings('form').parent('li').prev('li').find('input.pid').val();

                //        alert(dataString);

                $.ajax({
                    type: "POST",
                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                    url: './view-counter',
                    data: {dataString: dataString},
                    success: function (data) {
                        //                alert(data.view);
                        var dataNew = data;
                        console.log(dataNew);
                        //return false; 
                        $("#view_counter_" + dataString).html('Views ' + dataNew.view);
                        $("#" + this_modal).modal('hide');
                        $("#" + prev_modal).modal('show');



                    }
                });


            });


            //test



            //Right Key press


            var modal_id = 0;
            var next_modal = 0;
            var counter = 0;

            $('div#product-data').on('keyup', 'div.product_info', function (event) {

                if (event.keyCode === 39) {
                    //var modal_id = $(this).parent('li').children("div[class*='fadeIn in']").attr('id');
                    if (modal_id === 0)
                    {
                        modal_id = "myModal" + $(this).find('div').attr('id');
                    }
                    next_modal = $("#" + modal_id).parent('li').next('li').find('div.modal').attr('id');
                    //                alert(modal_id);
                    //                alert(next_modal);
                    ////                console.log(next_modal);
                    //                console.log(next_modal);

                    //                alert($('#next-button' + modal_id).attr('id'));
                    //                alert(next_modal);
                    //                $('#next-button' + modal_id).click();
                    $("#" + modal_id).modal('hide');

                    $("#" + next_modal).modal('show');
                    //return false;

                    counter ++;

                    if (counter > 5) {
                        page++;
                        loadMoreData(page);
                    }
                }

                if (event.keyCode === 37) {
                    //var modal_id = $(this).parent('li').children("div[class*='fadeIn in']").attr('id');
                    if (modal_id === 0)
                    {
                        modal_id = "myModal" + $(this).find('div').attr('id');
                    }
                    next_modal = $("#" + modal_id).parent('li').prev('li').find('div.modal').attr('id');
                    //                alert(modal_id);
                    //                alert(next_modal);
                    ////                console.log(next_modal);
                    //                console.log(next_modal);

                    //                alert($('#next-button' + modal_id).attr('id'));
                    //                alert(next_modal);
                    //                $('#next-button' + modal_id).click();
                    $("#" + modal_id).modal('hide');

                    $("#" + next_modal).modal('show');
                    //return false;
                }

                modal_id = next_modal;





            });






            //                $(".product_info").on('click',function(){
            //                    alert($(this).parent('li').next('li').find('div.modal').attr('id');
            //                });

            //                
            //Comment
            //    $('div#product-data').on('click','.comments', function () {
            //
            //        var id = $(this).attr('id');
            //        var comment = $('#comment-input').val();
            //        
            //        var data = 'id=' + id & 'comment=' + comment;
            //        
            //
            //        $.ajax({
            //            type: "POST",
            //            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
            //            url: './add-comment',
            //            data: data,
            //            success: function (status) {
            //                alert(status);
            //                //return false; 
            ////                $("#like_counter_" + dataString).html(status+' Likes');
            //            }
            //        });
            //    });
        });
        </script>

    </body>
</html>