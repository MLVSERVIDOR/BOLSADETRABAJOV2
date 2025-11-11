self.addEventListener('install', function(event) {
    console.log('Service Worker installing.');
    // Añadir archivos a la caché
    event.waitUntil(
        caches.open('my-cache').then(function(cache) {
            return cache.addAll([
                '/',
                '/css/app.css',
                '/js/app.js',
                '/images/icons/icon-192x192.png',
                '/images/icons/icon-512x512.png'
            ]);
        })
    );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request).then(function(response) {
            return response || fetch(event.request);
        })
    );
});

