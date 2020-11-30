<link rel="stylesheet" href="/css/note/index.css">

@extends('layouts.public.index')

@extends('layouts.admin.module')


@section('content')
	<div id="app">
	    <timeline></timeline>
	</div>

	<script src="{{mix('/js/app.js')}}"></script>
@endsection

