@if ($errors->any())
	<div class="alert alert-danger" role="alert">
		<b style="color:red;">{!! implode('<br>', $errors->all()) !!}</b>
	</div>
@endif

@if(Session::has('message'))
	<div class="alert alert-info">
		{{Session::get('message')}}
	</div>
@endif