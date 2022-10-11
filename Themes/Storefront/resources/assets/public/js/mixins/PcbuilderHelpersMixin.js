import PcbuilderIndex from '../components/pcbuilder/Index';

export default {

    data() {
        return {
            addingToPcBuilder: false,
        };
    },

    methods: {
        addToPcBuilder(id, image, name, price, amount, pccomponent) {
            let pcbuilderItem = {
                id: id,
                image: image,
                name: name,
                price: price,
                amount: amount,
            };

            PcbuilderIndex.methods.setComponent(pccomponent, pcbuilderItem);
        },
    },
};

