@extends('layouts.admin')

@section('title') {{__('Suppliers') }} @endsection

@section('content')
<!-- Page Headline -->
<div class="page-headline">
    <h1>{{__('Suppliers')}}</h1>
</div>
<!-- // Page Headline -->
<div class="row responsive-table">
    <div class="col-12 col-m-12">
        <table  class="table striped bordered" id="suppliers_datatable">
            <thead>
                <tr class="primary-bg">
                    <th>{{__('Supplier Name')}}</th>
                    <th>{{__('Action')}}</th>
                </tr>
        </thead>
        </table>
    </div>   
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{MAINASSETS}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $("#suppliers_datatable").DataTable({
            fixedHeader: true,
            orderCellsTop: false,
            "scrollX": true,
            "lengthMenu": [[10, 25, 50, 100, 200], [10, 25, 50, 100, 200]],
            "proccessing": true,
            "serverSide": true,
            "order": [[ 0, "asc" ]],
            "ajax": {
                url: "{{ route('backend.supplier.datatable') }}",
                type: "POST",
                dataType: "JSON",
                data:function(d) {
                    d._token ="{{ csrf_token() }}";
                }
            },
            "columns": [
                {"data": "name", "searchable": true, "orderable": true},
                {"data": "action", "searchable": false, "orderable": false}

            ],
           
        });
    })

</script>
@endsection