$(document).ready(() => {
    $('.img-selection').on('click', (e) => {
        $('.img-selected').removeClass('img-selected')
        $(e.target).addClass('img-selected')
        $('#image').val(e.target.src)
    });
});
