@extends('layouts.admin-master')

@section('title')
Manage Super Admins
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Manage Super Admins</h1>
  </div>
  <div class="section-body">
      <superadmin-component></superadmin-component>
  </div>
</section>
@endsection
