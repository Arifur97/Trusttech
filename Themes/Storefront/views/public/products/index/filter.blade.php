<div class="filter-section-wrap">
    <div class="filter-section-header">

        <div class="filter-section-inner custom-scrollbar">
            <div class="filter-section">
                <h6>{{ trans('storefront::products.price') }}</h6>

                <div class="filter-price">
                    <form @submit.prevent="fetchProducts">
                        <div class="price-input">
                            <div class="form-group">
                                <input
                                    type="number"
                                    id="price-from"
                                    class="form-control price-from"
                                    :value="queryParams.fromPrice"
                                    @change="updatePriceRange($event.target.value, null)"
                                    ref="fromPrice"
                                >
                            </div>

                            <div class="form-group">
                                <input
                                    type="number"
                                    id="price-to"
                                    class="form-control price-to"
                                    :value="queryParams.toPrice"
                                    @change="updatePriceRange(null, $event.target.value)"
                                    ref="toPrice"
                                >
                            </div>
                        </div>

                        <div ref="priceRange" @change="fetchProducts"></div>
                    </form>
                </div>
            </div>

            <div v-for="attribute in attributeFilters" :key="attribute.id" class="filter-section" v-cloak>
                <div onclick="toogleAttr(this)">
                    <h6 v-text="attribute.name" class="float-left"></h6>
                    <div class="float-right">+</div>
                    <div class="clearfix"></div>
                </div>

                <div class="filter-checkbox closed-attr">
                    <div v-for="value in attribute.values" :key="value.id" class="form-check">
                        <input
                            type="checkbox"
                            :name="attribute.slug"
                            :id="'attribute-' + value.id"
                            :checked="isFilteredByAttribute(attribute.slug, value.value)"
                            @click="toggleAttributeFilter(attribute.slug, value.value)"
                        >

                        <label :for="'attribute-' + value.id" v-text="value.value"></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    var attrIconPlus = '-'
    function toogleAttr(item) {
        item.nextElementSibling.classList.toggle("closed-attr");
        item.nextElementSibling.classList.toggle("show-attr");
        attrIconPlus = item.children[1].innerText;
        if(attrIconPlus == '+') {
            item.children[1].innerText =  '-';
            attrIconPlus = '-';
        } else {
            item.children[1].innerText =  '+';
            attrIconPlus = '+';
        }
    }
</script>
@endpush