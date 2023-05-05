$(document).ready(function () {
    // CREATE VALIDATION
    $('form').on('submit', function (event) {
        // ENTRY FORM VALIDATION
        $('.entry_type').each(function () {
            var selectedValue = $(this).val();
            if (selectedValue === '' || selectedValue === null) {
                event.preventDefault();
                alert('Please select a payment type.');
                $(this).focus();
                return false;
            }
        });
        $('.profile').each(function () {
            var selectedValue = $(this).val();
            if (selectedValue === '' || selectedValue === null) {
                event.preventDefault();
                alert('Please select a profile.');
                $(this).focus();
                return false;
            }
        });
        // INVOICE FORM VALIDATION
        var dateValue = $('#datepicker').val();
        if (dateValue === '' || dateValue === null) {
            event.preventDefault();
            alert('Please select a date.');
            $('#datepicker').focus();
            return false;
        }
        var dropdownValue = $('select[name="ledger_id"]').val();
        if (dropdownValue === '' || dropdownValue === null) {
            event.preventDefault();
            alert('Please select a customer.');
            $('select[name="ledger_id"]').focus();
            return false;
        }
        $('input[name="item[]"]').each(function () {
            var inputValue = $(this).val();
            if (inputValue === '' || inputValue === null) {
                event.preventDefault();
                alert('Please enter a value for the item field.');
                $(this).focus();
                return false;
            }
        });
        $('input[name="size[]"]').each(function () {
            var inputValue = $(this).val();
            if (inputValue === '' || inputValue === null) {
                event.preventDefault();
                alert('Please enter a value for the size field.');
                $(this).focus();
                return false;
            }
        });
        $('input[name="width[]"]').each(function () {
            var inputValue = $(this).val();
            if (inputValue === '' || inputValue === null) {
                event.preventDefault();
                alert('Please enter a value for the width field.');
                $(this).focus();
                return false;
            }
        });
        $('input[name="height[]"]').each(function () {
            var inputValue = $(this).val();
            if (inputValue === '' || inputValue === null) {
                event.preventDefault();
                alert('Please enter a value for the height field.');
                $(this).focus();
                return false;
            }
        });
        $('input[name="square_ft[]"]').each(function () {
            var inputValue = $(this).val();
            if (inputValue === '' || inputValue === null) {
                event.preventDefault();
                alert('Something wrong squire ft field.');
                $(this).focus();
                return false;
            }
        });
        $('input[name="qty[]"]').each(function () {
            var inputValue = $(this).val();
            if (inputValue === '' || inputValue === null) {
                event.preventDefault();
                alert('Please enter a value for the quantity field.');
                $(this).focus();
                return false;
            }
        });
        $('input[name="total_square_ft[]"]').each(function () {
            var inputValue = $(this).val();
            if (inputValue === '' || inputValue === null) {
                event.preventDefault();
                alert('Something wrong total squire ft field.');
                $(this).focus();
                return false;
            }
        });
        $('input[name="rate[]"]').each(function () {
            var inputValue = $(this).val();
            if (inputValue === '' || inputValue === null) {
                event.preventDefault();
                alert('Please enter a value for the rate field.');
                $(this).focus();
                return false;
            }
        });
        $('input[name="price[]"]').each(function () {
            var inputValue = $(this).val();
            if (inputValue === '' || inputValue === null) {
                event.preventDefault();
                alert('Something wrong total price field.');
                $(this).focus();
                return false;
            }
        });
    });
    // VALIDATION FOR ENTRY CREDIT AND DEBIT EQUAL NULL
    $(document).on('submit', '#entry_form', function (event) {
        $('input[name="debit[]"]').each(function (index, element) {
            var debitField = $('input[name="debit[]"]').eq(index);
            var creditField = $('input[name="credit[]"]').eq(index);
            var debitValue = debitField.val();
            var creditValue = creditField.val();
            if (debitValue === '' && creditValue === '') {
                event.preventDefault();
                alert('Please enter a value for either the debit or credit field in row ' + (index + 1) + '.');
                debitField.focus();
                return false;
            }
        });
    });
    // DATATABLE
    $('#example').DataTable({
        scrollX: true,
    });
    // SEARCH INPUT
    $('#search_dropdown select').selectpicker();
    // DATEPICKER
    $('.datepicker').datepicker({
        // dateFormat: "dd-mm-yy",
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    })
    // ADD INVOICE ROW
    $(document).on("click", "#add_invoice", function (e) {
        e.preventDefault();
        var add_attr = '';
        add_attr += '<tr>';
        add_attr += '<td><input required type="text" class="form-control" name="item[]" placeholder="Item"></td>';
        add_attr += '<td><input required type="text" class="form-control" name="size[]" placeholder="Size"></td>';
        add_attr += '<td><input required type="text" class="form-control width" name="width[]" placeholder="Width"></td>';
        add_attr += '<td><input required type="text" class="form-control height" name="height[]" placeholder="Height"></td>';
        add_attr += '<td><input required type="text" class="form-control square_ft" name="square_ft[]" placeholder="Square ft" readonly></td>';
        add_attr += '<td><input required type="text" class="form-control qty" name="qty[]" placeholder="Quantity"></td>';
        add_attr += '<td><input required type="text" class="form-control total_square_ft" name="total_square_ft[]" placeholder="Total Square ft" readonly></td>';
        add_attr += '<td><input required type="text" class="form-control rate" name="rate[]" placeholder="Rate"></td>';
        add_attr += '<td><input required type="text" class="form-control price" name="price[]" placeholder="Price" readonly></td>';
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
                                '<tr><td>' + invoice.entry_date + '</td><td>' + invoice.item + '</td><td>' + invoice.size + '</td><td>' + invoice.width + '</td><td>' + invoice.height + '</td><td>' + invoice.square_ft + '</td><td>' + invoice.qty + '</td><td>' + invoice.total_square_ft + '</td><td>' + invoice.rate + '</td><td>' + invoice.price.toLocaleString('en-US', { minimumFractionDigits: 2 }) + '</td></tr>'
                            )
                        })
                    } else {
                        $('.view_tBody').html('')
                    }
                    var number = data.transections.debit;
                    var total_price = number.toLocaleString('en-US', { minimumFractionDigits: 2 });
                    $('.view_total').text(total_price);
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
        // var price = $row.find('.price').val();

        $row.remove();

        // var subtotal = parseFloat($('#subtotal').val());
        // subtotal -= parseFloat(price);
        // $('#subtotal').val(subtotal.toFixed(2));
        var subtotal = 0;
        $('input[name="price[]"]').each(function () {
            subtotal += parseFloat($(this).val()) || 0;
        });

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
            return yyyy + '-' + mm + '-' + dd;
        }
        var add_attr = '';
        add_attr += '<tr>';
        add_attr += '<td><input type="text" class="form-control datepicker" name="date[]" value="' + getCurrentDate() + '" required></td>';
        add_attr += '<td><select name="type[]" class="form-control entry_type" required><option selected disabled value="">Select payment type</option><option value="customer">Customer Payment</option><option value="supplier">Supplier Payment</option><option value="bank">Bank Payment</option></select></td>';
        add_attr += '<td><select name="profile[]" class="form-control profile" required><option selected disabled value="">Select profile</option></select></td>';
        add_attr += '<td><input type="text" class="form-control" name="debit[]" placeholder="Debit"></td>';
        add_attr += '<td><input type="text" class="form-control" name="credit[]" placeholder="Credit"></td>';
        add_attr += '<td><input type="text" class="form-control" name="note[]" placeholder="Note"></td>';
        add_attr += '<td class="search_dropdown"> <select name="bank_name" data-live-search="true" class="form-control"> <option data-tokens="" disabled selected value="">Select Bank</option>';
        // add_attr += '<td class="bank_td"><input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Enter Bank"><div id="search_bank_name"></div></td>';
        // add_attr += '</select></td>';
        // add_attr += '<td><button class="btn btn-danger mt-1" id="remove_entry_row"><i class="fa-solid fa-trash"></i></button></td>';

        // $("#table_body").append(add_attr);

        // $('.datepicker').datepicker({
        //     dateFormat: "yy-mm-dd",
        //     changeMonth: true,
        //     changeYear: true,
        // });

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

                $('.datepicker').datepicker({
                    dateFormat: "yy-mm-dd",
                    changeMonth: true,
                    changeYear: true,
                });

                $('.search_dropdown select').selectpicker();
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
        $profileSelect.html('<option selected disabled required value="">Select profile</option>');

        // var $profileSelect = $row.find('#ajax_profile');
        // $profileSelect.html('<td id="search_dropdown"><select data-live-search="true" name="profile[]" class="form-control profile" required><option data-tokens="" selected disabled required value="">Select profile</option>');

        // $prfl = '';
        // $prfl = '<td id="search_dropdown">';
        // $prfl = '<select data-live-search="true" name="profile[]" class="form-control profile" required>';
        // $prfl = '<option data-tokens="" selected disabled required value="">Select profile</option>';


        $.ajax({
            url: 'profile/' + type,
            type: 'get',
            success: function (data) {
                $.each(data, function (index, profile) {
                    $profileSelect.append('<option value="' + profile.id + '">' + profile.name + '</option>');

                    // $profileSelect.html('<td>hii<td>')
                    // $profileSelect.append('<option value="' + profile.id + '">' + profile.name + '</option></select></td>');
                });
                // $('#search_dropdown select').selectpicker();
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
    // SEARCH FOR FILTER CUSTOMER
    $(document).on('click', '#customer_search_view', function (e) {
        e.preventDefault();
        var from = $('#from').val();
        var to = $('#to').val();
        var id = $(this).attr('view_id');
        var type = $('#customer_transection_type').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '' + id,
            type: 'get',
            data: {
                from: from,
                to: to,
                type: type
            },
            success: function (res) {
                $('#get_customer_transection').html(res);
                // testing

            }, error: function () {
                alert('Error');
            }
        });
        // $.ajax({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     url: 'download-customer-pdf' + id,
        //     type: 'get',
        //     data: {
        //         from: from,
        //         to: to,
        //         type: type
        //     },
        //     success: function (res) {
        //         // $('#get_customer_transection').html(res);
        //         console.log(res);
        //     }
        // })
    });

    $(document).on('change', '#customer_transection_type', function () {
        var id = $(this).attr('view_id');
        var from = $('#from').val();
        var to = $('#to').val();
        // console.log(from);
        // console.log(to);
        // console.log(type);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '' + id,
            type: 'get',
            data: {
                type: $(this).val(),
                from: from,
                to: to,
            },
            success: function (res) {
                $('#get_customer_transection').html(res);
            }, error: function () {
                alert('Error');
            }
        });
    })
    // SEARCH FOR FILTER SUPPLIER
    $('#supplier_search_view').click(function (e) {
        e.preventDefault();
        var from = $('#from').val();
        var to = $('#to').val();
        var id = $(this).attr('view_id');
        var type = $('#supplier_transection_type').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '' + id,
            type: 'get',
            data: {
                from: from,
                to: to,
                type: type
            },
            success: function (res) {
                $('#get_supplier_transection').html(res);
            }, error: function () {
                alert('Error');
            }
        });
    });
    $('#supplier_transection_type').on('change', function () {
        var id = $(this).attr('view_id');
        var from = $('#from').val();
        var to = $('#to').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '' + id,
            type: 'get',
            data: {
                type: $(this).val(),
                from: from,
                to: to,
            },
            success: function (res) {
                $('#get_supplier_transection').html(res);
            }, error: function () {
                alert('Error');
            }
        });
    })
    // SEARCH FOR FILTER BANK
    $('#bank_search_view').click(function (e) {
        e.preventDefault();
        var from = $('#from').val();
        var to = $('#to').val();
        var id = $(this).attr('view_id');
        // console.log(from);
        // console.log(to);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '' + id,
            type: 'get',
            data: {
                from: from,
                to: to
            },
            success: function (res) {
                $('#get_bank_transection').html(res);
            }, error: function () {
                alert('Error');
            }
        });
    });

    // $(document).on('click', '#download', function(e){
    //     e.preventDefault();
    //     var from = $('#from').val();
    //     var to = $('#to').val();
    //     var id = $(this).attr('download_id');
    //     var type = $('#customer_transection_type').val();

    //     window.location = 'download-customer-pdf/'+id;
    // })

    $(document).on('keyup', '#bank_name', function () {
        $('#search_bank_name').hide();
        $.ajax({
            url: 'search-bank/' + $(this).val(),
            type: 'get',
            success: function (res) {
                if (res.status == 200) {
                    $('#search_bank_name').fadeIn();
                    $.each(res.banks, function (index, bank) {
                        $('#search_bank_name').html('<button class="ajax_bank_name" value="' + bank.name + '">' + bank.name + '</button>');
                    })
                }
            }
        })
    });
    $('#search_bank_name').hide();
    $(document).on('click', '.ajax_bank_name', function () {
        $('#bank_name').val($(this).val());
        $('#search_bank_name').hide();
    });
    $(window).on('click', function () {
        $('#search_bank_name').hide();
    });


    // $(document).on('click', '#navbarSupportedContent ul li.nav-item', function(){
    //     // alert();
    //     $('li').removeClass('active');
    //     $(this).addClass('active');
    // });
});




