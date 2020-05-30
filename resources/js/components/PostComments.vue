<template>
    <div>
        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title font-weight-bold">Leave a reply</h4>
                <form @submit.prevent="submit">
                    <div class="form-group">
                        <textarea name="comment" id="comment" rows="4" v-model="formComment"
                                  placeholder="Your comment..."
                                  class="form-control"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">POST COMMENT</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div v-if="comments.length <= 0" class="alert alert-info mb-0" role="alert">
                    There's no comments yet, you can be the first!
                </div>
                <div v-for="(comment) in comments" class="media mb-3">
                    <img src="https://via.placeholder.com/70"
                         class="align-self-start mr-3 rounded-circle"
                         :alt="comment.user.name">
                    <div class="media-body">
                        <h5 class="mt-0 font-weight-bold" :class="author === comment.user.id ? 'text-danger' : ''">
                            {{ comment.user.name }}</h5>
                        <p class="mb-3">{{ comment.content }}</p>
                        <p class="text-right text-muted mb-0"><small>{{ comment.created_at }}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PostComments",
        props: [
            'commentsData',
            'authorId',
            'postId'
        ],
        methods: {
            submit() {
                let formData = new FormData();
                formData.append('content', this.formComment);
                formData.append('post_id', this.post);
                formData.append('_token', this.csrf);
                axios.post('/comments', formData).then(response => {
                    console.log('success')
                }).catch(error => {
                    console.log(error)
                });
            }
        },
        data() {
            return {
                csrf: '',
                comments: [],
                author: 0,
                formComment: '',
                post: 0
            }
        },
        mounted() {
            this.csrf = document.querySelector('meta[name="csrf-token"]').content;
            this.comments = this.commentsData;
            this.author = this.authorId;
            this.post = this.postId;
        }
    }
</script>

<style scoped>

</style>
