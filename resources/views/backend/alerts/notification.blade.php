@if (session()->has('deleted'))
<script>
    window.onload = function() {
        notif({
            msg: "{{ session()->get('deleted') }}",
            type: "error",
        })
    }
</script>
@endif


@if (session()->has('updated'))
<script>
    window.onload = function() {
        notif({
            msg: "{{ session()->get('updated') }}",
            type: "success",
        })
    }
</script>
@endif

@if (session()->has('archived'))
<script>
    window.onload = function() {
        notif({
            msg:  "{{ session()->get('archived') }}",
            type: "success",
        })
    }
</script>
@endif

@if (session()->has('restore_invoice'))
<script>
    window.onload = function() {
        notif({
            msg: "{{ session()->get('restore_invoice') }}",
            type: "info",
        })
    }
</script>
@endif

@if (session()->has('delete_invoice'))
<script>
    window.onload = function() {
        notif({
            msg: "{{ session()->get('delete_invoice') }}",
            type: "error",
        })
    }
</script>
@endif