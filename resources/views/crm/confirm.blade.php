@extends ('layouts.master')

@section ('content')
<main role="main" class="col-md-6 col-md-offset-3 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Create an Account</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" method="POST" action"/accounts">

                      {{ csrf_field() }}

                    <fieldset>
                        <div class="form-group">
                            <select class="form-control" name="service_id">
                              
                              @foreach (\App\Service::all() as $service)
                                <option value="{{ $service->id }}">{{ $service->service_type }}</option>
                              @endforeach
                            
                            </select>
			    		</div>
                        <div class="form-group">
    		    		    <input class="form-control" placeholder="First Name" name="first_name" type="text">
			    		</div>
                        <div class="form-group">
    		    		    <input class="form-control" placeholder="Last Name" name="last_name" type="text">
			    		</div>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="E-mail" name="email" type="email">
			    		</div>
			    		
			    		<input class="btn btn-lg btn-primary btn-block" type="submit" value="Confirm account">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
</div>
</main>
@endsection

