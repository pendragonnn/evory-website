<x-app-layout>

  <div class="w-full">

    {{-- HERO SECTION --}}
    <section class="w-full bg-gray-100 py-20 px-6 sm:px-12 lg:px-24 text-center">
      <h1 class="text-3xl sm:text-4xl font-bold leading-snug">
        Simplify Booth Management <br class="hidden sm:block">
        for Your Next Event
      </h1>

      <p class="mt-4 text-gray-600 max-w-2xl mx-auto text-sm sm:text-base">
        Evory helps you manage booths, exhibitors, floor plans, and more, all in one place.
      </p>

      <button @click="openRegister = true"
        class="mt-8 px-6 py-3 bg-black text-white rounded-md text-base sm:text-lg hover:bg-gray-800 transition">
        Get Started
      </button>
    </section>


    {{-- DASHBOARD PREVIEW --}}
    <section class="py-16 px-6 sm:px-12 lg:px-24 text-center">
      <h2 class="text-xl sm:text-2xl font-semibold mb-8">
        A Glimpse of the Dashboard
      </h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-4xl mx-auto">
        <div class="h-48 bg-gray-300 rounded-lg"></div>
        <div class="h-48 bg-gray-300 rounded-lg"></div>
      </div>

      <button class="mt-8 px-6 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition">
        Explore Features
      </button>
    </section>


    {{-- FEATURES SECTION --}}
    <section class="bg-gray-100 py-16 px-6 sm:px-12 lg:px-24">

      {{-- ITEM 1 --}}
      <div class="flex flex-col md:flex-row items-start gap-8 py-10 border-b border-gray-300">
        <div class="w-full md:w-1/3 
                    h-[200px] sm:h-[220px] lg:h-[250px] 
                    bg-gray-300 rounded-lg">
        </div>

        <div class="w-full md:w-2/3">
          <h3 class="font-semibold 
                       text-xl sm:text-2xl 
                       mb-4">
            Plan Your Exhibition Layout with Confidence
          </h3>

          <p class="text-gray-700 
                      text-base sm:text-lg 
                      leading-relaxed">
            Design your exhibition space effortlessly with Evory’s interactive Exhibition Floor Planner.
            Drag, drop, or resize booths all with real-time visual feedback.
            No stress, no mess—just a crystal-clear layout that evolves with you.
          </p>

          <a href="#" class="text-blue-600 
                               text-base sm:text-lg 
                               underline mt-3 inline-block">
            Learn how it works
          </a>
        </div>
      </div>


      {{-- ITEM 2 --}}
      <div class="flex flex-col-reverse md:flex-row items-start gap-8 py-10 border-b border-gray-300">

        <div class="w-full md:w-2/3">
          <h3 class="font-semibold 
                       text-xl sm:text-2xl 
                       mb-4">
            Bring Ideas to Life
          </h3>

          <p class="text-gray-700 
                      text-base sm:text-lg 
                      leading-relaxed">
            Give your exhibitors the edge with stunning, realistic 3D booth previews.
            Customize structures, colors, and visuals and explore layouts from every angle.
            Perfect for impressing clients and refining ideas before the big day.
          </p>

          <a href="#" class="text-blue-600 
                               text-base sm:text-lg 
                               underline mt-3 inline-block">
            See how it works
          </a>
        </div>

        <div class="w-full md:w-1/3 
                    h-[200px] sm:h-[220px] lg:h-[250px] 
                    bg-gray-300 rounded-lg">
        </div>
      </div>


      {{-- ITEM 3 --}}
      <div class="flex flex-col md:flex-row items-start gap-8 py-10">

        <div class="w-full md:w-1/3 
                    h-[200px] sm:h-[220px] lg:h-[250px] 
                    bg-gray-300 rounded-lg">
        </div>

        <div class="w-full md:w-2/3">
          <h3 class="font-semibold 
                       text-xl sm:text-2xl 
                       mb-4">
            Exhibitors, in Control
          </h3>

          <p class="text-gray-700 
                      text-base sm:text-lg 
                      leading-relaxed">
            Skip the back-and-forth. Exhibitors can easily update their own profiles using a secure auto-login link.
            No extra logins, no micromanaging.
          </p>

          <a href="#" class="text-blue-600 
                               text-base sm:text-lg 
                               underline mt-3 inline-block">
            Learn more about Auto-Login
          </a>
        </div>
      </div>

    </section>




    {{-- CTA SECTION --}}
    <section class="py-16 text-center px-6 sm:px-12 lg:px-24">
      <h2 class="text-xl sm:text-2xl mb-6">
        Ready to make booth management effortless?
      </h2>

      <button @click="openRegister = true"
        class="px-6 py-3 bg-black text-white rounded-md text-base sm:text-lg hover:bg-gray-800 transition">
        Start for Free
      </button>
    </section>


    {{-- FOOTER --}}
    <footer class="py-6 text-center bg-gray-200 text-gray-700 text-sm">
      Evory © 2025. All Rights Reserved.
    </footer>

  </div>


</x-app-layout>