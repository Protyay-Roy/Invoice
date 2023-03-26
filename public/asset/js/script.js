$(document).ready(function () {
    // DATATABLE
    $('#example').DataTable({
        scrollX: true,
    });
    // SEARCH INPUT
    $('#search_dropdown select').selectpicker();
    // ADD INVOICE ROW
    $(document).on("click", "#add_invoice", function (e) {
        e.preventDefault();
        var add_attr = '';
        add_attr += '<tr>';
        add_attr += '<td><input type="text" class="form-control" name="item[]" placeholder="Item"></td>';
        add_attr += '<td><input type="text" class="form-control" name="size[]" placeholder="Size"></td>';
        add_attr += '<td><input type="text" class="form-control width" name="width[]" placeholder="Width"></td>';
        add_attr += '<td><input type="text" class="form-control height" name="height[]" placeholder="Height"></td>';
        add_attr += '<td><input type="text" class="form-control square_ft" name="square_ft[]" placeholder="Square ft" readonly></td>';
        add_attr += '<td><input type="text" class="form-control qty" name="qty[]" placeholder="Quantity"></td>';
        add_attr += '<td><input type="text" class="form-control total_square_ft" name="total_square_ft[]" placeholder="Total Square ft" readonly></td>';
        add_attr += '<td><input type="text" class="form-control rate" name="rate[]" placeholder="Rate"></td>';
        add_attr += '<td><input type="text" class="form-control price" name="price[]" placeholder="Price" readonly></td>';
        add_attr += '<td><button class="btn btn-danger mt-1" id="remove_invoice_row"><i class="fa-solid fa-trash"></i></button></td>';
        add_attr += '</tr>';
        $("#table_body").append(add_attr)
    });
    // VIEW INVOICE CLICK EVENT
    $(document).on('click', '#view_invoice', function () {
        var id = $(this).val();
        $('#customer_id').val($(this).val());
        $.ajax({
            url: 'view-invoice/' + id,
            type: 'get',
            success: function (data) {
                if (data.status == 200) {
                    $('.view_tBody').html('');
                    $('#viewModal').modal('show');
                    $.each(data.transections.get_invoice_items, function (index, invoice) {

                        console.log(invoice.item);
                    });
                    $('#pdf_link').val(data.transections.id);
                    var d = new Date();
                    var strDate = d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear();

                    var type = data.transections.get_customer.type == 1 ? 'Customer' : 'Supplier';

                    $('.view_date').text(strDate)
                    $('.view_name').text(data.transections.get_customer.name)
                    $('.view_type').text(type)
                    $('.view_email').text(data.transections.get_customer.email);
                    $('.view_address').text(data.transections.get_customer.address);
                    $('.view_phone').text(data.transections.get_customer.phone);
                    $('.view_com_name').text(data.transections.get_customer.company_name);
                    $('.view_info').text(data.transections.get_customer.info);
                    if (data.transections.get_invoice_items != null) {
                        $.each(data.transections.get_invoice_items, function (index, invoice) {
                            $('.view_tBody').append(
                                '<tr><td>' + invoice.entry_date + '</td><td>' + invoice.item + '</td><td>' + invoice.size + '</td><td>' + invoice.width + '</td><td>' + invoice.height + '</td><td>' + invoice.square_ft + '</td><td>' + invoice.qty + '</td><td>' + invoice.total_square_ft + '</td><td>' + invoice.rate + '</td><td>' + invoice.price + '</td></tr>'
                            )
                        })
                    } else {
                        $('.view_tBody').html('')
                    }

                    $('.view_total').text(data.transections.debit);
                }
            }
        });
    });
    // CALCULATE INVOICE ITEMS BY CLICK EVENT
    $(document).on('keyup', '.width, .height, .rate, .qty', function () {
        var $row = $(this).closest('tr');
        var width = $row.find('.width').val();
        var height = $row.find('.height').val();
        var rate = $row.find('.rate').val();
        var qty = $row.find('.qty').val();

        var square_ft = (width * height) / 144;

        $row.find('.square_ft').val(square_ft.toFixed(2));
        var total_square_ft = square_ft * qty;

        $row.find('.total_square_ft').val(total_square_ft.toFixed(2));
        var price = total_square_ft * rate;
        $row.find('.price').val(price.toFixed(2));

        var subtotal = 0;
        $('input[name="price[]"]').each(function () {
            subtotal += parseFloat($(this).val()) || 0;
        });

        $('#subtotal').val(subtotal.toFixed(2));
    });
    // REMOVE INVOICE ROW
    $(document).on('click', '#remove_invoice_row', function () {
        var $row = $(this).closest('tr');
        var price = $row.find('.price').val();

        $row.remove();

        var subtotal = parseFloat($('#subtotal').val());
        subtotal -= parseFloat(price);
        $('#subtotal').val(subtotal.toFixed(2));
    });
    // DELETE INVOICE CLICK EVENT
    $(document).on('click', '#delete_invoice', function () {
        var id = $(this).val();
        var result = confirm('Do you want to delete this?');
        if (result) {
            window.location = 'delete-invoice/' + id;
        }

    });
    // VIEW CUSTOMER CLICK EVENT
    $(document).on('click', '#view_customer', function () {
        var id = $(this).val();
        $('#customer_id').val($(this).val());
        window.location = 'view-customer/' + id
    });
    // EDIT CUSTOMER CLICK EVENT
    $(document).on('click', '#edit_customer', function () {
        var id = $(this).val();
        $('#customer_id').val($(this).val());

        $.ajax({
            url: 'update-customer/' + id,
            type: 'get',
            success: function (data) {
                if (data.status == 200) {
                    $('#editModal').modal('show');
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
                }
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
    // VIEW SUPPLIER CLICK EVENT
    $(document).on('click', '#view_supplier', function () {
        var id = $(this).val();
        $('#customer_id').val($(this).val());
        window.location = 'view-supplier/' + id
    });
    // EDIT SUPPLIER CLICK EVENT
    $(document).on('click', '#edit_supplier', function () {
        var id = $(this).val();
        $('#supplier_id').val($(this).val());

        $.ajax({
            url: 'update-supplier/' + id,
            type: 'get',
            success: function (data) {
                if (data.status == 200) {
                    $('#editModal').modal('show');
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
                }
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
    // VIEW BANK CLICK EVENT
    $(document).on('click', '#view_bank', function () {
        var id = $(this).val();
        $('#customer_id').val($(this).val());
        window.location = 'view-bank/' + id
    });
    // EDIT BANK CLICK EVENT
    $(document).on('click', '#edit_bank', function () {
        var id = $(this).val();
        $('#bank_id').val($(this).val());

        $.ajax({
            url: 'update-bank/' + id,
            type: 'get',
            success: function (data) {
                if (data.status == 200) {
                    $('#editModal').modal('show');
                    $('#name').val(data.banks.name);
                    $('#account_number').val(data.banks.account_number);
                    $('#branch').val(data.banks.branch);
                    $('#info').val(data.banks.info);
                    if (data.bank_transections != null) {
                        $('#debit').val(data.bank_transections.debit);
                        $('#credit').val(data.bank_transections.credit);
                    } else {
                        $('#debit').val(null);
                        $('#credit').val(null);
                    }
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
    // ADD DAILY ENTRY ROW
    $(document).on("click", "#add_entry", function (e) {
        e.preventDefault();
        function getCurrentDate() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            return dd + '-' + mm + '-' + yyyy;
        }
        var add_attr = '';
        add_attr += '<tr>';
        add_attr += '<td><input type="text" class="form-control datepicker" name="date[]" value="' + getCurrentDate() + '"></td>';
        add_attr += '<td><select name="type[]" class="form-control entry_type"><option selected disabled>Select payment type</option><option value="customer">Customer Payment</option><option value="supplier">Supplier Payment</option><option value="bank">Bank Payment</option></select></td>';
        add_attr += '<td><select name="profile[]" class="form-control profile"><option selected disabled>Select profile</option><option value="customer">Customer Payment</option><option value="supplier">Supplier Payment</option><option value="bank">Bank Payment</option></select></td>';
        add_attr += '<td><input type="text" class="form-control" name="debit[]" placeholder="Debit"></td>';
        add_attr += '<td><input type="text" class="form-control" name="credit[]" placeholder="Credit"></td>';
        add_attr += '<td><input type="text" class="form-control" name="note[]" placeholder="Note"></td>';
        add_attr += '<td><select name="bank_name[]" id="bank_name" class="form-control"><option selected disabled>Select your bank</option>';

        $.ajax({
            url: '/get_bank',
            type: 'GET',
            success: function (data) {
                $.each(data.bank, function (index, bank) {
                    add_attr += '<option value="' + bank.name + '">' + bank.name + '</option>';
                });
                add_attr += '</select></td>';
                add_attr += '<td><button class="btn btn-danger mt-1" id="remove_entry_row"><i class="fa-solid fa-trash"></i></button></td>';

                $("#table_body").append(add_attr);

                // Initialize datepicker and set default date to current date
                $('.datepicker').datepicker({
                    dateFormat: "dd-mm-yy",
                    changeMonth: true,
                    changeYear: true,
                    // defaultDate: new Date('d-m-Y') // Set default date to current date
                });
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    // CHANGE ENTRY TYPE BY AJAX
    $(document).on('change', '.entry_type', function () {
        var type = $(this).val();
        var $row = $(this).closest('tr');
        var $profileSelect = $row.find('.profile');

        $profileSelect.html('<option selected disabled>Select profile</option>');

        $.ajax({
            url: 'profile/' + type,
            type: 'get',
            success: function (data) {
                $.each(data, function (index, profile) {
                    $profileSelect.append('<option value="' + profile.id + '">' + profile.name + '</option>');
                });
            },
            error: function () {
                alert('Error');
            }
        })
    })
    // DELETE ENTRY CLICK EVENT
    $(document).on('click', '#delete_entry', function () {
        var id = $(this).val();
        var result = confirm('Do you want to delete this?');
        if (result) {
            window.location = 'delete-entry/' + id;
        }
    });
    // DELETE ENTRY ROW
    $(document).on('click', '#remove_entry_row', function () {
        $(this).closest('tr').remove();
    });
    // DELETE DAILY ENTRY ROW
    $(document).on('click', '#pdf_link', function () {
        window.location = 'download-pdf/' + $(this).val();
    });
    // DATE
    $('.datepicker').datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true
    })
});




