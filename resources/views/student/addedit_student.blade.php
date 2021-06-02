@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
  	 <div class="col-md-8">
  	 	<div class="pull-left">
  	 		@if($edit == 1)
  	 		 <h3>Edit Student</h3>
  	 		@else
  	 		 <h3>Add Student</h3>
  	 		@endif
		 
		</div>
		<div class="pull-right-addedit">
			<a href="{{ URL::to('students') }}">
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
		 <form class="uk-form-stacked form_validation" method="post"  id="form_validation" action="{{ URL::to('students/'.$students->id) }}">
              <input type="hidden" name="_method" value="put">
		@else
	  	<form method="post" action="{{ URL::to('students') }}" name="add_student">
		@endif
	  	@csrf
		  <div class="form-group">
		    <label for="email">Name</label>
		    <input type="text" class="form-control" name="fullname" @if($edit == 1) value="{{$students->student_name}}" @endif placeholder="Enter Name" required>
		  </div>
		  <div class="form-group">
		    <label for="pwd">Age</label>
		    <input type="number" class="form-control" name="age" placeholder="Enter Age" @if($edit == 1) value="{{$students->student_age}}" @endif required>
		  </div>

		  <div class="form-group">
		  	  <label for="genderselection">Gender</label>
		  	  @if($edit == 1)
		  	  <div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="genderselection" id="inlineRadio1" value="m" @if($students->student_gender == 'm') checked @endif required>
				<label class="form-check-label" for="inlineRadio1">Male</label>
			  </div>
			  <div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="genderselection" id="inlineRadio2" value="f" @if($students->student_gender == 'f') checked @endif required>
				<label class="form-check-label" for="inlineRadio2">Female</label>
			  </div>
		  	  @else
		  	  <div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="genderselection" id="inlineRadio1" value="m" required>
				<label class="form-check-label" for="inlineRadio1">Male</label>
			  </div>
			  <div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="genderselection" id="inlineRadio2" value="f" required>
				<label class="form-check-label" for="inlineRadio2">Female</label>
			  </div>
		  	  @endif
			  
		  </div>


		  <div class="form-group">
			  <label for="sel1">Reporting Teacher</label>
			  <select class="form-control" id="teacherid" name="teacherid" required>
			  	<option value="">select Teacher</option>
			  	@foreach($teachers as $teacher)
			  	@if($edit == 1)	
			  	<option value="{{$teacher->id }}" @if($students->teacherId == $teacher->id) selected @endif>{{$teacher->teacher_name }}</option>
			  	@else
			  	<option value="{{$teacher->id }}">{{$teacher->teacher_name }}</option>
			  	@endif
			    
			    @endforeach
			  </select>
			</div>


		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>

  	 </div>
  </div>

</div>













@endsection
