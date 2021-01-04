@extends('layouts.master')

@section('content')
    <form class="pure-form">
        <fieldset>
            <legend>Contacts</legend>
            <input type="first" placeholder="First Name" />
            <input type="last" placeholder="Last Name" />
            <input type="type" placeholder="Phone type" />
            <input type="number" placeholder="Phone number" />
        </fieldset>
    </form>
@endsection