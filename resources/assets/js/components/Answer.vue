<script>
    export default {
        props: ['answer'],

        data(){
            return{
                editing : false,
                body: this.answer.body,
                bodyHtml: this.answer.body_html
            }
        }
    }
</script>