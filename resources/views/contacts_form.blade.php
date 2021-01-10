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
            <input placeholder="First Name" type="text" class="form-control" data-bind="value: contact.first_name, valueUpdate: 'afterkeydown'"/>
            <span data-bind='visible: contact.first_name.hasError, text: "First Name is required"'> </span>
            <div>
                <a href="#" data-bind="click: $root.removeContact">Remove contact</a>
            </div>
          </div>
          <div class="col-md-2">
            <input placeholder="Last Name" type="text" class="form-control" data-bind="value: contact.last_name, valueUpdate: 'afterkeydown'"/>
            <span data-bind='visible: contact.last_name.hasError, text: "Last Name is required"'> </span>
          </div>
          <div class="col-md-5">
            <div class="input-group" data-bind="foreach: {data: contact.phones, includeDestroyed: false}">
                <div class="form-group col-md-6">
                    <input placeholder="Phone Type" type="text" class="form-control" data-bind="value: type" />
                    <div>
                        <a href="#" data-bind="click: $parent.removePhone">Remove phone</a>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <input placeholder="Phone Number" type="text" class="form-control" data-bind="value: phone" />
                </div>
            </div>
          </div>
          <div class="col-md-3">
            <div>
                <a href="#" data-bind="click: $root.addPhone">Add phone</a>
            </div>
          </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-block btn-primary" data-bind="click: $root.updateContacts">Update</button>
        </div>
    </form>
@endsection