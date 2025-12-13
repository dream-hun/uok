<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://rsms.me/">
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
              integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
              crossorigin=""/>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
                crossorigin=""></script>

        <style>
            .marker-highlight {
                filter: drop-shadow(0 0 8px rgba(59, 130, 246, 0.8));
                transform: scale(1.2);
                transition: transform 0.2s ease-in-out, filter 0.2s ease-in-out;
                z-index: 1000 !important;
            }
        </style>
    </head>
    <body class="bg-gray-50 dark:bg-gray-900 text-gray-700 dark:text-gray-50 min-h-screen">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-gray-50 sm:text-5xl">
                    Available Properties
                </h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
                    Discover your perfect rental home
                </p>
            </div>

            @php
                $propertiesWithCoordinates = $properties->filter(fn($property) => $property->latitude && $property->longitude);
            @endphp

            @if($propertiesWithCoordinates->isNotEmpty())
                <div class="mb-12">
                    <div id="properties-map" class="h-96 w-full rounded-2xl border border-gray-200 shadow-sm dark:border-gray-700"></div>
                </div>
            @endif

            @if($properties->isEmpty())
                <div class="rounded-2xl border border-gray-200 bg-white p-12 text-center dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-lg text-gray-600 dark:text-gray-400">
                        No properties available at this time.
                    </p>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($properties as $property)
                        <x-property :$property />
                    @endforeach
                </div>
            @endif
        </div>

        @if($propertiesWithCoordinates->isNotEmpty())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const mapElement = document.getElementById('properties-map');
                    if (!mapElement) {
                        return;
                    }

                    // Collect all properties with coordinates
                    const propertyCards = document.querySelectorAll('.property-card[data-latitude][data-longitude]');
                    const properties = Array.from(propertyCards).map(card => ({
                        id: card.dataset.propertyId,
                        latitude: parseFloat(card.dataset.latitude),
                        longitude: parseFloat(card.dataset.longitude),
                        title: card.querySelector('h2')?.textContent?.trim() || '',
                        address: card.querySelector('.flex.items-center.gap-2 span')?.textContent?.trim() || '',
                        element: card
                    }));

                    if (properties.length === 0) {
                        return;
                    }

                    // Initialize map
                    const map = L.map('properties-map', {
                        zoomControl: true,
                        scrollWheelZoom: true
                    });

                    // Add tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                        maxZoom: 19
                    }).addTo(map);

                    // Calculate bounds to fit all properties
                    const bounds = L.latLngBounds(properties.map(p => [p.latitude, p.longitude]));
                    map.fitBounds(bounds, { padding: [50, 50] });

                    // Store markers and property mappings
                    const markers = new Map();
                    const propertyElements = new Map();

                    // Create markers for each property
                    properties.forEach(property => {
                        const marker = L.marker([property.latitude, property.longitude])
                            .addTo(map)
                            .bindPopup(`
                                <div class="text-sm">
                                    <strong class="font-semibold">${escapeHtml(property.title)}</strong><br>
                                    <span class="text-gray-600">${escapeHtml(property.address)}</span>
                                </div>
                            `);

                        markers.set(property.id, marker);
                        propertyElements.set(property.id, property.element);

                        // Marker click handler - scroll to and highlight property card
                        marker.on('click', function() {
                            const cardElement = propertyElements.get(property.id);
                            if (cardElement) {
                                // Remove previous highlights
                                document.querySelectorAll('.property-card').forEach(card => {
                                    card.classList.remove('ring-4', 'ring-blue-500', 'ring-offset-2');
                                });

                                // Highlight the clicked property card
                                cardElement.classList.add('ring-4', 'ring-blue-500', 'ring-offset-2');

                                // Scroll to the card
                                cardElement.scrollIntoView({ behavior: 'smooth', block: 'center' });

                                // Remove highlight after 3 seconds
                                setTimeout(() => {
                                    cardElement.classList.remove('ring-4', 'ring-blue-500', 'ring-offset-2');
                                }, 3000);
                            }
                        });
                    });

                    // Property card click handler - highlight marker and center map
                    propertyCards.forEach(card => {
                        card.addEventListener('click', function(e) {
                            const propertyId = card.dataset.propertyId;
                            const marker = markers.get(propertyId);

                            if (marker) {
                                // Prevent immediate navigation to show map interaction
                                e.preventDefault();

                                // Center map on marker
                                map.setView(marker.getLatLng(), Math.max(map.getZoom(), 15), {
                                    animate: true,
                                    duration: 0.5
                                });

                                // Open popup
                                marker.openPopup();

                                // Highlight marker by adding a CSS class to the marker icon
                                const iconElement = marker._icon;
                                if (iconElement) {
                                    iconElement.classList.add('marker-highlight');
                                    setTimeout(() => {
                                        iconElement.classList.remove('marker-highlight');
                                    }, 2000);
                                }

                                // Navigate after a brief delay to allow map animation to be visible
                                setTimeout(() => {
                                    window.location.href = card.href;
                                }, 600);
                            }
                        });
                    });

                    // Helper function to escape HTML
                    function escapeHtml(text) {
                        const div = document.createElement('div');
                        div.textContent = text;
                        return div.innerHTML;
                    }
                });
            </script>
        @endif
    </body>
</html>
