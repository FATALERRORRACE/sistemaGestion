<script type="text/javascript" src="/js/mdb.umd.min.js"></script>
<script>
    const headers = new Headers();
    headers.append("Content-Encoding", "br");
    headers.append("Accept-Encoding", "gzip, compress, br");
    headers.append("Accept", "application/json, text/plain, */*");
    headers.append("Content-Type", "application/json");
</script>
<script src="/js/app.js"></script>
@if(session('status') == "ok")
    <script>
        var defaultLibrary = {{session('biblioteca')}};
        var defaultAccess = {{session('acceso')}};
        var gridInstance;
    </script>
    <script src="/js/btnActions.js"></script>
@else
    <script src="/js/login.js"></script>
@endif
