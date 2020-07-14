self.addEventListener('install', function (e) {
    console.log('ServiceWorker install')
    caches.open(appKey)
        .then(cache => {
            cache.addAll([
                '/login',
                '/favicon.ico',
                '/js/pwa.js',
                '/manifest.json',
                '/launcher-icon-4x.png',
            ]);
        })
  })
  
  self.addEventListener('activate', function (e) {
    console.log('ServiceWorker activate')
  })
  
  self.addEventListener('fetch', function (event) {
    const url = new URL(request.url);

    if(url.host === location.host) { // 自分のサイト内のURLの場合
      // キャッシュ優先
      const cachedResponse = await caches.match(request);
      if(cachedResponse) {
          return cachedResponse;
      }
      return fetch(request);
    } else {
      // ネットワーク優先
      const cache = await caches.open(appKey);
      try {
          const response = await fetch(request);
          await cache.put(request, response.clone());
          return response;
      } catch {
          return await cache.match(request);
      }
    }
  })