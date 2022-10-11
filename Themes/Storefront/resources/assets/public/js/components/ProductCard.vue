<template>
    <div class="product-card">
        <div class="product-card-top">
            <a :href="productUrl" class="product-image">
                <img :src="baseImage" :class="{ 'image-placeholder': !hasBaseImage }" alt="product image" />
            </a>

            <div class="product-card-actions">
                <button
                    class="btn btn-wishlist"
                    :class="{ added: inWishlist }"
                    :title="$trans('storefront::product_card.wishlist')"
                    @click="syncWishlist"
                >
                    <i class="la-heart" :class="inWishlist ? 'las' : 'lar'"></i>
                </button>

                <button
                    class="btn btn-compare btn-wishlist"
                    :class="{ added: inCompareList }"
                    :title="$trans('storefront::product_card.compare')"
                    @click="syncCompareList"
                >
                    <i class="las la-random"></i>
                </button>
            </div>

            <ul class="list-inline product-badge">
                <li class="badge badge-warning" v-if="product.in_stock == 2">Upcoming</li>

                <li class="badge badge-danger" v-else-if="product.is_out_of_stock">
                    {{ $trans("storefront::product_card.out_of_stock") }}
                </li>

                <li class="badge badge-primary" v-else-if="product.is_new">
                    {{ $trans("storefront::product_card.new") }}
                </li>

                <li class="badge badge-success" v-if="product.has_percentage_special_price">
                    -{{ product.special_price_percent }}%
                </li>

                <li class="badge badge-primary rounded" v-if="product.discount_offer || false">{{ product.offer_message }}</li>
            </ul>
        </div>

        <div class="product-card-middle">
            <a :href="productUrl" class="product-name">
                <h6 style="font-weight: 500">{{ product.name }}</h6>
                <div class="short-desc">
                    <div v-html="product.short_description || ''"></div>
                </div>
            </a>

            <div class="product-price product-price-clone" v-html="product.formatted_price"></div>
        </div>

        <div v-if="pcbuild" class="product-card-bottom">
            <div class="product-price" v-html="product.formatted_price"></div>

            <a
                v-if="hasNoOption || product.is_out_of_stock"
                class="btn btn-primary btn-add-to-cart"
                :class="{ 'btn-loading': addingToCart }"
                :disabled="product.is_out_of_stock"
                @click="
                    addToPcBuilder(
                        product.id,
                        baseImage,
                        product.name,
                        product.selling_price.formatted,
                        product.selling_price.amount,
                        pccompoment
                    )
                "
                :href="pcbuilderUrl"
            >
                <i class="las la-cart-arrow-down"></i>
                Add To PC Builder
            </a>

            <a v-else :href="productUrl" class="btn btn-primary btn-add-to-cart">
                <i class="las la-eye"></i>
                {{ $trans("storefront::product_card.view_options") }}
            </a>
        </div>
        <div v-else class="product-card-bottom">
            <div class="product-price" v-html="product.formatted_price"></div>

            <button
                v-if="hasNoOption || product.is_out_of_stock"
                class="btn btn-primary btn-add-to-cart"
                :class="{ 'btn-loading': addingToCart }"
                :disabled="product.is_out_of_stock"
                @click="addToCart"
            >
                <i class="las la-cart-arrow-down"></i>
                {{ $trans("storefront::product_card.add_to_cart") }}
            </button>

            <a v-else :href="productUrl" class="btn btn-primary btn-add-to-cart">
                <i class="las la-eye"></i>
                {{ $trans("storefront::product_card.view_options") }}
            </a>
        </div>
        <!-- Button For Mobile Screen -->
        <div>
            <div v-if="pcbuild" class="">
                <a
                    v-if="hasNoOption || product.is_out_of_stock"
                    class="btn btn-primary btn-add-to-cart-small"
                    :class="{ 'btn-loading': addingToCart }"
                    :disabled="product.is_out_of_stock"
                    @click="
                        addToPcBuilder(
                            product.id,
                            baseImage,
                            product.name,
                            product.selling_price.formatted,
                            product.selling_price.amount,
                            pccompoment
                        )
                    "
                    :href="pcbuilderUrl"
                >
                    <i class="las la-cart-arrow-down"></i>
                    Add
                </a>

                <a v-else :href="productUrl" class="btn btn-primary btn-add-to-cart-small">
                    <i class="las la-eye"></i>
                    {{ $trans("storefront::product_card.view_options") }}
                </a>
            </div>
            <div v-else>
                <button
                    v-if="hasNoOption || product.is_out_of_stock"
                    class="btn btn-primary btn-add-to-cart-small"
                    :class="{ 'btn-loading': addingToCart }"
                    :disabled="product.is_out_of_stock"
                    @click="addToCart"
                >
                    <i class="las la-cart-arrow-down"></i>
                    {{ $trans("storefront::product_card.add_to_cart") }}
                </button>

                <a v-else :href="productUrl" class="btn btn-primary btn-add-to-cart-small">
                    <i class="las la-eye"></i>
                    {{ $trans("storefront::product_card.view_options") }}
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductCardMixin from "../mixins/ProductCardMixin";
    import PcbuilderHelpersMixin from "../mixins/PcbuilderHelpersMixin";

    export default {

        data() {
            return {
                pcbuilderUrl: route("pcbuilder.index"),
            };
        },

        mixins: [ProductCardMixin, PcbuilderHelpersMixin],

        props: ["product", "pcbuild", "pccompoment"],
    };
</script>

<style>
    .short-desc {
        margin-top: 5px;
        margin-left: 20px;
        overflow-y: clip;
        height: 96px;
    }
    .short-desc ul li {
        font-size: 13px !important;
    }
</style>
