$(document).ready(() => {
    $(document).on('click', '.delete-course', function() {
        let name = $(this).data('name')
        let id = $(this).data('id')
        $('#deleteCourseName').text(name)
        $('#deleteCourseInputHidden').val(id)
        $('#deleteCourseModal').modal('show')
    });

    $(document).on('submit', '#deleteCourseForm', function(e) {
        e.preventDefault()

        //Animation btn et spinner
        let divBtn = $('#divBtnDeleteCourse')
        let wait = divBtn.next()
        divBtn.hide()
        wait.fadeIn()

        //Requête AJAX
        let form = $(this)
        $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            method: "POST",
            success: (data) => {
                wait.hide()
                divBtn.fadeIn()

                let retour = jQuery.parseJSON(data)
                alert(retour.message)
                location.reload()
            },
            error: (data) => {
                wait.hide()
                divBtn.fadeIn()

                let retour = jQuery.parseJSON(data)
                console.log("ERREUR AJAX : ", retour)
            }
        })
    });

    $(document.body).on("click","tr[data-href]", function () {
        window.location.href = this.dataset.href;
    });

    $('[data-bs-toggle="popover"]').popover();

    $(document.body).on("submit",".search", function (e) {
        e.preventDefault()

        let search = $('#search').val()
        window.location.href = '/home?q=' + search;
    });
});