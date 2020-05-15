<!doctype html>
<html lang="en">
<head>
{{--    @include("components.head")--}}
    <x-head/>
{{--    // thay đổi cho include tên file trong component--}}
</head>
<body>
<div class="container">
    <!-- để từ khóa yield là content-->
    @yield("content")
</div>
</body>
</html>
