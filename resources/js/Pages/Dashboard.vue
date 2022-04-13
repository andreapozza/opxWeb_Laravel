<template>
    <Main title="Dashboard">
        contenuto
        <Link href="/setlocale/it">italiano</Link>
        &nbsp;
        <Link href="/setlocale/en">english</Link>
        &nbsp;
        {{ $page.props.locale }}

    </Main>
</template>

<script>
import Main from '@/Components/Main.vue'
import { Link } from '@inertiajs/inertia-vue3'
export default {
    components: { Main, Link }
}
</script>