<template>
    <div>
        <div v-for="message in messages">
            <strong>{{ message.user.name }}: </strong>
            <span>{{ message.message }}</span>
        </div>
    </div>
    <form @submit.prevent="send">
        <input type="text" v-model="form.message" placeholder="Send a message" required>
        <button type="submit">Send</button>
    </form>
</template>

<script>
export default {
    name: 'Messages',
    data() {
        return {
            messages: [],
            form: {
                message: '',
            },
            token: '',
        };
    },
    methods: {
        async send() {
            const headers = {Authorization: this.token};
            try {
                await axios.post('/api/messages/send', this.form, {headers});

                this.form.message = '';
            } catch (e) {
                console.error(e);
            }
        },
        async all() {
            const headers = {Authorization: this.token};
            try {
                const {data: {messages}} = await axios.get('/api/messages', {headers});
                this.messages = messages;

                Echo.join('message')
                    .listen('MessageEvent', ({message}) => {
                        this.messages.push(message);
                    });
            } catch (e) {
                console.error(e);
            }
        },
    },
    mounted() {
        const token = localStorage.getItem('laravel-realtime-chat');

        token ? (this.token = token) : this.$router.push('/login');

        this.all();
    },
};
</script>

<style scoped>

</style>
