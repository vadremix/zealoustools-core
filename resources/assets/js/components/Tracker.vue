<template>
    <div class="tracker">
        <div class="tracker-heading">{{ coin }}</div>
        <div class="tracker-subtext">BTC: 1</div>
        <div class="tracker-subtext">USD: 2502.58</div>
        <div class="tracker-subtext">Apx. Value: 2502.58</div>
        <input class="tracker-input" type="number" value="0">
        <div class="tracker-note">Source: Dummy</div>
    </div>
</template>

<script>
    export default {
        props: ['coin']
    }
</script>