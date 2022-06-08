$(document).ready(() => {
    $(document).on('click', '#btnAddStep', function(e){
        e.preventDefault()
        $('#addStepModal').modal('show')
    })
});