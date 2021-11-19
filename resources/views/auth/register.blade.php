@extends('layouts.menu')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" id="divru">Registro de Usuarios:</div>
                 <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Tipo de usuario</label>                        
                            <div class="col-md-6">
                                <select name="opt01" class="form-control" id="sel01">
                                <option selected>Seleccione opcion ...</option>
                                        @if(Auth::user()->idtype  == 1)
                                            <option value="1">ADMINISTRADOR</option>
                                            <option value="2">SUPERVISOR CALIDAD</option>
                                            <option value="3">AGENTE CALIDAD</option>
                                            <option value="4">SUPERVISOR LLAMADAS</option>
                                            <option value="5">AGENTE LLAMADAS</option>
                                            <option value="7">SUPERVISOR DE AUDITORIA</option> 
                                            <option value="8">CLIENTE</option>   
                                        @endif
                                        <option value="6">AUDITOR</option>                                         
                                </select> 
                            </div> 
                        </div>                         
                        <div class="form-group row mb-12"  id="div2">
                            <div class="col-md-12 offset-md-12" id="div3">
                                <button type="submit" class="btn btn-warning" id="bt01">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection

<style>

#divru {
  color:  #f2f4f4 ;
}

#bt01 {
    width: 100%;
}


#div2    { 
  padding: 0 1rem;
  margin: 1rem;
}


#div3    {   
    width: 100%;
    margin-left: auto;
    margin-right: auto;
}

</style>