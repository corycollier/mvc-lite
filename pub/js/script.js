
$('input[name=completed]').live('click', function(event){
	elTimeEntry = $(".form-element-time");
	elRepEntry = $(".form-element-reps");
	
	if($("#completed_true:checked").val()){
		elRepEntry.slideUp('fast');
		elTimeEntry.slideDown('slow');
	} else {
		elRepEntry.slideDown('fast');
		elTimeEntry.slideUp('slow');
	}
});

$("#username").live('keyup', function(event){
	
	var autocomplete = $(this).siblings(".autocomplete");

	if (autocomplete.css('display') != 'block') {
		autocomplete.slideDown('fast');
	}
	
	$.get('/users.php', $("form").serializeArray(), function(data, status){
		autocomplete.html(data);
	})
});

$("#username").live('focusout', function(event){
	$(this).siblings('.autocomplete').slideUp('slow');
});

$(".autocomplete a").live('click', function(event){
	$(".autocomplete a")
		.parentsUntil(".form-element")
		.last()
		.siblings("input")
		.val($(this).html())
	return false;
});