$('.saisieMontant').keyup(function(){
    let elem = $(this).parent()
    let price = parseFloat(elem.siblings('#price').text())
    let total = elem.siblings('#total')
    let nb = parseFloat($(this).val())

    if (isNaN(nb)) nb = 0

    total.html((price *  nb).toFixed(2) + ' €')
})


$('#ajouterLn').click(function(){
    $('#autreMontantListe').append(`<tr>
        <td class="col-md-3">
            <input type="date" name="date_autre_frais[]" class="form-control" required>
        </td>
        <td>
            <input type="text" name="libelle_autre_frais[]" class="form-control" required>
        </td>
        <td class="col-md-3">
            <input type="number" name="montant_autre_frais[]" class="form-control" required>
        </td>
        <td class="col-md-1">
            <span class="btn btn-danger btn-xs delete_row" style="margin-top: 1px; padding: 5px">
                <i class="fa fa-trash-o fa-fw"></i>
            </span>
        </td>
    </tr>`)

    $('.delete_row').click(function(){
        $(this).parent().parent().remove();
    })
})

$('.delete_row').click(function(){
    $(this).parent().parent().remove();
})
