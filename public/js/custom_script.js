$('body').on('click','.del_student',function(){
		var id  =  $(this).attr("data-id");
		var token = $("meta[name='csrf-token']").attr("content");

		swal({
		  title: "Are you sure?",
		  text: "You want to Delete Student!",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
		  	$.ajax({
		  		type: "DELETE",
                url: "students/"+id,
                data:{
                	 "id": id,
                	 "_token": token,
                },
                success : function(res){
                	if (res.message == 'success') {
                		 swal("success! Student has been deleted!", {
					      icon: "success",
					    });
                		  setTimeout(function(){ 
                		  	location.reload(); 
                		  }, 3000);

                		
                	}
                }
		  	});
		  } 
		});
	});


$('body').on('click','.del_mark',function(){
		var id  =  $(this).attr("data-id");
		var token = $("meta[name='csrf-token']").attr("content");

		swal({
		  title: "Are you sure?",
		  text: "You want to Delete Student Marks!",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
		  	$.ajax({
		  		type: "DELETE",
                url: "studentmarks/"+id,
                data:{
                	 "id": id,
                	 "_token": token,
                },
                success : function(res){
                	if (res.message == 'success') {
                		 swal("success! Student Marks has been deleted!", {
					      icon: "success",
					    });
                		  setTimeout(function(){ 
                		  	location.reload(); 
                		  }, 3000);

                		
                	}
                }
		  	});
		  } 
		});
	});