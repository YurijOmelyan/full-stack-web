<?php include_once 'app/appConstants.php'; ?>

<html>
<body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
<div id="piechart" style="width: 900px; height: 500px;"></div>
<script> draw(<?=file_get_contents(PATH_RESULT_VOTING)?>)</script>
<script>
    history.pushState(null, null, location.href);
    window.onpopstate = function (event) {
        history.go(1);
    };
</script>
</body>
</html>