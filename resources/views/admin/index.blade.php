@extends('adminlte::page')

@section('plugins.Datatables', true)
{{-- Setup data for datatables --}}
@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @can('can_parse_notices')
        <div class="p-4">
            <x-adminlte-button label="Обновить новости" theme="success" icon="fas fa-thumbs-up"/>
        </div>
    @endcan


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Заголовок</th>
                                    <th>Ссылка на ресурс</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($notices as $notice)
                                <tr>
                                    <td>{{$notice->id}}</td>
                                    <td>{{$notice->title}} </td>
                                    <td><a target="_blank" href="{{$notice->link}}">{{$notice->link}}</a></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>


@stop













