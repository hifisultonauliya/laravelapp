<template>
    <div>
        <b-container fluid="lg">
            <b-row class="filters">
                <b-col cols="3">
                    <v-select :options="['Canada', 'United States']"></v-select>
                </b-col>
                <b-col cols="3">
                    <v-select :options="['Canada', 'United States']"></v-select>
                </b-col>
                <b-col cols="3">
                    <v-select :options="['Canada', 'United States']"></v-select>
                </b-col>
                <b-col cols="3">
                    <v-select :options="['Canada', 'United States']"></v-select>
                </b-col>
            </b-row>
            <b-row class="btn-filter">
                <b-button variant="dark">Find</b-button>
            </b-row>
            <h1>Excel Data</h1>
            {{ data }}
            <!-- <table v-if="data.length">
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
            </table> -->
        </b-container>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            data: []
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/api/excel-data')
                .then(response => {
                    console.log("response", response)
                    this.data = response.data;
                })
                .catch(error => {
                    console.error('There was an error fetching the data!', error);
                });
        }
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
