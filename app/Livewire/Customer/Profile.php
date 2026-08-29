<?php

namespace App\Livewire\Customer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Profile extends Component
{
    public $name = '';
    public $email = '';
    public $phone_number = '';
    public $address = '';

    public $current_password = '';
    public $password = '';
    public $password_confirmation = '';


    public function mount()
    {
        $customer = Auth::guard('customer')->user();

        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->phone_number = $customer->phone_number;
        $this->address = $customer->address;
    }


    public function updateProfile()
    {
        $customer = Auth::guard('customer')->user();

        $validated = $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',

                Rule::unique('customers', 'email')
                    ->ignore($customer->id),
            ],

            'phone_number' => [
                'required',
                'string',
                'max:20',
            ],

            'address' => [
                'required',
                'string',
                'max:255',
            ],
        ]);


        $customer->update($validated);


        session()->flash(
            'profile-success',
            'Profile updated successfully.'
        );
    }


public function updatePassword()
{
    $customer = Auth::guard('customer')->user();

    $this->validate([
        'current_password' => [
            'required',
        ],

        'password' => [
            'required',
            'confirmed',
            'min:8',
        ],
    ]);


    if (
        !Hash::check(
            $this->current_password,
            $customer->password
        )
    ) {

        $this->addError(
            'current_password',
            'The current password is incorrect.'
        );

        return;
    }


    $customer->update([
        'password' => Hash::make(
            $this->password
        ),
    ]);


    /*
     * Password changed successfully.
     * Log the customer out immediately.
     */
    Auth::guard('customer')->logout();


    /*
     * Destroy the current session.
     */
    request()->session()->invalidate();


    /*
     * Generate a fresh CSRF token.
     */
    request()->session()->regenerateToken();


    /*
     * Send them back to login.
     */
    return redirect()
        ->route('customer.login')
        ->with(
            'success',
            'Password changed successfully. Please log in again.'
        );
}


    public function render()
    {
        return view(
            'livewire.customer.profile'
        )
            ->layout(
                'customer.layouts.app'
            );
    }
}