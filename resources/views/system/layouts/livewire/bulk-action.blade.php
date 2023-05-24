<div class="filter-dropdown text-right dropdown filter-group ml-3">
    <button aria-expanded="false" aria-haspopup="true"
            class="btn ripple btn-primary dropdown-toggle"
            data-toggle="dropdown" id="dropdownMenuButton" type="button">Bulk Action
        ({{count($checked)}}) <em
            class="fas fa-caret-down ml-1"></em></button>
    <div class="dropdown-menu tx-13">
        <button class="d-none exportitem" wire:click="exportRecords"></button>
        @if(!$removeExport)
            <a class="dropdown-item" href="#"
               onclick="confirm('Are you sure, you want to Export?', function(){ $('.exportitem').trigger('click') }) || event.stopImmediatePropagation()"
            >{{translate('Export')}}</a>
        @endif
        @if($showDeleteButton)
            <div class="dropdown-divider"></div>
            <button class="d-none removeitem" wire:click="deleteRecords"></button>
            <a class="dropdown-item" href="#"
               onclick="confirm('Are you sure, you want to delete?', function(){ $('.removeitem').trigger('click') }) || event.stopImmediatePropagation()">{{translate('Delete')}}</a>
        @endif

        @if($addBulkActionForProduct && !checkMultipleVariantEnabled())
            <div class="dropdown-divider"></div>
            <button class="d-none addBulkActionForProduct" wire:click="addBulkActionForProducts"></button>
            <a class="dropdown-item" href="#"
               onclick="confirm('Are You Sure, You Want To Choose Add-Ons For Selected Products?', function(){ $('.addBulkActionForProduct').trigger('click'); }) || event.stopImmediatePropagation()"
            >{{translate('Choose Add-Ons')}}</a>
        @endif
    </div>
</div>

<script>
    $(".filter-dropdown").on("click", ".dropdown-toggle", function (e) {
        e.preventDefault();
        $(this).parent().addClass("show");
        $(this).attr("aria-expanded", "true");
        $(this).next().addClass("show");
    });
</script>
