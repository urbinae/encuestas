@extends('layouts.welcome')

@section('content')
	<div id="ipadress" value="<?php echo $_SERVER['REMOTE_ADDR'] ?>"></div>
  <encuestados-component>
  </encuestados-component>
@endsection

