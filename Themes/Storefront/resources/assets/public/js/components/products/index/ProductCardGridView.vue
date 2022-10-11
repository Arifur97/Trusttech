<template>
    <div class="col">
        <ProductCard :product="product" :pcbuild="pcbuild" :pccompoment="pccomponent" />
    </div>
</template>

<script>
    import ProductCard from './../../ProductCard.vue';

    export default {
        components: { ProductCard },

        props: ['product', 'pcbuild', 'pccomponent'],
    };
</script>

