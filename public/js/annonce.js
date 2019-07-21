$('#add-image').click(function () {
    // Je récupere le numero des futures champs que je vais créer
    const index = +$('#widgets-counter').val();

    // je recupere les prototype des entry, il ce trouve dans le data-prototype
    const tmpl = $('#annonce_images').data('prototype').replace(/__name__/g, index);
    $('#annonce_images').append(tmpl);

    $('#widgets-counter').val(index + 1);
    handleDeleteButtons();
});

function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function () {
        const target = this.dataset.target;
        $(target).remove();
    });
}

function updateCounter() {
    const count = +$('#annonce_images div.form-group').length;

    $('#widgets-counter').val(count);
}
updateCounter();
handleDeleteButtons();
