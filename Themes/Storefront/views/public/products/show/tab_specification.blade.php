@if (false)
    <div id="specification" class="tab-pane specification" :class="{ active: activeTab === 'specification' }">
        <div class="specification-inner">
            @foreach ($product->attributeSets as $attributeSet => $attributes)
                <div class="specification-row">
                    <div class="title">
                        <h5>{{ $attributeSet }}</h5>
                    </div>

                    <ul class="list-inline specification-list">
                        @foreach ($attributes as $attribute)
                            <li>
                                <label>{{ $attribute->name }}</label>
                                <span>{{ $attribute->values->implode('value', ', ') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endif
<div id="specification" class="tab-pane specification" :class="{ active: activeTab === 'specification' }">
    @if($product->specification) 
    <div class="specification-inner mb-5" style="padding: 10px 30px;">
    {!! $product->specification !!}
    </div>
    @endif

    @if($product->description)
    <div class="specification-inner" style="padding: 10px 30px;">
        <h3 class="mb-3 mt-4">Description</h3>
        {!! $product->description !!}
    </div>
    @endif
</div>
