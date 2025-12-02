@extends('layouts.app')

@section('content')
  <!-- 🧭 Hero Section -->
  <section class="bg-gray-900 text-white py-16 text-center">
    <h1 class="text-4xl font-bold mb-3">Get in Touch</h1>
    <p class="text-lg">We're here to answer your vehicle questions, shipping concerns, or partnership ideas.</p>
  </section>

  <!-- 📩 Contact Form & Info -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-2 gap-12">
    <!-- Contact Form -->
    <div>
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Send Us a Message</h2>
      <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
        @csrf
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
          <input type="text" name="name" id="name" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500">
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
          <input type="email" name="email" id="email" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500">
        </div>
        <div>
          <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number (optional)</label>
          <input type="text" name="phone" id="phone"
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500">
        </div>
        <div>
          <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
          <select name="subject" id="subject" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500">
            <option>General Inquiry</option>
            <option>Vehicle Sales</option>
            <option>Shipping & Delivery</option>
            <option>Partnerships</option>
          </select>
        </div>
        <div>
          <label for="message" class="block text-sm font-medium text-gray-700">Your Message</label>
          <textarea name="message" id="message" rows="5" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500"></textarea>
        </div>
        <button type="submit"
                class="bg-red-600 text-white font-semibold py-2 px-5 rounded-md hover:bg-red-700 transition">
          Submit Message
        </button>
      </form>
    </div>

    <!-- Info + Map -->
    <div class="space-y-8">
      <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Contact Details</h2>
        <ul class="space-y-2 text-gray-700">
          <li><strong>Email:</strong> support@carvado.com</li>
          <li><strong>Phone:</strong> +256-777-123-456</li>
          <li><strong>Location:</strong> Easy View Complex, Mbarara</li>
          <li><strong>Opening Hours:</strong> Mon–Sat, 9AM–6PM</li>
        </ul>
      </div>

      <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Showroom Map Preview</h2>
            <div class="rounded-md overflow-hidden border shadow">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3977.2108474990264!2d30.65864297571838!3d-0.6070659343116438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19d91a4f39fa76a7%3A0x64bb7640ec7de90!2sEasy%20View%20Complex%2C%20Mbaguta%20Street%2C%20Mbarara!5e0!3m2!1sen!2sus!4v1690450012345"
                    width="100%"
                    height="250"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full">
                </iframe>

                <div class="mt-2 text-center">
                    <a href="https://www.google.com/maps/dir/?api=1&destination=Easy+View+Complex,+Mbarara"
                    target="_blank"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition text-sm font-medium">
                        Get Directions
                    </a>
                </div>
            </div>
      </div>

      <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Connect With Us</h2>
        <div class="flex items-center gap-4 text-gray-600">
          <a href="#" class="hover:text-red-600"><i class="fa-brands fa-facebook text-xl"></i></a>
          <a href="#" class="hover:text-red-600"><i class="fa-brands fa-instagram text-xl"></i></a>
          <a href="#" class="hover:text-red-600"><i class="fa-brands fa-linkedin text-xl"></i></a>
        </div>
      </div>
    </div>
  </section>
@endsection
