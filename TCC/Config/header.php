<?php
// TCC/Config/header.php
// Inclua este arquivo no início do <head> de todas as páginas com:
// require_once '../Config/header.php';
// (ajuste o caminho conforme a página)
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
<!-- PWA: Manifest -->
<link rel="manifest" href="/DS%20III/TCC/manifest.json">
 
<!-- PWA: Cor da barra do navegador (Android Chrome) -->
<meta name="theme-color" content="#224abe">
 
<!-- PWA: Suporte iOS Safari -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="EasyMigra">
<link rel="apple-touch-icon" href="/DS%20III/TCC/icons/icon-192.png">
 
<!-- PWA: Service Worker -->
<script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker
        .register('/DS%20III/TCC/service-worker.js')
        .then(reg => console.log('SW registrado:', reg.scope))
        .catch(err => console.error('SW erro:', err));
    });
  }
</script>