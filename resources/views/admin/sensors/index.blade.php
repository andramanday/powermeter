@extends('layouts.admin-master')

@section('title')
Lists Sensor
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Manage Sensors</h1>
  </div>
  <div class="section-body">
      <sensors-component></sensors-component>
  </div>
</section>
@endsection
