$(function(){
$(document).on('click','#add_item',function(){
	$.ajax({
		type: 'post',
		url: 'server/add_modal.php',
		data: {
				team_filter: $('#team_value').val()
			}
	}).done(function(data){
		$('.modal-body').html(data)
		$('.modal-title').html('Add Item')
		$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').removeClass('modal-sm');
		$('.modal-footer').html(
			'<input type="button" class="btn btn-primary" id="add_item_save" value="Save" />' +
			'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		$('.modal').modal('show')
		}).fail(function(data){
		alert('Something gone wrong.')
	})
})
$(document).on('click','#add_item_save',function(){
	var item_name = $('#item_name').val().trim().toUpperCase()
	var item_cate = $('#item_cate').val()
	if(!item_name){
		validate_error('Invalid item name!','#show_error','',0)
		return false
	}
	$.ajax({
		type: 'post',
		url: 'server/add_supply.php',
		data: {
			item_name: item_name,
			item_cate: item_cate
		}
	}).done(function(data){
		validate_error(data,'#show_error','',1)
	}).fail(function(data){
		alert('Something gone wrong.')
	})
})
load()
})
function load(){
	$.ajax({
		type: 'post',
		url: 'server/read_supply.php'
	}).done(function(data){
		$('#content').html(data)
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