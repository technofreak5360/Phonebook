<html>

<head>
    <title>Phonebook</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="jquery-ui.css">
    <link rel="stylesheet" href="bootstrap.min.css" />
    <script src="jquery.min.js"></script>
    <script src="jquery-ui.js"></script>
</head>

<body>
    <div class="container">
        <br />

        <h2 class="text-primary text-center">PHONEBOOK</h2>
        <br />
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-info btn-m" data-toggle="modal" data-target="#myModal2">search
            User</button>

        <!-- Modal -->
        <div id="myModal2" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Search User</h4>
                    </div>
                    <div class="modal-body">
                        <div class="topnav">
                            <div class="search-container">
                                <form action="" method="GET">
                                    <div class="col-md-6">
                                        <input type="text" name="search" class='form-control' id="search"
                                            placeholder="Search By Name" autocomplete="off">
                                    </div>
                                </form>
                            </div><br><br><br>
                            <table class="table table-bordered" id="table-data">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <?php 
require 'filter.php';
$data = filter();
while($row = $data->fetch_assoc()):

?>
                                <tr>
                                    <td> <?=$row['name'] ?> </td>
                                    <td> <?=$row['email'] ?> </td>
                                    <td> <?=$row['phone'] ?> </td>
                                </tr>
                                <?Php endwhile; ?>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <div align="right" style="margin-bottom:5px;">
            <img style="cursor:pointer" name="add" id="add" width="80em" src="add-remove.png" />
        </div>
        <div class="table-responsive" id="user_data">

        </div>
        <br />
    </div>

    <div id="user_dialog" title="Add Data">
        <form method="post" id="user_form">
            <div class="form-group">
                <label>Enter Name</label>
                <input type="text" name="name" id="name" class="form-control" />
                <span id="error_name" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label>Enter Email</label>
                <input type="text" name="email" id="email" class="form-control" />
                <span id="error_email" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label>Enter Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control" />
                <span id="error_phone" class="text-danger"></span>
            </div>
            <div class="form-group">
                <input type="hidden" name="action" id="action" value="insert" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <input type="submit" name="form_action" id="form_action" class="btn btn-info" value="Insert" />
            </div>
        </form>
    </div>

    <div id="action_alert" title="Action">

    </div>

    <div id="delete_confirmation" title="Confirmation">
        <p>Are you sure you want to Delete this data?</p>
    </div>

</body>

</html>




<script>
$(document).ready(function() {

    load_data();

    function load_data() {
        $.ajax({
            url: "fetch.php",
            method: "POST",
            success: function(data) {
                $('#user_data').html(data);
            }
        });
    }

    $("#user_dialog").dialog({
        autoOpen: false,
        width: 400
    });

    $('#add').click(function() {
        $('#user_dialog').attr('title', 'Add Data');
        $('#action').val('insert');
        $('#form_action').val('Insert');
        $('#user_form')[0].reset();
        $('#form_action').attr('disabled', false);
        $("#user_dialog").dialog('open');
    });

    $('#user_form').on('submit', function(event) {
        event.preventDefault();
        var error_name = '';
        var error_email = '';
        var error_phone = '';
        if ($('#name').val() == '') {
            error_first_name = 'Name is required';
            $('#error_name').text(error_name);
            $('#name').css('border-color', '#cc0000');
        } else {
            error_name = '';
            $('#error_name').text(error_name);
            $('#name').css('border-color', '');
        }
        if ($('#email').val() == '') {
            error_email = 'Email is required';
            $('#error_email').text(error_email);
            $('#email').css('border-color', '#cc0000');
        } else {
            error_email = '';
            $('#error_email').text(error_email);
            $('#email').css('border-color', '');
        }
        if ($('#phone').val() == '') {
            error_email = 'phone is required';
            $('#error_phone').text(error_phone);
            $('#phone').css('border-color', '#cc0000');
        } else {
            error_phone = '';
            $('#error_phone').text(error_email);
            $('#phone').css('border-color', '');
        }

        if (error_name != '' || error_email != '' || error_phone != '') {
            return false;
        } else {
            $('#form_action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "action.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    $('#user_dialog').dialog('close');
                    $('#action_alert').html(data);
                    $('#action_alert').dialog('open');
                    load_data();
                    $('#form_action').attr('disabled', false);
                }
            });
        }

    });

    $('#action_alert').dialog({
        autoOpen: false
    });

    $(document).on('click', '.edit', function() {
        var id = $(this).attr('id');
        var action = 'fetch_single';
        $.ajax({
            url: "action.php",
            method: "POST",
            data: {
                id: id,
                action: action
            },
            dataType: "json",
            success: function(data) {
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
                $('#user_dialog').attr('title', 'Edit Data');
                $('#action').val('update');
                $('#hidden_id').val(id);
                $('#form_action').val('Update');
                $('#user_dialog').dialog('open');
            }
        });
    });

    $('#delete_confirmation').dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            Ok: function() {
                var id = $(this).data('id');
                var action = 'delete';
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        id: id,
                        action: action
                    },
                    success: function(data) {
                        $('#delete_confirmation').dialog('close');
                        $('#action_alert').html(data);
                        $('#action_alert').dialog('open');
                        load_data();
                    }
                });
            },
            Cancel: function() {
                $(this).dialog('close');
            }
        }
    });

    $(document).on('click', '.delete', function() {
        var id = $(this).attr("id");
        $('#delete_confirmation').data('id', id).dialog('open');
    });

});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#search").keyup(function() {
        var search = $(this).val();

        $.ajax({

            url: 'filterop.php',
            method: 'post',
            data: {
                query: search
            },
            success: function(response) {
                $("#table-data").html(response);
            }

        });

    });
});
</script>