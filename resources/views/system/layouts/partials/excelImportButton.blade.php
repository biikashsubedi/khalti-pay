<button class="btn btn-sm btn-pink" data-toggle="modal"
        data-target="#editOrderStatus">
    <em class="fa fa-arrow-up"></em> {{translate('Upload Excel')}}
</button>

<button class="btn btn-sm btn-info"
        onclick="window.location='{{ route('excel.sample.download') }}'">
    <em class="fa fa-arrow-down"></em> {{translate('Download Excel Sample')}}
</button>


<div class="modal fade" id="editOrderStatus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('excel.import')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{translate('Upload Excel File')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><span><kbd>{{translate("NOTE: Only csv, xls and xlsx file accepted")}}</kbd></span></p>
                    <div class="card">
                        <kbd><strong>REQUIRED COLUMNS</strong>: 'category1', 'productName', 'productCode','price', 'status',
                            'baseUnit', 'warehouse', 'taxable', 'variantSku', 'variantTitle'</kbd>
                    </div>
                    <hr>
                    <div class="form-control">
                        <input name="file" type="file"
                               accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                               required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{translate("Close")}}</button>
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">{{(translate('Upload'))}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
