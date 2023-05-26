@extends('layouts.master')

@section('content')

    <div class="row dash-row">
        <div class="col-xl-4">
            <div class="stats stats-primary">
                <h3 class="stats-title"> {{ __('Clients') }} </h3>
                <div class="stats-content">
                    <div class="stats-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="stats-data">
                        <div class="stats-number">{{ \App\Models\Client::count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="stats stats-success ">
                <h3 class="stats-title"> {{ __('Projects') }} </h3>
                <div class="stats-content">
                    <div class="stats-icon">
                        <i class="fas fa-file"></i>
                    </div>
                    <div class="stats-data">
                    <div class="stats-number">{{ \App\Models\Project::count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="stats stats-danger">
                <h3 class="stats-title"> {{ __('Tasks') }} </h3>
                <div class="stats-content">
                    <div class="stats-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stats-data">
                    <div class="stats-number">{{ \App\Models\Task::count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
