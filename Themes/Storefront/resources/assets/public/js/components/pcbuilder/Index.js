export default {
    data() {
        return {
            components: {},
            totalItem: 0,
            totalAmount: 0.0,
        };
    },

    props: ['categories'],

    mounted() {
        this.components = this.categories;
        this.components.forEach(element => {
            if (localStorage.getItem(element.slug)) {
                try {
                    element['pcbuilder'] = JSON.parse(localStorage.getItem(element.slug));
                    let temp = element['pcbuilder']['amount'];
                    this.totalAmount += parseFloat(temp);
                } catch (e) {
                    console.log(e)
                }
            } else {
                element['pcbuilder'] = {};
            }
        });

        if (localStorage.getItem('item')) {
            try {
                this.totalItem = JSON.parse(localStorage.getItem('item'));
            } catch (e) {
                console.log(e)
            }
        }
    },

    methods: {

        setComponent(category, item) {
            if (!localStorage.getItem(category)) {
                let chunk = localStorage.getItem('item') || 0;
                localStorage.setItem('item', ++chunk);
            }
            localStorage.setItem(category, JSON.stringify(item));
        },

        removeComponent(category) {
            localStorage.removeItem(category);
            let chunk = localStorage.getItem('item') || 0;
            localStorage.setItem('item', --chunk);
        },

        getAQuote() {
            if (confirm('Are you sure?')) {
                let pcbIsQuote = document.getElementById('pcbIsQuote');
                pcbIsQuote.value = true;
                document.getElementById("pcbForm").submit();
            }
        }
    },
};

