<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    public function getContacts() {
        $users = User::with('phones')->get();
        return $users;
    }

    public function updateContacts(Request $request) {
        $user_data = $request->all();
        foreach($user_data as $data) {
            $error = $this->validateInput($data, ['first_name' => 'required', 'last_name' => 'required']);
            if($error) return;
            $user = !empty($data['id']) ? User::find($data['id']) : new User();
            $user->fill($data);
            $user->save();

            $this->addContactPhones($data['phones'], $user->id);
        }
        return $this->getContacts();
    }

    public function removeContact(Request $request) {
        if(empty($request->user_id)) return;
        $contact = User::find($request->user_id);
        if(empty($contact)) {
            return false;
        }
        if(!empty($contact->phones) && !$contact->phones->isEmpty()) {
            $contact->phones()->delete();
        }
        $contact->delete();
        return true;
    }

    public function addContactPhones($phones, $user_id) {
        if(empty($phones)) return;
        foreach($phones as $phone) {
            $error = $this->validateInput($phone, ['type' => 'required', 'phone' => 'required']);
            if($error) return;
            if(!empty($phone['_destroy'])) {
                Phone::where('user_id', $user_id)->where('type', $phone['type'])->where('phone', $phone['phone'])->delete();   
                continue;             
            }
            $phone['phone'] = $this->formatPhone($phone['phone']);
            Phone::updateOrCreate(['user_id' => $user_id, 'type' => $phone['type']], ['phone' => $phone['phone']]);
        }
    }

    public function formatPhone($phone) {
        if(!$phone) return $phone;
        $phone = trim($phone);
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if(!$phone) return $phone;
        if($phone[0] != '+') $phone = "+$phone";
        return $phone;
    }

    public function validateInput($data, $rules) {        
        $validator = Validator::make($data, $rules);
        return $validator->fails();
    }
}
