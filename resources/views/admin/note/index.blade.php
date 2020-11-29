<link rel="stylesheet" href="/css/note/index.css">

@extends('layouts.public.index')

@extends('layouts.admin.module')


@section('content')
	<div id="app">
		<div class='time-line'>
			<div v-for='item in testList' class='time-line-div'>
				<p>{{item.time}}</p>
				<p ref='circular'></p>
				<p>{{item.text}}</p>
			</div>
			<div class='img-dotted' ref='dotted'></div>
		</div>
	</div>

@endsection

