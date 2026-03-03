<x-guest-layout title="Astramc | Login">

    <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
        <div class="max-w-md w-full">

            <div class="p-6 sm:p-8 rounded-2xl bg-white border border-gray-200 shadow-sm">
                <x-logo href="{{ route('login.create') }}" />
                    <div class="text-center space-y-2">
                        <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                            Welcome back
                        </h1>
                        <p class="text-sm text-slate-500">
                            Please enter your details to sign in to your account.
                        </p>
                    </div>

            <form action="{{ route('login.store') }}" method="POST" class="mt-12 space-y-6">
            @csrf

              <x-input-with-icon
                    label="Username"
                    name="userName"
                    type="text"
                    placeholder="Enter your username"
                    class="bg-gray-50"
                >
                    <x-slot name="icon">
                        <x-userIcon />
                    </x-slot>
                </x-input-with-icon>

                <x-input-with-icon
                    label="Password"
                    name="password"
                    type="password"
                    placeholder="Enter your password"
                    class="bg-gray-50"
                >
                    <x-slot name="icon">
                        <x-eyeIcon />
                    </x-slot>
                </x-input-with-icon>

                    <div class="!mt-12">
                        <button type="submit" class="w-full py-2 px-4 text-[15px] font-medium tracking-wide rounded-md text-white bg-orange-500 hover:bg-blue-700 focus:outline-none cursor-pointer">
                        Sign in
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</x-guest-layout>
