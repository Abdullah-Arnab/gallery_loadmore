
<html>
    <head>
        <title>Laravel infinite scroll pagination</title>
        <meta name="_token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css">
        <style type="text/css">
            .ajax-load{
                background: #e1e1e1;
                padding: 10px 0px;
                width: 100%;
            }
            .list li {
                list-style: none;
                /*                        width: 33.3%;*/
                /*                        float: left;
                                        padding-left: 15px;
                                        padding-right: 15px;
                                        margin-bottom: 20px;*/
                /*                display: none;*/
            }
        </style>
    </head>
    <body>
<!--<input type="hidden" value="{{csrf_field()}}" id="csrf_token" />-->
        <div class="container" style="position:relative">
            <div class="col-md-12 com-sm-12 col-xs-12 col-lg-12 ">
                <h1><center>Gallery</center></h1>
                <ul class="list" id="list">
                    <div id="product-data">
                        @include('data')
                    </div>


                </ul>

            </div>
        </div>

        <div class="ajax-load text-center" style="display:none">
            <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More post</p>
        </div>
        <script type="text/javascript">
$(document).ready(function () {
    var page = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadMoreData(page);
        }
    });

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

    $('div#product-data').on('click','.products', function () {

        var dataString = $(this).attr('id');

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
            url: './view-counter',
            data: {dataString: dataString},
            success: function (status) {
                //alert(status);
                //return false; 
                $("#view_counter_" + dataString).html('Views ' + status);
            }
        });
    });
    
    $('div#product-data').on('click','.likes', function () {

        var dataString = $(this).attr('id');

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
            url: './like-counter',
            data: {dataString: dataString},
            success: function (status) {
                //alert(status);
                //return false; 
                $("#like_counter_" + dataString).html(status+' Likes');
            }
        });
    });
});

        </script>

    </body>
</html>