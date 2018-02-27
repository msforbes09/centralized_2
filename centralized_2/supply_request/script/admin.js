$(function(){
$(document).on('click','.btn_approve',function(){
	var id = $(this).parent().parent().attr('id').split('_')[1]
	approve(id,1,'')
})
$(document).on('click','.btn_disapprove',function(){
	var id = $(this).parent().parent().attr('id').split('_')[1]
	$('.modal-body').html(
		'<textarea id="comment" class="form-control" placeholder="input reason for disapproval here.."></textarea>' +
		'<div id="show_error" style="color: red; text-align: center; font-size: 15px; margin-top: 15px;"></div>' +
		'<input type="hidden" id="data_id" value="' + id + '" />'
		)
	$('.modal-title').html('Confirm Disapproval')
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-footer').html(
		'<input type="button" class="btn btn-danger" id="confirm_disapprove" value="Confirm" />' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
	$('.modal').modal('show')
})
$(document).on('click','#confirm_disapprove',function(){
	var comment = $('#comment').val().trim().toUpperCase()
	var id = $('#data_id').val()
	if(comment.length == 0){
		validate_error('Please input reason.','#show_error','',0)
		return false
	}
	approve(id,2,comment)
})
load()
})
function load(){
	$.ajax({
		type: 'post',
		url: 'server/read_teamrequest.php',
		data: {
			team: $('#team_id').val()
		}
	}).done(function(data){
		$('#request').html(data)
	}).fail(function(data){
		alert('Something gone wrong.')
	})
	$.ajax({
		type: 'post',
		url: 'server/read_teamhistory.php',
		data: {
			team: $('#team_id').val()
		}
	}).done(function(data){
		$('#history').html(data)
	}).fail(function(data){
		alert('Something gone wrong.')
	})
}
function approve(data_id,value,comment){
	$.ajax({
		type: 'post',
		url: 'server/approve_request.php',
		data: {
			data_id: data_id,
			value: value,
			comment: comment
		}
	}).done(function(data){
		validate_error(data,'','',1)
		load()
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