@include('components.shared.head')

<div class="wrapper">
@include('components.admin.navbar')

    @if(Auth::check() && Auth::user()->user_type === 'superadmin')
        @include('components.admin.sidebar')
    @elseif(Auth::check() && Auth::user()->user_type === 'admin')
        @include('components.admin.sidebar')
    @elseif(Auth::check() && Auth::user()->user_type === 'student')
        @include('components.students.sidebar')
    @elseif(Auth::check() && Auth::user()->user_type === 'teacher')
        @include('components.teachers.sidebar')
    @endif

</div>
@yield('content')

@include('components.shared.script')
