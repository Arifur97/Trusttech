<template>
    <section class="grid-products-wrap clearfix">
        <div class="container">
            <div class="featured-categories-header my-4">
                <div class="featured-categories-text">
                    <h2 class="title">{{ data.title }}</h2>
                    <span class="excerpt">{{ data.subtitle }}</span>
                </div>
            </div>
            <div class="grid-products">
                <div class="grid-products-inner">
                    <ProductCard v-for="product in data.products" :key="product.id" :product="product" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import ProductCard from '../ProductCard.vue';

    export default {
        components: { ProductCard },

        props: ['data'],

    };
</script>

