<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Carbon\Carbon;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $username = '';
    public string $phone = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:125'],
            'username' => ['required', 'string', 'lowercase', 'min:3', 'max:25', 'unique:' . User::class],
            'phone' => ['required', 'numeric', 'min:10', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['email_verified_at'] = Carbon::now();

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 items-center">
                    <form wire:submit="register">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text"
                                name="name" required autofocus autocomplete="name" placeholder="Joko Widodo" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Username -->
                        <div class="mt-4">
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text"
                                name="username" required autocomplete="username" placeholder="jokowi" />
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email"
                                name="email" required autocomplete="email" placeholder="jokowi@indonesia.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!--Phone -->
                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('Handphone')" />
                            <x-text-input wire:model="phone" id="phone" class="block mt-1 w-full" type="text"
                                name="phone" required autocomplete="phone" placeholder="081133557799" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password"
                                name="password" required autocomplete="new-password" placeholder="presiden123" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input wire:model="password_confirmation" id="password_confirmation"
                                class="block mt-1 w-full" type="password" name="password_confirmation" required
                                autocomplete="new-password" placeholder="presiden123" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('login') }}" wire:navigate>
                                {{ __('Sudah terdaftar ?') }}
                            </a>

                            <x-primary-button class="ms-4">
                                {{ __('Daftarkan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
