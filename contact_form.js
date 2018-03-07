$(document).ready(function () {

	$(".form1").submit(function() {
        var name = $(".form1 .name").val();
		var phone = $(".form1 .phone").val();
        var page = window.location.href;

		var successes_msg = '<p id="msg_ok1">Thank you!</p>';   

		var sp_data = new FormData();
        sp_data.append('hash', '2DkOqS');
        sp_data.append('form_id', '1');
        sp_data.append('name', name);
        sp_data.append('phone', phone);
        sp_data.append('page', page);

		$.ajax({
            url: "contact_form/contact_form.php",
            type: "POST",
            dataType: "html",
            contentType: false,
            processData: false,
            data: sp_data,
            success: function () {
                $(".form1 .result").html(successes_msg);
            }
        });
        return false;
	});


    $(".form2").submit(function() {
        var name = $(".form2 .name").val();
        var phone = $(".form2 .phone").val();
        var page = window.location.href;

        var successes_msg = '<p id="msg_ok2">Thank you!</p>';   

        var sp_data = new FormData();
        sp_data.append('hash', '2DkOqS');
        sp_data.append('form_id', '2');
        sp_data.append('name', name);
        sp_data.append('phone', phone);
        sp_data.append('page', page);

        $.ajax({
            url: "contact_form/contact_form.php",
            type: "POST",
            dataType: "html",
            contentType: false,
            processData: false,
            data: sp_data,
            success: function () {
                $(".form2 .result").html(successes_msg);
            }
        });
        return false;
    });

});