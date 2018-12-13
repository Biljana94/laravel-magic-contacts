<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($this->route()->parameters['contact']->id);        

        //$contactId ovde smo smestili id kontakta
        //ako je metoda PUT
        //onda vrati rutu sa parametrom id od kontakta
        //ako nije put metoda, vrati vrednost 0
        //sve nam je smesteno u contactId 
        $contactId = $this->method() == 'PUT'
            ? $this->route()->parameters['contact']->id
            : null;

        //validacija
        return [
            
            'first_name' => 'required',
            'last_name' => 'required',
            //email mora da bude unique u contacts tabeli u email koloni(unique:contacts,email)
            'email' => 'required|email|unique:contacts,email' .
                ($contactId ? ",$contactId" : ''),
                //ako je $contactId true, onda mu dodaj id tog kontakta
                //ako je $contactId false, vrati mu prazan string
                // ($this->method() == 'PUT') ? ',' . request()-> 
            
        ];
    }
}
