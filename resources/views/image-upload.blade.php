<form action="{{ url('image-upload') }}" enctype="multipart/form-data" method="POST">
			{{ csrf_field() }}
			<div class="row">
                                Name<input type="text" name="product_name"/><br/>
                                Price<input type="number" name="product_price"/>
                                
				<div class="col-md-12">
					<input type="file" name="image" />
				</div>
				<div class="col-md-12">
					<button type="submit" class="btn btn-success">Upload</button>
				</div>
                                
			</div>
		</form>