$(function(){
$(document).on('click','#send_request',function(){
	var request = $('#select_item').val()
	if(request == 0){
		alert('Invalid Request!')
		return false
	}
	$.ajax({
		type: 'post',
		url: 'server/send_request.php',
		data: {
			item: request,
			id: $('#staff_id').val()
		}
	}).done(function(data){
		if(data){
			alert(data)
		}
		$('#select_category, #select_item').val(0)
		load()
	}).fail(function(data){
		alert('Something gone wrong.')
	})
})
$(document).on('change','#select_category',function(){
	$.ajax({
		type: 'post',
		url: 'server/get_supply_list.php',
		data: {
			category: $(this).val()
		}
	}).done(function(data){
		$('#select_item').html(data)
	}).fail(function(data){
		alert('Something gone wrong.')
	})
})
$(document).on('change','#select_category, #select_item',function(){
	$('#show_error').html('')
})
$(document).on('click','.confirm_request, .clear_request',function(){
	var id = $(this).parent().parent().attr('id').split('_')[1]
	$.ajax({
		type: 'post',
		url: 'server/confirm_request.php',
		data: {
			data_id: id
		}
	}).done(function(data){
		console.log(data)
		load()
	}).fail(function(data){
		alert('Something gone wrong.')
	})
})
load()
})
function load(){
	$.ajax({
		type: 'post',
		url: 'server/read_myrequest.php',
		data: {
			id: $('#staff_id').val()
		}
	}).done(function(data){
		$('#request').html(data)
	}).fail(function(data){
		alert('Something gone wrong.')
	})
	$.ajax({
		type: 'post',
		url: 'server/read_myhistory.php',
		data: {
			id: $('#staff_id').val()
		}
	}).done(function(data){
		$('#history').html(data)
	}).fail(function(data){
		alert('Something gone wrong.')
	})
}
function validate_error(err_msg,err_out,success_msg,modal_close){
	if(err_msg != ''){
		if(err_out != ''){
			$(err_out).html(err_msg)
		}else{
			return alert(err_msg)
		}
	}else{
		if(modal_close == 1){
			$('.modal').modal('hide')
			load()
		}
		if(success_msg != ''){
			return alert(success_msg)
		}			
	}
}