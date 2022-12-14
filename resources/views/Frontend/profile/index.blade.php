@extends('Frontend.master')

@section('title','Profile')
@section('content')

<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Browser Sessions </h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        @foreach ($sessions as $session)

        <span class="ml-3">
            @if ($session->GetDevice($session->user_agent) == 'Phone')

            <div class="text-sm text-gray-900 dark:text-gray-300">
                <i class="fas fa-mobile"></i>

                {{ $session->GetDevice($session->user_agent) }} - {{ $session->GetBrowser($session->user_agent) }}
            </div>
            @else

            <div class="text-sm text-gray-900 dark:text-gray-300">
                <i class="fas fa-desktop"></i>

                {{ $session->GetDevice($session->user_agent) }} - {{ $session->GetBrowser($session->user_agent) }}
            </div>
            @endif
            <div>
                <div class="text-xs text-gray-500">
                    {{ $session->ip_address }},
                    <span class="font-semibold text-grey ">Last active {{
                        $session->last_activity->diffForHumans() }} </span>

                </div>
            </div>
        </span>
        @endforeach
    </div>
</div>

@endsection