@extends('layouts.admin')
@section('content')
<div class="col-12 py-3">
	<div class="container">
		<div class="p-3 main-box mx-auto" style="width:600px;max-width: 100%;">
			<div class="d-flex align-items-center justify-content-center py-4">
			 	<div class="col-12 d-inline-block mx-auto" style="width:120px">
			 		<img src="{{auth()->user()->getUserAvatar()}}" style="width:120px;max-width: 100%;border-radius: 50%;">
			 		<div class="col-12 font-3 text-center py-2">
			 			{{auth()->user()->name}}
			 		</div>
			 	</div>
			 	
			</div>
			<div class="col-12 p-0">
				<table class="table table-bordered table-striped rounded table-hover">
					<tbody>
						<tr>
							<td>Emaill</td>
							<td>{{auth()->user()->email}}</td>
						</tr>
						<tr>
							<td>Number Phone</td>
							<td>
								@if(auth()->user()->phone==null)
									Not Found
								@else
									{{auth()->user()->phone}}
								@endif
							</td>
						</tr>
						<tr>
							<td>Power</td>
							<td>{{auth()->user()->power}}</td>
						</tr>
						<tr>
							<td>Activated</td>
							<td>
								@if(!auth()->user()->blocked)
									<span class="fas fa-check-circle text-success"></span>
								@else
									<span class="fas fa-times-circle text-danger"></span>
								@endif

						</td>
						<tr>
							<td>Bio</td>
							<td>
								{{auth()->user()->bio}}
							</td>
						</tr>
						
						<tr>
							<td>Control</td>
							<td><a href="{{route('admin.profile.edit')}}" class="btn btn-light btn-sm border"><span class="fal fa-wrench"></span> Edite</a></td>
						</tr>

						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection