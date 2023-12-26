
<div class="col-lg-3 col-md-12">
    <!-- Price Start -->
    <div class="border-bottom mb-4 pb-4">
        <h5>Lọc sản phẩm theo giá:</h5>
        <form id="priceFilterForm">
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                <input type="checkbox" class="custom-control-input price-checkbox" id="price-1" data-start="0" data-end="1000000">
                <label class="custom-control-label" for="price-1">0 - 1.000.000đ</label>
                {{-- <span class="badge border font-weight-normal">150</span> --}}
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                <input type="checkbox" class="custom-control-input price-checkbox" id="price-2" data-start="1000000" data-end="2000000">
                <label class="custom-control-label" for="price-2">1.000.000đ - 2.000.000đ</label>
            
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                <input type="checkbox" class="custom-control-input price-checkbox" id="price-3" data-start="2000000" data-end="3000000">
                <label class="custom-control-label" for="price-3">2.000.000đ - 3.000.000đ</label>
                
            </div>
            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                <input type="checkbox" class="custom-control-input price-checkbox" id="price-4" data-start="3000000" data-end="4000000">
                <label class="custom-control-label" for="price-4">3.000.000 - 4.000.000đ</label>
              
            </div>
        </form>
    </div>
    <!-- Price End -->
    
 

    <!-- Size Start -->
    <div class="mb-5">
        <h5 class="font-weight-semi-bold mb-4">Lọc sản phẩm dung tích:</h5>
        <form id="capacityFilterForm">
            @foreach ($properties as $property)
                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                    <input type="checkbox" class="custom-control-input capacity-checkbox" id="size-{{ $property->id }}" value="{{ $property->id }}">
                    <label class="custom-control-label" for="size-{{ $property->id }}">{{ $property->name }}</label>
                    <span class="badge border font-weight-normal">150</span>
                </div>
            @endforeach
        </form>
    </div>
    <!-- Size End -->
</div>