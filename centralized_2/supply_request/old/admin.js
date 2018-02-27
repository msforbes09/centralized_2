$(function(){
//load	
	function load() {
		
		//console.log('load')
		$.ajax({
			type: 'post',
			url: 'admin_tbody.php',
			data: {}
		}).done(function(data){
			//console.log(u_name)
			//console.log(data)
			$("#content").html(data)
		}).fail(function(data){
			alert('Failed.')
		})
	}
 //function
	load()
//approve	
	$(document).on('click','.ok',function(){
		var $this = $(this)
		
		$this.parent().parent().css('background-color','blue')
		if( !confirm( 'You are going to approve Request?' ) ) {
			$this.parent().parent().css('background-color','transparent')
			return false
		}
		
		var id = $(this).attr('id').split('-')[1]
		$.ajax({
			type: 'post',
			url: 'approved.php',
			data: {
				id: id
			}
		}).done(function(data){
			//console.log(u_name)
			console.log(data)
			//$("#content").html(data)
		}).fail(function(data){
			alert('Failed.')
		})
		
		console.log(id)
	})
//note
	$(document).on('click','#note',function(){
		$(".modal-title").html('Add Note')
		$(".modal-body").html(
			'<textarea id="note_text" class="form-control input-lg" placeholder="Type new note here..."></textarea> <br>'
		)
		$(".modal-footer").html(
			'<button id="add_note" class="btn btn-sm btn-danger">Save<span class= "glyphicon glyphicon-download-alt"></span></button>' +
			'<button class="btn btn-sm btn-danger" data-dismiss="modal">Close<span class= "glyphicon glyphicon-remove"></span></button>'
		)
		$(".modal").modal('show')
	})
//add-note	
	$(document).on('click','#add_note',function(){
		//alert('sorry program finished not yet!')

		if( !$("#note_text").val() ){
				alert('Please input complete data.')
				return false
		}
		
		if(!confirm('Send message?')){
			return false
		}
		
		$.ajax({
			type: 'post',
			url: 'insert_note.php',
			data: {
				note_value: $("#note_text").val(),
			}
		}).done(function(data){
			//$(".modal").modal('hide')
			location.href = 'admin.php'
		}).fail(function(data){
			alert('fail')
		})
		/*
		*/
	})
//reject
	$(document).on('click','.reject',function(){
		var $this = $(this)
		
		$this.parent().parent().css('background-color','red')
		if( !confirm( 'You are going to disapprove Request?' ) ) {
			$this.parent().parent().css('background-color','transparent')
			return false
		}
		
		var id = $(this).attr('id').split('-')[1]
		$.ajax({
			type: 'post',
			url: 'reject.php',
			data: {
				id: id
			}
		}).done(function(data){
			//console.log(u_name)
			console.log(data)
			//$("#content").html(data)
		}).fail(function(data){
			alert('Failed.')
		})
		
		console.log(id)
	})
//test	
	$(document).on('click','#test',function(){
		console.log('this is a test')
		console.log($(".save").attr('id'))
	})
	
})
		//console.log('this is a test')