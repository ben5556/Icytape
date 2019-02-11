@extends('theme::app')

@section('content')

<div id="wrap" class="auth">

	<?php if (Session::has('notification')): ?>
	    <span class="notification"><?= Session::get('notification'); ?></span>
	<?php endif; ?>

	@include('theme::includes.form-reset-password')

</div>

@stop