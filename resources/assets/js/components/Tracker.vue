<template>
    <div class="tracker">
        <div class="tracker-heading">{{ coin.name + ' (' + coin.code + ')' }}</div>
        <div class="tracker-subtext">BTC: 1</div>
        <div class="tracker-subtext">USD: {{ coin.price }}</div>
        <div class="tracker-subtext">Apx. Value: 0</div>
        <input class="tracker-input" type="number" value="0">
        <div class="tracker-note">Source: {{ coin.provider }}</div>
    </div>
</template>

<script>
    export default {
        props: ['coin']
    }
</script>