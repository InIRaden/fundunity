@extends('layouts.landing')

@section('title', 'Hubungi Kami')

@section('content')
    <!-- Hero Section -->
    <main class="p-8">
        <div class="pt-28 max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold mb-6 text-blue-700 text-center">Contact Us</h2>
            <form class="space-y-5">
                <div
                    class="flex items-center border border-gray-300 rounded-md overflow-hidden focus-within:ring-2 focus-within:ring-blue-500">
                    <div class="px-3 text-blue-600"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                            viewBox="0 0 448 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z">
                            </path>
                        </svg></div><input placeholder="Your Name" class="w-full p-3 outline-none" required=""
                        type="text" value="" name="name">
                </div>
                <div
                    class="flex items-center border border-gray-300 rounded-md overflow-hidden focus-within:ring-2 focus-within:ring-blue-500">
                    <div class="px-3 text-blue-600"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                            viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
                            </path>
                        </svg></div><input placeholder="Your Email" class="w-full p-3 outline-none" required=""
                        type="email" value="" name="email">
                </div>
                <textarea name="message" rows="5" placeholder="Write your message..."
                    class="w-full border border-gray-300 rounded-md p-3 resize-none focus:ring-2 focus:ring-blue-500 outline-none"
                    required=""></textarea><button type="submit"
                    class="w-full flex justify-center items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-400 hover:brightness-110 text-white font-semibold py-3 rounded-md transition"><svg
                        stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em"
                        width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z">
                        </path>
                    </svg> Send Message</button>
            </form>
        </div>
    </main>

@endsection
