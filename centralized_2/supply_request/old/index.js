$(function(){
	
	function load() {
		
		//console.log('load')
		$.ajax({
			type: 'post',
			url: 'tbody.php',
			data: {}
		}).done(function(data){
			//console.log(u_name)
			//console.log('hi')
			$("#content").html(data)
		}).fail(function(data){
			alert('Failed.')
		})
	}
 
	load()
	
	$(document).on('click','#save',function(){
		
		
		$.ajax({
			type: 'post',
			url: 'ajax_insert.php',
			data: {
				i_name: $("#i_name").val(),
				i_desc: $("#i_desc").val(),
				status: 0
			}
		}).done(function(data){
			//alert(data)
			//console.log(data)
			alert('Your request has been sent.')
			load()
		}).fail(function(data){
			alert('fail')
		})
	})
	
	$(document).on('click','#test',function(){
		console.log('this is a test')
		console.log($(".save").attr('id'))
	})
	
})