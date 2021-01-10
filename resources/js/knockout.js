const ko = require('knockout');

ko.extenders.required = function(target, overrideMessage) {
    //add some sub-observables to our observable
    target.hasError = ko.observable();
    target.validationMessage = ko.observable();
 
    //define a function to do validation
    function validate(newValue) {
       target.hasError(newValue ? false : true);
       target.validationMessage(newValue ? "" : overrideMessage || "This field is required");
    }
 
    //initial validation
    validate(target());
 
    //validate whenever the value changes
    target.subscribe(validate);
 
    //return the original observable
    return target;
};

function AddContact(data) {
    var self = this;
    self.id = data.id;
    self.first_name = ko.observable(data.first_name).extend({ required: "Please enter a first name" });
    self.last_name =  ko.observable(data.last_name).extend({ required: "Please enter a first name" });
    self.phones = ko.observableArray([]);
    for(var phone in data.phones) {
        self.phones.push({type: data.phones[phone].type, phone: data.phones[phone].phone});
    }

    //parent remove
    self.removePhone = function(phone) { 
        self.phones.destroy(phone);
    }
}

function ViewModel() {
    var self = this;
    self.contacts = ko.observableArray([]);

    $.get("/get-contacts", function(response) {
        var contacts = $.map(response, function(contact) { return new AddContact(contact) });
        self.contacts(contacts);
    });
    //operations
    self.addContact = function() {
        self.contacts.push(new AddContact({first_name: "", last_name: "", phones: [""]}));
    }
    self.removeContact = function(contact) { 
        if(contact.id) {
            $.get("/remove/" + contact.id, function(response) {
                if(response) {
                    alert('Contact successfully removed.');
                }
            });
        }
        self.contacts.remove(contact); 
    }
    self.addPhone = function(contact) {
        contact.phones.push({type: "", phone: ""});
    }
    self.updateContacts = function() {
        $.ajax("/update-contacts", {
            data: ko.toJSON(self.contacts),
            type: "post", contentType: "application/json"
        });
    }
}

ko.applyBindings(new ViewModel());