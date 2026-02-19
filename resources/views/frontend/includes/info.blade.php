@if(session('info'))
<div class="alert alert-success">
{{(session('info'))}}

</div>
@endif

@if(count($errors)>0)
<div class="alertb alert-danger">
	<ul>
		@foreach($errors->all() as $error)
		<li>
			{{$error}}
		</li>
		@endforeach
	</ul>
</div>
@endif

@if(session('alert'))
<div class="alert alert-danger">
{{(session('alert'))}}

</div>
@endif