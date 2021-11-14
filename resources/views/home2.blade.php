@extends('layouts.menu')

 <!-- Auditorias  -->
@if(Auth::user()->idtype  == 6 or Auth::user()->idtype  == 7)  
    @include('dash.home-audits')
@endif

 <!-- Calidad  -->
 @if(Auth::user()->idtype  >= 1 and Auth::user()->idtype  <= 4)  
    @include('dash.home-calidad')
@endif

 <!-- Llamadas  -->
 @if(Auth::user()->idtype  == 5)  
    @include('dash.home-call')
@endif

<!-- Clientes  -->

@if(Auth::user()->idtype  == 8)  
    @include('dash.home-clients')
@endif
