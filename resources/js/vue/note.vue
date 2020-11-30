<el-timeline>
@foreach($notes as $k => $v)
<el-timeline-item timestamp="{{$v['updated_at']}}" placement="top">
  <el-card>
    <p>$v['content']</p>
  </el-card>
</el-timeline-item>
@endforeach
</el-timeline>

