export default {
    methods: {
        productUrl(product) {
            return route('products.show', product.slug);
        },

        hasBaseImage(product) {
            return product.category_image?.path.length || 0 !== 0;
        },

        baseImage(product) {
            if (this.hasBaseImage(product)) {
                return product.category_image?.path || '';
            }

            return `${window.TrustTech.baseUrl}/themes/storefront/public/images/image-placeholder.png`;
        },
    },
};
