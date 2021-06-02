@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="pull-left">
		  <h3>Student</h3>
		</div>
		<div class="pull-right">
			<a href="{{ URL::to('studentmarks/create') }}">
				<button type="button" class="btn btn-primary">Add</button>
			</a>
		</div>
		@if (Session::has('message'))
	        <div class="alert alert-success alert-dismissible">
	            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	            <strong>Success!</strong> {{ Session::get('message') }}
	        </div>
	    @endif

		@if ($errors->any())
		     @foreach ($errors->all() as $error)
		        <div class="alert alert-danger alert-dismissible">
		            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		            <strong>Error!</strong> {{$error}}
		        </div>
		    @endforeach
		@endif
		<table class="table table-striped">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">Name</th>
			      <th scope="col">Maths</th>
			      <th scope="col">Science</th>
			      <th scope="col">History</th>
			      <th scope="col">Term</th>
			      <th scope="col">Total Marks</th>
			      <th scope="col">Created On</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>

			  <tbody>
			  	
			  	@foreach($marks as $mark)
			  	@php
			  	$total = $mark->maths_mark + $mark->science_mark + $mark->history_mark;
			  	$created_at = $mark->created_at;
			  	$monthname = $mark->created_at->format('M');
			  	$splitdatetime = explode('-',$created_at); 
			  	$day = $splitdatetime[1];
			  	$year = $splitdatetime[0];

			  	$time = date('h:i A', strtotime($created_at)); 

			  	$formatted_date = $monthname.' '.$day.','.$year.' '.$time;
			  	@endphp
			    <tr>
			      <td>{{$mark->studentselect->student_name}}</td>
			      <td>{{$mark->termselect->terms}}</td>
			      <td>{{$mark->maths_mark}}</td>
			      <td>{{$mark->science_mark}}</td>
			      <td>{{$mark->history_mark}}</td>
			      <td>{{ $total }}</td>
			      <td>{{$formatted_date}}</td>
			      <td>
			      	 <a href="{{ URL::to('studentmarks/'.$mark->id.'/edit') }}">
			      	 	<button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
			      	 </a>
            		 <button type="button" data-id="{{$mark->id}}" class="btn btn-danger del_mark"><i class="far fa-trash-alt"></i></button>
			      </td>
			    </tr>
			    @endforeach
			  </tbody>
			 
			</table>


			{!! $marks->links() !!}
	</div>

</div>

























@endsection