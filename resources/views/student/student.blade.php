@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="pull-left">
		  <h3>Student</h3>
		</div>
		<div class="pull-right">
			<a href="{{ URL::to('students/create') }}">
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
			      <th scope="col">Age</th>
			      <th scope="col">Gender</th>
			      <th scope="col">Reporting Teacher</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@php $i = 1;  @endphp
			  	@foreach($students as $student)
			    <tr>
			      <td>{{$student->student_name}}</td>
			      <td>{{$student->student_age}}</td>
			      <td>{{$student->student_gender}}</td>
			      <td>{{$student->teacherselect->teacher_name}}</td>
			      <td>
			      	 <a href="{{ URL::to('students/'.$student->id.'/edit') }}">
			      	 	<button type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
			      	 </a>
            		 <button type="button" data-id="{{$student->id}}" class="btn btn-danger del_student"><i class="far fa-trash-alt"></i></button>
			      </td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>

			{!! $students->links() !!}
	</div>

</div>

























@endsection