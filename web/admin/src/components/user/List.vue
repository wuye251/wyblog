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
            :row-key="record => record.login.uuid"
            :data-source="dataSource"
            :pagination="pagination"
            :loading="loading"
            :dataSource="userList"
            @change="handleTableChange"
        >
            <template #bodyCell="{ column, text }">
            <template v-if="column.dataIndex === 'name'">{{ text.first }} {{ text.last }}</template>
            </template>
        </a-table>
    </a-card>

</template>

<script>
import { defineComponent, reactive } from 'vue'
import { userList } from '@/api/user.js'
const columns = []
export default defineComponent({
    data() {
        return {
            userList: [],
            columns
        }
    },
    create() {
        getUserList()
    },
    methods: {
        getUserList() {
            userList(columns).then(res => {

            })
        }
    },
})
</script>