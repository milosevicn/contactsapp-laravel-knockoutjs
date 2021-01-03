@extends('layouts.master')

@section('content')
    <form class="pure-form">
        <fieldset>
            <legend>Contacts Form</legend>
            <input type="email" placeholder="Email" />
            <input type="password" placeholder="Password" />
            <label for="default-remember">
                <input type="checkbox" id="default-remember" /> Remember me</label>
            <button type="submit" class="pure-button pure-button-primary">Sign in</button>
        </fieldset>
    </form>
@endsection