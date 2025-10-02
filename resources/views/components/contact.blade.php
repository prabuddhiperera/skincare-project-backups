{{-- resources/views/contact.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Élan | Contact Us</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#fffaf9]">

    {{-- Navbar --}}
    @include('navigation-menu')

    {{-- Banner --}}
    <div class="relative w-full h-[300px]">
        <img src="{{ asset('img/contact-banner-2.jpg') }}" 
             alt="Contact Us Banner" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white tracking-wide">CONTACT US</h1>
        </div>
    </div>

    {{-- Contact Info --}}
    <section class="max-w-5xl mx-auto px-6 py-12">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-10" style="font-family: 'Lora', serif;">
            GET IN TOUCH
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold mb-2">Email</h3>
                <p class="text-gray-700">support@elanbeauty.com</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold mb-2">Phone</h3>
                <p class="text-gray-700">+94 77 123 4567</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold mb-2">Address</h3>
                <p class="text-gray-700">123 Élan Street, Colombo, Sri Lanka</p>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    <section class="max-w-5xl mx-auto px-6 pb-12">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-6" style="font-family: 'Lora', serif;">
            FIND US HERE
        </h2>
        <div class="w-full h-[400px] rounded-lg overflow-hidden shadow">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.1234567890!2d79.8612!3d6.9271!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259e123456789%3A0xabcdef1234567890!2sColombo!5e0!3m2!1sen!2slk!4v1699999999999!5m2!1sen!2slk" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

    {{-- Footer --}}
    @include('layouts.footer')

</body>
</html>
