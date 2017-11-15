@foreach($products as $product)
<li>
    <form id="myForm" action="{{url("/view-counter")}}" type="POST">{{csrf_field()}}
        <input type="hidden" name="product_row_id" value="{{$product->product_row_id}}"/>
    </form>
    <div class="col-md-2 product_info">
        <div class="thumbnail products" id="{{$product->product_row_id}}"> 
            <a href="#" data-toggle="modal" data-target="#myModal{{$product->product_row_id}}">
                <img src="{{asset('/public/thumbs/')}}/{{$product->product_image}}" alt="Lights" style="width:100%">
                <div class="caption">
                    <p>Product {{$product->product_row_id}}</p>
                </div>
            </a>
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
                    <h6 id="view_counter_{{$product->product_row_id}}">View {{$product->product_views}}</h6>
                    <button type="button" id="{{$product->product_row_id}}" class="likes btn glyphicon glyphicon-thumbs-up"></button> <span id='like_counter_{{$product->product_row_id}}'>{{$product->product_likes}} Likes</span>
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
