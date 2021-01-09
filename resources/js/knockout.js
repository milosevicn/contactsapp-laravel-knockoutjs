const ko = require('knockout');

function AddContact(first_name, last_name, phones) {
    var self = this;
    self.first_name = ko.observable(first_name);
    self.last_name =  ko.observable(last_name);
    self.phones = ko.observableArray([]);
    for(var phone in phones) {
        self.phones.push({type: phones[phone].type, number: phones[phone].number});
    }
    
    //parent remove
    self.removePhone = function(phone) { 
        self.phones.remove(phone);
    }
}

function ViewModel() {
    var self = this;

    //server-side data
    self.contacts = ko.observableArray([
        new AddContact("Nikola", "Milosevic", [{type: "Mobile", number: "+381640000000"}, {type: "Home", number: "+381641111111"}]),
        new AddContact("Pera", "Peric", [{type: "Mobile", number: "+381642222222"}, {type: "Home", number: "+381643333333"}])
    ]);
    //operations
    self.addContact = function() {
        self.contacts.push(new AddContact("","",[""]));
    }
    self.removeContact = function(contact) { 
        self.contacts.remove(contact); 
    }
    self.addPhone = function(contact) {
        contact.phones.push({type: "", number: ""});
    }
}

ko.applyBindings(new ViewModel());