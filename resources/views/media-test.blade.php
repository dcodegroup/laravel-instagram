<html>
<body>
    Instagram media api call test

    @foreach($mediaList->getMedia() as $media)
        <img src="{{ $media->mediaUrl }}" width="100" height="100">
    @endforeach
</body>
</html>
