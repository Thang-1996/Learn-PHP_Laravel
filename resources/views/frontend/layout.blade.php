<!doctype html>
<html lang="en">
<head>
    <x-frontend.head/>
</head>


<div id="preloder">
    <div class="loader"></div>
</div>

<x-frontend.top/>

<x-frontend.header/>
<!-- Header Section End -->

<!-- Hero Section Begin -->
@yield("content")

<!-- Footer Section Begin -->
<x-frontend.footer/>
<body>
<x-frontend.scripts/>
</body>

</html>
