<template>
    <div>
          <span class="text-muted">
              Questioned  {{ postDate}}
          </span>
        <div class="media">
            <a class="pr-2" :href="user.url">
                <img :src="user.avatar">
            </a>
            <div class="media-body">
                <a :href="user.url">
                    {{user.name}}
                </a>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props:['label', 'model'],
        computed:{
            postDate(){
                return this.label + " "+this.model.create_date;
            }
        },
        data(){
            return{
                user:this.model.user
            }
        }
    }
</script>