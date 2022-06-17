<template>
    <div class="userList">
        <a-card>
            <!-- <a-row :gutter="20">
                <a-col 
                :span="3"
                @click="searchUser"
                >
                    <a-input-search
                        v-model="queryParam.username"
                        placeholder="输入用户名查找"
                        enter-button
                        allowClear
                        @search="searchUser"
                    />
                </a-col>
                <a-col :span="4">
                    <a-button type="primary">
                        <span>新增</span>
                    </a-button>
                </a-col>
            </a-row> -->
            <a-table
                :columns="columns" 
                :data-source="data" 
                @change="onChange"
                :row-key="username"
                :pagination="pagination"
                bordered
            >
            <template #bodyCell="{ column, text, record }">
                <template v-if="column.key === 'role'">
                    <template v-if="text === 1">
                        管理员
                    </template>
                    <template v-else>
                        订阅者
                    </template>
                </template>
                <!-- <template v-if="column.key === 'action'">
                    <a-button
                        type="primary"
                        style="margin-right: 50px"
                        @click="editUser(record.ID)"
                    >
                        编辑
                    </a-button>
                    <a-button
                        type="danger"
                        style="margin-right: 50px"
                        @click="deleteUser(record.ID)"
                    >
                        删除
                    </a-button>
                    <a-button 
                        type="info" 
                        @click="changePassword(record.ID)"
                    >
                        修改密码
                    </a-button>
                </template> -->
            </template>
            </a-table>
        </a-card>
    </div>
</template>

<script>
import { defineComponent, reactive, computed,ref } from 'vue'
import { userList, getUserById, deleteUserById, updateUserInfo} from '@/api/user.js'
import '../../assets/css/style.css'
import day from 'dayjs'
const columns = [
    {
        title: 'ID',
        dataIndex: 'ID',
        key:'ID',
        width:'5%',
        align: 'center',
    },
    {
        title: '用户名',
        dataIndex: 'username',
        key:'username',
        width:'15%',
        align: 'center',
    },
    {
        title: '身份',
        dataIndex: 'role',
        key:'role',
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
    // {
    //     dataIndex:'action',
    //     title: '操作',
    //     align: 'center',
    //     key:'action',
    // },

]
export default defineComponent({
    name: '',
    components: {},
    setup() {
        const editUser= ((id) => {
            const info = getUserById(id)
            console.log(info)
        })


        const deleteUser = ((id) => {
            const res = deleteUserById(id)
            console.log(res)
        })

        const changePassword = ((id, password) => {
            let param = {
                password: password
            }
            console.log(param)
            const res = updateUserInfo(id, param)
            console.log(res)
        })


        const searchUser = ((name) => {
            // // const { defaultCurrent, defaultPageSize } = this.pagination
            // //组装参数
            // let param = {  
            //     pageSize: this.queryParam.pageSize,  
            //     pageNum: this.queryParam.pageNum,
            //     searchname: name,
            // }
            // let res = userList(param);
            // const total = res.total
            // const records = res.data
            // this.pagination.total = total  
            // this.data = res.data

        })

        return {
            searchUser,
            editUser,
            deleteUser,
            changePassword,
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
                    this.getUserList()  //显示列表的接口名称  
                },  
                // 改变每页数量时更新显示  
                onChange: (current, size) => {  
                    this.pagination.defaultCurrent = current  
                    this.pagination.defaultPageSize = size  
                    this.getUserList()  
                } // 点击页码事件  
            } 
        }
    },
 
    created() {
        this.getUserList()
        console.log('created---', this.data)

    },
    methods: {
        async getUserList() {
            const { defaultCurrent, defaultPageSize } = this.pagination
            //组装参数
            const param = {  
                pageSize: defaultPageSize,  
                pageNum: defaultCurrent,
            }
            let res = await userList(param);
            console.log(res,'res')
            const total = res.total
            const records = res.data
            this.pagination.total = total  
            this.data = res.data
            console.log('this.data',this.data)
        },
    }
})
</script>