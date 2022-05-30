$(document).ready(() => {
    $('#password, #confirmPassword').on('keyup', () => {
        let passwordInput = $('#password');
        let confirmPasswordInput = $('#confirmPassword');
        if (passwordInput.val() !== confirmPasswordInput.val()) {
            confirmPasswordInput[0].setCustomValidity('Le mot de passe ne correspond pas.');
        } else
            confirmPasswordInput[0].setCustomValidity('');
    });
});
