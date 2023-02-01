<template>
    <div class="hero-card">
        <img :src="hero.thumbnail.path + '.' + hero.thumbnail.extension" alt="Hero Image">
        <h3>{{ hero.name }}</h3>
        <p>{{ hero.description }}</p>
        <button @click="voteForHero">Vote</button>
    </div>
</template>

<script>
export default {
    props: {
        hero: Object
    },
    methods: {
        voteForHero() {
            // Add code to make API call to persist the vote for this hero
        }
    }
}
</script>

<style>
.hero-card {
    width: 300px;
    height: 400px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 2px 2px 5px #ccc;
    overflow: hidden;
    margin-bottom: 20px;
    text-align: center;
}

.hero-card img {
    width: 100%;
    height: 60%;
}

.hero-card h3 {
    font-size: 22px;
    margin-top: 20px;
}

.hero-card p {
    font-size: 16px;
    margin: 20px;
    text-align: justify;
}
</style>