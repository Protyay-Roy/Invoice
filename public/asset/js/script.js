$(document).ready(function () {


    $('#example').DataTable({
        scrollX: true,
    });

    $('#search_dropdown select').selectpicker();

    // ADD INVOICE ROW
    $(document).on("click", "#add_invoice", function (e) {
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
        add_attr += '<td><button class="btn btn-danger mt-1" id="remove_invoice_row"><i class="fa-solid fa-trash"></i></button></td>';
        add_attr += '</tr>';
        $("#table_body").append(add_attr)
    });

    // REMOVE INVOICE ROW
    $(document).on('click', '#remove_invoice_row', function () {
        $(this).closest('tr').remove();
        var subtotal = $('#subtotal').val();
        var $row = $(this).closest('tr');
        var price = $row.find('.price').val();
        subtotal -= price;
        $('#subtotal').val(subtotal);

    });

    // CALCULATE INVOICE ITEMS BY CLICK EVENT
    $(document).on('keyup', '.width, .height, .rate', function () {
        var $row = $(this).closest('tr');
        var width = $row.find('.width').val();
        var height = $row.find('.height').val();
        var rate = $row.find('.rate').val();

        var square_ft = (width * height)/144;

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

    // DELETE CUSTOMER CLICK EVENT
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

    // DELETE SUPPLIER CLICK EVENT
    $(document).on('click', '#delete_supplier', function () {
        var id = $(this).val();
        var result = confirm('Do you want to delete this?');
        if (result) {
            window.location = 'delete-supplier/' + id;
        }

    });

    // BANK CLICK EVENT
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
                    if(data.bank_transections != null){
                        $('#debit').val(data.bank_transections.debit);
                        $('#credit').val(data.bank_transections.credit);
                    }else{
                        $('#debit').val(null);
                        $('#credit').val(null);
                    }
                    // console.log(data.transections.id);
                }
            }
        });

    });

    // DELETE BANK CLICK EVENT
    $(document).on('click', '#delete_bank', function () {
        var id = $(this).val();
        var result = confirm('Do you want to delete this?');
        if (result) {
            window.location = 'delete-bank/' + id;
        }

    });

    // DELETE INVOICE CLICK EVENT
    $(document).on('click', '#delete_invoice', function () {
        var id = $(this).val();
        var result = confirm('Do you want to delete this?');
        if (result) {
            window.location = 'delete-invoice/' + id;
        }

    });

    // ADD DAILY ENTRY ROW
    // $(document).on("click", "#add_entry", function (e) {
    //     e.preventDefault();
    //     var add_attr = '';
    //     add_attr += '<tr>';
    //     add_attr += '<td><input type="date" class="form-control" name="date[]"></td>';
    //     add_attr += '<td><select name="type[]" class="form-control entry_type"><option selected disabled>Select payment type</option><option value="customer">Customer Payment</option><option value="supplier">Supplier Payment</option><option value="bank">Bank Payment</option></select></td>';
    //     add_attr += '<td><select name="profile[]" class="form-control profile"><option selected disabled>Select profile</option><option value="customer">Customer Payment</option><option value="supplier">Supplier Payment</option><option value="bank">Bank Payment</option></select></td>';
    //     add_attr += '<td><input type="text" class="form-control" name="debit[]" placeholder="Debit"></td>';
    //     add_attr += '<td><input type="text" class="form-control" name="credit[]" placeholder="Credit"></td>';
    //     add_attr += '<td><input type="text" class="form-control" name="note[]" placeholder="Note"></td>';
    //     // add_attr += '<td><input type="text" class="form-control" name="bank_name[]" placeholder="Bank"></td>';
    //     add_attr += '<td><select name="bank_name[]" id="bank_name" class="form-control"><option selected disabled>Select your bank</option>@foreach (App\Models\Bank::get() as $bank)<option value="{{ $bank->name }}">{{ $bank->name }}</option>@endforeach</select></td>';
    //     add_attr += '<td><button class="btn btn-danger mt-1" id="remove_entry_row"><i class="fa-solid fa-trash"></i></button></td>';
    //     add_attr += '</tr>';
    //     $("#table_body").append(add_attr)
    // });

    // REMOVE DAILY ENTRY ROW
    $(document).on('click', '#remove_entry_row', function () {
        $(this).closest('tr').remove();
    });

    $(document).on('change', '.entry_type', function () {
        var type = $(this).val();
        var $row = $(this).closest('tr');
        var $profileSelect = $row.find('.profile');

        $profileSelect.html('<option selected disabled>Select profile</option>');

        $.ajax({
            url: 'profile/' + type,
            type: 'get',
            success: function (data) {
                // if(data.status == 200){
                    $.each(data, function(index, profile){
                        $profileSelect.append('<option value="' + profile.id + '">' + profile.name + '</option>');
                    });
                // }
            },
            error: function () {
                alert('Error');
            }
        })
    })



    $(document).on("click", "#add_entry", function (e) {
        // Prevent the default behavior of the button click
        e.preventDefault();

        // Build a string of HTML to add to the table
        var add_attr = '';
        add_attr += '<tr>';
        add_attr += '<td><input type="date" class="form-control" name="date[]"></td>';
        add_attr += '<td><select name="type[]" class="form-control entry_type"><option selected disabled>Select payment type</option><option value="customer">Customer Payment</option><option value="supplier">Supplier Payment</option><option value="bank">Bank Payment</option></select></td>';
        add_attr += '<td><select name="profile[]" class="form-control profile"><option selected disabled>Select profile</option><option value="customer">Customer Payment</option><option value="supplier">Supplier Payment</option><option value="bank">Bank Payment</option></select></td>';
        add_attr += '<td><input type="text" class="form-control" name="debit[]" placeholder="Debit"></td>';
        add_attr += '<td><input type="text" class="form-control" name="credit[]" placeholder="Credit"></td>';
        add_attr += '<td><input type="text" class="form-control" name="note[]" placeholder="Note"></td>';
        add_attr += '<td><select name="bank_name[]" id="bank_name" class="form-control"><option selected disabled>Select your bank</option>';

        // Use an AJAX request to get the bank model from the server
        $.ajax({
            url: '/get_bank',
            type: 'GET',
            success: function (data) {
                // Loop through the bank models and add an option element for each one
                $.each(data.bank, function (index, bank) {
                    add_attr += '<option value="' + bank.name + '">' + bank.name + '</option>';
                });

                // Add the closing tag for the select element and the remove button
                add_attr += '</select></td>';
                add_attr += '<td><button class="btn btn-danger mt-1" id="remove_entry_row"><i class="fa-solid fa-trash"></i></button></td>';

                // Append the new row to the table body
                $("#table_body").append(add_attr);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });



});

