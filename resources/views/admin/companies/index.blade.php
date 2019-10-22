@extends('layouts.admin-master')

@section('title')
Manage Users
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Manage Companies</h1>
  </div>
  <div class="section-body">
      <companies-component></companies-component>
  </div>
</section>
@endsection
