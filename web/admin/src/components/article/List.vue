<template>
    <div class="userList">
        文章列表页面
        <a-card>
            <a-row :gutter="20">
                <a-col 
                :span="5"
                @click="searchUser"
                >
                    <a-input-search
                        v-model="queryParam.articlename"
                        placeholder="输入文章名查找"
                        enter-button
                        allowClear
                        @search="searchUser"
                    />
                </a-col>
                <a-col :span="4">
                    <a-button type="primary" @click="addArticle">
                        <span>新增</span>
                    </a-button>
                </a-col>
            </a-row>
            <a-table
                :columns="columns" 
                :data-source="data" 
                @change="onChange"
                :row-key="article-name"
                :pagination="pagination"
                bordered
            >
            <template #bodyCell="{ column, text, record }">
                <template v-if="column.key === 'desc'">
                    <span class="desc">{{record.desc}}</span>
                </template>
                <template v-if="column.key === 'name'">
                    {{record.Category.name}}
                </template>
                <template v-if="column.key === 'img'">
                    <img  style="width:250px;heigth:250px" :src=text />
                </template>
                <template v-if="column.key === 'status'">
                    <template v-if="text === 1">
                        草稿
                    </template>
                    <template v-else-if="text === 2">
                        已发布
                    </template>
                    <template v-else-if="text === 3">
                        已删除
                    </template>
                </template>
                <template v-if="column.key === 'action'">
                    <div class="operate">
                        <a-button
                        type="primary"
                        @click="editArticle(record.ID)"
                        >
                            编辑
                        </a-button>
                        <!-- <a-button
                            type="danger"
                            style="margin-right: 50px"
                            @click="deleteArticle(record.ID)"
                        >
                            删除
                        </a-button> -->
                        <a-button v-if="record.status == 1"
                        type="Primary"
                        @click="editArticle(record.ID)"
                        style="margin-top: 16px;"
                        >
                            发布
                        </a-button>
                        <a-button v-else
                        type="dashed"
                        @click="editArticle(record.ID)"
                        style="margin-top: 16px;"
                        >
                            暂存草稿
                        </a-button>

                    </div>

                </template>
            </template>
            </a-table>
        </a-card>
    </div>
</template>

<script>
import { inject, createVNode, defineComponent, reactive, computed,ref } from 'vue'
import { articleList, deleteArticleById } from '@/api/article.js'
import '../../assets/css/style.css'
import day from 'dayjs'
import router from '../../router'
import { Modal,message } from 'ant-design-vue';
import { ExclamationCircleOutlined } from '@ant-design/icons-vue';

const columns = [
    {
        title: 'ID',
        dataIndex: 'ID',
        key:'ID',
        width:'5%',
        align: 'center',
    },
    {
        title: '分类',
        dataIndex: "Category.name",
        key:'name',
        width:'5',
        align: 'center',
    },
    {
        title: '文章标题',
        dataIndex: 'title',
        key:'title',
        width:'10%',
        align: 'center',
    },
    {
        title: '文章描述',
        dataIndex: 'desc',
        key:'desc',
        width:'20%',
        align: 'center',
    },
    {
        title: '文章缩略图',
        dataIndex: 'img',
        key:'img',
        width:'10%',
        align: 'center',
    },
    {
        title: '创建时间',
        dataIndex: 'CreatedAt',
        key:'createdAt',
        width:'10%',
        key: 'CreatedAt',
        customRender: (val) => {
            return val.value ? day(val.value).format('YYYY/MM/DD HH:mm') : '暂无'
        },
        align: 'center',
    },
    {
        title: '更新时间',
        dataIndex: 'UpdatedAt',
        key:'updateAt',
        width:'10%',
        customRender: (val) => {
            return val.value ? day(val.value).format('YYYY/MM/DD HH:mm') : '暂无'
        },
        align: 'center',
    },
    {
        title: '状态',
        dataIndex: 'status',
        key:'status',
        width:'10%',
        align: 'center',
    },
    {
        dataIndex:'action',
        title: '操作',
        align: 'center',
        key:'action',
        width: '5%'
    },

]
export default defineComponent({
    name:'',
    components:{
        message,
    },
    setup() {

        // const editUser= ((id) => {
        //     const info = getUserById(id)
        //     console.log(info)
        // })


        // const deleteUser = ((id) => {
        //     const res = deleteUserById(id)
        //     console.log(res)
        // })

        // const changePassword = ((id, password) => {
        //     let param = {
        //         password: password
        //     }
        //     console.log(param)
        //     const res = updateUserInfo(id, param)
        //     console.log(res)
        // })


        // const searchUser = ((name) => {
        //     // // const { defaultCurrent, defaultPageSize } = this.pagination
        //     // //组装参数
        //     // let param = {  
        //     //     pageSize: this.queryParam.pageSize,  
        //     //     pageNum: this.queryParam.pageNum,
        //     //     searchname: name,
        //     // }
        //     // let res = userList(param);
        //     // const total = res.total
        //     // const records = res.data
        //     // this.pagination.total = total  
        //     // this.data = res.data

        // })

        return {
            // searchUser,
            // editUser,
            // deleteUser,
            // changePassword,
        }
    },
    data() {
        return {
            columns,
            data:[],
            queryParam: {
                username: '',
                pagesize: 5,
                pagenum: 1,
                status:0,
            },
            pagination: {  
                defaultCurrent: 1,  // 默认当前页数  
                defaultPageSize: 5,   // 默认当前页显示数据的大小  
                total: 0, // 总数，必须先有  
                showSizeChanger: true,  
                showQuickJumper: true,  
                pageSizeOptions: ['5','10'],  
                showTotal: total => `共 ${total} 条`, // 显示总数  
                onShowSizeChange: (current, pageSize) => {  
                    this.pagination.defaultCurrent = 1  
                    this.pagination.defaultPageSize = pageSize  
                    this.list()  //显示列表的接口名称  
                },  
                // 改变每页数量时更新显示  
                onChange: (current, size) => {  
                    this.pagination.defaultCurrent = current  
                    this.pagination.defaultPageSize = size  
                    this.list()  
                } // 点击页码事件  
            } 
        }
    },
    created() {
        this.list()
        console.log('created---', this.data)

    },
    methods: {
        async list() {
            const { defaultCurrent, defaultPageSize } = this.pagination
            //组装参数
            const param = {  
                pageSize: defaultPageSize,  
                pageNum: defaultCurrent,
            }
            let res = await articleList(param);
            console.log(res,'res')
            const total = res.total
            const records = res.data
            this.pagination.total = total  
            this.data = res.data
            console.log('this.data',this.data)
        },

        addArticle() {
            router.push('/add-article')
        },

        editArticle(id) {
            router.push({path: '/add-article',query: {id:id}})
        },

        deleteArticle(id) {
            Modal.confirm({
                title: '确定删除该文章?',
                icon: createVNode(ExclamationCircleOutlined),
                content: createVNode('div', {
                style: 'color:red;',
                }, 'Some descriptions'),

                onOk() {
                    console.log('OK');
                    // deleteArticleById(id).then(res => {
                        // if (res.code == 200) {
                            message.success("删除成功");
                            // inject("reload")

                            // const reload = inject('reload') //注入刷新事件,这里括号中的参数要对应上前面provide中的第一个参数
                            // reload()
                        // } else {
                        //     message.error('删除失败');
                        // }

                    // })
                },

                onCancel() {
                    console.log('Cancel');
                },
            });
        },
    }
})
</script>


<style>
.desc {
    margin: 0 0 8px;
    font-size: 13px;
    line-height: 24px;
    color: #999;
}
.operate {
    display: flex;
    flex-direction: column;
}
</style>