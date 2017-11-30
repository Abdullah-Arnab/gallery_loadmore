@foreach($products as $product)
<li>
    <form id="myForm" action="{{url("/view-counter")}}" type="POST">{{csrf_field()}}
        <input type="hidden" name="product_row_id" value="{{$product->product_row_id}}"/>
    </form>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 product_info" >
        <input type="hidden" value="{{$product->product_row_id}}" class="product_id" />
        <div class="thumbnail products" id="{{$product->product_row_id}}" style="height: 25%;"> 
            <a href="#" data-toggle="modal" data-target="#myModal{{$product->product_row_id}}">
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
    <div class="modal animated fadeIn" id="myModal{{$product->product_row_id}}" role="dialog">
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

                    <button class="prev_button" type="button">Prev</button>
                    <button class="next_button" type="button">Next</button>
                </div>
                <div class="modal-body">
                    <img src="{{asset('/public/images/')}}/{{$product->product_image}}" alt="Lights" style="width:100%">
                </div>

                <!-- Comment-Box Start-->

                <div class="detailBox container">
                    <div class="titleBox">
                        <label>Comment Box</label>
                        <button type="button" class="close" aria-hidden="true">&times;</button>
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