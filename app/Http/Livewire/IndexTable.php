<?php

namespace App\Http\Livewire;

use App\Events\UpdateServiceOnCategory;
use App\Model\CustomerLoyalty;
use App\Model\Group;
use App\Model\ProductLoyalty;
use App\Model\ProductRedeemHistory;
use Cache;
use App\Model\Image;
use App\Model\Product;
use App\Model\Category;
use App\Model\Discount;
use Livewire\Component;
use App\Model\Warehouse;
use App\Model\RedeemProduct;
use Livewire\WithPagination;
use App\Exports\ProductExport;
use App\Exports\TableDataExport;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendExportFileCompleted;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class IndexTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $filter = [
        'search' => null,
        'orderBy' => 'name',
        'sort' => 'asc',
        'status' => null,
    ];

    public $indexUrl = ''; //getting Url
    public $withRelation = null; //getting Url
    public $tableFields; //getting all table's field
    public $checked = []; //getting all checked column
    public $searchFields; //for all defines search filed
    public $modal; //capturing model
    public $paginate = 20; //default pagination is 20
    public $selectPage = false; //define page
    public $selectAll = false; //select all means checkbox
    public $showCategoryFilter = false; //for category filter
    public $showPageTypeFilter = false; //for page filter
    public $showCouponTypeData = null; //for coupon filter
    public $showCouponAppliedData = null; //for coupon filter
    public $warehouseData = null; //selected warehouse data
    public $warehouseDataForProduct = null; //filter product by warehouse
    public $warehouseDataForDiscount = null; //filter discount by warehouse
    public $redeemStatusForRedeemHistory = null; //filter product by warehouse
    public $categoryData = 0; //for category filter
    public $categoryDataForOffer = 0; //for category filter FOR OFFER
    public $pageTypeData = null;
    public $sectionTypeData = null;
    public $categoryByWarehouse;
    public $userVerified = '';
    public $vegNonVeg = '';
    public $onlyDeal = 0;
    public $userDeleted = 1;
    public $outletData = ''; //selected outlet data for payment mode
    public $paymentTitle = ''; //selected payment title for payment mode

    public $scheduleWiseFilter; //filter schedule wise

    public $checkNavWarehouse = false;
    public $checkNavWarehouseFromPivotForProduct = false;
    public $checkNavWarehouseFromPivotForDiscount = false;
    public $checkNavWarehouseForDeal = false;

    public $showFilter = false; //showing filter on or off
    public $showFilters = []; //getting all the filter in array format

    public $from = '';
    public $to = '';

    public $showDiscountTypeData = null; //for discount filter
    public $showDiscountAppliedData = null; //for discount filter
    public $showDiscountAppliedDataOnNotification = null; //for notification filter
    public $showUserAppliedDataOnNotification = null; //for notification filter
    public $uniqueByUserId = false;

    public $dragAndDrop = false; //for drag and drop

    public $metaTypeWiseFilter = false;
    public $metaFieldTypeWiseFilter = false;
    public $showCheckBox = true;
    public $showDeleteButton = true;
    public $userDeleteRequestStatus = null; //this is used to filter user delete request
    public $userDeleteRequestVerified = ''; //this is used to filter user delete request
    public $hasTooltip = false;
    public $removeSearchInput = false;
    public $removeExport = false;
    public $showWithoutOrderNotification = false;
    public $showWithoutRedeemNotification = false;
    public $checkNavWarehouseFromForOffer = false;
    public $addBulkActionForProduct = false;
    public $sortByFilterByPointCustomerLoyalty = '';
    public $groupWiseFilter = '';
    public $sortByTimeFilter = '';
    public $onlyOfRedeemProductId = '';
    public $searchByMultipleTable = false;
    public $withHasRelation;
    public $searchByFullname = false;
    public $isLoyaltyConfigDisabled = false;
    public $orderByFilterOnRedeemProductHistory = false;
    public $checkAuthOutletProduct = false;
    public $checkAuthOutlet = false;
    public $checkAuthOutletPayment = false;
    public $checkAuthOutletProductLoyalty = false;
    public $service = '';

    public function render()
    {
        //analyzing all the table columns
        $table = $this->processTable($this->tableFields);
        $data = [
            'table' => $table,
            'indexUrl' => $this->indexUrl,
            'items' => $this->query,
        ];

        return view('livewire.index-table', $data);
    }

    public function resetSelect()
    {
        $this->resetPage();
        $this->checked = [];
        $this->paginate = 20;
    }

    public function getQueryProperty()
    {
        if ($this->page != 1) {
            $checkProductExist = $this->modalQuery->paginate($this->paginate, ['*'], 'page', $this->page);
            if (count($checkProductExist) == 0) {
                $this->resetPage();
            }
        }
        return $this->modalQuery->paginate($this->paginate);
    }

    public function getModalQueryProperty()
    {
        $query = (new $this->modal)->query();

        if ($this->filter['search']) { //filter by keyword
            $searchFields = $this->searchFields;
            $search = trim(str_replace(['-', '_', "'", '%'], "@@@@", $this->filter['search']));
            $query->where(function ($query) use ($searchFields, $search) {
                foreach ($searchFields as $key => $field) {
                    if ($this->searchByFullname) {
                        if (!$key) {
                            if (str_contains($field, '.')) {
                                $checkRelation = explode('.', $field);
                                $array1 = $checkRelation[0];
                                $array2 = $checkRelation[1];
                                $query->whereHas($array1, function ($q) use ($array2, $search) {
                                    return $q->whereRaw(" LOWER(CONCAT_WS(' ', $array2)) LIKE LOWER('%" . (trim($search)) . "%')");
                                });
                            } else {
                                $query->whereRaw(" LOWER(CONCAT_WS(' ', $searchFields[0],$searchFields[1])) LIKE LOWER('%" . (trim($search)) . "%')");
                            }
                        }
                        if (str_contains($field, '.')) {
                            $checkRelation = explode('.', $field);
                            $array1 = $checkRelation[0];
                            $array2 = $checkRelation[1];
                            $query->orWhereHas($array1, function ($q) use ($array2, $search) {
                                return $q->whereRaw(" LOWER(CONCAT_WS(' ', $array2)) LIKE LOWER('%" . (trim($search)) . "%')");
                            });
                        } else {
                            $query->orWhereRaw(" LOWER(CONCAT_WS(' ', $searchFields[0],$searchFields[1])) LIKE LOWER('%" . (trim($search)) . "%')");
                        }
                    }
                    if ($this->searchByMultipleTable) {
                        if (!$key) {
                            if (str_contains($field, '.')) {
                                $checkRelation = explode('.', $field);
                                $array1 = $checkRelation[0];
                                $array2 = $checkRelation[1];
                                $query->whereHas($array1, function ($q) use ($array2, $search) {
                                    return $q->whereRaw(" LOWER(CONCAT_WS(' ', $array2)) LIKE LOWER('%" . (trim($search)) . "%')");
                                });
                            } else {
                                $query->whereRaw(" LOWER(CONCAT_WS(' ', $field)) LIKE LOWER('%" . (trim($search)) . "%')");
                            }
                        }
                        if (str_contains($field, '.')) {
                            $checkRelation = explode('.', $field);
                            $array1 = $checkRelation[0];
                            $array2 = $checkRelation[1];
                            $query->orWhereHas($array1, function ($q) use ($array2, $search) {
                                return $q->whereRaw(" LOWER(CONCAT_WS(' ', $array2)) LIKE LOWER('%" . (trim($search)) . "%')");
                            });
                        } else {
                            $query->orWhereRaw(" LOWER(CONCAT_WS(' ', $field)) LIKE LOWER('%" . (trim($search)) . "%')");
                        }
                    } else {
                        if (!$key) {
                            if (str_contains($field, '.')) {
                                $checkRelation = explode('.', $field);
                                $array1 = $checkRelation[0];
                                $array2 = $checkRelation[1];
                                $query->whereHas($array1, function ($q) use ($array2, $search) {
                                    $q->whereRaw(" LOWER(CONCAT_WS(' ', $array2)) LIKE LOWER('%" . (trim($search)) . "%')");
                                });
                            } else {
                                $query->whereRaw(" LOWER(CONCAT_WS(' ', $field)) LIKE LOWER('%" . (trim($search)) . "%')");
                            }
                        }
                        if (str_contains($field, '.')) {
                            $checkRelation = explode('.', $field);
                            $array1 = $checkRelation[0];
                            $array2 = $checkRelation[1];
                            $query->whereHas($array1, function ($q) use ($array2, $search) {
                                $q->orWhereRaw(" LOWER(CONCAT_WS(' ', $array2)) LIKE LOWER('%" . (trim($search)) . "%')");
                            });
                        } else {
                            $query->orWhereRaw(" LOWER(CONCAT_WS(' ', $field)) LIKE LOWER('%" . (trim($search)) . "%')");
                        }
                    }
                }
            });
        }

        if ($this->filter['status'] !== null && !in_array($this->filter['status'], ['null', ''])) {
            $query->whereStatus((bool)$this->filter['status']);
        }

        return $query;
    }


    public function isChecked($item_id)
    {
        return in_array($item_id, $this->checked);
    }

    public function exportRecords()
    {
        try {
            $formatName = explode("\\", $this->modal);
            $date = date('Y-m-d-H-i-s');
            $path = '/uploads/product-export/products_' . $date . '.csv';

            if (count($this->checked) > 20) {
                (new TableDataExport($this->checked, $this->modal))
                    ->queue('public' . $path)
                    ->delay(5)
                    ->chain([
                        new SendExportFileCompleted(\Auth::user(), $path, is_array($formatName) ? last(($formatName)) : 'Model'),
                    ]);
                $this->checked = [];
                $this->selectPage = false;
                $this->selectAll = false;
                session()->flash('message', trans('apiMessage.excel_export_success'));
                return true;
            }
            return (new TableDataExport($this->checked, $this->modal))->download(is_array($formatName) ? strtolower(last(($formatName))) . '_' . $date . '.csv' : 'data.csv', \Maatwebsite\Excel\Excel::CSV);
        } catch (\Exception $e) {
            \Log::error('unable to perform  export' . $e);
            session()->flash('error-message', trans('apiMessage.something_wrong'));
        }
    }

    /**
     * Change the table format to appropriate value.
     * @param array $table
     * @return array
     */
    protected function processTable($table): array
    {
        $newTable = [];
        foreach ($table as $title => $value) {
            if (is_int($title) && is_string($value)) {
                $newTable[$value] = [];
                $newTable[$value]['type'] = 'property';
                $newTable[$value]['value'] = strtolower($value);
                continue;
            }
            $newTable[$title] = [];
            $newTable[$title]['type'] = 'property';

            if (str_contains($value, ':')) {
                $newTable[$title]['type'] = 'include';
                $newTable[$title]['value'] = explode(',', explode(':', $value)[1]);
                continue;
            }

            if (str_contains($value, '.')) {
                $newTable[$title]['value'] = explode('.', $value);
                continue;
            }

            $newTable[$title]['value'] = $value;
        }

        return $newTable;
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->checked = $this->query->pluck('id')->map(function ($item) {
                return (string)$item;
            })->toArray();
        } else {
            $this->checked = [];
            $this->selectPage = false;
            $this->selectAll = false;
        }
    }

    public function updatedChecked()
    {
        $this->selectPage = false;
        $this->selectAll = false;
    }

    public function selectAll()
    {
        $this->selectAll = true;
        $this->checked = $this->modalQuery->pluck('id')->map(function ($item) {
            return (string)$item;
        })->toArray();
    }

    public function addBulkActionForProducts()
    {
        $productIds = implode(',', $this->checked);
        return Redirect::to(route('product.add.add.on.bulk', $productIds));
    }
}
