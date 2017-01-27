@extends('layouts.main')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="jumbotron">
				<h1>Seja um Alpha Tester!</h1>
				<p>A nova rede social nerd está chegando, mas precisa de voluntários. Inscreva-se para ser um dos 250 sortudos que poderão testar o site a partir de 15/02/2017!<br/></p>
				<small>* Convites serão distribuidos por ordem de chegada, é preciso estar de acordo com nossos <a href="{{ url('/alpha-agreement') }}" target="_blank">termos para uso do software versão alpha</a>.</small>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Registrar usuário Alpha
				</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/') }}">
						{{ csrf_field() }}
						<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
							<label for="username" class="col-md-4 control-label">Nome de Usuário</label>

							<div class="col-md-6">
	                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

	                            @if ($errors->has('username'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('username') }}</strong>
	                                </span>
	                            @endif
	                        </div>
						</div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">E-Mail</label>

							<div class="col-md-6">
	                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

	                            @if ($errors->has('email'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('email') }}</strong>
	                                </span>
	                            @endif
	                        </div>
						</div>


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Cadastrar
								</button>
							</div>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>

@endsection