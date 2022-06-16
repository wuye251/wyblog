<template>
    <div>
        用户列表页面
    </div>
    <a-card>
        <a-row :gutter="20">
            <a-col :span="3">
                <a-input-search placeholder="Input username" enter-button>
                </a-input-search>
            </a-col>
            <a-col :span="4">
                <a-button type="primary">
                    <span>新增</span>
                </a-button>
            </a-col>
        </a-row>
        <a-table 
            :columns="columns" 
            :data-source="data" 
            @change="onChange"
            :row-key="username"
            :pagination="pagination"
            bordered
         />
    </a-card>

</template>

<script>
import { defineComponent, reactive, computed,ref } from 'vue'
import { userList } from '@/api/user.js' 
import day from 'dayjs'
const columns = [
    {
        title: 'ID',
        dataIndex: 'ID',
        width:'10%',
        align: 'center',
    },
    {
        title: '用户名',
        dataIndex: 'username',
        width:'10%',
        align: 'center',
    },
    {
        title: '身份',
        dataIndex: 'role',
        width:'10%',
        align: 'center',
    },
    {
        title: '创建时间',
        dataIndex: 'CreatedAt',
        width:'10%',
        key: 'CreatedAt',
        customRender: (val) => {
            return val ? day(val.CreatedAt).format('YYYY/MM/DD HH:mm') : '暂无'
        },
        align: 'center',
    },
    {
        title: '更新时间',
        dataIndex: 'UpdatedAt',
        width:'10%',
        customRender: (val) => {
            return val ? day(val.UpdatedAt).format('YYYY/MM/DD HH:mm') : '暂无'
        },
        align: 'center',
    },
    {
        title: '操作',
        align: 'center',
    },

]
export default defineComponent({

    data() {
        return {
            columns,
            data:[],
            pagination: {  
                defaultCurrent: 1,  // 默认当前页数  
                defaultPageSize: 5,   // 默认当前页显示数据的大小  
                total: 0, // 总数，必须先有  
                showSizeChanger: true,  
                showQuickJumper: true,  
                pageSizeOptions: ['5','10', '20', '30'],  
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