<!DOCTYPE html>
<html>
<head>
    <title>Form Submit using Ajax jQuery in Laravel 8 with Validation</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            <h2>Submit Form with Append</h2>
        </div>
        <div class="card-body">
            <form name="ajax-contact-form" id="ajax-contact-form" method="post" action="javascript:void(0)">
                @csrf
                <div id="all-forms">
                    <div id="one-form">
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea id="description" name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Date</label>
                            <input type="date" id="date" name="date" class="form-control">
                        </div>
                    </div>
                </div>
                <div id="buttons">
                <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                <button type="button" class="btn btn-success" name="add" id="add">+</button>
                </div>
            </form>

        </div>

    </div>
</div>
<script>
    $(document).ready(function () {
        var i = 0;
        var x = 1;
        var max = 5;

        $('#ajax-contact-form').on('click', '#add', function () {
            if (x <= max) {
                ++i;
                $('#all-forms').append('<div id="one-form">'
                    +'<div class="form-group">'
                    +	'<label for="exampleInputEmail1">First Name</label>'
                    +	'<input type="text" id="first_name" name="first_name" class="form-control">'
                    +'</div>'
                    +'<div class="form-group">'
                    +	'<label for="exampleInputEmail1">Last Name</label>'
                    +	'<input type="text" id="last_name" name="last_name" class="form-control">'
                    +'</div>'
                    +'<div class="form-group">'
                    +	'<label for="exampleInputEmail1">Email</label>'
                    +	'<input type="email" id="email" name="email" class="form-control">'
                    +'</div>'
                    +'<div class="form-group">'
                    +	'<label for="exampleInputEmail1">Subject</label>'
                    +	'<input type="text" id="subject" name="subject" class="form-control">'
                    +'</div>'
                    +'<div class="form-group">'
                    +	'<label for="exampleInputEmail1">Description</label>'
                    +	'<textarea id="description" name="description" class="form-control"></textarea>'
                    +'</div>'
                    +'<div class="form-group">'
                    +	'<label for="exampleInputEmail1">Date</label>'
                    +	'<input type="date" id="date" name="date" class="form-control">'
                    +'</div>'
                    +'</div>');

                x++;
            }
            if(x === 2) {
                $('#buttons').append('<button type="button" class="btn btn-danger" name="remove" id="remove">-</button>');
                console.log(x)
            }

        });



        $('#ajax-contact-form').on('click', '#remove', function () {
            $('#one-form').remove();
            x--;
            if (x === 1) {
                $('#remove').remove();
            }
            console.log(x)
        });


    });

    if ($("#ajax-contact-form").length > 0) {
        $("#ajax-contact-form").validate({
            rules: {
                first_name: {
                    required: true,
                    maxlength: 50
                },
                last_name: {
                    required: true,
                    maxlength: 50
                },
                email: {
                    required: true,
                    maxlength: 50,
                    email: true,
                },
                subject: {
                    required: true,
                    maxlength: 100
                },
                description: {
                    required: true,
                    maxlength: 300
                },
                date: {
                    required: true,
                },
            },
            messages: {
                first_name: {
                    required: "Please enter your first name",
                    maxlength: "Your name maxlength should be 50 characters long."
                },
                last_name: {
                    required: "Please enter your first name",
                    maxlength: "Your name maxlength should be 50 characters long."
                },
                email: {
                    required: "Please enter valid email",
                    email: "Please enter valid email",
                    maxlength: "The email name should less than or equal to 50 characters",
                },
                subject: {
                    required: "Please enter subject",
                    maxlength: "Your subject maxlength should be 100 characters long."
                },
                description: {
                    required: "Please enter description",
                    maxlength: "Your description name maxlength should be 300 characters long."
                },
                date: {
                    required: "Please enter the date",
                    maxlength: "Your date should be valid."
                },
            },
            submitHandler: function (form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#submit').html('Please Wait...');
                $("#submit").attr("disabled", true);

                $.ajax({
                    url: "{{url('save')}}",
                    type: "POST",
                    data: $('#ajax-contact-form').serialize(),
                    success: function (response) {
                        $('#submit').html('Submit');
                        $("#submit").attr("disabled", false);
                        alert('Ajax form has been submitted successfully');
                        document.getElementById("ajax-contact-form").reset();
                    }
                });
            }
        })

    }
</script>
