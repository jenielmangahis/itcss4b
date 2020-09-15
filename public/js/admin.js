$(function(){
	$('.colorpicker').colorpicker();
	$(".quick-search-company").click(function(){
		$("#modal-quick-search-company").modal("show");
	});

	$('.search-contact-name').select2({
		ajax: {
			url: base_url + '/_get_contact_list',
			dataType: 'json'
			// Additional AJAX parameters go here; see the end of this chapter for the full code of this example
		}
	});
});