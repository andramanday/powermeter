@extends('layouts.admin-master')

@section('title')
Edit Company ({{ $company->com_name }})
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Edit Company</h1>
  </div>
  <div class="section-body">
      <editcompany-component company='{!! $company->toJson() !!}'></editcompany-component>
  </div>
</section>
@endsection
