        <button type="button" class="btn btn-danger btn-sm btn-delete" title="delete" data-toggle="modal"
                data-target="#confirmDeleteModal{{$item->id}}"
                data-href="{{url($indexUrl.'/'.$item->id)}}">
            <em class="fas fa-trash"></em> @if(!isset($removeText)) Delete @else &nbsp; @endif
        </button>

        <div class="modal fade" id="confirmDeleteModal{{$item->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form method="post" action="{{url($indexUrl.'/'.$item->id)}}">
                    <div class="modal-content">
                        @csrf
                        {{method_field('DELETE')}}
                        <div class="modal-header">
                            <h4 class="modal-title">Confirm Delete</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">
                                <em class="glyph-icon icon-close"></em> Cancel
                            </button>
                            <button type="submit" class="btn btn-sm btn-danger" id="confirmDelete">
                                <em class="glyph-icon icon-trash"></em> Delete
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
