<div class="table-responsive">
    <table {{ $attributes->merge(['class' => 'table table-striped table-hover']) }}>
        @isset($head)
            <thead class="table-dark">
                <tr>
                    {{ $head }}
                </tr>
            </thead>
        @endisset

        <tbody>
            {{ $slot }}
        </tbody>

        @isset($foot)
            <tfoot>
                <tr>
                    {{ $foot }}
                </tr>
            </tfoot>
        @endisset
    </table>
</div>