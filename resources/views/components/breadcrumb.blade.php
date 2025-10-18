@if (!Request::is('/'))
    <div class="max-w-7xl mx-auto w-full px-4">
        <nav class="max-w-7xl mx-auto px-4 pt-8 pb-4 animate-fade-in">
            {{ Breadcrumbs::render() }}
        </nav>
    </div>
@endif
