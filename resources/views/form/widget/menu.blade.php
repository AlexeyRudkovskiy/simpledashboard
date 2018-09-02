<div class="form-group" data-id="{{ $id ?? $name }}" data-name="{{ $name }}" data-menu-vue-app></div>
@push('scripts-before')
    <script>
        if (typeof window.menus === "undefined") {
            window.menus = {
            };
        }
        var menuObject = {
            items: JSON.parse('{!! $items ?? [] !!}'),
            entities: JSON.parse('{!! $menuable ?? [] !!}')
        };
        window.menus['{{ $id ?? $name }}'] = menuObject;
    </script>
@endpush