@extends ('layouts.master')

@section ('content')
<main role="main" class="col-md-6 col-md-offset-3 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Create a Service</h3>
      </div>
      <div class="panel-body">
        <form method="POST" action"/services">

          {{ csrf_field() }}

          <fieldset>
            <div class="form-group">
                <input class="form-control" placeholder="Service Name" name="service_type" type="text">
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Description" name="description" type="text">
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Cost" name="cost" type="number" step="0.01" min="0">
            </div>
            
            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Confirm account">
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection


