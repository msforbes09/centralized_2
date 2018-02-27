$(function(){
$(document).on('click','.btn_none',function(){
	var id = $(this).parent().parent().attr('id').split('_')[1]
	set_availability(id,2)
})
$(document).on('click','.btn_deliver',function(){
	var id = $(this).parent().parent().attr('id').split('_')[1]
	set_availability(id,1)
})
$(document).on('click','#print',function(){
	$.ajax({
		type: 'post',
		url: 'server/print_request.php',
		data: {
			section: $('#section_id').val()
		}
	}).done(function(data){
		$('#content').html(data)
		window.print()
		location.href = 'request.php'
	}).fail(function(data){
		alert('Something gone wrong.')
	})
})
load()
})
function load(){
	$.ajax({
		type: 'post',
		url: 'server/read_request.php',
		data: {
			section: $('#section_id').val()
		}
	}).done(function(data){
		$('#request').html(data)
	}).fail(function(data){
		alert('Something gone wrong.')
	})
	$.ajax({
		type: 'post',
		url: 'server/read_history.php',
		data: {
			section: $('#section_id').val()
		}
	}).done(function(data){
		$('#history').html(data)
	}).fail(function(data){
		alert('Something gone wrong.')
	})
}
function set_availability(data_id,value){
	$.ajax({
		type: 'post',
		url: 'server/set_availability.php',
		data: {
			data_id: data_id,
			value: value
		}
	}).done(function(data){
		console.log(data)
		load()
	}).fail(function(data){
		alert('Something gone wrong.')
	})
}