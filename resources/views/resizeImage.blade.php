<!--{!! Form::open(array('route' => 'resizeImagePost','enctype' => 'multipart/form-data')) !!}
        <div class="row">
                <div class="col-md-4">
                        <br/>
                        {!! Form::text('title', null,array('class' => 'form-control','placeholder'=>'Add Title')) !!}
                </div>
                <div class="col-md-12">
                        <br/>
                        {!! Form::file('image', array('class' => 'image')) !!}
                </div>
                <div class="col-md-12">
                        <br/>
                        <button type="submit" class="btn btn-success">Upload Image</button>
                </div>
        </div>
{!! Form::close() !!}-->


<form method="POST" action="http://localhost/gallery_loadmore/resizeImagePost" enctype="multipart/form-data"> {{csrf_field()}}
    <div class="row">
        <div class="col-md-4">
            <br/>
            <input class="form-control" placeholder="Product Name" name="product_name" type="text">
        </div>
        <div class="col-md-4">
            <br/>
            <input class="form-control" placeholder="Product Price" name="product_price" type="number">
        </div>
        <div class="col-md-12">
            <br/>
            <input class="image" name="image" type="file">
        </div>
        <div class="col-md-12">
            <br/>
            <button type="submit" class="btn btn-success">Upload Image</button>
        </div>
    </div>
</form>