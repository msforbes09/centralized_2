$(function(){
$(document).on('click','#test',function(){
	//test
})
$(document).on('click','#save_btn',function(){
	var address = $('#address_txt').val().toLowerCase()
	var name = $('#name_txt').val()
	var desc = $('#desc_txt').val()
	if (address.toLowerCase().slice(-9) == 'index.php'){
		address = address.toLowerCase().slice(0,-9)
	}
	if (!address || !name || !desc){
		alert('Input Complete Data!')
		return false
	}
	$.ajax({
			type: 'post',
			url: 'server/check_address.php',
			data:{
				address: address
			}
		}).done(function(data){
			if(data != 0 ){
				alert('Data is already existing!')
				return false
			}
			$.ajax({
				type: 'post',
				url: 'server/add_system.php',
				data:{
					address: address,
					name: name,
					desc: desc
				}
			}).done(function(data){
				if (data){
					alert(data)
				} else {
					$('.modal').modal('hide')
					load()
				}
			}).fail(function(data){
				alert('Failed.')
			})

		}).fail(function(data){
			alert('Failed.')
		})
})
$(document).on('dblclick','.command',function(){
	var command = prompt()
	switch (command){
		case 'add':
			$.ajax({
				type: 'post',
				url: 'server/add_modal.php'
			}).done(function(data){
				$('.modal-dialog').removeClass('modal-lg');
				$('.modal-dialog').removeClass('modal-sm');
				$('.modal-title').html('Add System');
				$('.modal-body').html(data);
				$('.modal-footer').html(
				'<button type="button" id="save_btn" class="btn btn-success">Save</button>' +
				'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
				$('.modal').modal('show')
			}).fail(function(data){
				alert('Failed.')
			})
			break
		default:
			alert('Unknown Command')
	}
})
$(document).on('dblclick','.system_update',function(){
	var id = $(this).attr('id').split('_')[1]
	get_user(id)
})
$(document).on('dblclick','#add_position',function(){
	$.ajax({
		type: 'post',
		url: 'server/get_position.php'
	}).done(function(data){
		$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').removeClass('modal-sm');
		$('.modal-title').html('Add User By Position');
		$('.modal-body').html(data);
		$('.modal-footer').html(
		'<button type="button" id="save_position" class="btn btn-success">Save</button>' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		$('.modal').modal('show')
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('click','#save_position',function(){
	var system_id = $('#system_id').val()
	var val = $('#input_position').val()
	if (val == 1){
		alert('Invalid Input!')
		return false
	}
	$.ajax({
		type: 'post',
		url: 'server/set_user.php',
		data: {
			col: 'job_category_id',
			val: val,
			system_id : system_id
			}
	}).done(function(data){
		$('.modal').modal('hide')
		get_user(system_id)
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('dblclick','#add_status',function(){
	$.ajax({
		type: 'post',
		url: 'server/get_status.php'
	}).done(function(data){
		$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').removeClass('modal-sm');
		$('.modal-title').html('Add User By Status');
		$('.modal-body').html(data);
		$('.modal-footer').html(
		'<button type="button" id="save_status" class="btn btn-success">Save</button>' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		$('.modal').modal('show')
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('click','#save_status',function(){
	var system_id = $('#system_id').val()
	var val = $('#input_status').val()
	if (val == 1){
		alert('Invalid Input!')
		return false
	}
	$.ajax({
		type: 'post',
		url: 'server/set_user.php',
		data: {
			col: 'status_id',
			val: val,
			system_id : system_id
			}
	}).done(function(data){
		$('.modal').modal('hide')
		get_user(system_id)
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('dblclick','#add_section',function(){
	$.ajax({
		type: 'post',
		url: 'server/get_section.php'
	}).done(function(data){
		$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').removeClass('modal-sm');
		$('.modal-title').html('Add User By Section');
		$('.modal-body').html(data);
		$('.modal-footer').html(
		'<button type="button" id="save_section" class="btn btn-success">Save</button>' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		$('.modal').modal('show')
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('click','#save_section',function(){
	var system_id = $('#system_id').val()
	var val = $('#input_section').val()
	if (val == 1){
		alert('Invalid Input!')
		return false
	}
	$.ajax({
		type: 'post',
		url: 'server/set_user.php',
		data: {
			col: 'section_id',
			val: val,
			system_id : system_id
			}
	}).done(function(data){
		$('.modal').modal('hide')
		get_user(system_id)
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('dblclick','#add_team',function(){
	$.ajax({
		type: 'post',
		url: 'server/get_team.php'
	}).done(function(data){
		$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').removeClass('modal-sm');
		$('.modal-title').html('Add User By Team');
		$('.modal-body').html(data);
		$('.modal-footer').html(
		'<button type="button" id="save_team" class="btn btn-success">Save</button>' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		$('.modal').modal('show')
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('change','#select_section',function(){
	$.ajax({
		type: 'post',
		url: 'server/read_team.php',
		data:	{
			section_id: $('#select_section').val()
		}
	}).done(function(data){
		$('#input_team, #select_team, #select_team_1').html(data)
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('click','#save_team',function(){
	var system_id = $('#system_id').val()
	var val = $('#input_team').val()
	if (val == 1){
		alert('Invalid Input!')
		return false
	}
	$.ajax({
		type: 'post',
		url: 'server/set_user.php',
		data: {
			col: 'team_id',
			val: val,
			system_id : system_id
			}
	}).done(function(data){
		$('.modal').modal('hide')
		get_user(system_id)
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('dblclick','#add_job',function(){
	$.ajax({
		type: 'post',
		url: 'server/get_job.php'
	}).done(function(data){
		$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').removeClass('modal-sm');
		$('.modal-title').html('Add User By Job Description');
		$('.modal-body').html(data);
		$('.modal-footer').html(
		'<button type="button" id="save_job" class="btn btn-success">Save</button>' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		$('.modal').modal('show')
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('change','#select_team',function(){
	$.ajax({
		type: 'post',
		url: 'server/read_job.php',
		data:	{
			team_id: $('#select_team').val()
		}
	}).done(function(data){
		$('#input_job').html(data)
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('click','#save_job',function(){
	var system_id = $('#system_id').val()
	var val = $('#input_job').val()
	if (val == 1){
		alert('Invalid Input!')
		return false
	}
	$.ajax({
		type: 'post',
		url: 'server/set_user.php',
		data: {
			col: 'job_desc_id',
			val: val,
			system_id : system_id
			}
	}).done(function(data){
		$('.modal').modal('hide')
		get_user(system_id)
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('dblclick','#add_staff',function(){
	$.ajax({
		type: 'post',
		url: 'server/get_staff.php'
	}).done(function(data){
		$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').removeClass('modal-sm');
		$('.modal-title').html('Add User');
		$('.modal-body').html(data);
		$('.modal-footer').html(
		'<button type="button" id="save_staff" class="btn btn-success">Save</button>' +
		'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		$('.modal').modal('show')
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('change','#select_team_1',function(){
	$.ajax({
		type: 'post',
		url: 'server/read_staff.php',
		data:	{
			team_id: $('#select_team_1').val()
		}
	}).done(function(data){
		$('#input_staff').html(data)
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('click','#save_staff',function(){
	var system_id = $('#system_id').val()
	var val = $('#input_staff').val()
	if (val == 1){
		alert('Invalid Input!')
		return false
	}
	$.ajax({
		type: 'post',
		url: 'server/set_user.php',
		data: {
			col: 'staff_id',
			val: val,
			system_id : system_id
			}
	}).done(function(data){
		$('.modal').modal('hide')
		get_user(system_id)
	}).fail(function(data){
		alert('Failed.')
	})
})
$(document).on('click','#copy',function(){
	var paste = "<?php require_once '../../forbes/system_control.php'?>"
	$('#clipboard').html('<textarea id="text_board">' + paste + '</textarea>');
	$('#text_board').select()
	document.execCommand("copy")
	$('#clipboard').html('')
})
/*
*/
load()
})
function load(){
	$.ajax({
			type: 'post',
			url: 'server/read_system.php'
		}).done(function(data){
			$('#content').html(data)
		}).fail(function(data){
			alert('Failed.')
		})
}
function get_user(id){
	$.ajax({
			type: 'post',
			url: 'server/get_system.php',
			data: {
				data_id: id
			}
		}).done(function(data){
			$('#header').html(data)
		}).fail(function(data){
			alert('Failed.')
		})
	$.ajax({
			type: 'post',
			url: 'server/read_user.php',
			data: {
				data_id: id
			}
		}).done(function(data){
			$('#content').html(data)
		}).fail(function(data){
			alert('Failed.')
		})
}