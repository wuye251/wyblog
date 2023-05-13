<template>
    <div class="categoryList">
        <a-card>
            <a-row :gutter="20">
                <a-col :span="4">
                    <a-button type="primary" @click="addcategory=true">
                        <span>新增</span>
                    </a-button>
                </a-col>
            </a-row>
            <a-table
                :columns="columns" 
                :data-source="data" 
                @change="onChange"
                :row-key="category-name"
                :pagination="pagination"
                bordered
            >
            <template #bodyCell="{ column, text, record }">
                <template v-if="column.key === 'action'">
                    <a-button
                        type="primary"
                        style="margin-right: 50px"
                        @click="editcategory(record.ID)"
                    >
                        编辑
                    </a-button>
                    <a-button
                        type="danger"
                        style="margin-right: 50px"
                        @click="deletecategory(record.ID)"
                    >
                        删除
                    </a-button>

                </template>
            </template>
            </a-table>
        </a-card>
    </div>
    <a-modal
      closable
      title="新增分类"
      :visible="addcategory"
      width="60%"
      @ok="addCateOk"
      @cancel="addCateCancel"
      destroyOnClose
    >
      <a-form-model v-model="newCate">
        <a-form-model-item label="分类名称" prop="name">
          <a-input v-model:value="newCate.name"></a-input>
        </a-form-model-item>
        <a-form-model-item label="序号" prop="sort">
            <a-input v-model:value="newCate.sort"></a-input>
          </a-form-model-item>  
      </a-form-model>
    </a-modal>

    <!-- 编辑分类区域 -->
    <a-modal
        closable
        :visible="editCateVisible"
        title="编辑分类"
        ok-text="确认"
        cancel-text="取消"
        @ok="editCateOk"
        @cancel="editCateCancel"
        destroyOnClose
        width="60%"
    >
      <a-form-model :model="newCate" ref="addCateRef">
        <a-form-model-item label="分类名称" prop="name">
          <a-input v-model:value="newCate.name"></a-input>
        </a-form-model-item>
        <a-form-model-item label="序号" prop="sort">
            <a-input v-model:value="newCate.sort"></a-input>
        </a-form-model-item>  
      </a-form-model>
    </a-modal>
</template>

<script>
import { inject, createVNode, defineComponent, reactive, computed,ref } from 'vue'
import { getList,add, deletecategoryById, getCategoryById, updateCategoryInfo } from '@/api/category.js'
import '../../assets/css/style.css'
import day from 'dayjs'
import { Modal,message } from 'ant-design-vue';
import { ExclamationCircleOutlined } from '@ant-design/icons-vue';
import MyForm from '@/components/common/MyForm.vue'
const columns = [
    {
        title: '权重',
        dataIndex: 'sort',
        key:'sort',
        width:'5%',
        align: 'center',
    },
    {
        title: '分类',
        dataIndex: "name",
        key:'name',
        width:'15%',
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
        dataIndex:'action',
        title: '操作',
        align: 'center',
        key:'action',
        width:'15%',
    },

]
export default defineComponent({
    name:'',
    components:{
        message,
        MyForm,
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
            },
            newCate: reactive({name:""}), 
            addcategory: false,
            editCateVisible: false,
        }
    },
    created() {
        this.list()
        // console.log('created---', this.data)
    },
    methods: {
        async list() {
            const { defaultCurrent, defaultPageSize } = this.pagination
            //组装参数
            const param = {  
                pageSize: defaultPageSize,  
                pageNum: defaultCurrent,
            }
            let res = await getList(param);
            console.log(res,'res')
            const total = res.total
            const records = res.data
            this.pagination.total = total  
            this.data = res.data
            console.log('this.data',this.data)
        },

        // 新增分类
        addCateOk() {
            let param = {
                "name": this.newCate.name,
                "sort": this.newCate.sort,
            }
            add(param).then(res => {
                if (res.code != 200) return this.$message.error(res.message)
                this.addcategory = false
                this.$message.success('添加分类成功')
                this.newCate.name = ''
                this.list()
            })

        },
        addCateCancel() {

            console.log("addCateCancel")
            this.addcategory = false
            this.$message.info('新增分类已取消')
            this.newCate.name = ''
        },
        // 编辑分类
        editcategory(id) {
             getCategoryById(id).then(res => {
                if (res.code != 200) return this.$message.error(res.message)
                this.newCate = res.data
                console.log(' this.newCate',this.newCate)
            })

            this.editCateVisible = true
        },

        editCateOk() {
            let param = {
                "name": this.newCate.name,
                "sort": this.newCate.sort,
            }
            updateCategoryInfo(this.newCate.ID, param).then(res => {
                if (res.code != 200) return this.$message.error(res.message)
                this.editCateVisible = false
                this.$message.success('更新分类信息成功')
                this.newCate = {name:''}
                this.list()
            })
        },
        editCateCancel() {
            this.editCateVisible = false
            this.newCate = {name:''}
            this.$message.info('编辑已取消')
        },



        deletecategory(id) {
            const that = this // 提前保存this
            Modal.confirm({
                title: '确定删除该分类?',
                icon: createVNode(ExclamationCircleOutlined),
                content: createVNode('div', {style: 'color:red;',}, 'Some descriptions'),
                cancelText: "取消",

                onOk() {
                    console.log('OK');
                    deletecategoryById(id).then(res => {
                        if (res.code == 200) {
                            message.success("删除成功");
                            that.list()
                        } else {
                            message.error('删除失败');
                        }

                    })
                },
                onCancel() {
                    console.log('Cancel');
                },

            });
        },
    }
})
</script>