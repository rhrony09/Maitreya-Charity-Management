$("#contactForm").on("submit", function (event) {
    event.preventDefault();
    let name = $("#p_name").val();
    let email = $("#p_email").val();
    let phone = $("#p_phone").val();
    let subject = $("#p_subject").val();
    let message = $("#p_message").val();

    if (name == "" || email == "" || phone == "" || subject == "" || message == "") {
        formError();
    } else {
        let data = {
            _token: "{{csrf_token()}}",
            name: name,
            email: email,
            phone: phone,
            subject: subject,
            message: message
        };
        submitForm(data);
    }
});


function submitForm(data) {
    $.ajax({
        type: "POST",
        url: "{{route('send.message')}}",
        data: data,
        success: function (response) {
            formSuccess(response);
        }
    });
}

function formSuccess(response) {
    $("#contactForm")[0].reset();
    submitMSG(true, response)
}

function formError() {
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
        $(this).removeClass();
    });
}

function submitMSG(valid, msg) {
    if (valid) {
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#success").removeClass().addClass(msgClasses).text(msg);
}
