@extends('layouts.admin-master')

@section('title')
Manage Devices
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Manage Devices</h1>
  </div>
  <div class="section-body">
      <devices-component></devices-component>
  </div>
</section>
@endsection
