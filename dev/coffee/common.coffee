
jQuery(document).ready ->
    $ = jQuery
    doc = $ document

    $('[title]').tooltip()

    doc.on 'click', '[data-confirm]', (e) ->
        e.preventDefault()

        if confirm($(this).attr('data-confirm'))
            window.location = $(this).attr 'href'
