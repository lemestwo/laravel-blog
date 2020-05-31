<template>
    <div>
        <div class="card mb-3">
            <div v-if="isAuth" class="card-body">
                <h4 class="card-title font-weight-bold">Leave a reply</h4>
                <form @submit.prevent="submit">
                    <div class="form-group">
                        <textarea name="content" id="content" rows="4" v-model="formComment"
                                  placeholder="Your comment..."
                                  class="form-control"
                                  :class="hasError('content') ? 'is-invalid' : ''"
                                  @keydown="clearError('content')" required></textarea>
                        <span class="invalid-feedback" v-text="getError('content')" role="alert"></span>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" :disabled="isLoading">
                            <span v-if="isLoading" class="spinner-grow spinner-grow-sm" role="status"
                                  aria-hidden="true">
                            </span>
                            POST COMMENT
                        </button>
                    </div>
                </form>
            </div>

            <div v-else class="alert alert-info mb-0" role="alert">
                You need to login to comment.
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div v-if="!hasComments" class="alert alert-info mb-0" role="alert">
                    There's no comments yet, you can be the first!
                </div>
                <div v-for="(comment, index) in post.comments" class="media mb-3">
                    <img src="https://via.placeholder.com/70"
                         class="align-self-start mr-3 rounded-circle"
                         :alt="comment.user.name">
                    <div class="media-body">
                        <h5 class="mt-0 font-weight-bold"
                            :class="post.user.id === comment.user.id ? 'text-danger' : ''">
                            {{ comment.user.name }}</h5>
                        <p class="mb-3" v-html="comment.content"></p>
                        <p class="text-right text-muted mb-0">
                            <small>
                                <span v-if="comment.user.id === authData.id">
                                    <a v-on:click.prevent="deleteComment(comment.id, index)"
                                       :href="isCommentLoading(comment.id) ? '#' : false">
                                        Delete
                                    </a>
                                    -
                                </span>
                                {{ comment.created_at }}
                            </small>
                        </p>
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
            'postData',
            'authCheck'
        ],
        methods: {
            hasError(field) {
                return this.errors[field] != null;
            },
            getError(field) {
                return this.errors[field] ? this.errors[field][0] : '';
            },
            clearError(field) {
                this.errors[field] = null;
            },
            isCommentLoading(id) {
                return this.loadingComments[id] !== true;
            },
            submit() {
                this.isLoading = true;
                let formData = new FormData();
                formData.append('content', this.formComment);
                formData.append('post_id', this.post.id);
                formData.append('_token', this.csrf);
                axios.post('/comments', formData).then(response => {
                    this.isLoading = false;
                    this.formComment = '';
                    this.hasComments = true;
                    this.post = response.data[0];
                }).catch(error => {
                    this.isLoading = false;
                    this.errors = error.response.data.errors;
                });
            },
            deleteComment(id, index) {
                if (confirm('Are you sure?')) {
                    this.loadingComments[id] = true;
                    axios.delete('/comments/' + id).then(() => {
                        this.loadingComments[id] = false;
                        this.post.comments.splice(index, 1);
                    }).catch(() => {
                        this.loadingComments[id] = false;
                    });
                }
            }
        },
        data() {
            return {
                csrf: '',
                post: [],
                hasComments: false,
                formComment: '',
                isAuth: false,
                authData: null,
                isLoading: false,
                loadingComments: [],
                errors: []
            }
        },
        mounted() {
            this.csrf = document.querySelector('meta[name="csrf-token"]').content;
            this.post = this.postData;
            this.hasComments = this.post.comments.length > 0;
            this.authData = this.authCheck;
            this.isAuth = this.authData.id === 0 ? false : true;

        }
    }
</script>

<style scoped>

</style>
