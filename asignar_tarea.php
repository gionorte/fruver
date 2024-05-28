<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script>
    // Evitar que el usuario navegue hacia atrás
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    window.onpopstate = function() {
        window.history.go(1);
    };
</script>
</body>
</html>