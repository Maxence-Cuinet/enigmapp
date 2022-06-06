$(document).ready(() => {
    $('.img-selection').on('click', (e) => {
        $('.img-selected').removeClass('img-selected')
        $(e.target).addClass('img-selected')
        console.log(e.target.src)
        $('#image').val(e.target.src)
    });
});
