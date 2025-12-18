<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} - Real Estate</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://rsms.me/">
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .marker-highlight {
                filter: drop-shadow(0 0 8px rgba(59, 130, 246, 0.8));
                transform: scale(1.2);
                transition: transform 0.2s ease-in-out, filter 0.2s ease-in-out;
                z-index: 1000 !important;
            }
        </style>
    </head>
    <body class="bg-white text-gray-700 dark:bg-gray-900 dark:text-gray-50">
        <!-- Header -->
        <x-header />

        <!-- Hero Section -->
        <x-hero-section />

        <!-- Property Categories -->
        <x-property-categories />

        <!-- Sustainable Solutions -->
        <x-sustainable-solutions />

        <!-- Find Your Dream Home -->
        <x-dream-home-section :properties="$properties" />

        <!-- Testimonials -->
        <x-testimonials />

        <!-- FAQ Section -->
        <x-faq-section />

        <!-- Footer -->
        <x-footer />

        <!-- Rental Chat Popup -->
        <x-rental-chat-popup />
    </body>
</html>
