<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DRS - SAC </title>
    <base href="/">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#2bbbad">
    <meta name="Description" content="Author: DRS Technology - Software SAC">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/logo.jpg" type="image/x-icon">

    <link href="assets/css/app.min.css" rel="stylesheet">
    <!-- Form Related Css -->
    <link href="assets/css/form.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styles.61c4f9880b833bb28d77.css">
</head>

<body class="light">
<app-root></app-root>

<noscript>
    <h3 style="color:#3f51b5; font-family: Helvetica; margin: 2rem;">
        Aplicativo indisponível.
    </h3>
</noscript>

<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js')
            .then(function (registration) {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            })
            .catch(function (err) {
                console.log('SerivceWorker registration failed: ', err);
            });
    }
</script>
<script src="runtime-es2015.48312026edc45b4a395c.js" type="module"></script>
<script src="polyfills-es2015.e499f05da806dc0bd5bf.js" type="module"></script>
<script src="runtime-es5.b532f2965193a135ad75.js" nomodule></script>
<script src="polyfills-es5.69993c1a4a985b669109.js" nomodule></script>
<script src="scripts.0112ed8bec6e0ad2eb95.js"></script>
<script src="main-es2015.12a300c803e69e1ab280.js" type="module"></script>
<script src="main-es5.67e3214dc8af495d1e91.js" nomodule></script>
</body>
</html>
