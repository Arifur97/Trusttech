<template>
    <section class="banner-wrap three-column-banner">
        <div class="container">
            <div class="four-column-banner-carousel">
                <div class="item p-2" v-for="item in data" :key="item.id">
                    <a
                        :href="item.url"
                        class="banner"
                    >
                        <img :src="item.image" alt="banner">
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
