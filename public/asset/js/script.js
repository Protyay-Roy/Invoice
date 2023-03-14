$(document).ready(function () {


    $('#example').DataTable();

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
        var subtotal = $('#subtotal').val();
        var $row = $(this).closest('tr');
        var price = $row.find('.price').val();
        subtotal -= price;
        $('#subtotal').val(subtotal);

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

    // CUSTOMER CLICK EVENT
    $(document).on('click', '#edit_customer', function () {
        var id = $(this).val();
        $('#editModal').modal('show');
        $('#customer_id').val($(this).val());

        $.ajax({
            url: 'update-customer/' + id,
            type: 'get',
            success: function (data) {
                if (data.status == 200) {
                    $('#name').val(data.ledgers.name);
                    $('#email').val(data.ledgers.email);
                    $('#address').val(data.ledgers.address);
                    $('#phone').val(data.ledgers.phone);
                    $('#company_name').val(data.ledgers.company_name);
                    $('#info').val(data.ledgers.info);
                    if (data.transections != null) {
                        $('#debit').val(data.transections.debit);
                        $('#credit').val(data.transections.credit);
                    } else {
                        $('#debit').val(null);
                        $('#credit').val(null);
                    }
                    // console.log(data.transections.id);
                }
                // $('#name').val(data.ledgers.name);
            }
        });

    });

    $(document).on('click', '#delete_customer', function () {
        var id = $(this).val();
        var result = confirm('Do you want to delete this?');
        if (result) {
            window.location = 'delete-customer/' + id;
        }

    });

    // SUPPLIER CLICK EVENT
    $(document).on('click', '#edit_supplier', function () {
        var id = $(this).val();
        $('#editModal').modal('show');
        $('#supplier_id').val($(this).val());

        $.ajax({
            url: 'update-supplier/' + id,
            type: 'get',
            success: function (data) {
                if (data.status == 200) {
                    $('#name').val(data.ledgers.name);
                    $('#email').val(data.ledgers.email);
                    $('#address').val(data.ledgers.address);
                    $('#phone').val(data.ledgers.phone);
                    $('#company_name').val(data.ledgers.company_name);
                    $('#info').val(data.ledgers.info);
                    if (data.transections != null) {
                        $('#debit').val(data.transections.debit);
                        $('#credit').val(data.transections.credit);
                    } else {
                        $('#debit').val(null);
                        $('#credit').val(null);
                    }
                    // console.log(data.transections.id);
                }
                // $('#name').val(data.ledgers.name);
            }
        });

    });

    $(document).on('click', '#delete_supplier', function () {
        var id = $(this).val();
        var result = confirm('Do you want to delete this?');
        if (result) {
            window.location = 'delete-supplier/' + id;
        }

    });

    // Bank CLICK EVENT
    $(document).on('click', '#edit_bank', function () {
        var id = $(this).val();
        $('#editModal').modal('show');
        $('#bank_id').val($(this).val());

        $.ajax({
            url: 'update-bank/' + id,
            type: 'get',
            success: function (data) {
                if (data.status == 200) {
                    $('#name').val(data.banks.name);
                    $('#account_number').val(data.banks.account_number);
                    $('#branch').val(data.banks.branch);
                    $('#info').val(data.banks.info);
                    // if(data.transections != null){
                    //     $('#debit').val(data.transections.debit);
                    //     $('#credit').val(data.transections.credit);
                    // }else{
                    //     $('#debit').val(null);
                    //     $('#credit').val(null);
                    // }
                    // console.log(data.transections.id);
                }
            }
        });

    });

    $(document).on('click', '#delete_bank', function () {
        var id = $(this).val();
        var result = confirm('Do you want to delete this?');
        if (result) {
            window.location = 'delete-bank/' + id;
        }

    });

    $(document).on('click', '#delete_invoice', function () {
        var id = $(this).val();
        var result = confirm('Do you want to delete this?');
        if (result) {
            window.location = 'delete-invoice/' + id;
        }

    });

    // $(document).on('click', '#edt', function () {
    //         window.location = 'edit-invoice';
    // });
});

