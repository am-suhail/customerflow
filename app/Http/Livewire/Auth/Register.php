<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use AbanoubNassem\FilamentPhoneField\Forms\Components\PhoneInput;

class Register extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public
        $name,
        $phone,
        $email,
        $password,
        $password_confirmation;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->required(),

            PhoneInput::make('phone')
                ->tel()
                ->initialCountry('AE')
                ->required()
                ->unique(column: 'mobile'),

            TextInput::make('email')
                ->email()
                ->required()
                ->unique(),

            TextInput::make('password')
                ->password()
                ->required()
                ->confirmed()
                ->disableAutocomplete(),

            TextInput::make('password_confirmation')
                ->label('Password Confirmation')
                ->password()
                ->dehydrated(false)
        ];
    }

    protected function getFormModel(): string
    {
        return User::class;
    }

    public function register()
    {
        $validated = $this->form->getState();

        $user = User::create([
            'email' => $validated['email'],
            'mobile' => $validated['phone'],
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
