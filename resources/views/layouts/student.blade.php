@include('components.shared.head')

<div class="wrapper">
@include('components.admin.navbar')
@include('components.students.sidebar')
</div>
@yield('content')

@include('components.shared.script')
