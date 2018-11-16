@extends('layouts.template')
@section('content')
@php($i = 0)
@php($d = $paymentDetails)
<form method="POST" action="https://ssl.dotpay.pl/test_payment/">
		{{ csrf_field() }}
		<input type="hidden" name="api_version" id="api_version" value="{{ $d['api_version'] }}">

		<input type="hidden" name="id" id="id" value="{{ $d['id'] }}">
		
		<input type="hidden" name="currency" id="currency" value="{{ $d['currency'] }}">
		
		<input type="hidden" name="chk" id="chk" value="{{ $ChkValue }}">

		<input type="hidden" name="pin" id="pin" value="{{ $d['pin'] }}">

		<input type="hidden" name="url" id="url" value="{{ $d['url'] }}">

		<input type="hidden" name="type" id="type" value="{{ $d['type'] }}">

		<input type="hidden" name="buttontext" id="buttontext" value="{{ $d['buttontext'] }}">

		<input type="hidden" name="email" id="email" value="{{ $d['email'] }}">

		<input type="hidden" name="p_email" id="p_email" value="{{ $d['p_email'] }}">

		Products:
		<textarea rows="3" class="form-control" name="description" id="description" required readonly>{{ $d['description'] }}</textarea>
		Price({{ $d['currency'] }}):
		<input class="form-control" type="text" name="amount" id="amount" required  value="{{ $d['amount'] }}" readonly>
		<button class="form-control" type="submit">Submit and go to payment</button>
</form>
@endsection