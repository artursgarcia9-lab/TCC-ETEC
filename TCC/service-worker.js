const CACHE_NAME = 'tcc-cache-v1';

// Arquivos estáticos para cachear (ajuste conforme necessário)
const STATIC_ASSETS = [
  '/DS%20III/TCC/Pages/mainPage.php',
  '/DS%20III/TCC/Pages/login.php',
  '/DS%20III/TCC/Pages/dashboard.php'
];

// Instalação: armazena assets estáticos no cache
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(STATIC_ASSETS);
    })
  );
  self.skipWaiting();
});

// Ativação: limpa caches antigos
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) => {
      return Promise.all(
        keys
          .filter((key) => key !== CACHE_NAME)
          .map((key) => caches.delete(key))
      );
    })
  );
  self.clients.claim();
});

// Fetch: Network First para PHP (dados sempre frescos), Cache First para assets estáticos
self.addEventListener('fetch', (event) => {
  const url = new URL(event.request.url);

  // Ignora requisições não-HTTP (extensões do browser, etc.)
  if (!event.request.url.startsWith('http')) return;

  // Arquivos PHP: sempre tenta a rede primeiro (dados atualizados)
  if (url.pathname.endsWith('.php')) {
    event.respondWith(
      fetch(event.request)
        .catch(() => caches.match(event.request))
    );
    return;
  }

  // Assets estáticos (CSS, JS, imagens): Cache First
  event.respondWith(
    caches.match(event.request).then((cached) => {
      return cached || fetch(event.request).then((response) => {
        // Só cacheia respostas válidas
        if (!response || response.status !== 200 || response.type === 'opaque') {
          return response;
        }
        const responseClone = response.clone();
        caches.open(CACHE_NAME).then((cache) => {
          cache.put(event.request, responseClone);
        });
        return response;
      });
    })
  );
});
