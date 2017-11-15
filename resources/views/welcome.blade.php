<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>jQuery Gallery with Load More</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css">
        <style>


            .list {
                width: 100%;
                float: left;
                margin: 0;
                padding: 0;
            }

            .list li {
                list-style: none;
                /*                        width: 33.3%;*/
                /*                        float: left;
                                        padding-left: 15px;
                                        padding-right: 15px;
                                        margin-bottom: 20px;*/
                display: none;
            }

            .list span {
                background: #77787b;
                color: #fff;
                display: block;
                text-align: center;
                padding: 15px;
                min-height: 400px;
            }

            * {
                box-sizing: border-box;
            }

            .load-btn {
                margin: auto;
                display: block;
                padding: 5px 10px;
                color: black;
                border: none;
                margin-bottom: 200px;
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1><center>Gallery</center></h1>
            
            <ul class="list" id="list">
                @foreach($data['products'] as $product)
                <li>
                    <div class="col-md-2" >
                        <div class="thumbnail">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$product->product_row_id}}">
                                <img src="{{asset('/public/thumbs/')}}/{{$product->product_image}}" alt="Lights" style="width:100%">
                                <div class="caption">
                                    <p>{{$product->product_name}}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal{{$product->product_row_id}}" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{$product->product_name}}</h4>
                                </div>
                                <div class="modal-body">
                                    <img src="{{asset('/public/images/')}}/{{$product->product_image}}" alt="Lights" style="width:100%">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </li>
                @endforeach

            </ul>
            <button id="btn" class="load-btn">Load More..</button>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
        <script src="{{asset('/public/js/loadmore.js')}}"></script>
        
        <script>
$("#list").loadMore({
    selector: 'li',
    loadBtn: '#btn',
    limit: 6,
    load: 6,
    animate: true,
    animateIn: 'fadeInUp'
});
        </script>
    </body>

</html>