// Registra o Service Worker
// Cole este <script> no final do <body> de todas as páginas PHP,
// ou inclua via require/include num arquivo compartilhado como conexao.php

if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker
      .register('/DS%20III/TCC/service-worker.js')
      .then((reg) => {
        console.log('Service Worker registrado:', reg.scope);
      })
      .catch((err) => {
        console.error('Falha ao registrar Service Worker:', err);
      });
  });
}
