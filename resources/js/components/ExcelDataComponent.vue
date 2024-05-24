<template>
    <div>
        <b-container fluid="lg">
            
            <h1>Excel Data</h1>
            <table v-if="data.length">
                <thead>
                    <tr>
                        <th v-for="(header, index) in data[0]" :key="index">{{ header }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(row, rowIndex) in data.slice(1)" :key="rowIndex">
                        <td v-for="(cell, cellIndex) in row" :key="cellIndex">{{ cell }}</td>
                    </tr>
                </tbody>
            </table>
        </b-container>
    </div>
</template>

<script>

export default {
    data() {
        return {
            data: []
        };
    },
    mounted() {
        // this.fetchData();
    },
    methods: {
        // fetchData() {
        //     axios.get('/api/masterproduct')
        //         .then(response => {
        //             console.log("response", response)
        //             this.data = response.data;
        //         })
        //         .catch(error => {
        //             console.error('There was an error fetching the data!', error);
        //         });
        // }
    }
};
</script>

<style scoped>
table {
    width: 100%;
    border-collapse: collapse;
}
table, th, td {
    border: 1px solid black;
}
th, td {
    padding: 8px;
    text-align: left;
}
</style>
