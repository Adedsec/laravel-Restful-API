@if(session('success'))
	<div class="alert alert-success text-right">
		{{ session()->get('success') }}
	</div>
@endif

@if(session('error'))
	<div class="alert alert-danger text-right">
		{{ session()->get('error') }}
	</div>
@endif
