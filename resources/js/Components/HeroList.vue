<template>
    <div class="hero-list">
        <HeroCard v-for="hero in heroes" :hero="hero" :key="hero.id"></HeroCard>
    </div>
</template>

<script>
import HeroCard from '@/Components/HeroCard.vue';
import axios from 'axios';
import CryptoJS from 'crypto-js';
var timestamp = new Date().getTime();
var hash = CryptoJS.MD5(timestamp + "cbd53fbde77140ab88d30959a7cb1b52b33c6f29" + "7a64612a721a4da481921fb8f58b906d");

export default {
    components: {
        HeroCard
    },
    data() {
        return {
            heroes: []
        }
    },
    mounted() {
        axios.get('https://gateway.marvel.com/v1/public/characters', {
            params: {
                apikey:  "7a64612a721a4da481921fb8f58b906d",
                ts: timestamp,
                hash: hash,
            }
        })
        .then(response => {
            this.heroes = response.data.data.results;
        })
        .catch(error => {
            console.log(error);
        });
    }
}
</script>

<style>
.hero-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
</style>