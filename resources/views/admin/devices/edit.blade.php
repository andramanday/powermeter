@extends('layouts.admin-master')

@section('title')
Edit Device ({{ $device->dev }})
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Edit Device</h1>
  </div>
  <div class="section-body">
      <editdevice-component device='{!! $device->toJson() !!}'></editdevice-component>
  </div>
</section>
@endsection
