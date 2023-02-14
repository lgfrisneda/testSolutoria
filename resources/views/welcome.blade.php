<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    @routes

</head>

<body class="container">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-records-tab" data-bs-toggle="tab" data-bs-target="#nav-records" type="button" role="tab" aria-controls="nav-records" aria-selected="true">Records</button>
            <button class="nav-link" id="nav-charts-tab" data-bs-toggle="tab" data-bs-target="#nav-charts" type="button" role="tab" aria-controls="nav-charts" aria-selected="false">Chart</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-records" role="tabpanel" aria-labelledby="nav-records-tab">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="my-2">
                        <button id="btn-add" class="btn btn-primary" role="button" data-bs-toggle="modal" data-bs-target="#financialIndicatorModal">Create record</button>
                    </div>
                    <div class="card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="financialIndicators-list" name="financialIndicators-list">
                                @foreach($financialIndicators as $financialIndicator)
                                <tr id="financialIndicator-{{ $financialIndicator->id }}">
                                    <th id="id-{{ $financialIndicator->id }}" scope="row">{{ $financialIndicator->id }}</th>
                                    <td id="name-{{ $financialIndicator->id }}">{{ $financialIndicator->name }}</td>
                                    <td id="code-{{ $financialIndicator->id }}">{{ $financialIndicator->code }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button value="{{ $financialIndicator->id }}" class="btn btn-sm btn-primary open-model" data-bs-toggle="modal" data-bs-target="#financialIndicatorModal">
                                                Edit
                                            </button>
                                            <button value="{{ $financialIndicator->id }}" class="btn btn-sm btn-danger delete-financialIndicator">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="financialIndicatorModal" tabindex="-1" aria-labelledby="financialIndicatorModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="financialIndicatorModalLabel">Modal data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="modalFormData" name="modalFormData" class="form-horizontal">
                                        <input type="hidden" class="form-control" id="id" name="id" value="0">
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">name:</label>
                                            <input type="text" class="form-control" id="name" name="name" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="code" class="col-form-label">code:</label>
                                            <input type="text" class="form-control" id="code" name="code" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="unit" class="col-form-label">unit:</label>
                                            <input type="text" class="form-control" id="unit" name="unit" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="value" class="col-form-label">value:</label>
                                            <input type="text" class="form-control" id="value" name="value" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="date" class="col-form-label">date:</label>
                                            <input type="date" class="form-control" id="date" name="date" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="origin" class="col-form-label">origin:</label>
                                            <input type="text" class="form-control" id="origin" name="origin" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="time" class="col-form-label">time:</label>
                                            <input type="time" class="form-control" id="time" name="time" value="">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" id="btn-save" value="store" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-charts" role="tabpanel" aria-labelledby="nav-charts-tab">
            <div class="card text-center mt-4">
                <div class="card-header">
                    Filter
                </div>
                <div class="card-body">
                    <form class="row row justify-content-center">
                        <div class="col-auto">
                            <label for="from" class="visually-hidden">From</label>
                            <input type="date" class="form-control" id="from" name="from">
                        </div>
                        <div class="col-auto">
                            <label for="to" class="visually-hidden">To</label>
                            <input type="date" class="form-control" id="to" name="to">
                        </div>
                        <div class="col-auto">
                            <button id="filter-button" class="btn btn-primary mb-3">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <canvas id="myChart" height="100px"></canvas>
        </div>
    </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>