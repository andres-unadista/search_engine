<template>
    <div class="appWrapper">
        <div class="container">
            <div class="search-box">
                <input type="text" name="query" class="search-input" placeholder="Escriba término de búsqueda" v-model="query" @input="search()" />
                <ul class="result-list" :class="showItems">
                    <li v-for="post in posts" class="result-item">
                        <a href="" class="result-link">
                            <div class="result-title">{{ post.title }}</div>
                            <div class="result-content">
                                {{ post.description }}
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Laboriosam tempora amet nisi delectus inventore quia vel atque
                nulla voluptatibus, maxime repudiandae, odit doloremque natus
                perspiciatis nobis perferendis enim error est!
            </p>
            <p>
                Recusandae nemo, neque beatae unde totam quas explicabo maxime
                cupiditate asperiores quibusdam porro id repudiandae harum
                corrupti aliquam temporibus odit ducimus eaque? Eos vel maxime
                veritatis nisi officia facilis aperiam?
            </p>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                query: "",
                showList: false,
                posts: []
            };
        },
        computed: {
            showItems() {
                return this.showList ? 'show' : 'hide';
            }
        },
        methods: {
            search() {
                if (this.query.length >= 3) {
                    axios
                        .post("/post/search", { q: this.query })
                        .then((res) => {
                            this.showList = true;
                            this.posts = res.data.posts;
                        })
                        .catch((err) => {
                            console.log(err.response);
                        });
                }
            },
        },
    };
</script>
<style>
    body {
        padding: 0;
        margin: 0;
        font-family: sans-serif;
        background: #1d976c;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #93f9b9, #1d976c);
        /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #93f9b9, #1d976c);
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    /* width */
    ::-webkit-scrollbar {
        width: 20px;
        border-radius: 7px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 7px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        border-radius: 7px;
        background: rgb(94, 93, 93);
        height: 80px!important;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        border-radius: 7px;
        background: #666565;
    }

    .container {
        padding: 30px;
    }

    .search-box {
        position: relative;
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .search-input {
        width: 40%;
        height: 30px;
        border-radius: 10px;
        border: 0;
        background: #eee;
        padding: 10px 20px;
        font-size: 1.2rem;
        outline: none;
    }

    .result-list.show {
        width: 43%;
        max-height: 250px;
        overflow-y: auto;
        list-style: none;
        background: #fff;
        padding: 0;
        top: 40px;
        border-radius: 10px;
        box-shadow: 1px 2px 8px 0px #b5b5b5;
        position: absolute;
    }

    .result-item {
        border-bottom: 1px solid rgb(192, 192, 192);
        padding: 10px 20px !important;
    }

    .result-list.hide {
        display: none;
    }

    .result-link {
        text-decoration: none;
    }

    .result-title {
        color: black;
        font-weight: 600;
        display: block;
        font-size: 18px;
    }

    .result-content {
        font-size: 18px;
        color: rgb(58, 57, 57);
    }
</style>
