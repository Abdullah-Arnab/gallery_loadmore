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
        <link rel="stylesheet" href="{{url('/public/css/comment.css')}}">
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
                        <!-- @data -->
                        @foreach($products as $product)
                        <li>
                            <form id="myForm" action="{{url("/view-counter")}}" type="POST">{{csrf_field()}}
                                <input type="hidden" name="product_row_id" value="{{$product->product_row_id}}"/>
                            </form>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 product_info" >
                                <div class="thumbnail products" id="{{$product->product_row_id}}" style="height: 25%;"  > 
                                    <a href="#" data-toggle="modal" data-target="#myModal{{$product->product_row_id}}" >
                                        <img src="{{asset('/public/thumbs/')}}/{{$product->product_image}}" alt="Lights" style="max-width: 100%; display: block; max-height: 80%;" class="img-responsive">

                                    </a> 
                                    <div class="caption">
                                        <p style="position:absolute; bottom:10%; ">Product {{$product->product_row_id}}</p>
                                    </div>
                                </div>

                            </div>

                            <!-- Modal -->
                            <form id="myForm" action="{{url("/like-counter")}}" type="POST">{{csrf_field()}}
                                <input type="hidden" name="product_row_id" value="{{$product->product_row_id}}"/>
                            </form>
                            <div class="modal fade" id="myModal{{$product->product_row_id}}" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->     
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Product {{$product->product_row_id}}</h4>

                                            <!--                    Views Display-->
                                            <h6 id="view_counter_{{$product->product_row_id}}">View {{$product->product_views}}</h6>

                                            <!--                    Likes Button-->
                                            <button type="button" id="{{$product->product_row_id}}" class="likes btn glyphicon glyphicon-thumbs-up"></button> <span id='like_counter_{{$product->product_row_id}}'>{{$product->product_likes}} Likes</span>
                                        </div>
                                        <!-- New Modal -->
                                        <div class="modal-body">
                                            <div id="lightbox" class="carousel slide" data-ride="carousel" data-interval="false">
                                                <ol class="carousel-indicators">

                                                    <?php
                                                    $i = 1;
                                                    foreach ($products as $product):
                                                        $ol_class = ($i == 1) ? 'active' : '';
                                                        ?>

                                                        <!--                            Here I add the counter to data-slide attribute and add class to indicator-->
                                                        <li data-target="#lightbox" data-slide-to="<?php echo $i; ?>"  class="<?php echo $ol_class; ?>"></li>
                                                        <?php $i++; ?>$i
                                                    <?php endforeach; ?>
                                                </ol>
                                                <div class="carousel-inner">
                                                    <?php
                                                    $j = 1; //Counter
                                                    foreach ($products as $product): //Foreach
                                                        $item_class = ($j == 1) ? 'item active' : 'item'; //Set class active for image which is showing
                                                        ?>              
                                                        <div class="<?php echo $item_class; ?>"> 
                                                            <img src="{{asset('/public/images/')}}/{{$product->product_image}}" alt="Lights" style="width:100%">
                                                        </div>
                                                        <?php $j++; ?>
                                                    <?php endforeach; ?> 
                                                </div>
                                                <a class="left carousel-control" href="#lightbox" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                                                <a class="right carousel-control" href="#lightbox" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                                            </div>
                                        </div>
                                        <!-- New Modal End -->


                                        <!-- Comment-Box Start-->

                                        <div class="detailBox container">
                                            <div class="titleBox">
                                                <label>Comment Box</label>

                                            </div>
                                            <div class="commentBox">

                                                <p class="taskDescription">See User Comments About This Product</p>
                                            </div>
                                            <div class="actionBox">
                                                <ul class="commentList">
                                                    <li>
                                                        <div  id="comment_{{$product->product_row_id}}">
                                                        </div>
                                                    </li>
                                                </ul>
                                                <br/>
                                                <form class="form-inline" role="form" action="{{url('/add-comment')}}" method="POST">{{csrf_field()}}
                                                    <div class="form-group">
                                                        <input id="comment-input" class="form-control" type="text" placeholder="Your comments" name="comment" />
                                                    </div>
                                                    <div class="form-group">
                                                        <input style="width: 100%" class="form-control" type="hidden" placeholder="Your comments" value="{{$product->product_row_id}}" name="id" />
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="comments btn btn-default" type="submit">Add</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                        <!-- Comment-Box End-->

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </li>
                        @endforeach


                        <!-- End data -->
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
                                alert(JSON.stringify(data));
                                
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