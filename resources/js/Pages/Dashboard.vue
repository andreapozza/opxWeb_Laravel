<template>
    <Main title="Dashboard">
        contenuto <br>
        <Link href="/setlocale/it">italiano</Link>
        &nbsp;
        <Link href="/setlocale/en">english</Link>
        &nbsp;
        {{ $page.props.locale }}
        <br><br><br>
        <button class="py-1 px-4 border border-black" @click="c--">-</button>
        {{ __(':num Page|:num Pages', {num: c}, c, true) }}
        <button class="py-1 px-4 border border-black" @click="c++">+</button>

    </Main>
</template>

<script>
import Main from '@/Components/Main.vue'
import { Link } from '@inertiajs/inertia-vue3'
export default {
    components: { Main, Link },
    data() {
        return {
            c: 0
        }
    }
}
</script>