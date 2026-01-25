$(document).on('click', '#submitFinal', function(){
    const formData = {
        _token: $('input[name="_token"]').val(),
        application_no: $('input[name="application_no"]').val()
    };
    const ajaxFormData = new FormData();
    Object.keys(formData).forEach(key => {
        ajaxFormData.append(key, formData[key]);
    });

    // AJAX request
    $.ajax({
        url: "{{route('noc.step.five.post')}}",
        type: 'POST',
        data: ajaxFormData,
        contentType: false,
        processData: false,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': formData._token
        },
        success: function(response) {
            if (response.status === "1") {
                const tabLinks = [
                    'basicTabLink', 'proprietaryTabLink', 'areaTabLink',
                    'essentialTabLink', 'attachmentsTabLink', 'finalTabLink'
                ];
                const tabs = [
                    'basicTab', 'proprietaryTab', 'areaTab',
                    'essentialTab', 'attachmentsTab', 'finalTab'
                ];
                tabLinks.forEach(link => $(`#${link}`).removeClass('active'));
                tabs.forEach(tab => $(`#${tab}`).removeClass('show active'));
                $("#finalTabLink").addClass('active');
                $("#finalTab").addClass('show active');
                const newValue = 100;
                const bar = $('#bar_value');
                const bar_text = $('#bar_text');
                bar.attr('aria-valuenow', newValue);
                bar_text.css('width', `${newValue}%`);
                bar_text.text(`${newValue}%`);
            } else {
                $('#errorBlock').html(response.msg || "An error occurred").show();
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", { status, error, response: xhr.responseText });
            $('#errorBlock').html(`An error occurred: ${xhr.responseJSON?.message || error}`).show();
        }
    });
});