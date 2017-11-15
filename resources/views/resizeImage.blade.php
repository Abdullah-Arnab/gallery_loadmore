{!! Form::open(array('route' => 'resizeImagePost','enctype' => 'multipart/form-data')) !!}
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
{!! Form::close() !!}