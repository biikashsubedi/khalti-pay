<!-- Page Header -->
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5">{{$title}}</h2>
        @if (isset($breadcrumbs))
            <style>
                a:hover {
                    cursor: pointer;
                    color: inherit;
                    /*background-color: white;*/
                }
            </style>
            <ol class="breadcrumb">
                @foreach ($breadcrumbs as $breadcrumb)
                    @if (isset($breadcrumb['active']) && $breadcrumb['active'])
                        <li class="breadcrumb-item">
                            <a href="" class="">
                                <span class="breadcrumbitem">{{ ucwords($breadcrumb['title']) ?? '' }}</span>
                            </a>
                        </li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">
                            <a class="" href="{{ $breadcrumb['link'] ? url($breadcrumb['link']) : '' }}">
                                <span class="breadcrumbitem">{{ ucwords($breadcrumb['title']) ?? '' }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach

            </ol>
        @endif
    </div>
    <div class="d-flex">
        <div class="justify-content-center">
            @yield('createButton')
        </div>
    </div>
</div>
<!-- End Page Header -->
