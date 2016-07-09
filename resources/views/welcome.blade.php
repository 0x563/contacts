@extends('layout')
@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">+ Lista de contactos +</div>
    <div class="panel-body">
        <div class="row">
            <form method="GET">
                <div class="col-md-2">Nombre:</div>
                <div class="col-md-2">
                    <input type="text" class="form-control" value="{{ Session('name') }}" name="name" autofocus>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-2">Rut:</div>
                <div class="col-md-2">
                    <input type="text" class="form-control" value="{{ Session('rut') }}" name="rut">
                </div>
                <div class="col-md-2">
                    <input type="submit" value="Buscar" class="btn btn-primary">
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Rut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->rut}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{  $contacts->appends([
                'name' => Session('name'),
                'rut'  => Session('rut')
            ])->render()
        }}
    </div>
</div>

@endsection
