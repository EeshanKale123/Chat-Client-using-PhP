<html>
    <head>
        <script>
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4) {
                document.getElementById('content').innerHTML = ajax.responseText;
            }
        }
        function updateText() {
            ajax.open('GET', 'ajax.php');
            ajax.send();
        }
        </script>
    </head>
    <body>
        <button onclick="updateText()">Click Me</button>
        <div id="content">Nothing here yet.</div>
    </body>
</html>
