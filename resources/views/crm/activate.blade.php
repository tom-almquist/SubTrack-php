@extends ('layouts.master')

@section ('content')
<main role="main" class="col-md-6 col-md-offset-3 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Activate an Account</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" method="POST" action"/accounts/activate">

                      {{ csrf_field() }}

                    <fieldset>
                        <div class="form-group">
                            <select class="form-control" name="account_id">
                              
                              @foreach (\App\Account::where('state', '=', 'set-up')->get() as $account)
                                <option name="account_id" value="{{ $account->id }}">{{ $account->first_name . ' ' . $account->last_name }}</option>
                              @endforeach

                            </select>
                        </div>
			    		<input class="btn btn-lg btn-primary btn-block" type="submit" value="Confirm account"></input> 
			    	</fieldset>
			      	</form>
			    </div>
			</div>
</div>
</main>
@endsection

