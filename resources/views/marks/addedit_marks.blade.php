@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
  	 <div class="col-md-8">
  	 	<div class="pull-left">
  	 		@if($edit == 1)
  	 		 <h3>Edit Student Marks</h3>
  	 		@else
  	 		 <h3>Add Student Marks</h3>
  	 		@endif
		 
		</div>
		<div class="pull-right-addedit">
			<a href="{{ URL::to('studentmarks') }}">
				<button type="button" class="btn btn-primary">Back To listing</button>
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
		@if($edit == 1)
		 <form class="form_validation" method="post"  id="form_validation" action="{{ URL::to('studentmarks/'.$mark->id) }}">
     <input type="hidden" name="_method" value="put">
		@else
	  	<form method="post" action="{{ URL::to('studentmarks') }}">
		@endif
	  	@csrf

	  	<div class="form-group">
			  <label for="sel1">Students</label>
			  <select class="form-control" id="teacherid" name="studentsid" required>
			  	<option value="">select Students</option>
			  	@foreach($students as $student)
			  	@if($edit == 1)	
			  	<option value="{{$student->id }}" @if($mark->studentId == $student->id) selected @endif>{{$student->student_name }}</option>
			  	@else
			  	<option value="{{$student->id }}">{{$student->student_name }}</option>
			  	@endif
			    
			    @endforeach
			  </select>
			</div>

			<div class="form-group">
			  <label for="sel1">Term</label>
			  <select class="form-control" id="teacherid" name="termid" required>
			  	<option value="">select Term</option>
			  	@foreach($terms as $term)
			  	@if($edit == 1)	
			  	<option value="{{$term->id }}" @if($mark->termId == $term->id) selected @endif>{{$term->terms }}</option>
			  	@else
			  	<option value="{{$term->id }}">{{$term->terms }}</option>
			  	@endif
			    
			    @endforeach
			  </select>
			</div>
		  <div class="form-group">
		    <label for="email">Maths Mark</label>
		    <input type="number" class="form-control" name="mat_mark" @if($edit == 1) value="{{$mark->maths_mark}}" @endif placeholder="Enter Maths Mark" required>
		  </div> 

		  <div class="form-group">
		    <label for="email">Science Mark</label>
		    <input type="number" class="form-control" name="sci_mark" @if($edit == 1) value="{{$mark->science_mark}}" @endif placeholder="Enter Science Mark" required>
		  </div> 

		  <div class="form-group">
		    <label for="email">History Mark</label>
		    <input type="number" class="form-control" name="his_mark" @if($edit == 1) value="{{$mark->history_mark}}" @endif placeholder="Enter History Mark" required>
		  </div>

		  


		  


		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>

  	 </div>
  </div>

</div>













@endsection
