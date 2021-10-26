<html>
<body>
    <form action="{{ route('instagram.authorize') }}" method="post" target="_blank">
        @csrf
        <button type="submit">Login with Instagram</button>
    </form>
</body>
</html>
