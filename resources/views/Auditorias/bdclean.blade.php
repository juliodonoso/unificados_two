@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form method="POST" id="formedit" name="formedit" action="">  
                {{ csrf_field() }} 
                <h2>pr</h2>
            </form>
        </div>
    </div>
</div>
@endsection
@endauth
