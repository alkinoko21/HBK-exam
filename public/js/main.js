$(document).ready(function() {
	var URL = window.location.protocol+'//'+window.location.hostname+'/';
	if(window.location.hostname == 'localhost')
	{
		var URL = window.location.protocol+'//'+window.location.hostname+':8000/';
	}
    // $('#add_company_btn').on('click',function(){
    //     $('#add_company_modal').css({'display':'block'});
    // });

    // $('.close_modal').on('click',function(){
    //     $(this).closest('div.modal').css({'display':'none'});
    // });

    // $('#submit_add_company').on('click',function(){
    // 	$('#add_comp_form').submit();
    // 	// var comp_name = $('#add_company_modal input[name=name]').val();
    // 	// var comp_email = $('#add_company_modal input[name=name]').val();
    // 	// var comp_link = $('#add_company_modal input[name=name]').val();
    // });

    $('.rem_tr').on('click',function(){
    	var con = confirm('Are you sure?');
    	if(con)
	    {
		    var elm = $(this);
	    	var tbody = elm.closest('tbody');
	        var c = tbody.find('tr').length;
	        var com_id = elm.closest('td').attr('data-id')
	        var token = elm.closest('td').attr('data-token')
	        var entity = elm.closest('td').attr('data-entity')
	    	$.ajax({
		        url: URL+'delete_'+entity,
		        type: "post",
		        data: {
		        	"_token": token,
		        	'id':com_id
		        },
		        success: function (response) {
		        	if(response.success)
	    			{
		        		elm.closest('tr').remove();
					    if(c == 1)
					    {
					    	tbody.append('<tr><td colspan="6" class="text-center">No Records Found!</td><tr>');
					    }
					}
		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
		    });
		}
    });
});