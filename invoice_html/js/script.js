$(document).ready(function () {

    $('#search_dropdown select').selectpicker();

    // ADD ROW
    $(document).on("click", "#add_attribute", function (e) {
        e.preventDefault();
        var add_attr = '';
        add_attr += '<tr>';
        add_attr += '<td><input type="text" class="form-control" name="item[]" placeholder="Item"></td>';
        add_attr += '<td><input type="text" class="form-control" name="size[]" placeholder="Size"></td>';
        add_attr += '<td><input type="text" class="form-control" name="unit[]" placeholder="Unit"></td>';
        add_attr += '<td><input type="text" class="form-control width" name="width[]" placeholder="Width"></td>';
        add_attr += '<td><input type="text" class="form-control height" name="height[]" placeholder="Height"></td>';
        add_attr += '<td><input type="text" class="form-control square_ft" name="square_ft[]" placeholder="Square ft" readonly></td>';
        add_attr += '<td><input type="text" class="form-control rate" name="rate[]" placeholder="Rate"></td>';
        add_attr += '<td><input type="text" class="form-control price" name="price[]" placeholder="Price" readonly></td>';
        add_attr += '<td><button class="btn btn-danger mt-1" id="remove_attribute"><i class="fa-solid fa-trash"></i></button></td>';
        add_attr += '</tr>';
        $("#attr_field").append(add_attr)
    });

    // REMOVE ROW
    $(document).on('click', '#remove_attribute', function () {
        $(this).closest('tr').remove();
    });

    $(document).on('keyup', '.width, .height, .rate', function () {
        var $row = $(this).closest('tr');
        var width = $row.find('.width').val();
        var height = $row.find('.height').val();
        var rate = $row.find('.rate').val();

        var square_ft = width * height;

        $row.find('.square_ft').val(square_ft);
        var price = square_ft * rate;
        $row.find('.price').val(price);

        var subtotal = 0;
        $('input[name="price[]"]').each(function () {
            subtotal += parseInt($(this).val()) || 0;
        });

        $('#subtotal').val(subtotal);
    });

});
