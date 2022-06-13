$(document).ready(() => {
    $(document.body).on("click",".answer", function () {
        let answerId = $(this).data('id')
        let stepId = $(this).data('step-id')

        $.ajax({
            url: '/step/' + stepId,
            method: "GET",
            success: (data) => {
                let correctAnswer = data.answer_id

                if (answerId === parseInt(correctAnswer)) {
                    $('.modal').modal('hide');
                    $('.btn-quiz').addClass('d-none')
                    $('.win-alert').removeClass('d-none')
                    $('.btn-next-step').removeClass('d-none')
                } else {
                    let errorAlert = $('.first-error-alert');
                    if (errorAlert.hasClass('d-none')) {
                        errorAlert.removeClass('d-none')
                    } else {
                        $('.modal').modal('hide');
                        $('.btn-quiz').addClass('d-none')
                        $('.lose-alert').removeClass('d-none')
                        $('.btn-next-step').removeClass('d-none')
                    }
                }
            }
        })
    });

    $(document.body).on("click","#btn-abandon", function () {
        $.ajax({
            url: '/course/participate/abandon',
            method: "POST",
            success: () => {
                window.location.href = '/';
            }
        })
    });

});
