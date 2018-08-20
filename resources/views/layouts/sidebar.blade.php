@extends('layouts.master')
@section('content')
    
<nav class="navbar navbar-light bg-biscay">
    <span class="navbar-brand mb-0 h1 text-light">KPUP</span>
</nav>

<div class="wrapper">
    <nav id="sidebar" class="bg-coralite">
        <div class="sidebar-header mb-5"></div>
        <ul class="list-unstyled components text-light ml-2 mr-2">
            <li class="mt-2">
                <a href="/admin/dashboard/" class="btn btn-coralite btn-block text-left s-200 @yield('dashboard')">
                    <i class="fas fa-tachometer-alt"></i>Dashboard
                </a>
            </li>
            <li class="mt-2">
                <a href="/admin/dashboard/kandidat" class="btn btn-coralite btn-block text-left s-200 @yield('kandidat') ">
                    <i class="fas fa-sticky-note"></i>Kandidat
                </a>
            </li>
            <li class="mt-2">
                <a href="/admin/dashboard/configtable" class="btn btn-coralite btn-block text-left s-200 @yield('config') ">
                    <i class="fas fa-table"></i>Pilih Table
                </a>
            </li>
            <li class="mt-2">
                <a href="/admin/dashboard/angkatan" class="btn btn-coralite btn-block text-left s-200 @yield('pemilih') ">
                    <i class="fas fa-users"></i>Pemilih
                </a>
            </li>
        </ul>
    </nav>
    
    <div id="content">
        <button type="button" id="sidebarCollapse" class="hamburger hamburger--spin is-active bg-coralite mb-3 mr-3">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
        
        @yield('sidebar')

    </div>
</div>
<script>
        
    </script>
@endsection
@section('js')
<script>
var hamburger = document.querySelector(".hamburger");
        hamburger.addEventListener("click", function () {
            hamburger.classList.toggle("is-active");
        });

</script>
@endsection
