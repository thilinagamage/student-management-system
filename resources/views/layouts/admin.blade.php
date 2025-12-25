@include('components.shared.head')

<div class="wrapper">
@include('components.admin.navbar')
@include('components.admin.sidebar')
</div>
@yield('content')

@include('components.shared.script')
