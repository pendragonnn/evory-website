<div 
    x-show="openRegister"
    x-transition.opacity
    x-cloak
    class="fixed inset-0 bg-[#5a5a5a]/70 backdrop-blur-sm z-50"
>
    <!-- RESPONSIVE SHEET -->
    <div 
        x-transition
        class="
            absolute bottom-0 right-0 bg-[#E6E6E6] shadow-2xl 
            rounded-tl-[40px]
            w-[95vw] h-[100vh] p-6 
            sm:w-[90vw] sm:h-[92vh] sm:p-10 
            md:w-[85vw] 
            lg:w-[75vw] lg:h-[90vh] lg:p-12
            overflow-y-auto
        "
    >

        {{-- Close --}}
        <button 
            @click="openRegister = false" 
            class="absolute right-6 top-6 text-3xl text-gray-700 hover:text-black">
            &times;
        </button>

        {{-- Title --}}
        <h2 class="text-center font-semibold mb-10 
                   text-3xl sm:text-4xl">
            Sign Up
        </h2>

        <form method="POST" action="{{ route('register') }}" 
              class="space-y-6 max-w-xl mx-auto">
            @csrf

            {{-- Fields --}}
            <div>
                <label class="block mb-1 text-gray-700 text-sm sm:text-base">Full Name</label>
                <input type="text" name="name"
                    class="w-full border border-gray-300 rounded-md 
                           py-2 px-3 sm:py-3 sm:px-4 
                           text-sm sm:text-base" required>
            </div>

            <div>
                <label class="block mb-1 text-gray-700 text-sm sm:text-base">Email Address</label>
                <input type="email" name="email"
                    class="w-full border border-gray-300 rounded-md 
                           py-2 px-3 sm:py-3 sm:px-4 
                           text-sm sm:text-base" required>
            </div>

            <div>
                <label class="block mb-1 text-gray-700 text-sm sm:text-base">Phone Number (Optional)</label>
                <input type="text" name="phone"
                    class="w-full border border-gray-300 rounded-md 
                           py-2 px-3 sm:py-3 sm:px-4 
                           text-sm sm:text-base">
            </div>

            <div>
                <label class="block mb-1 text-gray-700 text-sm sm:text-base">Password</label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded-md 
                           py-2 px-3 sm:py-3 sm:px-4 
                           text-sm sm:text-base" required>
            </div>

            <div>
                <label class="block mb-1 text-gray-700 text-sm sm:text-base">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full border border-gray-300 rounded-md 
                           py-2 px-3 sm:py-3 sm:px-4 
                           text-sm sm:text-base" required>
            </div>

            {{-- Terms --}}
            <label class="flex items-center gap-2 text-xs sm:text-sm">
                <input type="checkbox" required>
                <span>
                    I agree to the 
                    <a href="#" class="text-blue-600 underline">Terms and Conditions</a>
                </span>
            </label>

            {{-- Button --}}
            <button class="w-full py-2 sm:py-3 bg-black text-white rounded-full 
                           text-base sm:text-lg mt-4">
                Sign Up
            </button>
        </form>

        {{-- Divider --}}
        <div class="my-10 sm:my-12 flex items-center gap-4 max-w-xl mx-auto">
            <div class="flex-1 border-t border-gray-400"></div>
            <span class="text-gray-500 text-sm sm:text-base">or</span>
            <div class="flex-1 border-t border-gray-400"></div>
        </div>

        {{-- Login redirect --}}
        <p class="text-center text-sm sm:text-base">
            Already have an account?
            <button 
                @click="openRegister = false; openLogin = true" 
                class="text-blue-600 underline">
                Log In
            </button>
        </p>

    </div>
</div>
