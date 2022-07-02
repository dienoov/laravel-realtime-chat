<template>
    <form @submit.prevent="login">
        <input type="email" v-model="form.email" placeholder="Email" required>
        <input type="password" v-model="form.password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</template>

<script>
export default {
    name: 'Login',
    data() {
        return {
            form: {
                email: '',
                password: '',
            },
        };
    },
    methods: {
        async login() {
            try {
                const {data: {user}} = await axios.post('/api/auth/login', this.form);
                localStorage.setItem('laravel-realtime-chat', user.token);
                this.$router.push('/');
            } catch (e) {
                console.error(e);
            }
        },
    },
};
</script>

<style scoped>

</style>
