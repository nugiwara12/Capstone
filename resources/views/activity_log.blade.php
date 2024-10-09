@extends('layouts.app3')
  
@section('title', 'Activity Logs')
  
@section('contents')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
   

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                </div>
                
        <section class="section">
            <div class="card">
                <div class="card-header">
                    Log Datatable
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Description</th>
                                <th>Date Time</th>
                            </tr>    
                        </thead>
                        <tbody>
                            @foreach ($activityLog as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->date_time }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <footer>
                    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
                    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
                    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
                    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
                    <script>
                        new DataTable('#table1', {
                            lengthMenu: [
                                [10, 25, 50, -1],
                                [10, 25, 50, 'All']
                            ]
                        });
                    </script>
                
                    </footer>
                </div>
            </div>
        </section>
    </div>

@endsection
