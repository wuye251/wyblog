<template>
    <div class="container">
        <a-card>
            <a-form 
            :model="articleInfo"
            >
                <a-form-item>
                    <a-form-item label="文章标题">
                        <a-input style="width: 30%;" v-model:value="articleInfo.title"></a-input>
                    </a-form-item>
                    <a-form-item label="文章分类">
                        <a-select style="width:200px" v-model:value="articleInfo.categoryId" placeholder="请选择" @change="cateChange">
                            <a-select-option v-for="item in catagoryList" :key="item.ID" :value="item.ID">{{item.name}}</a-select-option>
                          </a-select>
                    </a-form-item>
                    <a-form-item label="文章描述">
                        <a-input type="textarea" v-model:value="articleInfo.desc"></a-input>
                    </a-form-item>
                    <a-form-item label="文章缩略图">
                        <a-upload
                            v-model:file-list="fileList"
                            name="file"
                            :action="uploadUrl"
                            :headers="headers"
                            @change="uploadChange"
                            @multiple="false"
                            :show-upload-list="false"
                        >
                            <a-button>
                            <upload-outlined></upload-outlined>
                            点击上传
                            </a-button>
                            <br>
                            <img v-if="imageUrl" :src="imageUrl" alt="avatar" style="width:150px;height: 150px"/>
                            <div v-else>
                                <loading-outlined v-if="loading"></loading-outlined>
                                <plus-outlined v-else></plus-outlined>
                            </div>
                        </a-upload>
                    </a-form-item>
                    <a-form-item label="文章内容">
                        <v-md-editor 
                          left-toolbar="undo redo | image"
                          v-model="articleInfo.content"       
                          :disabled-menus="[]"
                          @upload-image="handleUploadImage"
                          height="500px">
                        </v-md-editor>
                    </a-form-item>
                    <a-form-item>
                        <a-button type="danger" style="margin-right:15px" @click="submit">提交</a-button>
                        <a-button type="danger" style="margin-right:15px" @click="drafts">保存草稿</a-button>
                        <a-button type="primary" @click="$router.back()">取消</a-button>

                    </a-form-item>
                </a-form-item>
            </a-form>
        </a-card>
    </div>
</template>

<script>
import { UploadOutlined} from '@ant-design/icons-vue';
import { defineComponent, reactive, ref } from 'vue'
import { getList } from '@/api/category.js'
import { addArticle, getArticleInfo, updateArticle } from '@/api/article.js'
import { upload } from '@/api/upload.js'
import { getToken } from '@/utils/auth.js'
import { message } from 'ant-design-vue';
import router from '../../router'
import { useRoute} from 'vue-router'


export default defineComponent({
    name:'',
    components:{
        UploadOutlined,
        message,
    },
    setup () {
        const articleInfo = reactive({
                id:0,
                title:'',
                categoryId:undefined,
                desc:'',
                content:'',
                img:'',
        })

        const catagoryList = reactive([]);
        const getCateList = (() => {
            getList({pageSize:100, pageNum:1}).then(res => {
                catagoryList.push(...res.data)
            })
        })
        const cateChange = ((value) => {
            articleInfo.categoryId = value
            console.log('cateChange', articleInfo)

        })
        const imageUrl = ref('');

        const uploadChange = info => {
            console.log(info.file)
            if (info.file.status === 'uploading') {
                console.log('uploading')
                return;
            }

            if (info.file.status === 'done') {
                // Get this url from response in real world.
                console.log('done')
                imageUrl.value = info.file.response.data
                articleInfo.img = imageUrl.value
            }

            if (info.file.status === 'error') {
                loading.value = false;
                message.error('upload error');
            }
        }


        const uploadUrl = window.g.BASE_URL + '/api/v1/upload'
        const headers = {Authorization: `Bearea-Token ${getToken()}`}

        const submit = (() => {
            articleInfo.status = 2
            let res = add()
            console.log('submit',res)
        })

        const drafts = (() => {
            articleInfo.status = 1
            let res = add()
            console.log('drafts',res)

        })

        const add = (() => {
            let data = {
                title:articleInfo.title,
                desc: articleInfo.desc,
                content:articleInfo.content,
                categoryId:articleInfo.categoryId,
                status: articleInfo.status,
                img:articleInfo.img
            }
            if (articleInfo.id > 0) {
                //update
                updateArticle(articleInfo.id, data).then(res => {
                    if(res.code == 200) {
                        message.success("发布成功")
                        router.push('/article-list')
                    } else {
                        console.log('error')
                        message.error("发布失败")
                    }
                })
            } else {
                //add
                addArticle(data).then(res => {
                    if(res.code == 200) {
                        message.success("发布成功")
                        router.push('/article-list')
                    } else {
                        console.log('error')
                        message.error("发布失败")
                    }
                })
            }
            
        })
        const getRouteQuery = (() => {
            let route = useRoute() // 第一步
            let routeQuery = route.query // 第二步
            if (routeQuery.id > 0) {
                articleInfo.id = routeQuery.id
                getArticleInfo(articleInfo.id).then(res => {
                    let data = res.data
                    articleInfo.title = data.title
                    articleInfo.desc = data.desc
                    articleInfo.content = data.content
                    articleInfo.status = data.status
                    articleInfo.img = data.img
                    imageUrl.value = data.img
                    articleInfo.categoryId = data.categoryId
                    console.log('articleInfo',articleInfo)
                })
            }
        })
        return {
            imageUrl,
            uploadUrl,
            headers,
            text: '',
            catagoryList,
            articleInfo,
            getCateList,
            cateChange,
            uploadChange,
            submit,
            drafts,
            getRouteQuery,
        }
    },
    created() {
        this.getRouteQuery()
        this.getCateList()
    },
    methods: {
        handleUploadImage(event, insertImage, files) {
            // 拿到 files 之后上传到文件服务器，然后向编辑框中插入对应的内容
            let getFileInfo = files[0]
            upload(getFileInfo).then(res => {
                if(res.code == 200) {
                    insertImage({
                        url:
                            res.data,
                        desc: getFileInfo.name,
                        // width: 'auto',
                        // height: 'auto',
                    });
                } else {
                    message.error("上传失败")
                }
                
            })

        }
    },
})
</script>