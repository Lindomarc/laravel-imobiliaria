$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

    $('.open_filter').on('click', function (event) {
        event.preventDefault();

        box = $(".form_advanced");
        button = $(this);

        if (box.css("display") !== "none") {
            button.text("Filtro Avançado ↓");
        } else {
            button.text("✗ Fechar");
        }

        box.slideToggle();
    });

    $('select[name*="filter_"]').change(function () {
        let search = $(this);
        let nextIndex = search.data('index') + 1;

        $.post(search.data('action'), {search: search.val()}, (response) => {

            if (response.status === 'success') {
                let select = $(`select[data-index="${nextIndex}"`);

                select.empty();
                $.each(response.data, function (key, value) {
                    select.append($('<option>', {
                            text: value,
                            value: key
                        })
                    );
                });

                $.each($('select[name*="filter_"]'),function (index, element) {
                    if ($(element).data('index') >= (nextIndex + 1)){
                        $(element).append($('<option>', {
                                text: 'Selecione o filtro anterior',
                                disabled: true
                            })
                        );
                    }
                })

                $('.selectpicker').selectpicker('refresh')
            }

            if (response.status === 'fail') {

                $.each($('select[name*="filter_"]'), function (index, element) {
                    if ($(element).data('index') >= (nextIndex)) {
                        $(element).empty();
                        $(element).append($('<option>', {
                                text: 'Selecione o filtro anterior',
                                disabled: true
                            })
                        );
                    }
                    $('.selectpicker').selectpicker('refresh')
                })
            }

            }, 'json');
    });

});
