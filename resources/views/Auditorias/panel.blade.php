@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form method="POST" id="formedit" name="formedit" action="">  
                {{ csrf_field() }} 
    
                    <div class="card-header"> 
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center icon-warning">                                   
                                                    <i class="nc-icon nc-satisfied text-success"></i>
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="numbers">
                                                    <p class="card-category">Cumple</p>
                                                    <h4 class="card-title">{{$cumple}}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer ">
                                        <hr>
                                        <div class="stats">
                                            <i class="fa fa-check" aria-hidden="true"></i> Auditorias satisfactorias
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
@endauth
