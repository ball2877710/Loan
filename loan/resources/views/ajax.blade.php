<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ajax CRUD Laravel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}" type="text/javascript"></script>
</head>
<body>

    <div class="container">
        <p>
            <h1>Ajax CRUD Laravel</h1>
        </p>
        <div class="row">
            <div class="col-md-8">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Loan Amount</th>
                            <th>Loan Term</th>
                            <th>Interest Rate</th>
                            <th>Created at</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="col-md-4">
                <form>
                    <div class="form-group myid">
                        <label>ID</label>
                        <input type="number" id="id" class="form-control" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label>Loan Amount</label>
                        <input type="text" id="loanAmount" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Loan Term</label>
                        <input type="text" id="loanTerm" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Interest Rate</label>
                        <input type="text" id="interestRate" class="form-control">
                    </div>
                    <div class="form-group myid">
                        <label>Created at</label>
                        <input type="number" id="created_at" class="form-control" readonly="readonly">
                    </div>
                    <button type="button" id="save" onclick="saveData()" class="btn btn-primary">Submit</button>
                    <button type="button" id="update" onclick="updateData()" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#datatable').DataTable();
        $('#save').show();
        $('#update').hide();
        $('.myid').hide();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function viewData(){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/cruds",
                success: function(response){
                    var rows = "";
                    $.each(response, function(key, value){
                        rows = rows + "<tr>";
                        rows = rows + "<td>"+value.id+"</td>";
                        rows = rows + "<td>"+value.loanAmount+"</td>";
                        rows = rows + "<td>"+value.loanTerm+"</td>";
                        rows = rows + "<td>"+value.interestRate+"</td>";
                        rows = rows + "<td>"+value.created_at+"</td>";
                        rows = rows + "<td width='180'>";
                        rows = rows + "<button type='button' class='btn btn-warning' onclick='editData("+value.id+")'>Edit</button>";
                        rows = rows + "<button type='button' class='btn btn-danger' onclick='deleteData("+value.id+")'>Delete</button>";
                        rows = rows + "</td></tr>";
                    })
                    $('tbody').html(rows);
                }
            })
        }

        viewData();

        function saveData(){
            var loanAmount = $('#loanAmount').val();
            var loanTerm = $('#loanTerm').val();
            var interestRate = $('#interestRate').val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {loanAmount:loanAmount, loanTerm:loanTerm, interestRate:interestRate},
                url: '/cruds',
                success: function(response){
                    viewData();
                    clearData();
                    $('#save').show();
                }
            })
        }

        function clearData(){
            $('#id').val('');
            $('#loanAmount').val('');
            $('#loanTerm').val('');
            $('#interestRate').val('');
            $('#created_at').val('');
        }

        function editData(id, loanAmount, loanTerm, interestRate, created_at){
            $('#save').hide('');
            $('#update').show('');
            $('.myid').show('');
            $.ajax({
                type: 'GET',
                dataType: 'json',
                data: {loanAmount:loanAmount, loanTerm:loanTerm, interestRate:interestRate},
                url: '/cruds/'+id+"/edit",
                success: function(response){
                    $('#id').val(response.id);
                    $('#loanAmount').val(response.loanAmount);
                    $('#loanTerm').val(response.loanTerm);
                    $('#interestRate').val(response.interestRate);
                    $('#created_at').val(response.created_at);
                }
            })
        }

        function updateData(){
            var id = $('#id').val();
            var loanAmount = $('#loanAmount').val();
            var loanTerm = $('#loanTerm').val();
            var interestRate = $('#interestRate').val();
            var created_at = $('#created_at').val();
            $.ajax({
                type: 'PUT',
                dataType: 'json',
                data: {loanAmount:loanAmount, loanTerm:loanTerm, interestRate:interestRate},
                url: '/cruds/'+id,
                success: function(response){
                    viewData();
                    clearData();
                    $('#save').show();
                    $('#update').show('');
                    $('.myid').show('');
                }
            })
        }

        function deleteData(id){
            $.ajax({
                type: 'DELETE',
                dataType: 'json',
                url: '/cruds/'+id,
                success: function(response){
                    viewData();
                }
            })
        }
    </script>
</body>
</html>
