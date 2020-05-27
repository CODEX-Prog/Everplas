@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/fullcalendar/fullcalendar.min.css')}}">
@endsection

@section('css_after')
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('js/plugins/fullcalendar/fullcalendar.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/calendar/calendar.min.js') }}"></script>
    <script src="{{ asset('js/pages/calendar/custom.js') }}"></script>

@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Calendar
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Calendar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Calendar -->
        <div class="block">
            <div class="block-content">
                <div class="row items-push">
                    <div class="col-md-8 col-lg-7 col-xl-9">
                        <!-- Calendar Container -->
                        <div class="js-calendar"></div>
                    </div>
                    <div class="col-md-4 col-lg-5 col-xl-3">

                        <!-- Add Event Form -->
                        <form class="js-form-add-event push">
                            <div class="input-group">
                                <label for="new-event"></label>
                                <input type="text" id="new-event" name="new-event" class="js-add-event form-control" placeholder="Add Event..">
                                <div class="input-group-append">
                                    <button class="" type="submit">
                                        <i class="fa fa-fw fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- END Add Event Form -->

                        <!-- Event List -->
                        <ul class="js-events list list-events">
                            <li style="background-color: #fac5a5;">Work</li>
                            <li style="background-color: #b5d0eb;">Relax</li>
                            <li style="background-color: #faeab9;">Gym</li>
                            <li style="background-color: #fac5a5;">Secret Project</li>
                            <li style="background-color: #c8e2b3;">Cinema</li>
                            <li style="background-color: #b6d1ec;">Biking</li>
                            <li style="background-color: #c8e2b3;">Trip</li>
                            <li style="background-color: #faeab9;">Swimming</li>
                        </ul>
                        <div class="text-center">
                            <em class="font-size-sm text-muted">
                                <i class="fa fa-arrows-alt"></i> Drag and drop events on the calendar
                            </em>
                        </div>
                        <!-- END Event List -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Calendar -->
    </div>
    <!-- END Page Content -->
@endsection
