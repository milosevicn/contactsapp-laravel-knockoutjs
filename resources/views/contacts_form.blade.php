@extends('layouts.master')

@section('content')
    <h2>Contacts</h2>
    <button class="btn btn-primary" data-bind="click: addContact">Add new contact</button>

    <form>
        <div class="form-row">
          <div class="col-md-2">
            <label>First name</label>
          </div>
          <div class="col-md-2">
            <label>Last name</label>
          </div>
          <div class="col-md-2">
            <label>Phone numbers</label>
          </div>
        </div>
        <div class="form-row" data-bind="foreach: {data: contacts, as: 'contact'}">
          <div class="col-md-2">
            <input type="text" class="form-control" data-bind="value: contact.first_name" />
            <div>
                <a href="#" data-bind="click: $root.removeContact">Remove contact</a>
            </div>
          </div>
          <div class="col-md-2">
            <input type="text" class="form-control" data-bind="value: contact.last_name" />
          </div>
          <div class="col-md-5">
            <div class="input-group" data-bind="foreach: {data: contact.phones}">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" data-bind="value: type" />
                    <div>
                        <a href="#" data-bind="click: $parent.removePhone">Remove phone</a>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" data-bind="value: number" />
                </div>
            </div>
          </div>
          <div class="col-md-3">
            <div>
                <a href="#" data-bind="click: $root.addPhone">Add phone</a>
            </div>
          </div>
        </div>
    </form>
@endsection