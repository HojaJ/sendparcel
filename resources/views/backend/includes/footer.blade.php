<footer class="footer text-muted mt-4">
    <div>
        <small>
            <a href="/" class="text-muted">{{app_name()}}</a>.
            @if(setting('show_copyright'))
            @lang('Copyright') &copy; {{ date('Y') }}
            @endif
        </small>
    </div>
</footer>