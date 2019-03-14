$("form[novalidate]").submit(function (event) {
    var $form = $(this);

    if (!$form.get(0).checkValidity()) {
        event.preventDefault();
    }

    $(this).addClass("was-validated");
});
