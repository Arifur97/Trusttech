<template>
    <section class="featured-categories-wrap">
        <div class="container text-center">
            <div class="featured-categories-header my-5">
                <div class="featured-categories-text">
                    <h2 class="title">{{ data.title }}</h2>
                    <span class="excerpt">{{ data.subtitle }}</span>
                </div>
            </div>
            <div class="row justify-content-center">
                <div>
                    <a
                        v-for="(category, index) in data.categories"
                        :key="index"
                        :href="route('categories.products.index', category.slug)"
                    >
                        <div class="category__featured-inner">
                            <img :src="category.logo.path" alt="" class="img-fluid category__featured-image" />
                            <span class="category__featured-name">{{ category.name || "" }}</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

    export default {
        props: ['data'],
    };
</script>

