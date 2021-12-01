@extends("layouts.public")


@section("content")
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <h1 class="lead">Apply for Join Us.</h1>
        </x-slot>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name') " />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="row">
                <div class="mt-4 col-6">
                    <x-label for="mother_name" :value="__('Mother Name')" />

                    <x-input id="mother_name" class="block mt-1 w-full" type="text" name="mother_name" :value="old('mother_name')" required autofocus />
                </div>

                <div class="mt-4 col-6">
                    <x-label for="father_name" :value="__('Father Name')" />

                    <x-input id="father_name" class="block mt-1 w-full" type="text" name="father_name" :value="old('father_name')" required autofocus />
                </div>

            </div>
            <div class="mt-4">
                <x-label for="contact" :value="__('Contact')" />

                <x-input id="contact" class="block mt-1 w-full" type="text" name="contact" :value="old('contact')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="education" :value="__('Education')" />

                <x-input id="education" class="block mt-1 w-full" type="text" name="education" :value="old('education')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="dob" :value="__('Date of Birth')" />

                <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="gender" :value="__('Gender')" />
                <select name="gender" class="block shadow-md form-select mt-1 w-full" id="gender">
                    <option value="" selected disabled hidden></option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>

            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="row">
                <div class="mt-4 col">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4 col">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
                </div>

            </div>
            <div class="flex items-center justify-end mt-4">
                <a class=" text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
@endsection