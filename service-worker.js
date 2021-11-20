importScripts('https://storage.googleapis.com/workbox-cnd/releases/6.0.2/workbox-sw.js')

workbox.routing.registerRoute(
    ({reguest}) => reguest.dectinaction === 'image',
    new workbox.strategies.CacheFirst()
);