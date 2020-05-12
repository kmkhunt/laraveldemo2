@extends('layouts.app')
@section("content")
<section id="content">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper">
    <!-- Search for small screen -->
    </div>
    <!--breadcrumbs end-->
    <!--start container-->
        <div class="container">
               <h2>Laravel Yajra DataTables</h2>
            <table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Name</th>
                     <th>Email</th>
                  </tr>
               </thead>
            </table>
         </div>
       <script>
         $(function() {
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('users/index') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' }
                     ]
            });
         });
         </script>
    <!--end container-->
</section>
<script type="text/javascript">
$(document).ready(function() {
    var CSRF_TOKEN = "{{ csrf_token() }}";
    /*to display amenity information*/
    var dt = $('#DataTable').dataTable({
        'oLanguage': {
            'sEmptyTable': 'Records not found',
        },
        'processing': true,
        'bInfo': true,
        "bAutoWidth": false,
        'serverSide': true,
        'ajax': {
            'url': '{{ URL::route("ViewUserJson") }}',
            'type': 'GET',
            'data': {_token: CSRF_TOKEN},
        },
        'searching': true,
        'bLengthChange': false,
        "sPaginationType": "full_numbers",
        'pageLength': 10,
        'orderCellstop': true,
        'stateSave': false,
        "bPaginate": true,
        'order': [[3, "desc"]],
        "rowId":function(data) {
            return "tr_"+data.user_id;
        },
        'aoColumns': [
            {'data': 'name', 'sWidth': '15%', },
            {'data': 'email', 'sWidth': '15%', },
            {'data': 'created_at', 'sWidth': '15%'},
            {'data': 'action', 'bSortable': false, 'sWidth': '15%', render: function ( data, type, row ) {
                return "<ul id='dropdown__"+row.user_id+"' class='dropdown-content'>"+
                    "<li><a href='javascript:;' title='Edit Detail'>Edit</a></li>"+
                    "<li><a href='javascript:;' title='View Detail'>View</a></li>"+
                  "</ul>";
            } },
        ],
        "fnDrawCallback": function(oSettings) {

        }
    });


});
</script>
@endsection